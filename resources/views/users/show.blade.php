@extends('layouts.master')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employee</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get_employees') }}">Employee</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get_customers') }}">Customers</a></li>
                    <li class="breadcrumb-item active">Show</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->
        @include('layouts.alert')
        <section class="section">
            <div class="card container">
                <div class="card-body p-4">
                    <h4 class="text-center p-4">Customer / Employee Details</h4>
                    <div class="row">
                        <div class="row mb-3">
                            @php
                                $generator = new Picqer\Barcode\BarcodeGeneratorHTML();
                            @endphp
                            <div class="col-sm-2">Unique Id</div>
                            <div class="col-sm-5">{{ $user->unique_id??'-' }}</div>
                            <div
                                class="col-sm-5">{!! $generator->getBarcode( $user->unique_id, $generator::TYPE_CODE_128) !!}
                            </div>
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
                            <div class="col-sm-2">DOB</div>
                            <div class="col-sm-10">{{ $user->dob??'-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">Address</div>
                            <div class="col-sm-10">{{ $user->address?? '-' }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">Email</div>
                            <div class="col-sm-4">{{ $user->email }}</div>
                            <div class="col-sm-2">Phone</div>
                            <div class="col-sm-4">{{ $user->phone }}</div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2">Gender</div>
                            <div class="col-sm-4">{{ $user->gender }}</div>
                            <div class="col-sm-2">Status</div>
                            <div class="col-sm-4">{{ $user->status }}</div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <a type="button" class="btn btn-primary btn-sm m-1"
                               href="{{ route('users.edit', $user->id) }}">Edit</a>
                            <a type="button" class="btn btn-secondary btn-sm m-1"
                               href="{{ url()->previous() }}">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
