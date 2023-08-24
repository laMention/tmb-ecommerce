@extends('layouts.auth')





@section('title')

    {{ localize('Sign Up') }}

@endsection





@section('contents')

    <section class="login-section py-5">

        <div class="container">

            <div class="row justify-content-center">

                {{-- todo:: make banner dynamic --}}

                <div class="col-lg-5 col-12 tt-login-img"

                    data-background="{{ staticAsset('frontend/default/assets/img/banner/login-banner.jpg') }}"></div>

                <div class="col-lg-5 col-12 bg-white d-flex p-0 tt-login-col shadow">

                    <form class="tt-login-form-wrap p-3 p-md-6 p-lg-6 py-7 w-100 " action="{{ route('register') }}"

                        method="POST" id="login-form">

                        @csrf

                        <div class="mb-7">

                            <a href="{{ route('home') }}">

                                <img src="{{ uploadedAsset(getSetting('navbar_logo')) }}" alt="logo">

                            </a>

                        </div>

                        <h2 class="mb-4 h3">{{ localize('Salut!') }}

                            <br>{{ localize('Inscrivez-vous en tant que client.') }}

                        </h2>



                        <div class="row g-3">

                            <div class="col-sm-12">

                                <div class="input-field">

                                    <label class="fw-bold text-dark fs-sm mb-1">{{ localize('Nom et prénom') }}<sup

                                            class="text-danger">*</sup>

                                    </label>

                                    <input type="text" id="name" name="name"

                                        placeholder="{{ localize('Entrez votre nom') }}" class="theme-input"

                                        value="{{ old('name') }}" required>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <div class="input-field">

                                    <label class="fw-bold text-dark fs-sm mb-1">{{ localize('Email') }}<sup

                                            class="text-danger">*</sup></label>

                                    <input type="email" id="email" name="email"

                                        placeholder="{{ localize('Entrer votre Email') }}" class="theme-input"

                                        value="{{ old('email') }}" required>

                                </div>

                            </div>



                            <div class="col-sm-12">

                                <div class="input-field">

                                    <label class="fw-bold text-dark fs-sm mb-1">

                                        @if (getSetting('registration_with') == 'email_and_phone')

                                            {{ localize('Phone') }}<sup class="text-danger">*</sup>

                                        @else

                                            {{ localize('Phone') }}

                                        @endif

                                        <small>({{ localize('Entrez le numéro de téléphone avec le code du pays') }})</small>

                                    </label>

                                    <input type="text" id="phone" name="phone" placeholder="+225 07 00000000"

                                        class="theme-input" value="{{ old('phone') }}"

                                        @if (getSetting('registration_with') == 'email_and_phone') required @endif>

                                </div>

                            </div>



                            <div class="col-sm-12">

                                <div class="input-field check-password">

                                    <label class="fw-bold text-dark fs-sm mb-1">{{ localize('Mot de passe') }}<sup

                                            class="text-danger">*</sup></label>

                                    <div class="check-password">

                                        <input type="password" name="password" placeholder="{{ localize('Mot de passe') }}"

                                            class="theme-input" required>

                                        <span class="eye eye-icon"><i class="fa-solid fa-eye"></i></span>

                                        <span class="eye eye-slash"><i class="fa-solid fa-eye-slash"></i></span>

                                    </div>

                                </div>

                            </div>

                            <div class="col-sm-12">

                                <div class="input-field check-password">

                                    <label class="fw-bold text-dark fs-sm mb-1">{{ localize('Confirmez le mot de passe') }}<sup

                                            class="text-danger">*</sup></label>

                                    <div class="check-password">

                                        <input type="password" name="password_confirmation"

                                            placeholder="{{ localize('Confirmez le mot de passe') }}" class="theme-input" required>

                                        <span class="eye eye-icon"><i class="fa-solid fa-eye"></i></span>

                                        <span class="eye eye-slash"><i class="fa-solid fa-eye-slash"></i></span>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="row g-4 mt-3">

                            <div class="col-sm-12">

                                <button type="submit" class="btn btn-primary w-100 sign-in-btn"

                                    onclick="handleSubmit()">{{ localize('S inscrire') }}</button>

                            </div>



                        </div>

                        <p class="mb-0 fs-xs mt-4">{{ localize('Vous avez déjà un compte?') }} <a

                                href="{{ route('login') }}">{{ localize('S identifier') }}</a></p>

                    </form>

                </div>

            </div>

        </div>

    </section>

@endsection



@section('scripts')

    <script>

        "use strict";



        // disable login button

        function handleSubmit() {

            $('#login-form').on('submit', function(e) {

                $('.sign-in-btn').prop('disabled', true);

            });

        }

    </script>

@endsection

