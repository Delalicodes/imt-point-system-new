import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Initialize Echo with Pusher
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.pusherKey,
    cluster: window.pusherCluster,
    forceTLS: true
});
