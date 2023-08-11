@extends('layouts.master')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employee</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get_employees') }}">Employee</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="card">
                <div class="card-body p-4">
                    <h4 class="text-center p-4">Customer / Employee Details</h4>
                    <div class="row">
                        <div class="row mb-3">
                            <div class="col-sm-2">Unique Id</div>
                            <div class="col-sm-10">{{ $user->unique_id }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">Role</div>
                            <div class="col-sm-10">{{ $user->roles[0]['name'] }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">Name</div>
                            <div class="col-sm-10">{{ $user->name }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">Address</div>
                            <div class="col-sm-10">{{ $user->address }}</div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-2">Email</div>
                            <div class="col-sm-4">{{ $user->email }}</div>
                            <div class="col-sm-2">Phone</div>
                            <div class="col-sm-4">{{ $user->phone }}</div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-4">{{ $user->status }}</div>
                            <div class="col-sm-2">Gender</div>
                            <div class="col-sm-4">{{ $user->gender }}</div>
                        </div>

                        <hr>
                        <h4 class="text-center p-4">Login Details</h4>
                        <div class="row g-3">
                            <div class="col-md-6 row">
                                <div class="col-sm-2">Email</div>
                                <div class="col-sm-10">{{ $user->email }}</div>
                            </div>
                        </div>
                        <hr>
                        <div class="text-left p-4">
                            <button type="submit" class="btn btn-primary btn-sm">Edit</button>
                            <button type="reset" class="btn btn-secondary btn-sm">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
