<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectFaq;
use App\Models\ProjectMilestone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $vendor = auth()->user()->vendor;

        $projects = Project::where('vendor_id', $vendor?->id)
            ->withCount('investments')
            ->latest()
            ->paginate(15);

        return view('vendor.projects.index', compact('projects'));
    }

    public function create(): View
    {
        return view('vendor.projects.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $vendor = auth()->user()->vendor;

        if (!$vendor) {
            return redirect()->route('vendor.projects.index')
                ->with('error', 'Profil vendor belum lengkap.');
        }

        $validated = $request->validate([
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
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $counter = 1;
        while (Project::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }
        $validated['slug'] = $slug;
        $validated['vendor_id'] = $vendor->id;
        $validated['status'] = 'draft';

        if ($request->hasFile('cover_image')) {
            $validated['cover_image'] = $request->file('cover_image')->store('projects/covers', 'public');
        }

        $project = Project::create($validated);

        $this->syncMilestones($request, $project);
        $this->syncFaqs($request, $project);

        return redirect()->route('vendor.projects.index')
            ->with('success', 'Proyek berhasil dibuat sebagai draft.');
    }

    public function edit(Project $project): View
    {
        $vendor = auth()->user()->vendor;

        if ($project->vendor_id !== $vendor?->id) {
            abort(403);
        }

        return view('vendor.projects.edit', compact('project'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $vendor = auth()->user()->vendor;

        if ($project->vendor_id !== $vendor?->id) {
            abort(403);
        }

        $validated = $request->validate([
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
            'cover_image' => 'nullable|image|max:2048',
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

        $this->syncMilestones($request, $project);
        $this->syncFaqs($request, $project);

        return redirect()->route('vendor.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $vendor = auth()->user()->vendor;

        if ($project->vendor_id !== $vendor?->id) {
            abort(403);
        }

        if (!in_array($project->status, ['draft', 'pending'])) {
            return redirect()->route('vendor.projects.index')
                ->with('error', 'Hanya proyek dengan status draft atau pending yang dapat dihapus.');
        }

        $project->delete();

        return redirect()->route('vendor.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }

    public function submit(Project $project): RedirectResponse
    {
        $vendor = auth()->user()->vendor;

        if ($project->vendor_id !== $vendor?->id) {
            abort(403);
        }

        if ($project->status !== 'draft') {
            return redirect()->route('vendor.projects.index')
                ->with('error', 'Hanya proyek draft yang dapat diajukan.');
        }

        $project->update(['status' => 'pending']);

        return redirect()->route('vendor.projects.index')
            ->with('success', 'Proyek berhasil diajukan untuk review.');
    }

    private function syncMilestones(Request $request, Project $project): void
    {
        $project->milestones()->delete();

        $phases = $request->input('milestones', []);
        foreach ($phases as $i => $milestone) {
            if (empty($milestone['title'])) continue;
            $project->milestones()->create([
                'phase_name' => $milestone['title'],
                'description' => $milestone['description'] ?? null,
                'target_date' => $milestone['date'] ?? $milestone['target_date'] ?? null,
                'is_completed' => isset($milestone['is_completed']),
                'order' => $i,
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
