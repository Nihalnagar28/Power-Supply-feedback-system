{{-- Admin Dashboard Page --}}
@extends('layouts.app')

@section('title', 'Admin Dashboard — Power Supply Feedback System')

@section('content')

    <section class="section">
        <div class="container">
            <div class="section-header">
                <h2>Admin Dashboard</h2>
                <p>Manage and update complaint statuses</p>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            {{-- Stats --}}
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-value">{{ $totalComplaints }}</div>
                    <div class="stat-label">Total Complaints</div>
                </div>
                <div class="stat-card stat-pending">
                    <div class="stat-value">{{ $pendingComplaints }}</div>
                    <div class="stat-label">Pending</div>
                </div>
                <div class="stat-card stat-resolved">
                    <div class="stat-value">{{ $resolvedComplaints }}</div>
                    <div class="stat-label">Resolved</div>
                </div>
            </div>

            {{-- Complaints Management --}}
            @if($complaints->count())
                <div class="card-grid">
                    @foreach($complaints as $complaint)
                        <div class="card admin-complaint-card">
                            <div class="card-header">
                                <span class="card-location">{{ $complaint->location }}</span>
                                <span class="card-type">{{ $complaint->issue_type }}</span>
                            </div>

                            @if($complaint->name)
                                <p class="text-muted mb-1" style="font-size:0.85rem;">By: {{ $complaint->name }}</p>
                            @endif

                            <p class="card-desc">{{ Str::limit($complaint->description, 120) }}</p>

                            @if($complaint->remark)
                                <div class="remark-box">
                                    <div class="remark-label">Admin Remark</div>
                                    {{ $complaint->remark }}
                                </div>
                            @endif

                            <div class="card-footer">
                                @include('components.status-badge', ['status' => $complaint->status])
                                <span class="card-date">{{ $complaint->created_at->format('d M Y') }}</span>
                            </div>

                            {{-- Admin Action Form --}}
                            <div class="admin-form">
                                <form action="{{ url('/admin/update-status') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $complaint->id }}">

                                    <div class="form-row">
                                        <div class="form-group">
                                            <label class="form-label">Status</label>
                                            <select name="status" class="form-control">
                                                <option value="pending" {{ $complaint->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="resolved" {{ $complaint->status === 'resolved' ? 'selected' : '' }}>Resolved</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group mt-1">
                                        <label class="form-label">Remark <span class="optional">(optional)</span></label>
                                        <textarea name="remark" class="form-control" placeholder="e.g., Team dispatched, Issue resolved...">{{ $complaint->remark }}</textarea>
                                    </div>

                                    <div class="card-actions">
                                        <button type="submit" class="btn btn-success btn-sm">💾 Update</button>
                                    </div>
                                </form>

                                {{-- Delete button as separate form --}}
                                <div class="card-actions" style="border-top:none; margin-top:0; padding-top:0;">
                                    <form action="{{ url('/admin/delete/' . $complaint->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this complaint?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">🗑 Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="empty-icon">📊</div>
                    <p>No complaints to manage.</p>
                </div>
            @endif
        </div>
    </section>

@endsection
