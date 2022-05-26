@extends('layouts.main1')

@section('content')

<!-- banner -->
<section class="inner-page-banner login-inner-banner verify_email_section">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-title-wrap text-center">
                    <h1 class="page-title-heading">Verify</h1>
                    <p class="page-sub-title">{{ __('Verify Your Email Address') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //banner -->

<div class="content-wrap">
<section class="login-main-section login_text_2">
    <div class="container">
        <!-- login  -->
        <div class="row">
            <div class="col-md-8 col-lg-6 offset-lg-3 offset-md-2">
                <div class="form-border-md">
                   

                <div class="card-boday">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    {{ __('Before proceeding, please check your email for a verification link.') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                </div>
                </div>
            </div>
        </div>
        <!-- //login -->
    </div>
</section>
</div>

@endsection
