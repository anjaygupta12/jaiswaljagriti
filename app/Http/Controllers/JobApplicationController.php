<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JobApplicationController extends Controller
{
    public function create(\App\Models\JobListing $jobListing)
    {
        if (!$jobListing->isInternal() || !$jobListing->show_apply) {
            abort(404);
        }

        return view('job_apply', compact('jobListing'));
    }

    public function store(Request $request, \App\Models\JobListing $jobListing)
    {
        if (!$jobListing->isInternal() || !$jobListing->show_apply) {
            abort(404);
        }

        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'resume' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'g-recaptcha-response' => 'required'
        ]);

        // Recaptcha Verification
        $recaptchaResponse = $request->input('g-recaptcha-response');
        $secretKey = env('RECAPTCHA_SECRET_KEY', '6LeIxAcTAAAAAGG-vFI1TnRWxMZNFuojJ4WifJWe');

        // Allow dummy validation if secret key is not set for local dev (the test key will pass but we still need to send the request or just skip it. Google test keys actually pass the verification api so we don't need to skip it.)
        if ($secretKey) {
            $response = \Illuminate\Support\Facades\Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                'secret' => $secretKey,
                'response' => $recaptchaResponse,
                'remoteip' => $request->ip()
            ]);

            if (!$response->json('success')) {
                return back()->withErrors(['g-recaptcha-response' => 'Captcha verification failed.'])->withInput();
            }
        }

        $file = $request->file('resume');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('resumes'), $filename);
        $path = 'resumes/' . $filename;

        \App\Models\JobApplication::create([
            'user_id' => auth()->id(),
            'job_listing_id' => $jobListing->id,
            'email' => $request->email,
            'phone' => $request->phone,
            'resume_path' => $path,
            'status' => 'pending'
        ]);

        return redirect()->route('job.show', $jobListing)->with('success', 'Your application has been submitted successfully.');
    }
}
