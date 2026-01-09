<?php

namespace App\Http\Controllers;

use App\Models\Pengumumanujian;
use App\Models\Registrant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PengumumanujianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengumumanujian = Pengumumanujian::with('registrant')->latest()->paginate(10);
        $registrants = Registrant::orderBy('name')->get();
        return view('admin.pengumumanujian.index', compact('pengumumanujian', 'registrants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $registrants = Registrant::orderBy('name')->get();
        return view('admin.pengumumanujian.create', compact('registrants'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'registrant_id' => 'required|exists:registrants,id',
            'status' => 'required|in:Lulus,Tidak Lulus',
        ], [
            'registrant_id.required' => 'Pendaftar harus dipilih.',
            'registrant_id.exists' => 'Pendaftar tidak valid.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus Lulus atau Tidak Lulus.',
        ]);

        // Check if registrant already has announcement
        $existingAnnouncement = Pengumumanujian::where('registrant_id', $validated['registrant_id'])->first();
        if ($existingAnnouncement) {
            return redirect()->back()->withErrors(['registrant_id' => 'Pendaftar ini sudah memiliki pengumuman ujian.'])->withInput();
        }

        Pengumumanujian::create($validated);

        return redirect()->route('admin.pengumuman-ujian.index')->with('success', 'Pengumuman ujian berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pengumumanujian $pengumuman_ujian)
    {
        return view('admin.pengumumanujian.show', compact('pengumuman_ujian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pengumumanujian $pengumuman_ujian)
    {
        $registrants = Registrant::orderBy('name')->get();
        return view('admin.pengumumanujian.edit', compact('pengumuman_ujian', 'registrants'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pengumumanujian $pengumuman_ujian)
    {
        $validated = $request->validate([
            'registrant_id' => 'required|exists:registrants,id',
            'status' => 'required|in:Lulus,Tidak Lulus',
        ], [
            'registrant_id.required' => 'Pendaftar harus dipilih.',
            'registrant_id.exists' => 'Pendaftar tidak valid.',
            'status.required' => 'Status harus dipilih.',
            'status.in' => 'Status harus Lulus atau Tidak Lulus.',
        ]);

        // Check if registrant already has announcement (except current)
        $existingAnnouncement = Pengumumanujian::where('registrant_id', $validated['registrant_id'])
            ->where('id', '!=', $pengumuman_ujian->id)
            ->first();
        if ($existingAnnouncement) {
            return redirect()->back()->withErrors(['registrant_id' => 'Pendaftar ini sudah memiliki pengumuman ujian lain.'])->withInput();
        }

        $pengumuman_ujian->update($validated);

        return redirect()->route('admin.pengumuman-ujian.index')->with('success', 'Pengumuman ujian berhasil diperbarui.');
    }

    /**
     * Print PDF Surat Kelulusan
     */
    public function print(Pengumumanujian $pengumuman_ujian)
    {
        $registrant = $pengumuman_ujian->registrant()->with(['major', 'academic', 'guardians', 'address'])->first();
        
        if (!$registrant) {
            return redirect()->back()->with('error', 'Data pendaftar tidak ditemukan.');
        }

        $pdf = Pdf::loadView('admin.pengumumanujian.print-kelulusan', [
            'pengumuman' => $pengumuman_ujian,
            'registrant' => $registrant,
        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename = 'Surat-Kelulusan-' . $registrant->registration_number . '.pdf';
        
        return $pdf->stream($filename);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pengumumanujian $pengumuman_ujian)
    {
        $pengumuman_ujian->delete();

        return redirect()->route('admin.pengumuman-ujian.index')->with('success', 'Pengumuman ujian berhasil dihapus.');
    }
}
