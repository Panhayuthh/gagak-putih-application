@extends('layouts.app')

@section('title', 'event Management')

@section('content')
@include('admin.addEvent')
@include('admin.editEvent')

<div class="container mt-4 p-4">
        <div class="row align-items-center mb-4 ">

            @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
            @endif
    
            @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif
            
            <div class="col mt-0">
                <h1 class="mb-3">Event Management</h1>
            </div>
            <div class="col-auto">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
              Add Event
            </button>
            </div>
        </div>

        <div class="row g-3">
    @foreach($events as $event)
        <div class="col-12 col-sm-6 col-md-4 col-lg-3">
            <div class="card h-100 border-0 rounded-4 overflow-hidden shadow-lg">
                <div class="position-relative">
                    <img src="{{ $event->photo ? asset('storage/' . $event->photo) : 'https://via.placeholder.com/350x350?text=Image' }}" 
                        class="card-img-top img-fluid" 
                        alt="Event Image" 
                        style="height: 250px; object-fit: cover; object-position: center;">
                    <div class="position-absolute top-0 end-0 p-3">
                        <span class="badge bg-primary bg-opacity-75 rounded-pill">
                            {{ $event->created_at->diffForHumans() }}
                        </span>
                    </div>
                </div>
                
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title fw-bold mb-3 text-truncate d-inline-block" style="max-width: 100%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                        {{ $event->name }}</h5>
                    
                    <div class="d-flex align-items-center mb-2">
                        <span class="text-muted text-truncate d-inline-block" style="max-width: 100%; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                            <i class="bi bi-geo-alt text-primary me-3"></i>{{ $event->location }}
                        </span>
                    </div>
                    
                    <div class="d-flex align-items-center mb-3">
                        <i class="bi bi-calendar text-primary me-3"></i>
                        <span class="text-muted">{{ $event->date ?? 'N/A' }}</span>
                    </div>
                    
                    <div class="mt-auto d-flex justify-content-between align-items-center">
                        <div class="dropdown">
                            <button class="btn btn-primary btn-sm dropdown-toggle" 
                                    type="button" 
                                    id="eventActionsDropdown-{{ $event->id }}" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                <i class="bi bi-three-dots-vertical me-1"></i> 
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" 
                                aria-labelledby="eventActionsDropdown-{{ $event->id }}">
                                <li>
                                    <button type="button" 
                                            class="dropdown-item" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editEventModal-{{ $event->id }}">
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </button>
                                </li>
                                <li>
                                    <form action="{{ route('events.destroy', ['event' => $event]) }}" 
                                        method="post" 
                                        class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" 
                                                class="dropdown-item text-danger" 
                                                onclick="return confirm('Are you sure you want to delete this event?')">
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

          {{ $events->links('pagination::bootstrap-5') }}    
      </div>

@endsection
