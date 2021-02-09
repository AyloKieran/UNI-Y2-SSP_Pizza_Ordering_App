@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Register') }}
                </div>

                <div class="card-body">
                    <form method="post">
                        @csrf
                        <fieldset>
                            <legend>Enter your registration details</legend>

                            <div class="form-group row"> <!-- Added formatting -->
                                <label for="name" class="col-md-4 col-form-label text-md-right">Username:</label> <!-- Added formatting -->

                                <div class="col-md-6">
                                    <input type="text" required name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" autofocus> <!-- Added error feedback, re-fill value on error, focus on load -->

                                    @error('name') <!-- Added error feedback -->
                                        <span class="invalid-feedback" role="alert">
                                         <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Added same enhancements for rows below; other than password refilling for security purposes -->

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>

                                <div class="col-md-6">
                                    <input type="password" required name="password" id="password" class="form-control @error('password') is-invalid @enderror">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">Confirm Password:</label>

                                <div class="col-md-6">
                                    <input type="password" required name="password_confirmation" id="password_confirmation" class="form-control @error('password') is-invalid @enderror">

                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>

                                <div class="col-md-6">
                                    <input type="text" required name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="url" class="col-md-4 col-form-label text-md-right">Webpage URL:</label>

                                <div class="col-md-6">
                                    <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror" value="{{ old('url') }}" autofocus>

                                    @error('url')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">Date of birth:</label>

                                <div class="col-md-6">
                                    <input type="date" required name="dob" id="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" autofocus>

                                    @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            @if(config('services.recaptcha.key'))
                                <div class="form-group row">
                                    <div class="g-recaptcha mx-auto" data-sitekey="{{config('services.recaptcha.key')}}">
                                    </div>

                                    @error('g-recaptcha-response')
                                        <span class="mx-auto" style="width: 100%; margin-top: 0.25rem; font-size: 80%; color: #e3342f; text-align: center" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            @endif

                        </fieldset>
                        <div class="col-md-8 offset-md-4">
                            <button type="submit" name="submit" class="btn btn-primary" formnovalidate>Submit Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
