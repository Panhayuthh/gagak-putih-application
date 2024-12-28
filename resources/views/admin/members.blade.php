@extends('layouts.app')

@section('title', 'memberManagement')

@section('content')
@include('admin.addMember')
@include('admin.editMember')

<div class="container mt-4 p-4">
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

            <!-- Table Section -->
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
                                    <img src="{{ asset('storage/' . $member->photo) }}" alt="Profile" style="width: 45px; height: 45px"
                                    class="rounded-circle">
                                </td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->role }}</td>
                                <td>{{ $member->school }}</td>
                                <td>
                                    <span class="text-muted">
                                        <i class="bi {{ $member->gender == 'Male' ? 'bi-gender-male text-primary' : 'bi-gender-female text-danger' }} me-2"></i>
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
                                <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editMemberModal-{{ $member->id }}">
                                    Edit
                                </button>
                                <form action="{{ route('members.destroy', ['member' => $member]) }}" method="post" class="d-inline">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this member?')">
                                        Delete
                                    </button>
                                </form>
                                </td>
                            </tr>
            
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>