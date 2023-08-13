@extends('layouts.header')
@section('master-content')
    <main>
        <div class="container">
            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="d-flex justify-content-center py-4">
                                <a href="index.html" class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/logo.png" alt="">
                                    <span class="d-none d-lg-block">Pixel Studios</span>
                                </a>
                            </div><!-- End Logo -->
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                                        <p class="text-center small">Enter your personal details to create account</p>
                                    </div>
                                    <form class="row g-3 needs-validation" novalidate method="POST"
                                          action="{{ route('register') }}">
                                        @csrf
                                        <div class="col-12">
                                            <label for="name" :value="__('Name')" class="form-label">Your Name</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                   :value="old('name')" required autofocus>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                                        </div>

                                        <div class="col-12">
                                            <label for="email" :value="__('Email')" class="form-label">Email</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                <input type="email" name="email" class="form-control" id="email"
                                                       :value="old('email')" required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="phone" :value="__('Phone')" class="form-label">Phone</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"><i
                                                        class="bi bi-phone"></i></span>
                                                <input type="phone" name="phone" class="form-control" id="phone"
                                                       :value="old('phone')" required>
                                                <div class="invalid-feedback">Please choose a username.</div>
                                            </div>
                                        </div>

                                        <div class="row g-3">
                                            <legend class="col-form-label col-sm-4 pt-0">Gender</legend>
                                            <div class="col-sm-8">
                                                <fieldset class="mb-3 d-flex justify-content-around">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                               id="gender_male"
                                                               value="{{ GENDER_MALE }}" checked>
                                                        <label class="form-check-label" for="gender_male">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="gender"
                                                               id="gender_female"
                                                               value="{{ GENDER_FEMALE }}">
                                                        <label class="form-check-label" for="gender_female">
                                                            Female
                                                        </label>
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" :value="__('Password')"
                                                   class="form-label">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="password"
                                                   required autocomplete="new-password">
                                            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                                        </div>

                                        <div class="col-12">
                                            <label for="password_confirmation" :value="__('Confirm Password')"
                                                   class="form-label">Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control"
                                                   id="password_confirmation" required>
                                            <x-input-error :messages="$errors->get('password_confirmation')"
                                                           class="mt-2"/>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" name="terms" type="checkbox"
                                                       value=""
                                                       id="acceptTerms" required>
                                                <label class="form-check-label" for="acceptTerms">I agree and accept
                                                    the
                                                    <a href="#">terms and conditions</a></label>
                                                <div class="invalid-feedback">You must agree before submitting.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Create Account
                                            </button>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('login') }}">Log in</a></p>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main><!-- End #main -->
@endsection
