@extends('layouts.app')

@section('')
<div class="container mt-5">
    <h2>Points by Date</h2>
    <input type="text" id="date_picker" class="form-control datepicker mb-3" placeholder="Select a date to view points">

    <div id="points_table_container">
        <p>Select a date to see points.</p>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/js/bootstrap-datepicker.min.js"></script>
<script>
$(document).ready(function() {
    $('.datepicker').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true
    }).on('changeDate', function(e) {
        let selectedDate = $(this).val();

        $.ajax({
            url: "{{ route('points.history.fetch') }}",
            method: "GET",
            data: { date: selectedDate },
            success: function(response) {
                console.log(response); // Check the response to ensure user data is included

                let pointsTableContainer = $('#points_table_container');
                pointsTableContainer.empty();

                if (response.length > 0) {
                    let table = `
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>User</th>
                                    <th>Points</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;

                    response.forEach(function(point) {
                        let userName = point.user ? (point.user.first_name + ' ' + point.user.last_name) : 'No User';
                        table += `
                            <tr>
                                <td>${userName}</td>
                                <td>${point.point}</td>
                            </tr>
                        `;
                    });

                    table += `
                            </tbody>
                        </table>
                    `;

                    pointsTableContainer.append(table);
                } else {
                    pointsTableContainer.append('<p>No points found for this date.</p>');
                }
            },
            error: function() {
                $('#points_table_container').html('<p>An error occurred while retrieving points.</p>');
            }
        });
    });
});
</script>
@endpush
