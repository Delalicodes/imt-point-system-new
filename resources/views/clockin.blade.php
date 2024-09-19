@extends('layouts.app2')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Work Time Tracker</h2>

    <!-- Clock In/Out Button -->
    <div class="text-center mt-4">
        <button id="clockInOutButton" class="btn btn-primary">Start Work</button>
    </div>

    <!-- Attendance Info -->
    <div class="mt-5" id="workInfo" style="display:none;">
        <h4>Work Details</h4>
        <p id="workStatus">Status: Working</p>
        <p id="totalHoursWorked">Total Hours Worked: </p>
    </div>
</div>

<!-- Include jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function () {
    // Handle Clock In/Out
    $('#clockInOutButton').on('click', function () {
        $.ajax({
            url: '{{ route("attendance.toggle") }}',
            type: 'POST',
            data: {_token: '{{ csrf_token() }}'},
            success: function (response) {
                if (response.success.includes('started')) {
                    $('#clockInOutButton').text('End Work');
                    $('#workStatus').text('Status: Working');
                    $('#workInfo').show();
                } else if (response.success.includes('ended')) {
                    $('#clockInOutButton').text('Start Work');
                    $('#workStatus').text('Status: Work Ended');
                    $('#totalHoursWorked').text('Total Hours Worked: ' + response.total_hours);
                    $('#workInfo').show();
                }
                alert(response.success);
            }
        });
    });
});
</script>
@endsection
