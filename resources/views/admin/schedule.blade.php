@extends('layouts.app')

@section('title', 'Schedule Management')

@section('content')

@include('admin.addSchedule')
@include('admin.editSchedule')

<div class="container px-5">
    <div class="row g-4 justify-content-center">
        <div class="col-12 mt-5">
            <div class="row align-items-center">

                @if(session('error'))
                <div class="alert alert-danger mt-3">{{ session('error') }}</div>
                @endif
        
                @if(session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif

                <div class="col mt-0">
                    <h1 class="mb-3">Schedule Management</h1>
                </div>
                <div class="col-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addScheduleModal">
                  Add Schedule
                </button>
                </div>
            </div>
        </div>

        @if ($classes->isEmpty())
        <div class="col-12 mt-3">
            <p class="m-0">You have no schedules.</p>
        </div>
        @endif
        
        @foreach($classes as $class)
        <div class="col-3">
            <div class="card bg-white">
                <div class="card-body">
                    <img src="{{ $class->photo ? asset('storage/' . $class->photo) : 'https://via.placeholder.com/350x350?text=Image' }}" 
                         class="w-100 mb-3 rounded" 
                         style="height: 150px; object-fit: cover;" 
                         alt="...">
                    <h5 class="card-title text-dark fw-bold mb-3 text-truncate d-inline-block" 
                        style="max-width: 100%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                        {{ $class->name }}
                    </h5>
                    <p class="card-text fw-bold text-dark m-0">
                        <i class="bi bi-mortarboard text-primary me-2"></i>
                        {{ $class->level }}</p>
                    <p class="card-text text-dark m-0">
                        <i class="bi bi-calendar text-primary me-2"></i>
                        {{ $class->date }}, 
                        {{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }} - 
                        {{ \Carbon\Carbon::parse($class->end_time)->format('H:i') }}
                    </p>
                    <p class="card-text text-dark m-0 text-truncate d-inline-block" 
                        style="max-width: 100%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                        <i class="bi bi-geo-alt text-primary me-2"></i>
                        {{ $class->location }}
                    </p>

                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" 
                                    type="button" 
                                    id="ScheduleActionsDropdown-{{ $class->id }}" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <i class="bi bi-three-dots-vertical me-1"></i> 
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" 
                                aria-labelledby="ScheduleActionsDropdown-{{ $class->id }}">
                                <li>
                                    <button type="button" 
                                            class="dropdown-item" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editScheduleModal-{{ $class->id }}">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </button>
                                </li>
                                <li>
                                    <form action="{{ route('schedule.destroy', ['class' => $class]) }}" 
                                        method="post" 
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" 
                                                class="dropdown-item text-danger" 
                                                onclick="return confirm('Are you sure you want to delete this Schedule?')">
                                            <i class="bi bi-trash me-2"></i>Delete
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        @endforeach
    </div>

    <div class="row mt-5">
        {{ $classes->links('pagination::bootstrap-5') }}
    </div>
</div>

@endsection