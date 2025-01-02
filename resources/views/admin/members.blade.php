@extends('layouts.app')

@section('title', 'member Management')

@section('content')
@include('admin.addMember')
@include('admin.editMember')

<div class="container p-4">
    <div class="header text-center mb-4">
        @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

        <h1>Member Management</h1>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMemberModal">Add Member</button>

        <form action="{{ route('members.search') }}" method="get">
            <div class="d-flex align-items-center">
                <input type="search" name="search" class="form-control me-2" placeholder="Search club name" value="{{ $search ?? '' }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>
    </div>

    @if (isset($results) && count($results) > 0)
        <ul>
            @foreach ($results as $result)
                <li>{{ $result->name }}</li>
            @endforeach
        </ul>
    @elseif (isset($results))
        <p class="text-dark">No results found.</p>
    @endif

    <h3 class="my-4">Membership Request</h3>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">School</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $index => $member)
                @if($member->isApproved == '0')
                    @if(count($members) == 0)
                        <tr>
                            <td colspan="7" class="text-center">No membership request.</td>
                        </tr>
                    @endif
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://via.placeholder.com/350x350?text=Image' }}" alt="Profile" style="width: 45px; height: 45px"
                                class="img-fluid rounded-circle">
                            </td>
                            <td>{{ $member->name }}</td>
                            <td>{{ $member->role }}</td>
                            <td>{{ $member->school }}</td>
                            <td>
                                <span class="text-muted">
                                    <i class="bi {{ $member->gender == 'male' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }} me-2"></i>
                                {{ $member->gender }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('members.approve', ['member' => $member]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('put')
                                    <button type="submit" class="btn btn-success" onclick="return confirm('Are you sure you want to accept this member?')">
                                        Approve
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <h3 class="my-4">Current Member</h3>

    <div class="table-responsive">
        <table class="table table-bordered table-striped ">
            <thead class="table-dark">
                <tr>
                    <th scope="col">NO</th>
                    <th scope="col">Profile</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">School</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Belt</th>
                    <th scope="col">Medal</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $index => $member)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <img src="{{ $member->photo ? asset('storage/' . $member->photo) : 'https://via.placeholder.com/350x350?text=Image' }}" alt="Profile" style="width: 45px; height: 45px"
                            class="img-fluid rounded-circle">
                        </td>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->role }}</td>
                        <td>{{ $member->school }}</td>
                        <td>
                            <span class="text-muted">
                                <i class="bi {{ $member->gender == 'male' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }} me-2"></i>
                                {{ $member->gender }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-secondary bg-opacity-10 text-white">
                            {{ $member->belt }}
                            </span>
                        </td>
                        <td>

                            {{ $member->medal }}
                        </td>

                        <td>
                        {{-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editMemberModal-{{ $member->id }}">
                            Edit
                        </button>
                        <form action="{{ route('members.destroy', ['member' => $member]) }}" method="post" class="d-inline">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">
                                Delete
                            </button>
                        </form> --}}
                        <div class="mt-auto d-flex justify-content-between align-items-center">
                            <div class="dropdown">
                                <button class="btn btn-primary btn-sm dropdown-toggle" 
                                        type="button" 
                                        id="memberActionsDropdown-{{ $member->id }}" 
                                        data-bs-toggle="dropdown" 
                                        aria-expanded="false">
                                    <i class="bi bi-three-dots-vertical me-1"></i> 
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" 
                                    aria-labelledby="memberActionsDropdown-{{ $member->id }}">
                                    <li>
                                        <button type="button" 
                                                class="dropdown-item" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editMemberModal-{{ $member->id }}">
                                            <i class="bi bi-pencil me-2"></i>Edit
                                        </button>
                                    </li>
                                    <li>
                                        <form action="{{ route('members.destroy', ['member' => $member]) }}" 
                                            method="post" 
                                            class="d-inline">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" 
                                                    class="dropdown-item text-danger" 
                                                    onclick="return confirm('Are you sure you want to delete this member?')">
                                                <i class="bi bi-trash me-2"></i>Delete
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
            {{ $members->links('pagination::bootstrap-5') }}    
        </div>
    </div>
</div>

@endsection