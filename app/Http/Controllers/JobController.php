<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index()
    {
        $jobs = ['job1', 'job2', 'job3'];
        return view('jobs.index', [
            'title' => 'Available Jobs',
            'jobs' => $jobs
        ]);
    }

    public function create()
    {
        return view('jobs.create');
    }
}
