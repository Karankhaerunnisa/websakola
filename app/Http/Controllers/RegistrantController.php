<?php

namespace App\Http\Controllers;

use App\Enums\RegistrantStatus;
use App\Exports\RegistrantsExport;
use App\Http\Requests\StoreRegistrantRequest;
use App\Http\Requests\UpdateRegistrantRequest;
use App\Models\Major;
use App\Models\Registrant;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegistrantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $majors = Major::all();

        $statuses = RegistrantStatus::cases();

        $registrants = Registrant::with('major')

            ->when($request->majorCode, function ($query, $majorCode) {
                $query->whereRelation('major', 'code', $majorCode);
            })

            ->when($request->status, function ($query, $status) {
                $query->where('status', $status);
            })

            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('registration_number', 'like', "%{$search}%");
                });
            })
            ->paginate(10);

        return view('admin.registrants.index', compact('majors', 'statuses', 'registrants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegistrantRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Registrant $registrant)
    {
        $registrant->load(['major', 'address', 'guardians', 'academic']);

        return view('admin.registrants.partials.detail-modal', compact('registrant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegistrantRequest $request, Registrant $registrant)
    {
        $registrant->update($request->validated());

        return back()->with('message', 'Status pendaftar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registrant $registrant)
    {
        $registrant->delete();

        return redirect()->route('admin.registrants.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function print(Registrant $registrant)
    {
        $registrant->load(['major', 'address', 'guardians', 'academic']);

        $pdf = Pdf::loadView('admin.registrants.print', compact('registrant'));

        return $pdf->stream('Bukti-Pendaftaran-' . $registrant->registration_number . '.pdf');
    }

    public function export(Request $request)
    {
        return Excel::download(new RegistrantsExport($request), 'data-pendaftar-'. now()->format('d-m-Y').'.xlsx');
        // return (new RegistrantsExport($request))->download('data-pendaftar-'. now()->format('d-m-Y').'.xlsx');
    }
}
