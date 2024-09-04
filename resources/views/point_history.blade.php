<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Points</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-datepicker@1.9.0/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Points by Date</h2>
    <input type="text" id="date_picker" class="form-control datepicker mb-3" placeholder="Select a date to view points">

    <div id="points_list">
        <p>Select a date to see points.</p>
    </div>
</div>

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

                let pointsList = $('#points_list');
                pointsList.empty();

                if (response.length > 0) {
                    response.forEach(function(point) {
                        // Construct the full name from first_name and last_name
                        let userName = point.user ? (point.user.first_name + ' ' + point.user.last_name) : 'No User';
                        pointsList.append('<div class="alert alert-info"><strong>User:</strong> ' + userName + ' <br><strong>Points:</strong> ' + point.point + '</div>');
                    });
                } else {
                    pointsList.append('<p>No points found for this date.</p>');
                }
            },
            error: function() {
                $('#points_list').html('<p>An error occurred while retrieving points.</p>');
            }
        });
    });
});

</script>
</body>
</html>
