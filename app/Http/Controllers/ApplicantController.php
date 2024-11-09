<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Applicant;
use App\Mail\JobApplied;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;

class ApplicantController extends Controller
{
    public function store(Request $request, Job $job): RedirectResponse
    {
        // Check if the user has already applied to the job
        if (Applicant::where('job_id', $job->id)->where('user_id', Auth::user()->id)->exists()) {
            return redirect()->back()->with('error', 'You have already applied to this job.');
        }

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

        // Send email notification
        // Mail::to($job->user->email)->send(new JobApplied($applicant, $job));

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }

    public function destroy(Applicant $applicant): RedirectResponse
    {
        // delete resume
        if ($applicant->resume_path) {
            Storage::disk('public')->delete($applicant->resume_path);
        }

        $applicant->delete();

        return redirect()->back()->with('success', 'Application deleted successfully!');
    }
}
