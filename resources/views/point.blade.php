@extends('layouts.app2')

@section('point')
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="display-4 text-primary font-weight-bold">User Points Management</h1>
            <p class="lead text-muted">Easily manage and track user points</p>
        </div>

        <!-- Add Button -->
        <div class="d-flex justify-content-center">
            <button id="addButton" type="button" class="btn btn-info btn-lg">
                Add Points
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Points</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addForm">
                            @csrf <!-- Include CSRF token field -->
                            <div class="mb-2">
                                <label class="col-form-label">Name</label>
                                <select class="form-control form-control-info btn-square" name="user_id" id="user_id">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="point" class="form-label">Points</label>
                                <input type="number" id="point" name="point" class="form-control" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveButton">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('table')
    <div class="container mt-5">
        <!-- Table Title -->
        <div class="text-center mb-4">
            <h2 class="font-weight-bold">Points Overview</h2>
            <p class="text-muted">View and manage points allocated to users</p>
        </div>

        <div class="card">
            <div class="card-header bg-info text-white">
                <h5>User Points Table</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Points</th>
                                <th scope="col">Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($points as $point)
                                <tr>
                                    <td>{{ $point->user->first_name }} {{ $point->user->last_name }}</td>
                                    <td>{{ $point->point }}</td>
                                    <td>{{ $point->created_at }}</td>
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom Script -->
<script>
    $(document).ready(function() {
        var addModal = new bootstrap.Modal(document.getElementById('addModal'));

        // Show the modal when the Add button is clicked
        $('#addButton').on('click', function() {
            addModal.show();
        });

        // Handle the form submission with AJAX
        $('#saveButton').on('click', function(event) {
            event.preventDefault(); // Prevent default form submission

            const formData = $('#addForm').serialize();

            // Include CSRF token
            formData._token = "{{ csrf_token() }}";

            // AJAX request to store the data
            $.ajax({
                url: '{{ route('point.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Success:', response);
                    addModal.hide(); // Close the modal
                    alert(response.success); // Display success message
                    location.reload(); // Reload page to show updated points
                },
                error: function(xhr) {
                    console.error('Error:', xhr.status, xhr.statusText);
                    const errors = xhr.responseJSON.errors;
                    let notificationContainer = $('#notification-container');
                    notificationContainer.empty();

                    // Loop through errors and display them (if needed)
                    $.each(errors, function(key, value) {
                        notificationContainer.append('<div>' + value + '</div>');
                    });
                }
            });
        });
    });
</script>
