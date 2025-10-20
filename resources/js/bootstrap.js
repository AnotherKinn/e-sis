import axios from 'axios';
import Echo from 'laravel-echo';
import Pusher from 'pusher-js'; // tetap diperlukan walau pakai Reverb

window.axios = axios;
window.Pusher = Pusher;

// ===============
// Konfigurasi Echo + Reverb
// ===============
window.Echo = new Echo({
    broadcaster: 'reverb',
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
    wsPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    wssPort: import.meta.env.VITE_REVERB_PORT ?? 8080,
    forceTLS: window.location.protocol === 'https:',
    enabledTransports: ['ws', 'wss'],
    withCredentials: true,
});


// Debug koneksi Reverb
if (window.Echo.connector?.pusher?.connection) {
    window.Echo.connector.pusher.connection.bind('connected', () => {
        console.log('✅ Echo connected to Reverb');
    });

    window.Echo.connector.pusher.connection.bind('error', (err) => {
        console.error('❌ Echo connection error:', err);
    });

    window.Echo.connector.pusher.connection.bind('state_change', (states) => {
        console.log('🔄 Echo state changed:', states);
    });
}

// Ambil meta tag dari Blade (pastikan kamu sudah punya di layout utama)
const userId = document.querySelector('meta[name="user-id"]')?.content;
const userRole = document.querySelector('meta[name="role"]')?.content;
const guard = document.querySelector('meta[name="guard"]')?.content ?? 'web';

// ===============================
// Debug Info
// ===============================
console.log('🔑 Reverb Key:', import.meta.env.VITE_REVERB_APP_KEY);
console.log(`👤 userId=${userId}, role=${userRole}, guard=${guard}`);

// ===============================
// Tes Langganan Channel Private
// ===============================
if (userId && userRole === 'siswa') {
    window.Echo.private(`siswa-izin.${userId}`)
        .subscribed(() => {
            console.log(`📡 Subscribed ke private siswa-izin.${userId}`);
        })
        .listen('.izin.created', (data) => {
            console.log(`📩 Event izin.created untuk siswa-${userId}:`, data);
        })
        .error((err) => {
            console.error(`⚠️ Error pada private channel siswa-izin.${userId}:`, err);
        });
}

// ===============================
// Tes Langganan Channel Umum (Petugas/Admin)
// ===============================
if (['petugas', 'admin'].includes(userRole)) {
    window.Echo.channel('izin-channel')
        .subscribed(() => {
            console.log(`📡 Subscribed ke channel izin-channel`);
        })
        .listen('.izin.created', (data) => {
            console.log('📨 Event izin.created diterima (admin/petugas):', data);
        })
        .error((err) => {
            console.error(`⚠️ Error pada izin-channel:`, err);
        });
}

// Axios setup
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Import echo.js jika kamu masih punya file itu
import './echo';
