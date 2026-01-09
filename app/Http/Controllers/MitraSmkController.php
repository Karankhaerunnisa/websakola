<?php

namespace App\Http\Controllers;

use App\Models\MitraSmk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MitraSmkController extends Controller
{
    public function index()
    {
        $mitra = MitraSmk::latest()->get();
        $categories = MitraSmk::categories();
        $partnershipTypes = MitraSmk::partnershipTypes();
        return view('admin.mitra.index', compact('mitra', 'categories', 'partnershipTypes'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'partnership_type' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = 'mitra_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('mitra', $fileName, 'public');
            $data['logo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        MitraSmk::create($data);

        return back()->with('success', 'Data mitra berhasil ditambahkan.');
    }

    public function update(Request $request, MitraSmk $mitra)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'website' => 'nullable|url|max:255',
            'address' => 'nullable|string|max:500',
            'partnership_type' => 'nullable|string',
            'description' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        if ($request->hasFile('logo')) {
            if ($mitra->logo) {
                Storage::disk('public')->delete('mitra/' . $mitra->logo);
            }
            $file = $request->file('logo');
            $fileName = 'mitra_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('mitra', $fileName, 'public');
            $data['logo'] = $fileName;
        }

        $data['is_active'] = $request->has('is_active');

        $mitra->update($data);

        return back()->with('success', 'Data mitra berhasil diperbarui.');
    }

    public function destroy(MitraSmk $mitra)
    {
        if ($mitra->logo) {
            Storage::disk('public')->delete('mitra/' . $mitra->logo);
        }

        $mitra->delete();

        return back()->with('success', 'Data mitra berhasil dihapus.');
    }
}
