{{-- Home Page --}}
@extends('layouts.app')

@section('title', 'Power Supply Feedback System — Home')

@section('content')

    {{-- Hero Section --}}
    <section class="hero">
        <div class="container">
            <h1>Report Power Issues in Your Area</h1>
            <p>Help us improve electricity supply. Submit feedback about power cuts, voltage problems, and outages in your locality.</p>
            <a href="{{ url('/submit') }}" class="btn btn-white btn-lg">Submit Feedback</a>
        </div>
    </section>

    {{-- Recent Complaints --}}
    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>Recent Complaints</h2>
                <p>Latest reported issues from across the region</p>
            </div>

            @if($complaints->count())
                <div class="card-grid">
                    @foreach($complaints as $complaint)
                        @include('components.complaint-card', ['complaint' => $complaint])
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📋</div>
                    <p>No complaints have been filed yet.</p>
                    <a href="{{ url('/submit') }}" class="btn btn-primary mt-2">Submit First Complaint</a>
                </div>
            @endif
        </div>
    </section>

@endsection
