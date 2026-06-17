<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LandingPageContent;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LandingPageController extends Controller
{
    public function index(): View
    {
        $sections = LandingPageContent::orderBy('section_key')->get();
        return view('admin.landing-page.index', compact('sections'));
    }

    public function update(Request $request, LandingPageContent $landingPageContent): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|max:2048',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('landing-page', 'public');
        }

        $landingPageContent->update($validated);

        return redirect()->route('admin.landing-page.index')
            ->with('success', 'Konten halaman utama berhasil diperbarui.');
    }
}
