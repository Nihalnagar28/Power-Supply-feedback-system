{{-- Complaint Card Component --}}
{{-- Usage: @include('components.complaint-card', ['complaint' => $complaint]) --}}
<div class="card complaint-card fade-in-up">
    <div class="card-header">
        <span class="card-location">{{ $complaint->location }}</span>
        <span class="card-type">{{ $complaint->issue_type }}</span>
    </div>
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
</div>
