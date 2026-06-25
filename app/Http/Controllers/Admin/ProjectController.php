<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectDocument;
use App\Models\ProjectFaq;
use App\Models\ProjectGallery;
use App\Models\ProjectMilestone;
use App\Models\Vendor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::with('vendor')->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function show(Project $project): View
    {
        $project->load(['vendor', 'galleries', 'milestones', 'documents', 'faqs', 'investments']);
        return view('admin.projects.show', compact('project'));
    }

    public function create(): View
    {
        $vendors = Vendor::with('user')->where('is_verified', true)->get();
        return view('admin.projects.create', compact('vendors'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'mining_type' => 'nullable|string|max:255',
            'total_capital' => 'required|numeric|min:0',
            'min_investment' => 'required|numeric|min:0',
            'investment_type' => 'required|in:single,multi',
            'investor_share' => 'required|numeric|min:0|max:100',
            'vendor_share' => 'required|numeric|min:0|max:100',
            'duration_months' => 'required|integer|min:1',
            'risk_level' => 'required|in:rendah,sedang,tinggi',
            'permit_status' => 'nullable|string|max:255',
            'luas_lahan' => 'nullable|string|max:255',
            'status' => 'required|in:draft,pending,fundraising,in_progress,completed,rejected',
            'cover_image' => 'nullable|image|max:2048',
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        $project = Project::create($validated);

        $this->syncGalleries($request, $project);
        $this->syncMilestones($request, $project);
        $this->syncDocuments($request, $project);
        $this->syncFaqs($request, $project);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dibuat.');
    }

    public function edit(Project $project): View
    {
        $vendors = Vendor::with('user')->where('is_verified', true)->get();
        $project->load(['galleries', 'milestones', 'documents', 'faqs']);

        $milestonesJson = $project->milestones->map(fn($m) => [
            'phase_name' => $m->phase_name,
            'description' => $m->description,
            'target_date' => $m->target_date ? $m->target_date->format('Y-m-d') : '',
            'is_completed' => (bool) $m->is_completed,
        ]);

        $faqsJson = $project->faqs->map(fn($f) => [
            'question' => $f->question,
            'answer' => $f->answer,
        ]);

        $existingGalleriesJson = $project->galleries->map(fn($g) => [
            'id' => $g->id,
            'url' => asset('storage/' . $g->image),
            'caption' => $g->caption,
        ]);

        return view('admin.projects.edit', compact('project', 'vendors', 'milestonesJson', 'faqsJson', 'existingGalleriesJson'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'vendor_id' => 'required|exists:vendors,id',
            'title' => 'required|string|max:255',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'mining_type' => 'nullable|string|max:255',
            'total_capital' => 'required|numeric|min:0',
            'min_investment' => 'required|numeric|min:0',
            'investment_type' => 'required|in:single,multi',
            'investor_share' => 'required|numeric|min:0|max:100',
            'vendor_share' => 'required|numeric|min:0|max:100',
            'duration_months' => 'required|integer|min:1',
            'risk_level' => 'required|in:rendah,sedang,tinggi',
            'permit_status' => 'nullable|string|max:255',
            'luas_lahan' => 'nullable|string|max:255',
            'status' => 'required|in:draft,pending,fundraising,in_progress,completed,rejected',
            'cover_image' => 'nullable|image|max:2048',
            'started_at' => 'nullable|date',
            'ended_at' => 'nullable|date',
        ]);

        if ($request->title !== $project->title) {
            $slug = Str::slug($request->title);
            $originalSlug = $slug;
            $counter = 1;
            while (Project::where('slug', $slug)->where('id', '!=', $project->id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $validated['slug'] = $slug;
        }

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        $project->update($validated);

        $this->syncGalleries($request, $project);
        $this->syncMilestones($request, $project);
        $this->syncDocuments($request, $project);
        $this->syncFaqs($request, $project);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function investors(Project $project): View
    {
        $project->load('vendor');
        $investments = $project->investments()
            ->with('lender')
            ->latest()
            ->get();

        $totalCollected = $investments->sum('amount');

        $investments->each(function ($inv) use ($totalCollected, $project) {
            $inv->ownership_pct = $totalCollected > 0
                ? round(($inv->amount / $totalCollected) * 100, 2)
                : 0;
            $inv->estimated_share_pct = $totalCollected > 0
                ? round(($inv->amount / $totalCollected) * $project->investor_share, 2)
                : 0;
        });

        return view('admin.projects.investors', compact('project', 'investments', 'totalCollected'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }

    private function syncGalleries(Request $request, Project $project): void
    {
        $removeIds = $request->input('remove_gallery_ids', []);
        if (!empty($removeIds)) {
            $project->galleries()->whereIn('id', $removeIds)->delete();
        }

        $existingIds = $request->input('existing_gallery_ids', []);
        $project->galleries()->whereNotIn('id', $existingIds)->delete();

        $replacedImages = $request->file('replaced_gallery_images', []);
        foreach ($replacedImages as $galleryId => $file) {
            $gallery = $project->galleries()->find($galleryId);
            if ($gallery) {
                $path = $file->store('projects/galleries', 'public');
                $gallery->update(['image' => $path]);
            }
        }

        if (!$request->hasFile('galleries')) {
            return;
        }

        $order = 0;
        foreach ($request->file('galleries', []) as $index => $file) {
            $path = $file->store('projects/galleries', 'public');
            $project->galleries()->create([
                'image' => $path,
                'caption' => $request->input("galleries_caption.$index"),
                'order' => $order++,
            ]);
        }
    }

    private function syncMilestones(Request $request, Project $project): void
    {
        $project->milestones()->delete();

        $phases = $request->input('milestones', []);
        foreach ($phases as $i => $milestone) {
            if (empty($milestone['phase_name'])) continue;
            $project->milestones()->create([
                'phase_name' => $milestone['phase_name'],
                'description' => $milestone['description'] ?? null,
                'target_date' => $milestone['target_date'] ?? null,
                'is_completed' => isset($milestone['is_completed']),
                'order' => $i,
            ]);
        }
    }

    private function syncDocuments(Request $request, Project $project): void
    {
        $removeIds = $request->input('remove_doc_ids', []);
        if (!empty($removeIds)) {
            $project->documents()->whereIn('id', $removeIds)->delete();
        }

        foreach ($request->file('documents', []) as $i => $file) {
            $path = $file->store('projects/documents', 'public');
            $project->documents()->create([
                'name' => $request->input("document_names.$i"),
                'file' => $path,
                'type' => $request->input("document_types.$i", 'other'),
            ]);
        }
    }

    private function syncFaqs(Request $request, Project $project): void
    {
        $project->faqs()->delete();

        $faqs = $request->input('faqs', []);
        foreach ($faqs as $i => $faq) {
            if (empty($faq['question'])) continue;
            $project->faqs()->create([
                'question' => $faq['question'],
                'answer' => $faq['answer'],
                'order' => $i,
            ]);
        }
    }
}
