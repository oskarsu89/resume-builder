<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Resume;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;

class ResumeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Resume/Index');
    }

    protected function resumeValidationRules(Bool $addTitle = false): array
    {
        $rules = [
            'personalDetails.first_name' => 'required|string|max:255',
            'personalDetails.last_name' => 'required|string|max:255',
            'personalDetails.email' => 'required|email|max:255',
            'personalDetails.phone' => ['required', 'regex:/^\+?[0-9\s\-\(\)]+$/', 'max:20'],
            'personalDetails.address' => 'required|string|max:255',

            'employmentHistory' => 'required|array|min:1',
            'employmentHistory.*.job_title' => 'required|string|max:255',
            'employmentHistory.*.company' => 'required|string|max:255',
            'employmentHistory.*.start_date' => 'required|date',
            'employmentHistory.*.end_date' => 'nullable|date|after_or_equal:employmentHistory.*.start_date',
            'employmentHistory.*.description' => 'nullable|string|max:500',

            'education' => 'required|array|min:1',
            'education.*.institution' => 'required|string|max:255',
            'education.*.degree' => 'required|string|max:255',
            'education.*.field_of_study' => 'required|string|max:255',
            'education.*.start_date' => 'required|date',
            'education.*.end_date' => 'nullable|date|after_or_equal:education.*.start_date',
        ];

        if ($addTitle) {
            $rules['resumeTitle.title'] = 'required|string|max:255';
        }

        return $rules;
    }

    protected function resumeValidationMessages(): array
    {
        return [
            'personalDetails.phone.regex' => "Please enter a valid phone number with the correct format.",
            'employmentHistory.*.end_date.after_or_equal' => "Employment end date should be the same or later than employment start date",
            'education.*.end_date' => "Education end date should be the same or later than education start date"
        ];
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate($this->resumeValidationRules(true), $this->resumeValidationMessages());

        // Create the Resume
        $resume = Resume::create([
            'title' => $validated['resumeTitle']['title'],
            'user_id' => auth()->id(),
        ]);

        // Create personal details record
        $resume->personalDetails()->create($validated['personalDetails']);

        // Create employment history records
        $resume->employmentHistory()->createMany($validated['employmentHistory']);

        // Create education records
        $resume->education()->createMany($validated['education']);

        return redirect()->route('dashboard')->with('success', 'Resume created successfully!');
    }

    public function destroy(Resume $resume): RedirectResponse
    {
        $resume->delete();

        return redirect()->route('dashboard')->with('success', 'Resume deleted successfully!');
    }

    public function edit($id): Response
    {
        $resume = Resume::with(['personalDetails', 'employmentHistory', 'education'])->findOrFail($id);

        return inertia('Dashboard/Edit', [
            'resume' => $resume,
        ]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $validated = $request->validate($this->resumeValidationRules(false), $this->resumeValidationMessages());

        $resume = Resume::findOrFail($id);

        // Update personal info
        $resume->personalDetails()->update($validated['personalDetails']);

        // Update employment history
        $resume->employmentHistory()->delete();
        $resume->employmentHistory()->createMany($validated['employmentHistory']);

        // Update education history
        $resume->education()->delete();
        $resume->education()->createMany($validated['education']);

        return redirect()->route('dashboard')->with('success', 'Resume updated successfully!');
    }

    public function download($id)
    {
        $resume = Resume::with(['personalDetails', 'employmentHistory', 'education'])->findOrFail($id);

        // Create Resume PDF
        $pdf = Pdf::loadView('pdf.resume', compact('resume'));

        // Download the PDF
        return $pdf->download('resume.pdf');
    }
}
