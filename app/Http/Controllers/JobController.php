<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class JobController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jobs = Job::latest()->paginate(9);
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

        $validatedData['user_id'] = Auth::user()->id;

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
        // Check if user is authorized to edit the job
        $this->authorize('update', $job);

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
        // Check if user is authorized to update the job
        $this->authorize('update', $job);

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
        // Check if user is authorized to delete the job
        $this->authorize('delete', $job);

        // Delete company logo
        if ($job->company_logo) {
            Storage::disk('public')->delete($job->company_logo);
        }

        $job->delete();

        // Check if request came from the dashboard
        if (request()->query('from') == 'dashboard') {
            return redirect()->route('dashboard')->with('success', 'Job deleted successfully!');
        }

        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }

    public function search(Request $request): View
    {
        $keywords = strtolower($request->input('keywords'));
        $location = strtolower($request->input('location'));

        $query = Job::query();
        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw("LOWER(title) LIKE ?", ["%{$keywords}%"])
                    ->orWhereRaw("LOWER(description) LIKE ?", ["%{$keywords}%"])
                    ->orWhereRaw("LOWER(tags) LIKE ?", ["%{$keywords}%"]);
            });
        }

        if ($location) {
            $query->where(function ($q) use ($location) {
                $q->whereRaw("LOWER(address) LIKE ?", ["%{$location}%"])
                    ->orWhereRaw("LOWER(city) LIKE ?", ["%{$location}%"])
                    ->orWhereRaw("LOWER(state) LIKE ?", ["%{$location}%"])
                    ->orWhereRaw("LOWER(zipcode) LIKE ?", ["%{$location}%"]);
            });
        }

        $jobs = $query->paginate(9);

        return view('jobs.index')->with('jobs', $jobs);
    }
}
