{{-- resources/views/chat.blade.php --}}
@extends('layouts.app2')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-4" style="background-color: #f3f4f6; min-height: 100vh; display: flex; flex-direction: column; justify-content: space-between;">

        <!-- Work Status Section -->
        <div class="card mb-4">
            <div class="card-body">
                <h4 class="card-title">Current Work Status</h4>
                <p id="currentWorkStatus">Status: <span class="text-{{ $isClockedIn ? 'success' : 'danger' }}">{{ $isClockedIn ? 'Working' : 'Not Working' }}</span></p>
                <p id="totalHoursWorked">Total Hours Worked: {{ $totalHoursWorked }}</p>
                <p id="latestReport">Latest Report: {{ $latestReport }}</p>
            </div>
        </div>

        <!-- Chat messages container -->
        <div id="chat-messages" class="chat-container" style="flex-grow: 1; overflow-y: auto; padding: 20px; border-radius: 10px; background-color: rgba(255, 255, 255, 0.8);">
            <!-- Messages will be dynamically loaded here -->
        </div>

        <div id="typing-indicator" style="display: none; font-style: italic; color: #888;">Typing...</div>

        <!-- Message input form -->
        <form id="report-form" class="d-flex mt-3">
            @csrf
            <input id="message" type="text" class="form-control me-2" placeholder="Type your message here..." required>
            <button type="submit" class="btn btn-primary">Send</button>
        </form>
    </div>

    <!-- jQuery for handling AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        const joinTime = new Date().toISOString();

        function pollMessages() {
            $.ajax({
                url: '{{ route("chat.poll") }}',
                method: 'GET',
                success: function(response) {
                    $('#chat-messages').empty();

                    response.reports.forEach(function(report) {
                        let isOwnMessage = report.user_id == '{{ auth()->id() }}';
                        let messageBubble = `
                            <div class="d-flex mb-3 ${isOwnMessage ? 'justify-content-end' : ''}">
                                <div class="d-flex flex-column ${isOwnMessage ? 'align-items-end' : ''}" style="max-width: 70%;">
                                    <span style="font-size: 12px; font-weight: bold;">${report.user_name}</span>
                                    <div style="background-color: ${isOwnMessage ? '#007bff' : '#e1e9f4'}; color: ${isOwnMessage ? '#fff' : '#000'}; padding: 8px 12px; border-radius: 5px; word-wrap: break-word;">
                                        <div style="font-size: 14px;">${report.message}</div>
                                        <small style="font-size: 10px; color: ${isOwnMessage ? '#fff' : '#888'}; float: right;">${report.created_at}</small>
                                    </div>
                                </div>
                            </div>
                        `;
                        $('#chat-messages').append(messageBubble);
                    });

                    scrollToBottom();
                },
                error: function(xhr) {
                    console.log("Error polling messages: ", xhr.responseText);
                }
            });
        }

        function scrollToBottom() {
            $('#chat-messages').scrollTop($('#chat-messages')[0].scrollHeight);
        }

        $('#report-form').on('submit', function(e) {
            e.preventDefault();
            let message = $('#message').val();

            $.ajax({
                url: '{{ route('chat.store') }}',
                method: 'POST',
                data: {
                    message: message,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    $('#message').val('');
                    pollMessages(); // Refresh messages
                },
                error: function(xhr) {
                    alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText);
                }
            });
        });

        setInterval(pollMessages, 2000);
        $(document).ready(function() {
            pollMessages();
        });
    </script>
@endsection
