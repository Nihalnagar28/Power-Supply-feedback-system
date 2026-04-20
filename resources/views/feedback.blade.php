{{-- Feedback Form Page --}}
@extends('layouts.app')

@section('title', 'Submit Feedback — Power Supply Feedback System')

@section('content')

    <section class="section">
        <div class="container">
            <div class="section-header text-center">
                <h2>Submit Your Feedback</h2>
                <p>Let us know about electricity supply issues in your area</p>
            </div>

            <div class="card form-card">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-error">
                        @foreach($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <form action="{{ url('/submit') }}" method="POST" id="feedbackForm">
                    @csrf

                    <div class="form-group">
                        <label class="form-label">Name <span class="optional">(optional)</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Your name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label class="form-label">Location <span style="color:#EF4444">*</span></label>
                        <input type="text" name="location" class="form-control" placeholder="e.g., Sector 12, Noida" value="{{ old('location') }}" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Issue Type <span style="color:#EF4444">*</span></label>
                        <select name="issue_type" class="form-control" required>
                            <option value="" disabled selected>Select issue type</option>
                            <option value="Power Cut" {{ old('issue_type') == 'Power Cut' ? 'selected' : '' }}>Power Cut</option>
                            <option value="Voltage Issue" {{ old('issue_type') == 'Voltage Issue' ? 'selected' : '' }}>Voltage Issue</option>
                            <option value="Frequent Outage" {{ old('issue_type') == 'Frequent Outage' ? 'selected' : '' }}>Frequent Outage</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Description <span style="color:#EF4444">*</span></label>
                        <textarea name="description" class="form-control" placeholder="Describe the issue in detail..." required>{{ old('description') }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width:100%">Submit Feedback</button>
                </form>
            </div>
        </div>
    </section>

@endsection
