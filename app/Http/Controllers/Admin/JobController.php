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

    public function update(Request $request, $id)
    {
        $request->validate([
            'pekerjaan' => 'required|string|max:100',
        ]);

        $job = Job::findOrFail($id);
        $job->update([
            'pekerjaan' => $request->pekerjaan,
        ]);

        return redirect()->route('admin.job.index')->with('success', 'Pekerjaan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        $job->delete();

        return redirect()->route('admin.job.index')->with('success', 'Pekerjaan berhasil dihapus');
    }
}
