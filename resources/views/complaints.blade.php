{{-- Complaints Listing Page --}}
@extends('layouts.app')

@section('title', 'All Complaints — Power Supply Feedback System')

@section('content')

    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>All Complaints</h2>
                <p>Browse all reported electricity supply issues</p>
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
