<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Show admin login form.
     */
    public function loginForm()
    {
        // If already logged in, go straight to dashboard
        if (session('admin_logged_in')) {
            return redirect('/admin/dashboard');
        }
        return view('admin.login');
    }

    /**
     * Handle admin login (basic hardcoded auth).
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        // Simple hardcoded credentials
        if ($request->email === 'admin@power.gov' && $request->password === 'admin123') {
            session(['admin_logged_in' => true]);
            return redirect('/admin/dashboard');
        }

        return back()->with('error', 'Invalid credentials. Please try again.');
    }

    /**
     * Admin dashboard with stats and all complaints.
     */
    public function dashboard()
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin')->with('error', 'Please login first.');
        }

        $complaints        = Feedback::latest()->get();
        $totalComplaints   = $complaints->count();
        $pendingComplaints = $complaints->where('status', 'pending')->count();
        $resolvedComplaints = $complaints->where('status', 'resolved')->count();

        return view('admin.dashboard', compact(
            'complaints',
            'totalComplaints',
            'pendingComplaints',
            'resolvedComplaints'
        ));
    }

    /**
     * Update complaint status and optionally add remark.
     */
    public function updateStatus(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin');
        }

        $request->validate([
            'id'     => 'required|exists:feedbacks,id',
            'status' => 'required|in:pending,resolved',
        ]);

        $feedback = Feedback::findOrFail($request->id);
        $feedback->status = $request->status;

        if ($request->filled('remark')) {
            $feedback->remark = $request->remark;
        }

        $feedback->save();

        return redirect('/admin/dashboard')->with('success', 'Complaint updated successfully.');
    }

    /**
     * Delete a complaint.
     */
    public function delete($id)
    {
        if (!session('admin_logged_in')) {
            return redirect('/admin');
        }

        Feedback::findOrFail($id)->delete();

        return redirect('/admin/dashboard')->with('success', 'Complaint deleted successfully.');
    }

    /**
     * Admin logout.
     */
    public function logout()
    {
        session()->forget('admin_logged_in');
        return redirect('/admin');
    }
}
