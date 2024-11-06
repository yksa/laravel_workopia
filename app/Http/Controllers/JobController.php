<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::all();
        return view('jobs.index')->with('jobs', $jobs);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jobs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Hardcoded user Id
        $validatedData['user_id'] = 1;

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            $companyLogo = $request->file('company_logo');
            $companyLogoPath = $companyLogo->store('logos', 'public');
            $validatedData['company_logo'] = $companyLogoPath;
        }

        // dd($validatedData);

        // Submit data to database
        Job::create($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }


    /**
     * Display the specified resource.
     *
     * @param  Job  $job
     * @return View
     */
    public function show(Job $job): View
    {

        return view('jobs.show')->with('job', $job);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job): View
    {
        return view('jobs.edit')->with('job', $job);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Job  $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Job $job): RedirectResponse
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|integer',
            'tags' => 'nullable|string',
            'job_type' => 'required|string',
            'remote' => 'required|boolean',
            'requirements' => 'nullable|string',
            'benefits' => 'nullable|string',
            'address' => 'nullable|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zipcode' => 'nullable|string',
            'contact_email' => 'required|email',
            'contact_phone' => 'nullable|string',
            'company_name' => 'required|string',
            'company_description' => 'nullable|string',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'company_website' => 'nullable|url',
        ]);

        // Handle company logo upload
        if ($request->hasFile('company_logo')) {
            // Delete old image
            if ($job->company_logo) {
                Storage::disk('public')->delete($job->company_logo);
            }

            $companyLogo = $request->file('company_logo');
            $companyLogoPath = $companyLogo->store('logos', 'public');
            $validatedData['company_logo'] = $companyLogoPath;
        }

        // Submit data to database
        $job->update($validatedData);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }


    /**
     * Delete a job and remove the associated company logo.
     *
     * @param \App\Models\Job $job
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Job $job): RedirectResponse
    {
        // Delete company logo
        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }
}
