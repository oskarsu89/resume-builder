<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Resume;

class ResumeController extends Controller
{
    /**
     * Display the user's profile form.
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        // Fetch resumes for the authenticated user
        $resumes = Resume::where('user_id', auth()->id())->get();

        // Pass the resumes to the Dashboard view
        return Inertia::render('Dashboard/Index', [
            'resumes' => $resumes
        ]);
    }
}
