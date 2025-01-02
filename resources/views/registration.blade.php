@extends('layouts.app')

@section('title', 'Register Member')

@section('content')

<form action="{{ route('member.store') }}" method="POST" enctype="multipart/form-data" class="container-fluid">
    @csrf
    <div class="row justify-content-center my-5">
        <div class="col-5">

        @if(session('error'))
            <div class="alert alert-danger mt-3">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mt-3">{{ session('success') }}</div>
        @endif

            <h1 class="lead">Come join us and be part of</h1>
            <h1><strong>GAGAK PUTIH INDONESIA !</strong></h1>
            
            <div class="mb-3">
                <label class="form-label d-block">Role</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="roleCoach" name="role" value="coach" required>
                    <label class="form-check-label" for="roleCoach">Coach</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="roleAthlete" name="role" value="athlete" required checked>
                    <label class="form-check-label" for="roleAthlete">Athlete</label>   
                </div>
            </div>
            <div class="row">                
                <x-form-input label="name" name="name" id="InputName" />
                <x-form-input label="school" name="school" id="InputSchool" />
            </div>  
            <x-form-input label="email" name="email" id="InputEmail" />  
            <div class="mb-3">
                <label class="form-label d-block">Gender</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderMale" name="gender" value="male" required>
                    <label class="form-check-label" for="genderMale">Male</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" id="genderFemale" name="gender" value="female" required>
                    <label class="form-check-label" for="genderFemale">Female</label>
                </div>
            </div>   
            <div class="row">
                <div class="col mb-3">
                    <label for="belt" class="form-label">Belt</label>
                    <select class="form-select" id="belt" name="belt" required>
                        <option value="white">White</option>
                        <option value="yellow">Yellow</option>
                        <option value="orange">Orange</option>
                        <option value="green">Green</option>
                        <option value="blue">Blue</option>
                        <option value="purple">Purple</option>
                        <option value="brown">Brown</option>
                        <option value="black">Black</option>
                    </select>
                </div>
                <div class="col mb-3">
                    <label for="medal" class="form-label">Medal</label>
                    <select class="form-select" id="medal" name="medal">
                        <option value="">No Medal</option>
                        <option value="gold">Gold</option>
                        <option value="silver">Silver</option>
                        <option value="bronze">Bronze</option>
                    </select>
                </div>
            </div>     
            <div class="mb-3">
                <label for="profile" class="form-label">Profile</label>
                <input type="file" class="form-control" id="profile" name="profile" accept="image/*">
            </div>

            <button type="submit" class="btn btn-primary">Register</button>
        </div>
    </div>
</form>

@endsection