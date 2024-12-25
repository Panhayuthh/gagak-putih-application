@extends('layouts.app')

@section('title', 'Class')

@section('content')
<div class="container px-5">
    <div class="row g-4 justify-content-center">
        <div class="col-12 mt-5 text-center">
            <h1 class="mb-3">CLASSES</h1>
            <p>Documentation of the matches we have participated in and the medals won by the athletes.</p>
        </div>
        
        @foreach($classes as $class)
        <div class="col-3">
            <div class="card bg-white">
                <div class="card-body">
                    <img src="https://via.placeholder.com/350x350?text=Image" 
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
                </div>
            </div>
        </div>        
        @endforeach
    </div>

    <div class="row mt-5">
        {{ $classes->links() }}
    </div>
</div>

@endsection