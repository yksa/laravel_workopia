<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    public function index()
    {
        $bookmarkedJobs = Auth::user()->bookmarkedJobs()->orderBy('job_user_bookmarks.created_at', 'desc')->paginate(9);

        return view('jobs.bookmarked')->with('bookmarks', $bookmarkedJobs);
    }

    public function store(Job $job): RedirectResponse
    {
        $user = Auth::user();

        // Check if the job is already bookmarked by the user
        if ($user->bookmarkedJobs()->where('job_id', $job->id)->exists()) {
            return back()->with('success', 'Job is already bookmarked.');
        }

        // Bookmark the job
        $user->bookmarkedJobs()->attach($job->id);

        return back()->with('success', 'Job bookmarked successfully.');
    }
}
