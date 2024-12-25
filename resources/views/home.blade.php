@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <!-- Hero Section -->
    <div class="position-relative text-white">
        <img src="{{ asset('images/dashboard.png') }}" alt="Hero Image" class="img-fluid w-100 object-cover opacity-50" style="height: 100vh; object-fit: cover;">
        <div class="position-absolute top-50 start-0 translate-middle-y ">
            <p class="fw-bold text-uppercase ms-5 " style="font-size:6em">GAGAK PUTIH</p>
            <h2 class="fw-bold ms-5" style="font-size:3em">INDONESIA</h2>
            <a href="">
                <button class="btn btn-primary btn-lg mt-5 ms-5 border-yellow-400 hover:bg-blue-600" style="width: 180px">Register</button>
            </a>
        </div>
    </div>

    <!-- About Section -->
    <div class="container d-flex align-items-center justify-content-center" style="height: 100vh;">
        <div class="row w-100">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold pb-5">ABOUT US</h1>
                <p class="lead">
                    Gagak Putih Indonesia is one of the branches of pencak silat <br>
                    martial arts in Indonesia. Gagak Putih Indonesia was founded by <br>
                    Pendekar Utama Haji Junaedi in 1972...
                </p>
            </div>
            <div id="carouselImage" class="carousel slide col-lg-5" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/aboutus1.png') }}" alt="Gagak Putih" class="img-fluid rounded d-block">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/aboutus2.png') }}" alt="Gagak Putih" class="img-fluid rounded d-block">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/aboutus3.png') }}" alt="Gagak Putih" class="img-fluid rounded d-block">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/aboutus4.png') }}" alt="Gagak Putih" class="img-fluid rounded d-block">
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselImage" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselImage" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Card Section -->
    <div class="container mt-4 py-5">
    <h2 class="text-center text-white fw-bold mb-4">SCHEDULE</h2>
    <div class="row justify-content-center">
        @php 

        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        @endphp

        @foreach ($days as $day)
        
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1 class="mt-2">{{ $day }}</h1>
                <div class="p-2">
                    @foreach ($classes as $class)
                    @if ($class->date == $day)
                    <div class="row p-2 mt-2">
                        <div class="col-4">
                            <img src="{{ $class->photo ? asset('storage/' . $class->photo) : 'https://via.placeholder.com/350x350?text=Image' }}" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                        </div>
                        
                        <div class="col align-self-start text-start">
                            <p>{{ $class->location }}</p>
                            <p>{{ $class->start_time }} - {{ $class->end_time }}</p>
                        </div>
                    </div>
                    @endif
                    @endforeach
                </div>
            </div>
        </div>

        @endforeach

        <!-- Single Day Card -->
        {{-- <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Monday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 1 Cibinong<br>
                            09.00 - 11.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            15.00 - 17.00</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Repeat for other days -->
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Tuesday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 2 Cibinong<br>
                            10.00 - 12.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            16.00 - 18.00</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Wednesday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 3 Cibinong<br>
                            08.00 - 10.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            14.00 - 16.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Thursday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 3 Cibinong<br>
                            08.00 - 10.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            14.00 - 16.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Friday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 3 Cibinong<br>
                            08.00 - 10.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            14.00 - 16.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Saturday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 3 Cibinong<br>
                            08.00 - 10.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            14.00 - 16.00</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4 justify-content-center d-flex">
            <div class="card" style="background-color:white; color:black; text-align:center;">
                <h1>Sunday</h1>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school1.jpeg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Junior High School PGRI 3 Cibinong<br>
                            08.00 - 10.00</p>
                    </div>
                </div>
                <div class="d-flex flex-row align-items-center p-2">
                    <div class="flex-shrink-0">
                        <img src="/image/school2.jpg" alt="School" class="img-fluid rounded" style="width: 100px; height: auto;">
                    </div>
                    <div class="ms-3">
                        <p>Senior High School PGRI Cibinong<br>
                            14.00 - 16.00</p>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
</div>

@endsection
