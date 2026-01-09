<?php

namespace App\Http\Controllers;

use App\Models\Ekskul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EkskulController extends Controller
{
    public function index()
    {
        $ekskul = Ekskul::latest()->get();
        $categories = Ekskul::categories();
        return view('admin.ekskul.index', compact('ekskul', 'categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'schedule' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = 'ekskul_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('ekskul', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        Ekskul::create($data);

        return back()->with('success', 'Data ekstrakurikuler berhasil ditambahkan.');
    }

    public function update(Request $request, Ekskul $ekskul)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'schedule' => 'nullable|string|max:255',
            'instructor' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('photo')) {
            if ($ekskul->photo) {
                Storage::disk('public')->delete('ekskul/' . $ekskul->photo);
            }
            $file = $request->file('photo');
            $fileName = 'ekskul_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('ekskul', $fileName, 'public');
            $data['photo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $ekskul->update($data);

        return back()->with('success', 'Data ekstrakurikuler berhasil diperbarui.');
    }

    public function destroy(Ekskul $ekskul)
    {
        if ($ekskul->photo) {
            Storage::disk('public')->delete('ekskul/' . $ekskul->photo);
        }

        $ekskul->delete();

        return back()->with('success', 'Data ekstrakurikuler berhasil dihapus.');
    }
}
