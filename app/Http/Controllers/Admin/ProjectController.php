<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
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
            'investment_type' => 'required|in:single,multiple',
            'investor_share' => 'required|numeric|min:0|max:100',
            'vendor_share' => 'required|numeric|min:0|max:100',
            'duration_months' => 'required|integer|min:1',
            'risk_level' => 'required|in:low,medium,high',
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

        Project::create($validated);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dibuat.');
    }

    public function edit(Project $project): View
    {
        $vendors = Vendor::with('user')->where('is_verified', true)->get();
        return view('admin.projects.edit', compact('project', 'vendors'));
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
            'status' => 'required|in:draft,pending,fundraising,in_progress,completed,failed',
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

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
