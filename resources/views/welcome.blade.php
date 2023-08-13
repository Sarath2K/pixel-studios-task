@extends('layouts.header')
@section('master-content')
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="#" class="logo d-flex align-items-center">
                <img src="{{asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Pixel Studios</span>
            </a>
        </div><!-- End Logo -->

        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                @if (Route::has('login'))
                    @auth
                        <li class="nav-item m2">
                            <a href="{{ url('/dashboard') }}"
                               class="nav-link nav-profile d-flex align-items-center pe-0">Dashboard</a>

                        </li>
                    @else
                        <li class="nav-item m-2">
                            <a href="{{ route('login') }}" class="nav-link nav-profile d-flex align-items-center pe-0">Log
                                in</a>
                        </li>
                        @if (Route::has('register'))
                            <li class="nav-item m-2">
                                <a href="{{ route('register') }}"
                                   class="nav-link nav-profile d-flex align-items-center pe-0">Register</a>
                            </li>
                        @endif
                    @endauth
                @endif
            </ul>
        </nav>
    </header><!-- End Header -->
    <div class="welcome">
        <div class="content">
            <div>
                <h1 class="text-primary">Be alive with tech Satisfaction</h1>
                <h2 class="card-title">Maximise your business potential with the art of web apps from us.</h2>
            </div>
        </div>
    </div>
@endsection()
