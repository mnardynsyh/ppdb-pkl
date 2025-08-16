<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function index()
    {
        $job = Job::latest()->get();
        return view('admin.job', compact('job'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:100',
        ]);

        Job::create([
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect()->route('admin.job.index')->with('success', 'Pekerjaan berhasil ditambahkan');
    }

    /**
     * Update data pekerjaan.
     * Laravel akan secara otomatis menemukan $job berdasarkan id_job dari URL.
     */
    public function update(Request $request, Job $job)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:100',
        ]);

        $job->update([
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect()->route('admin.job.index')->with('success', 'Pekerjaan berhasil diperbarui');
    }

    /**
     * Hapus data pekerjaan.
     * Laravel akan secara otomatis menemukan $job berdasarkan id_job dari URL.
     */
    public function destroy(Job $job)
    {
        $job->delete();

        return redirect()->route('admin.job.index')->with('success', 'Pekerjaan berhasil dihapus');
    }
}
