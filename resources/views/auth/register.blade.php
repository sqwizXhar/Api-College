@extends('layouts.auth')

@section('title')
    <h1 class="title">Register a new account</h1>
@endsection

@section('form')
    <div class="container min-vh-100 d-flex justify-content-center">

        <form action="{{ route('register') }}" method="post">
            @csrf
            {{-- First_name --}}
            <div class="col-lg-6">
                <label for="first_name">Firstname</label>
                <input type="text"
                       name="first_name"
                       class="col-form-label"
                       id="first_name"
                >
                @error('first_name')
                <p class="error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Last_name --}}
            <div class="col-lg-6">
                <label for="last_name">Lastname</label>
                <input type="text"
                       name="last_name"
                       class="col-form-label"
                       id="last_name"
                >
            </div>

            {{-- Middle_name --}}
            <div class="col-lg-6">
                <label for="middle_name">Middle name</label>
                <input type="text"
                       name="middle_name"
                       class="col-form-label"
                       id="middle_name"
                >
            </div>

            {{-- Login --}}
            <div class="col-lg-6">
                <label for="login">Login</label>
                <input type="text"
                       name="login"
                       class="col-form-label"
                       id="login"
                >
            </div>

            {{-- Password --}}
            <div class="col-lg-6">
                <label for="password">Password</label>
                <input type="password"
                       name="password"
                       class="col-form-label"
                       id="password"
                >
            </div>

            {{-- Submit Button --}}
            <button class="btn btn-dark">Register</button>

        </form>

    </div>
@endsection
