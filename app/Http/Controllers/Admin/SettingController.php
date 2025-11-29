<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        // Fetch all settings and map them key => value for easy access in Blade
        // Example: $settings['school_name'] returns 'SMK Rohmatul Ummah'
        $settings = Setting::all()->pluck('value', 'key');

        // dd($settings);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(UpdateSettingRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('app_logo')) {
            $this->handleFileUpload(
                $request->file('app_logo'),
                'app_logo',
                'school-logo'
            );
        }

        if ($request->hasFile('document_header')) {
            $this->handleFileUpload(
                $request->file('document_header'),
                'document_header',
                'letter-head'
            );
        }

        // Remove handled attributes from array
        unset($validated['app_logo']);
        unset($validated['document_header']);

        // FIX 4: Loop through validated data directly
        foreach ($validated as $key => $value) {
            // We update blindly because $validated only contains valid rules from your Request
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    /**
     * Private Helper to handle file replacement logic
     */
    private function handleFileUpload(UploadedFile $file, string $dbKey, string $filenamePrefix): void
    {
        // 1. Generate unique filename
        $filename = $filenamePrefix . '-' . time() . '.' . $file->getClientOriginalExtension();

        // 2. Find and Delete Old File
        $oldFile = Setting::where('key', $dbKey)->value('value');

        if ($oldFile) {
            $oldPath = public_path('images/' . $oldFile);
            if (File::exists($oldPath)) {
                File::delete($oldPath);
            }
        }

        // 3. Move New File
        $file->move(public_path('images'), $filename);

        // 4. Update Database
        Setting::updateOrCreate(
            ['key' => $dbKey],
            ['value' => $filename, 'type' => 'string']
        );
    }
}
