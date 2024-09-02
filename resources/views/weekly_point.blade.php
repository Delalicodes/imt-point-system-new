@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary font-weight-bold">Weekly Summary</h1>
            <p class="lead text-muted">Track and view the summary of user points for the week</p>
        </div>

        <!-- Table Title -->
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">Weekly Points Overview</h2>
            <p class="text-muted">View the points accumulated by users for the current week</p>
        </div>

        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>Weekly Points Table</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Position</th>
                                <th scope="col">Name</th>
                                <th scope="col">Total Points</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $index => $user)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                    <td>{{ $user->total_points }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Include jQuery and Bootstrap JS -->
<script src="../assets/js/jquery-3.5.1.min.js"></script>
<script src="../assets/js/bootstrap/popper.min.js"></script>
<script src="../assets/js/bootstrap/bootstrap.js"></script>

<!-- Include Feather Icons -->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
