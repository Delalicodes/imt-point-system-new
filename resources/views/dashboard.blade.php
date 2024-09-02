@extends('layouts.app')

@section('widget')
    <div class="container-fluid mt-5">
        <h1 class="dashboard-title text-center mb-5">Leaderboard: Top Achievers</h1>
        <div class="row justify-content-center">
            @foreach ($topUsers as $index => $user)
                <div class="col-sm-6 col-md-4 col-lg-3 mb-4">
                    <div class="card h-100 d-flex flex-column justify-content-center align-items-center {{ $index < 3 ? 'gradient-card' : 'regular-card' }}">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                @if ($index === 0)
                                    <i class="pe-7s-medal pe-5x" style="color: #ffd700;"></i>
                                @elseif ($index === 1)
                                    <i class="pe-7s-medal pe-4x" style="color: #c0c0c0;"></i>
                                @elseif ($index === 2)
                                    <i class="pe-7s-medal pe-3x" style="color: #cd7f32;"></i>
                                @else
                                    <i class="pe-7s-user pe-4x" style="color: #007bff;"></i>
                                @endif
                            </div>
                            <h5 class="card-title mb-2">
                                {{ $user->first_name }} {{ $user->last_name }}
                            </h5>
                            <h4 class="card-text mb-0">
                                {{ $user->total_points }} pts
                            </h4>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .dashboard-title {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
            margin-bottom: 40px;
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .card {
            border-radius: 15px; /* Rounded corners */
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Subtle shadow */
            transition: transform 0.3s, box-shadow 0.3s;
            height: 250px; /* Fixed height for uniformity */
            padding: 20px; /* Padding for spacing */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); /* Pronounced shadow on hover */
        }

        .gradient-card {
            background: linear-gradient(135deg, #ff7e5f, #feb47b); /* Bootstrap-compatible gradient */
            color: #ffffff;
        }

        .regular-card {
            background-color: #ffffff;
            color: #333333;
        }
    </style>
@endpush
