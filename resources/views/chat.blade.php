@extends('layouts.app2')

@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="container py-4" style="background-color: #f5f5f5; min-height: 100vh; display: flex; flex-direction: column;">
        <!-- Chat messages container -->
        <div id="chat-messages" class="chat-container" style="flex-grow: 1; overflow-y: auto; padding: 15px; background-color: #fff; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
            <!-- Messages will be dynamically loaded here -->
        </div>
        <div id="typing-indicator" style="display: none; margin-top: 5px; font-style: italic; color: #888;"></div>

        <!-- Message input form at the bottom -->
        <form id="report-form" class="d-flex mt-3" style="border: 1px solid #ddd; background-color: #fff; border-radius: 10px; padding: 8px;">
            @csrf
            <input id="message" type="text" class="form-control me-2" placeholder="Type your message..." style="flex-grow: 1; border: none; border-radius: 8px; padding: 10px; box-shadow: none;" required>
            <button type="submit" class="btn btn-primary" style="border-radius: 8px;">Send</button>
        </form>
    </div>

    <!-- JQuery for handling AJAX -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // Setup CSRF token for every AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Store the join time when the user enters the chat
        const joinTime = new Date().toISOString(); // ISO format for easy comparison

        // Poll for new messages every 5 seconds
        function pollMessages() {
            $.ajax({
                url: '{{ route("chat.poll") }}',
                method: 'GET',
                data: {
                    join_time: joinTime // Send join time to the server
                },
                success: function(response) {
                    $('#chat-messages').empty(); // Clear the chat container

                    // Rebuild the chat messages
                    response.reports.forEach(function(report) {
                        let bubbleStyle = report.user_id == '{{ auth()->id() }}' ? 'background-color: #DCF8C6; margin-left: auto;' : 'background-color: #E5E5EA;';
                        $('#chat-messages').append(`
                            <div class="message-bubble my-2 p-2" style="max-width: 60%; ${bubbleStyle} border-radius: 15px; padding: 8px 12px; border: 1px solid #ddd; word-wrap: break-word; font-size: 14px; position: relative;">
                                <strong style="font-size: 12px; color: #555;">${report.user_name}</strong><br>
                                <span>${report.message}</span>
                                <small style="position: absolute; bottom: 5px; right: 10px; font-size: 10px; color: #999;">${report.created_at}</small>
                            </div>
                        `);
                    });

                    // Scroll to the bottom of the chat container after messages have been appended
                    scrollToBottom();
                },
                error: function(xhr) {
                    console.log("Error polling messages: ", xhr.responseText);
                }
            });
        }

        // Function to scroll to the bottom of the chat
        function scrollToBottom() {
            const chatContainer = $('#chat-messages');
            chatContainer.scrollTop(chatContainer[0].scrollHeight);
        }

        // Handle sending a new message
        $('#report-form').on('submit', function(e) {
            e.preventDefault();
            let message = $('#message').val();

            $.ajax({
                url: '{{ route('chat.store') }}',
                method: 'POST',
                data: {
                    message: message,
                    _token: $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is included
                },
                success: function(response) {
                    $('#message').val(''); // Clear message input
                    $('#typing-indicator').hide(); // Hide typing indicator
                    pollMessages(); // Poll messages immediately after sending
                },
                error: function(xhr) {
                    console.log("Error: ", xhr.responseText);
                    alert('An error occurred: ' + xhr.status + ' ' + xhr.statusText); // User feedback for errors
                }
            });
        });

        // Poll for new messages every 2 seconds
        setInterval(pollMessages, 2000);

        // Auto-scroll to the bottom on page load
        $(document).ready(function() {
            pollMessages(); // Initial poll to load messages
            setTimeout(scrollToBottom, 100); // Ensure messages are loaded before scrolling
        });
    </script>

@endsection
