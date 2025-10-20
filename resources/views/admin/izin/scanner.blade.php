<x-app-layout>
    <div class="">
        <h1 class="text-xl font-bold mb-4 text-[#224779]">Scan QR Code</h1>
        <hr class="border-1 border-[#224779]">
    </div>
    <div class="p-4 md:p-6 bg-white rounded-lg w-full max-w-lg mx-auto mt-12">
        <h1 class="text-xl font-bold mb-4 text-black text-center">Scan QR Code</h1>
        <hr class="border-1 border-[#224779]">
        <br>
        <div id="reader" style="width: 100%;"></div>
    </div>

    <!-- 1. Load library dulu -->
    {{-- <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/html5-qrcode/minified/html5-qrcode.min.js"></script>


    <!-- 2. Baru jalankan kode scanner -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let isScanned = false; // flag biar cuma sekali

            function onScanSuccess(decodedText, decodedResult) {
                if (isScanned) return;
                isScanned = true;

                let adminUrl = decodedText;
                if (decodedText.includes("/siswa/izin/cetak/")) {
                    adminUrl = decodedText.replace("/siswa/izin/cetak/", "/admin/izin/cetak/");
                }

                // Stop scanner + tutup kamera
                html5QrcodeScanner.clear().then(() => {
                    console.log("Scanner stopped & camera released");
                    // redirect setelah kamera benar-benar mati
                    window.location.href = adminUrl;
                }).catch(err => {
                    console.error("Gagal stop scanner", err);
                    // fallback tetap redirect
                    window.location.href = adminUrl;
                });
            }

            function onScanFailure(error) {
                // tidak perlu spam console
            }

            const html5QrcodeScanner = new Html5QrcodeScanner("reader", {
                fps: 10,
                qrbox: 250,
                rememberLastUsedCamera: true // opsional: biar kamera terakhir tersimpan
            });

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });

    </script>

</x-app-layout>
