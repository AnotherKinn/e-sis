<x-app-layout>
    <div class="max-w-4xl mx-auto p-6">
        <h1 class="text-2xl font-bold text-[#224779] mb-4">Daftar Notifikasi</h1>

        @if ($notifikasi->isEmpty())
            <div class="bg-white p-6 rounded-lg shadow text-center text-gray-500">
                Tidak ada notifikasi saat ini.
            </div>
        @else
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <ul class="divide-y divide-gray-200">
                    @foreach ($notifikasi as $notif)
                        <li class="p-4 hover:bg-gray-50 transition flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2">
                                    <i data-lucide="bell" class="w-4 h-4 text-blue-500"></i>
                                    <p class="text-sm font-medium text-gray-800">
                                        {{ $notif->judul ?? 'Notifikasi' }}
                                    </p>
                                </div>
                                <p class="text-sm text-gray-600 mt-1">
                                    {{ $notif->pesan }}
                                </p>
                                <p class="text-[11px] text-gray-400 mt-1">
                                    {{ $notif->created_at->diffForHumans() }}
                                </p>
                            </div>

                            @if (!$notif->is_read)
                                <span class="bg-blue-500 text-white text-xs font-semibold px-2 py-1 rounded-full">
                                    Baru
                                </span>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <script>
        lucide.createIcons();
    </script>
</x-app-layout>
