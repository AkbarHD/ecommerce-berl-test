@extends('admin.layouts.tamplate')

@section('title', 'Dashboard')
@section('content')

@section('css')
    <link rel="stylesheet" href="{{ asset('style/homeadmin.css') }}">
    <style>
        .card-box {
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .icon-box {
            font-size: 30px;
        }

        .card-title {
            font-weight: bold;
            font-size: 18px;
        }

        .card-value {
            font-size: 24px;
            margin-top: 5px;
        }
    </style>
@endsection

<div class="dashboard-container py-4">
    <div class="welcome-section">
        {{-- <h2 class="text-success">{{ __('Halo, selamat datang') }} <span class="user-name">{{ Auth::user()->nameclub }}</span>!</h2> --}}
        <h2 class="text-success">{{ __('Halo, selamat datang') }} <span class="user-name">{{ Auth::user()->name }}</span>!
        </h2>
        <p>
            {{ __('Senang bertemu kembali. Anda kini berada di dashboard sistem manajemen. Berikut ringkasan aktivitas Anda hari ini.') }}
        </p>
    </div>


    <div class="row g-3">
        <div class="col-md-4">
            <div class="card-box bg-warning">
                <div>
                    <div class="">Pending</div>
                    <div class="card-value">{{ $totalPending }}</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-clock"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box bg-success">
                <div>
                    <div class="">Lunas</div>
                    <div class="card-value">{{ $totalLunas }}</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-check-circle"></i>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-box bg-danger">
                <div>
                    <div class="">Dibatalkan</div>
                    <div class="card-value">{{ $totalBatal }}</div>
                </div>
                <div class="icon-box">
                    <i class="fas fa-times-circle"></i>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('js')

@endsection
