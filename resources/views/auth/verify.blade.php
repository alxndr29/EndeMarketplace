@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Verifikasikan alamat email anda') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Link verifikasi email telah dikirimkan ke email yang terdaftar.') }}
                        </div>
                    @endif

                    {{ __('Sebelum melanjutkan, periksa email anda untuk melihat link verifikasi.') }}
                    {{ __('Jika anda tidak menerima email') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('klik disini untuk meminta lagi') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
