@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{ __('Selamat datang ') }}
            {{ __(Auth::user()->name) }}
            {{ __(' di TesLogin.com') }}
            <br><br>

            <div class="container">
                @if(is_null(Auth::user()->email_verified_at))
                    <div class="alert alert-warning" role="alert">
                        {{ __('Kami sudah mengirimkan email untuk memverifikasi akun kamu, namun kami belum bisa memverifikasi email kamu.') }}
                        <form method="POST" action="{{ route('verification.resend') }}">
                            @csrf
                            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('Kirimkan ulang email verifikasi') }}</button>
                        </form>
            </div>
            @endif

            <div class="card">
                <div class="card-header">{{ __('Detail Pengguna') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <table>
                    <tr>
                        <td>Nama</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ Auth::user()->name }}</td>
                    </tr>
                    <tr>
                        <td>Alamat Email</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ Auth::user()->email }}</td>
                    </tr>
                    <tr>
                        <td>Nomor Telepon</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ Auth::user()->phone }}</td>
                    </tr>
                    <tr>
                        <td>Akun Dibuat Pada</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ Auth::user()->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Terakhir Diedit</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td>{{ Auth::user()->updated_at}}</td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>&nbsp;:&nbsp;</td>
                        @if (is_null(Auth::user()->email_verified_at))
                            <td>Email belum diverifikasi</td>
                        @endif
                        @if (!is_null(Auth::user()->email_verified_at))
                            <td>Email terverifikasi</td>
                        @endif
                    </tr>
                
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
