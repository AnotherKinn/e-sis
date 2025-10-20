import './bootstrap';
import { createIcons, icons } from 'lucide';
import Swiper from "swiper/bundle";
import "swiper/css/bundle";
import Swal from 'sweetalert2';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

// Ambil meta dari Blade
const userRole = document.querySelector('meta[name="role"]')?.content || '';
const userId = document.querySelector('meta[name="user-id"]')?.content || '';
const guard = document.querySelector('meta[name="guard"]')?.content || 'web';

// Helper aman untuk subscribe Echo
async function safeEchoChannel(channelType, channelName, eventName, callback) {
    try {
        const echoChannel =
            channelType === 'private'
                ? window.Echo.private(channelName)
                : window.Echo.channel(channelName);

        echoChannel.listen(eventName, (event) => {
            try {
                callback(event);
            } catch (err) {
                console.error(`❌ Error dalam listener untuk ${eventName}:`, err);
            }
        });
    } catch (err) {
        console.error(`❌ Gagal subscribe ke channel: ${channelName}`, err);
    }
}

// ===============================
// 🔔 Notifikasi Realtime Berdasarkan Role / Guard
// ===============================
try {
    // === SISWA ===
    if (userRole === 'siswa') {
        safeEchoChannel('private', `siswa-izin.${userId}`, '.izin.created', (event) => {
            console.log('🎒 Notifikasi siswa:', event);

            Swal.fire({
                title: 'Pengajuan Izin',
                text: `Izin kamu berhasil dibuat: ${event.izin.keterangan}`,
                icon: 'success',
                confirmButtonText: 'OK'
            });

            const badge = document.getElementById('notif-badge');
            if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
        });

        safeEchoChannel('private', `siswa-izin.${userId}`, '.izin.validated', (event) => {
            console.log('✅ Izin divalidasi:', event);

            Swal.fire({
                title: 'Izin Kamu Divalidasi',
                text: `Status: ${event.izin.status_izin}`,
                icon: 'info',
                confirmButtonText: 'OK'
            });

            const badge = document.getElementById('notif-badge');
            if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
        });

        safeEchoChannel('private', `siswa-izin.${userId}`, '.izin.scanned', (event) => {
            console.log('📷 Izin discan:', event);
            Swal.fire({
                title: 'Izinmu sudah discan',
                text: 'Silakan upload bukti izin segera.',
                icon: 'info',
                confirmButtonText: 'OK'
            });
        });

    // === ADMIN (dari tabel users) ===
    } else if (userRole === 'admin') {
        safeEchoChannel('public', 'izin-channel', '.izin.created', (event) => {
            console.log('📨 Ada izin baru (admin):', event);

            Swal.fire({
                title: 'Ada Izin Masuk!',
                text: `Dari siswa: ${event.izin?.notifikasi?.pesan || 'Data tidak tersedia'}`,
                icon: 'info',
                confirmButtonText: 'OK'
            });

            const badge = document.getElementById('notif-badge');
            if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
        });

        safeEchoChannel('public', 'izin-channel', '.izin.bukti_uploaded', (event) => {
            console.log('📂 Bukti izin diunggah (admin):', event);

            Swal.fire({
                title: 'Bukti Izin Baru!',
                text: `Siswa ${event.izin?.notifikasi?.pesan || 'tidak diketahui'} mengunggah bukti.`,
                icon: 'info',
                confirmButtonText: 'OK'
            });

            const badge = document.getElementById('notif-badge');
            if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
        });

    // === PETUGAS (guard petugas) ===
    } else if (guard === 'petugas') {
        safeEchoChannel('public', 'izin-channel', '.izin.created', (event) => {
            console.log('📨 Ada izin baru (petugas):', event);

            Swal.fire({
                title: 'Ada Izin Masuk!',
                text: `Dari siswa: ${event.izin?.notifikasi?.pesan || 'Data tidak tersedia'}`,
                icon: 'info',
                confirmButtonText: 'OK'
            });

            const badge = document.getElementById('notif-badge');
            if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
        });

        safeEchoChannel('public', 'izin-channel', '.izin.bukti_uploaded', (event) => {
            console.log('📂 Bukti izin diunggah (petugas):', event);

            Swal.fire({
                title: 'Bukti Izin Baru!',
                text: `Siswa ${event.izin?.notifikasi?.pesan || 'tidak diketahui'} mengunggah bukti.`,
                icon: 'info',
                confirmButtonText: 'OK'
            });

            const badge = document.getElementById('notif-badge');
            if (badge) badge.innerText = parseInt(badge.innerText || 0) + 1;
        });
    }
} catch (error) {
    console.error("❌ Terjadi error saat inisialisasi Echo:", error);
}

// ===============================
// 💄 UI Initialization
// ===============================
document.addEventListener("DOMContentLoaded", () => {
    try {
        createIcons({ icons });

        const totalSlides = document.querySelectorAll('.keunggulanSwiper .swiper-slide').length;
        const perViewDesktop = Math.min(3, Math.max(1, totalSlides - 1));
        const perViewTablet = Math.min(2, Math.max(1, totalSlides - 1));
        const perViewMobile = 1;

        new Swiper('.keunggulanSwiper', {
            slidesPerView: perViewMobile,
            spaceBetween: 20,
            loop: true,
            speed: 4000,
            autoplay: {
                delay: 0,
                disableOnInteraction: false,
                reverseDirection: true,
            },
            freeMode: true,
            freeModeMomentum: false,
            breakpoints: {
                640: { slidesPerView: perViewTablet },
                1024: { slidesPerView: perViewDesktop },
            },
        });

        const notifications = document.querySelectorAll('.notify');
        notifications.forEach((notif) => {
            setTimeout(() => {
                notif.classList.add('hide');
                notif.addEventListener('animationend', () => notif.remove());
            }, 4000);
        });

        Alpine.start();
    } catch (err) {
        console.error('❌ UI initialization failed:', err);
    }
});
