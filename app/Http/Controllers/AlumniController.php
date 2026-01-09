<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::latest()->get();
        $majors = Major::orderBy('name')->get();
        return view('admin.alumni.index', compact('alumni', 'majors'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|string|max:4',
            'major' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'alumni_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('alumni', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        Alumni::create($data);

        return back()->with('success', 'Data alumni berhasil ditambahkan.');
    }

    public function update(Request $request, Alumni $alumni)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'graduation_year' => 'required|string|max:4',
            'major' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'current_position' => 'nullable|string|max:255',
            'company' => 'nullable|string|max:255',
            'testimonial' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($alumni->photo) {
                Storage::disk('public')->delete('alumni/' . $alumni->photo);
            }
            $file = $request->file('photo');
            $fileName = 'alumni_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('alumni', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $alumni->update($data);

        return back()->with('success', 'Data alumni berhasil diperbarui.');
    }

    public function destroy(Alumni $alumni)
    {
        if ($alumni->photo) {
            Storage::disk('public')->delete('alumni/' . $alumni->photo);
        }

        $alumni->delete();

        return back()->with('success', 'Data alumni berhasil dihapus.');
    }
}
