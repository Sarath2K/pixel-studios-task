@extends('layouts.master')
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Employees</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('get_employees') }}">Employee</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>

        <section class="section">
            <div class="card">
                <div class="card-body p-2">
                    <ul class="nav nav-tabs align-items-end w-100" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link"
                               href="{{ route('get_employees', ['roles' => ['Manager','Sales Executive']]) }}">
                                Employees
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url()->current() }}">
                                Create
                            </a>
                        </li>
                    </ul>
                    <form method="post" action="{{route('users.store')}}" method="POST" class="p-4">
                        @csrf
                        @method('POST')
                        <h4 class="text-center p-4">Customer / Employee Details</h4>
                        <div class="row mb-3">
                            <label for="hospital_name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="hospital_name" name="name">
                                @error('name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-sm-2 col-form-label">Address</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" id="address" name="address"></textarea>
                                @error('address')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-4">
                                <input type="email" class="form-control" id="email" name="email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                            <div class="col-sm-4">
                                <input type="phone" class="form-control" id="phone" name="phone">
                                @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <legend class="col-form-label col-sm-2 pt-0">Gender</legend>
                            <div class="col-sm-4">
                                <fieldset class="mb-3 d-flex justify-content-around">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_male"
                                               value="{{ GENDER_MALE }}" checked>
                                        <label class="form-check-label" for="gender_male">
                                            Male
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="gender" id="gender_female"
                                               value="{{ GENDER_FEMALE }}">
                                        <label class="form-check-label" for="gender_female">
                                            Female
                                        </label>
                                    </div>
                                </fieldset>
                            </div>

                            <label for="role" class="col-sm-2 col-form-label">Staff Role</label>
                            <div class="col-sm-4">
                                <select class="form-select states" aria-label="Default select example" id="role"
                                        name="role_id">
                                    <option selected disabled class="text-center">-- Select Role --</option>
                                    @forelse($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @empty
                                        <option selected>No Data Available</option>
                                    @endforelse
                                </select>
                                @error('role')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <label for="dob" class="col-sm-2 col-form-label">D.O.B</label>
                            <div class="col-sm-4">
                                <input type="date" class="form-control" id="date" name="dob">
                                @error('dob')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <legend class="col-form-label col-sm-2 pt-0">Status</legend>
                            <div class="col-sm-4">
                                <fieldset class="mb-3 d-flex justify-content-around">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_active"
                                               value="{{ EMPLOYEE_STATUS_ACTIVE }}" checked>
                                        <label class="form-check-label" for="status_active">
                                            Active
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="status" id="status_inactive"
                                               value="{{ EMPLOYEE_STATUS_INACTIVE }}">
                                        <label class="form-check-label" for="status_inactive">
                                            Inactive
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <hr>
                        <h4 class="text-center p-4">Login Details</h4>
                        <div class="row g-3">
                            <div class="col-md-6 row">
                                <label for="email_login" class="col-sm-2 form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" id="email_login" name="email_login"
                                           disabled/>
                                    @error('email_login')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 row">
                                <label for="password" class="col-sm-2 form-label">Pass Code</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="password" name="password"/>
                                    @error('password')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary m-1">Submit</button>
                            <button type="reset" class="btn btn-sm btn-secondary m-1">Back</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </main>
@endsection
@push('scripts')
    <script>
        const emailInput = document.getElementById('email');
        const emailLoginInput = document.getElementById('email_login');

        emailInput.addEventListener('input', function () {
            emailLoginInput.value = this.value;
        });
    </script>
@endpush
