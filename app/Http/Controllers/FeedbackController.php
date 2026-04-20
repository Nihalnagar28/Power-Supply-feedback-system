<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Home page — show latest 6 complaints.
     */
    public function home()
    {
        $complaints = Feedback::latest()->take(6)->get();
        return view('home', compact('complaints'));
    }

    /**
     * Show the feedback submission form.
     */
    public function create()
    {
        return view('feedback');
    }

    /**
     * Store a newly submitted feedback.
     */
    public function store(Request $request)
    {
        $request->validate([
            'location'    => 'required|string|max:255',
            'issue_type'  => 'required|string|in:Power Cut,Voltage Issue,Frequent Outage',
            'description' => 'required|string',
        ]);

        Feedback::create([
            'name'        => $request->name,
            'location'    => $request->location,
            'issue_type'  => $request->issue_type,
            'description' => $request->description,
            'status'      => 'pending',
        ]);

        return redirect('/submit')->with('success', 'Your feedback has been submitted successfully!');
    }

    /**
     * Show all complaints (latest first).
     */
    public function index()
    {
        $complaints = Feedback::latest()->get();
        return view('complaints', compact('complaints'));
    }
}
