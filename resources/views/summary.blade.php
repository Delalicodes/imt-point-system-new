@extends('layouts.app2')

@section('title')
    <div class="container mt-4">
        <h2 class="text-center font-weight-bold">Leaderboard</h2>
    </div>
@endsection

@section('content')
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Leaderboard</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped table-responsive-sm">
                    <thead>
                        <tr>
                            <th scope="col">User Name</th>
                            <th scope="col">Total Points</th>
                            <th scope="col">Position</th>
                            <th scope="col">Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($usersWithPoints as $index => $user)
                            <tr>
                                <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                <td>{{ $user->total_points }}</td>
                                <td>
                                    @if ($index == 0)
                                        <span class="text-warning">🥇 Gold Medal</span> <!-- Gold Medal -->
                                    @elseif($index == 1)
                                        <span class="text-secondary">🥈 Silver Medal</span> <!-- Silver Medal -->
                                    @elseif($index == 2)
                                        <span class="text-bronze">🥉 Bronze Medal</span> <!-- Bronze Medal -->
                                    @else
                                        {{ $index + 1 }} <!-- Display rank for other positions -->
                                    @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                            </tr>


                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
