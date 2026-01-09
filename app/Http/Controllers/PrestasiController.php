<?php

namespace App\Http\Controllers;

use App\Models\Prestasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PrestasiController extends Controller
{
    public function index()
    {
        $prestasi = Prestasi::latest()->get();
        $categories = Prestasi::categories();
        $levels = Prestasi::levels();
        return view('admin.prestasi.index', compact('prestasi', 'categories', 'levels'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'level' => 'required|string',
            'rank' => 'nullable|string|max:100',
            'student_name' => 'nullable|string|max:255',
            'event_name' => 'nullable|string|max:255',
            'achievement_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'prestasi_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('prestasi', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        Prestasi::create($data);

        return back()->with('success', 'Data prestasi berhasil ditambahkan.');
    }

    public function update(Request $request, Prestasi $prestasi)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'level' => 'required|string',
            'rank' => 'nullable|string|max:100',
            'student_name' => 'nullable|string|max:255',
            'event_name' => 'nullable|string|max:255',
            'achievement_date' => 'nullable|date',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($prestasi->photo) {
                Storage::disk('public')->delete('prestasi/' . $prestasi->photo);
            }
            $file = $request->file('photo');
            $fileName = 'prestasi_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('prestasi', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $prestasi->update($data);

        return back()->with('success', 'Data prestasi berhasil diperbarui.');
    }

    public function destroy(Prestasi $prestasi)
    {
        if ($prestasi->photo) {
            Storage::disk('public')->delete('prestasi/' . $prestasi->photo);
        }

        $prestasi->delete();

        return back()->with('success', 'Data prestasi berhasil dihapus.');
    }
}
