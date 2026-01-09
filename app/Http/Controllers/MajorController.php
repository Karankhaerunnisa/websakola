<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMajorRequest;
use App\Http\Requests\UpdateMajorRequest;
use App\Models\Major;
use Illuminate\Support\Facades\Storage;

class MajorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $majors = Major::withCount('registrants')->latest()->get();

        return view('admin.majors.index', compact('majors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMajorRequest $request)
    {
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $fileName = $data['code'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('majors', $fileName, 'public');
            $data['logo'] = $fileName;
        }

        Major::create($data);

        return back()->with('success', 'Jurusan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Major $major)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMajorRequest $request, Major $major)
    {
        $data = $request->validated();

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($major->logo) {
                Storage::disk('public')->delete('majors/' . $major->logo);
            }
            
            $file = $request->file('logo');
            $fileName = $data['code'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('majors', $fileName, 'public');
            $data['logo'] = $fileName;
        }

        $major->update($data);

        return back()->with('success', 'Jurusan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Major $major)
    {
        if ($major->registrants->count() > 0) {
            return back()->with('error', 'Gagal Menghapus! Masih ada siswa yang mendaftar di jurusan ini.');
        }

        // Delete logo file if exists
        if ($major->logo) {
            Storage::disk('public')->delete('majors/' . $major->logo);
        }

        $major->delete();

        return back()->with('success', 'Jurusan berhasil dihapus.');
    }

    /**
     * Show form to edit major content (blog content, photos, youtube)
     */
    public function editContent(Major $major)
    {
        return view('admin.majors.edit-content', compact('major'));
    }

    /**
     * Update major content (blog content, photos, youtube)
     */
    public function updateContent(UpdateMajorRequest $request, Major $major)
    {
        $data = [];
        
        // Update content
        $data['content'] = $request->input('content');
        $data['youtube_url'] = $request->input('youtube_url');

        // Handle photo1 upload
        if ($request->hasFile('photo1')) {
            // Delete old photo if exists
            if ($major->photo1) {
                Storage::disk('public')->delete('majors/' . $major->photo1);
            }
            
            $file = $request->file('photo1');
            $fileName = $major->code . '_photo1_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('majors', $fileName, 'public');
            $data['photo1'] = $fileName;
        }

        // Handle photo2 upload
        if ($request->hasFile('photo2')) {
            // Delete old photo if exists
            if ($major->photo2) {
                Storage::disk('public')->delete('majors/' . $major->photo2);
            }
            
            $file = $request->file('photo2');
            $fileName = $major->code . '_photo2_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('majors', $fileName, 'public');
            $data['photo2'] = $fileName;
        }

        $major->update($data);

        return back()->with('success', 'Konten jurusan berhasil diperbarui.');
    }
}
