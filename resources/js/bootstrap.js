// bootstrap.js

// Import dependencies (if you have any setup code or libraries to include)
import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

// Set up Axios defaults (if needed)
axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Configure Echo with Pusher
window.Echo = new Echo({
    broadcaster: 'pusher',
    key: window.pusherKey, // Ensure these values are defined globally or set in the HTML
    cluster: window.pusherCluster,
    forceTLS: true
});
