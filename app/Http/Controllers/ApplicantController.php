<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Applicant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicantController extends Controller
{
    public function store(Request $request, Job $job): RedirectResponse
    {

        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'contact_phone' => 'string',
            'contact_email' => 'required|email',
            'message' => 'string',
            'location' => 'string',
            'resume' => 'required|file|mimes:pdf|max:2048',
        ]);

        // Hanlde resume upload
        $resume = $request->file('resume');
        $path = $resume->store('resumes', 'public');
        $validatedData['resume_path'] = $path;

        $applicant = new Applicant($validatedData);
        $applicant->job_id = $job->id;
        $applicant->user_id = Auth::user()->id;
        $applicant->save();

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}
