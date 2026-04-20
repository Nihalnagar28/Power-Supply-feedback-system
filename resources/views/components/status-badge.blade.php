{{-- Status Badge Component --}}
{{-- Usage: @include('components.status-badge', ['status' => 'pending']) --}}
@if($status === 'resolved')
    <span class="badge badge-resolved">Resolved</span>
@else
    <span class="badge badge-pending">Pending</span>
@endif
