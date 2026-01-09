<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatan = Kegiatan::latest()->get();
        $categories = Kegiatan::categories();
        return view('admin.kegiatan.index', compact('kegiatan', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'kegiatan_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('kegiatan', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        Kegiatan::create($data);

        return back()->with('success', 'Data kegiatan berhasil ditambahkan.');
    }

    public function update(Request $request, Kegiatan $kegiatan)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string',
            'event_date' => 'nullable|date',
            'location' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($kegiatan->photo) {
                Storage::disk('public')->delete('kegiatan/' . $kegiatan->photo);
            }
            $file = $request->file('photo');
            $fileName = 'kegiatan_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('kegiatan', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $kegiatan->update($data);

        return back()->with('success', 'Data kegiatan berhasil diperbarui.');
    }

    public function destroy(Kegiatan $kegiatan)
    {
        if ($kegiatan->photo) {
            Storage::disk('public')->delete('kegiatan/' . $kegiatan->photo);
        }

        $kegiatan->delete();

        return back()->with('success', 'Data kegiatan berhasil dihapus.');
    }
}
