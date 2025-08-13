import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 80,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 443,
    forceTLS: (import.meta.env.VITE_REVERB_SCHEME ?? 'https') === 'https',
    enabledTransports: ['ws', 'wss'],
    withCredentials: true,

    authorizer: (channel, options) => {
        return {
            // authorize: (socketId, callback) => {
            //     axios.post('/custom-broadcasting-auth', {
            //         socket_id: socketId,
            //         channel_name: channel.name
            //     }, {
            //         withCredentials: true,
            //         headers: {
            //             'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            //         }
            //     })
            //     .then(response => {
            //         callback(false, response.data);
            //     })
            //     .catch(error => {
            //         callback(true, error);
            //     });
            // }
            authorize: (socketId, callback) => {
                fetch('/custom-broadcasting-auth', {  
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        socket_id: socketId,
                        channel_name: channel.name
                    })
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Auth success:', data);
                    callback(false, data);
                })
                .catch(error => {
                    console.error('Auth failed:', error);
                    callback(true, error);
                });
            }
        };
    }
});

// console.log('Echo initialized:', window.Echo);