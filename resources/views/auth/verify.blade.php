@extends('layouts.main')

@section('page-title')
Veryfy Email
@endsection

@section('custom-css')
<style>
    .veryfy{
        padding-top: 70px;
        height: 350px;
    }
</style>
@endsection

@section('page-content')
<div class="row justify-content-center veryfy">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Verify Your Email Address') }}</div>

            <div class="card-body">
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
@endsection

@section('custom-js')
@endsection