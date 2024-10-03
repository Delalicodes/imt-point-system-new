@extends('layouts.app2')

@section('content')
<div class="container">
    <!-- Week Selection Form -->
    <div class="row">
        <div class="col-12">
            <form action="{{ route('dashboard') }}" method="GET" id="weekForm">
                <div class="form-group">
                    <label for="week">Select Week:</label>
                    <input type="week" name="week" id="week" class="form-control" value="{{ old('week', $startOfWeek->format('Y-\WW')) }}">
                </div>
            </form>
        </div>
    </div>

    <!-- Top 3 Users Section -->
    <div class="row mt-4">
        @if($topUsers->count() > 0)
            @foreach ($topUsers as $index => $user)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card pull-up
                        @if($index === 0) bg-success
                        @elseif($index === 1) bg-warning
                        @elseif($index === 2) bg-info
                        @endif text-white">

                        <div class="card-content">
                            <div class="card-body">
                                <div class="media d-flex">
                                    <div class="align-self-center">
                                        @if ($index === 0)
                                            <i class="la la-trophy font-large-2 text-white"></i> <!-- Gold trophy for first place -->
                                        @elseif ($index === 1)
                                            <i class="las la-medal font-large-2 text-white"></i> <!-- Silver medal for second place -->
                                        @elseif ($index === 2)
                                            <i class="las la-award font-large-2 text-white"></i> <!-- Bronze award for third place -->
                                        @endif
                                    </div>
                                    <div class="media-body text-right">
                                        <h5>{{ $user->first_name }} {{ $user->last_name }}</h5>
                                        <h3>{{ $user->total_points }} pts</h3>
                                        <p>Rank: {{ $index + 1 }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No top users found for this week.</p>
        @endif
    </div>

    <!-- Active Users Table Section -->
    <div class="row mt-4">
        @if($activeUsers->count() > 0)
            <h4 class="mb-3">Active Users</h4>
            <div class="table-responsive">
                <table class="table table-striped table-hover table-bordered">
                    <thead class="thead-light">
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Status</th>
                            <th>Clock-in Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($activeUsers as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->first_name }}</td>
                                <td>{{ $user->last_name }}</td>
                                <td><span class="badge badge-success">Active</span></td>
                                <td>{{ $user->attendance()->latest()->first()->clock_in_time ?? 'N/A' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No users are currently clocked in.</p>
        @endif
    </div>
</div>

<script>
    // Automatically submit form when a week is selected
    document.getElementById('week').addEventListener('change', function() {
        document.getElementById('weekForm').submit();
    });
</script>
@endsection

<style>
    /* Custom styles to enhance the table appearance */
    .table {
        border-radius: 0.5rem;
        overflow: hidden;
        border: 1px solid #dee2e6;
    }
    .table th {
        background-color: #f8f9fa;
        color: #343a40;
    }
    .table td {
        vertical-align: middle;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0, 123, 255, 0.1);
    }
    .badge {
        font-size: 0.9rem;
        padding: 0.5rem 0.7rem;
    }
</style>
