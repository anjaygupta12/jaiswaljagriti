@extends('admin.layouts.app')

@section('title', 'Manage Wing Members')
@section('header', 'Wing Members')

@section('content')
<div class="card shadow-sm card-box">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="m-0 font-weight-bold text-dark">Wing Members Directory</h5>
        <a href="{{ route('admin.wing-members.create') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-plus mr-1"></i> Add New Member
        </a>
    </div>
    
    <div class="card-body">
        <!-- Filter Tabs -->
        <div class="mb-4">
            <a href="{{ route('admin.wing-members.index') }}" class="btn btn-outline-secondary btn-sm mr-2 {{ !request('type') ? 'active bg-secondary text-white' : '' }}">
                All Wings
            </a>
            <a href="{{ route('admin.wing-members.index', ['type' => 'executive-body']) }}" class="btn btn-outline-primary btn-sm mr-2 {{ request('type') == 'executive-body' ? 'active' : '' }}">
                Executive Body
            </a>
            <a href="{{ route('admin.wing-members.index', ['type' => 'youth-wing']) }}" class="btn btn-outline-info btn-sm mr-2 {{ request('type') == 'youth-wing' ? 'active' : '' }}">
                Youth Wing
            </a>
            <a href="{{ route('admin.wing-members.index', ['type' => 'womens-wing']) }}" class="btn btn-outline-danger btn-sm mr-2 {{ request('type') == 'womens-wing' ? 'active' : '' }}">
                Women's Wing
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th style="width: 80px;">Photo</th>
                        <th>Name</th>
                        <th>Designation</th>
                        <th>Wing Type</th>
                        <th>Contact Info</th>
                        <th style="width: 100px;">Sort Order</th>
                        <th style="width: 80px;">Status</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($members as $member)
                        <tr>
                            <td class="text-center align-middle">
                                @if($member->image)
                                    <img src="{{ asset($member->image) }}" class="img-thumbnail" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%;">
                                @else
                                    <div class="d-inline-block bg-light text-muted border rounded-circle text-center align-middle" style="width: 50px; height: 50px; line-height: 50px;">
                                        <i class="fas fa-user fa-lg"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="font-weight-bold align-middle">{{ $member->name }}</td>
                            <td class="align-middle">{{ $member->designation }}</td>
                            <td class="align-middle">
                                @if($member->type == 'executive-body')
                                    <span class="badge badge-primary px-3 py-2">Executive Body</span>
                                @elseif($member->type == 'youth-wing')
                                    <span class="badge badge-info px-3 py-2">Youth Wing</span>
                                @elseif($member->type == 'womens-wing')
                                    <span class="badge badge-danger px-3 py-2">Women's Wing</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div style="font-size: 13px;">
                                    @if($member->phone)
                                        <div><i class="fas fa-phone mr-1 text-muted"></i> {{ $member->phone }}</div>
                                    @endif
                                    @if($member->email)
                                        <div><i class="fas fa-envelope mr-1 text-muted"></i> {{ $member->email }}</div>
                                    @endif
                                    @if(!$member->phone && !$member->email)
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center align-middle font-weight-bold">{{ $member->sort_order }}</td>
                            <td class="text-center align-middle">
                                @if($member->status)
                                    <span class="badge badge-success px-2 py-1">Active</span>
                                @else
                                    <span class="badge badge-secondary px-2 py-1">Inactive</span>
                                @endif
                            </td>
                            <td class="align-middle">
                                <div class="btn-group">
                                    <a href="{{ route('admin.wing-members.edit', $member->id) }}" class="btn btn-warning btn-sm mr-1">
                                        <i class="fas fa-edit mr-1"></i> Edit
                                    </a>
                                    <form action="{{ route('admin.wing-members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this wing member?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash mr-1"></i> Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center py-5">
                                <div class="mb-3">
                                    <i class="fas fa-users-slash fa-3x text-muted"></i>
                                </div>
                                <h5 class="text-muted">No wing members found</h5>
                                <p class="text-muted">Click "Add New Member" to begin populating this section.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
