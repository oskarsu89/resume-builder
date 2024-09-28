<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Resume;

class DashboardController extends Controller
{
    /**
     * Display the user's profile form.
     * @return \Inertia\Response
     */
    public function index(): Response
    {
        $resumes = Resume::where('user_id', auth()->id())->get();

        return Inertia::render('Dashboard/Index', [
            'resumes' => $resumes
        ]);
    }
}
