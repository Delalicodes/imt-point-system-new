@extends('layouts.app2')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Work Time Tracker</h2>

    <!-- Clock In/Out Button -->
    <div class="text-center mb-4">
        <button id="clockInOutButton" class="btn btn-lg {{ $isClockedIn ? 'btn-danger' : 'btn-primary' }}">
            {{ $isClockedIn ? 'End Work' : 'Start Work' }}
        </button>
    </div>

    <!-- Current Work Info -->
    <div class="card mb-4" id="workInfo" style="{{ $isClockedIn ? 'display:block;' : 'display:none;' }}">
        <div class="card-body">
            <h4 class="card-title">Current Work Details</h4>
            <p id="workStatus">Status: {{ $isClockedIn ? 'Working' : 'Not Working' }}</p>
            <p id="totalHoursWorked">Total Hours Worked: </p>
        </div>
    </div>

    <!-- Report Section -->
    <div class="card mt-4" id="reportSection" style="{{ $isClockedIn ? 'display:block;' : 'display:none;' }}">
        <div class="card-body">
            <h4 class="card-title">Report Your Activity</h4>
            <textarea id="reportInput" class="form-control" rows="3" placeholder="What did you do?"></textarea>
            <small id="charCount" class="text-muted">Characters left: 255</small>
            <button id="submitReportButton" class="btn btn-success mt-2">Submit Report</button>
        </div>
    </div>

    <!-- Historical Attendance Records -->
    <div class="card">
        <div class="card-body">
            <h4 class="card-title mb-4">Historical Attendance Records</h4>
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Clock In Time</th>
                        <th>Clock Out Time</th>
                        <th>Total Hours Worked</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($attendances as $attendance)
                        <tr>
                            <td>{{ \Carbon\Carbon::parse($attendance->clock_in_time)->format('l, F j, Y g:i A') }}</td>
                            <td>{{ $attendance->clock_out_time ? \Carbon\Carbon::parse($attendance->clock_out_time)->format('l, F j, Y g:i A') : 'Not yet clocked out' }}</td>
                            <td>{{ $attendance->total_hours }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
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
                    $('#clockInOutButton').text('End Work').removeClass('btn-primary').addClass('btn-danger');
                    $('#workStatus').text('Status: Working');
                    $('#workInfo').show();
                    $('#reportSection').show(); // Show report section when clocked in
                } else if (response.success.includes('ended')) {
                    $('#clockInOutButton').text('Start Work').removeClass('btn-danger').addClass('btn-primary');
                    $('#workStatus').text('Status: Work Ended');
                    $('#totalHoursWorked').text('Total Hours Worked: ' + response.total_hours);
                    $('#workInfo').show();
                    $('#reportSection').hide(); // Hide report section when clocked out
                }
                alert(response.success);
            }
        });
    });

    // Handle Report Submission
    $('#submitReportButton').on('click', function () {
        const report = $('#reportInput').val();

        $.ajax({
            url: '{{ route("attendance.report") }}',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                report: report
            },
            success: function (response) {
                alert(response.success);
                $('#reportInput').val(''); // Clear input after submission
                $('#charCount').text('Characters left: 255'); // Reset char count
            },
            error: function (xhr) {
                alert(xhr.responseJSON.error);
            }
        });
    });

    // Character counter for report input
    $('#reportInput').on('input', function () {
        const maxLength = 255;
        const currentLength = $(this).val().length;
        $('#charCount').text(`Characters left: ${maxLength - currentLength}`);
    });

    // Set up hourly reminder (client-side)
    setInterval(function() {
        if ($('#workStatus').text().includes('Working')) {
            alert('Time to report what you did this hour!');
            const audio = new Audio('{{ asset('sounds/notification.mp3') }}'); // Update path to your notification sound
            audio.play();
        }
    }, 3600000); // 3600000 milliseconds = 1 hour

    // Optional: Real-time clocking status update (poll server every minute)
    setInterval(function() {
        $.ajax({
            url: '{{ route("attendance.status") }}',
            type: 'GET',
            success: function(response) {
                if (!response.isClockedIn) {
                    $('#clockInOutButton').text('Start Work').removeClass('btn-danger').addClass('btn-primary');
                    $('#workInfo').hide();
                    $('#reportSection').hide();
                }
            }
        });
    }, 60000); // 60000 milliseconds = 1 minute
});
</script>
@endsection
