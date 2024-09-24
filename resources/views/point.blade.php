@extends('layouts.app2')

@section('content')
    <div class="container mt-5">
        <!-- Page Title Section -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary font-weight-bold">User Points Management</h1>
            <p class="lead text-muted">Easily manage and track user points.</p>
        </div>

        <!-- Add Points Section -->
        <div class="d-flex justify-content-center mb-4">
            <button id="addButton" type="button" class="btn btn-lg btn-info shadow-lg" data-bs-toggle="modal" data-bs-target="#addModal">
                Add Points
            </button>
        </div>

        <!-- Add Points Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header bg-info text-white">
                        <h5 class="modal-title" id="addModalLabel">Add Points</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm">
                            @csrf <!-- CSRF Token -->
                            <div class="mb-3">
                                <label for="user_id" class="form-label">Select User</label>
                                <!-- Changed to 'form-control' to match the points input style -->
                                <select class="form-control" name="user_id" id="user_id" required>
                                    <option value="">Choose a user...</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="point" class="form-label">Points</label>
                                <input type="number" id="point" name="point" class="form-control" placeholder="Enter points" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Save Points</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Points Overview Section -->
        <div class="card mt-5 shadow-lg">
            <div class="card-header bg-info text-white">
                <h5 class="card-title mb-0">User Points Table</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Name</th>
                                <th>Points</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($points as $point)
                                <tr>
                                    <td>{{ $point->user->first_name }} {{ $point->user->last_name }}</td>
                                    <td>{{ $point->point }}</td>
                                    <td>{{ $point->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No points available yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

<!-- Scripts Section -->
    <!-- Include Bootstrap CSS and JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Script for Modal & AJAX -->
    <script>
        $(document).ready(function () {
            var addModal = new bootstrap.Modal(document.getElementById('addModal'));

            // Show modal when "Add Points" button is clicked
            $('#addButton').on('click', function () {
                addModal.show();
            });

            // Handle form submission with AJAX
            $('#saveButton').on('click', function (event) {
                event.preventDefault(); // Prevent default form submission

                let formData = $('#addForm').serialize(); // Serialize form data

                $.ajax({
                    url: '{{ route('point.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function (response) {
                        alert(response.success); // Show success message
                        location.reload(); // Reload the page to show updated points
                    },
                    error: function (xhr) {
                        console.error(xhr);
                        alert('An error occurred. Please try again.');
                    }
                });
            });

            // Reload page when modal is closed
            $('#addModal').on('hidden.bs.modal', function () {
                location.reload();
            });
        });
    </script>
