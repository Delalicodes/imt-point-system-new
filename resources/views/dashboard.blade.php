@extends('layouts.app2')

@section('content')
<div class="container">
    <!-- Top Users Section -->
    <div class="row">
        @foreach ($topUsers as $index => $user)
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card pull-up">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="media d-flex">
                                <div class="align-self-center">
                                    @if ($index === 0)
                                        <i class="las la-medal font-large-2 success"></i>
                                    @elseif ($index === 1)
                                        <i class="las la-award font-large-2 warning"></i>
                                    @elseif ($index === 2)
                                        <i class="la la-star font-large-2 info"></i>
                                    @else
                                        <i class="la la-bed font-large-2 danger"></i>
                                    @endif
                                </div>
                                <div class="media-body text-right">
                                    <h5 class="text-muted text-bold-500">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                    <h3 class="text-bold-600">{{ $user->total_points }} pts</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Active Users Section -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Active Users</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Time</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($activeUsers as $user)
                                    <tr>
                                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>

                                        <td>{{ $user->created_at }}</td>
                                        <td>Active</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
