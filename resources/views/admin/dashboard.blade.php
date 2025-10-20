<x-app-layout>
    <div class="hidden md:block">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold">Dashboard</h1>
            <div class="flex items-center gap-2">
                <span class="font-medium">{{ Auth::user()->nama }}</span>
                <i data-lucide="user-circle" class="w-8 h-8"></i>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="bg-[#017BFA] text-white rounded-lg p-6 flex justify-between items-center mb-6">
            <div>
                <h2 class="text-xl font-bold">Halo, {{ Auth::user()->nama }} 👋</h2>
                <p>Digitalisasi perizinan, mendukung sekolah modern.</p>
            </div>

            <!-- ilustrasi guru/siswa -->
            <div class="flex gap-4">
                <img src="{{ asset('storage/asset/data-reports.svg') }}" alt="Illustration Data Reports" class="w-40">
                <img src="{{ asset('storage/asset/resume.svg') }}" alt="Illustration Resume" class="w-40">
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column -->
            <div class="col-span-2 space-y-6">
                <!-- Ringkasan -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                        <p class="text-gray-500">Total Siswa</p>
                        <h3 class="text-xl font-bold">{{ $totalSiswa }}</h3>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                        <p class="text-gray-500">Total Izin Masuk</p>
                        <h3 class="text-xl font-bold">{{ $totalIzin }}</h3>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                        <p class="text-gray-500">Izin Disetujui</p>
                        <h3 class="text-xl font-bold">{{ $izinDisetujui }}</h3>
                    </div>
                    <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                        <p class="text-gray-500">Izin Ditolak</p>
                        <h3 class="text-xl font-bold">{{ $izinDitolak }}</h3>
                    </div>
                </div>




                <!-- Grafik -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h3 class="font-bold mb-4">Statistik Izin Mingguan</h3>
                    <div id="izinChart" style="height:400px;"></div>
                </div>
            </div>

            <!-- Right Column -->

            <!-- Kalender -->
            <div class="bg-white shadow-lg rounded-xl p-4">
                <h3 class="font-bold mb-4 flex items-center gap-2 text-gray-700">
                    <i data-lucide="calendar"></i>
                    Kalender
                </h3>
                <div id="calendar" class="fc-theme-tailwind"></div>

                <!-- Izin Terbaru -->
                <div class="bg-white shadow-lg rounded-lg p-4 mt-10">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="clock"></i>
                        Izin Yang Perlu Divalidasi
                    </h3>

                    @if($izinTerbaru->isEmpty())
                    <p class="text-sm text-gray-500 text-center">Belum ada izin yang perlu divalidasi.</p>
                    @else
                    <ul class="space-y-3">
                        @foreach($izinTerbaru as $izin)
                        <li class="flex justify-between">
                            <span>{{ $izin->user->nama }}</span>
                            <span class="text-sm text-gray-500 capitalize">{{ $izin->jenis_izin }}</span>
                        </li>
                        @endforeach
                    </ul>
                    @endif
                </div>

            </div>



        </div>
    </div>
    </div>

    <div class="md:hidden pt-0">
        <!-- Hero Section -->
        <div class="bg-[#017BFA] text-white rounded-lg p-6 flex justify-between items-center mb-6 m-2 mt-0">
            <div>
                <h2 class="text-xl font-bold">Halo, {{ Auth::user()->nama }} 👋</h2>
                <p>Digitalisasi perizinan, mendukung sekolah modern.</p>
            </div>

            <!-- ilustrasi guru/siswa -->
            {{-- <div class="flex gap-4">
                <img src="{{ asset('storage/asset/data-reports.svg') }}" alt="Illustration Data Reports" class="w-40">
            <img src="{{ asset('storage/asset/resume.svg') }}" alt="Illustration Resume" class="w-40">
        </div> --}}
    </div>


    <div class="grid grid-cols-2 gap-6 m-2">
        <!-- Left Column -->
        <div class="col-span-2 space-y-6">
            <!-- Ringkasan -->
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-4">
                <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                    <p class="text-gray-500">Total Siswa</p>
                    <h3 class="text-xl font-bold">{{ $totalSiswa }}</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                    <p class="text-gray-500">Total Izin Masuk</p>
                    <h3 class="text-xl font-bold">{{ $totalIzin }}</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                    <p class="text-gray-500">Izin Disetujui</p>
                    <h3 class="text-xl font-bold">{{ $izinDisetujui }}</h3>
                </div>
                <div class="bg-white shadow-lg rounded-lg p-4 text-center">
                    <p class="text-gray-500">Izin Ditolak</p>
                    <h3 class="text-xl font-bold">{{ $izinDitolak }}</h3>
                </div>
            </div>
        </div>

        <!-- Right Column -->

        <div class="col-span-2">
            <div class="w-full flex bg-white shadow-lg rounded-xl p-4">
                <!-- Izin Terbaru -->
                <div class="bg-white shadow-lg rounded-lg p-4 w-full">
                    <h3 class="font-bold mb-4 flex items-center gap-2">
                        <i data-lucide="clock"></i>
                        Izin Yang Perlu Divalidasi
                    </h3>
                    <ul class="space-y-3">
                        @forelse ($izinTerbaru as $izin)
                            <li class="flex justify-between">
                                <span>{{ $izin->user->nama }}</span>
                                <span class="text-sm text-gray-500 capitalize">{{ $izin->jenis }}</span>
                            </li>
                        @empty
                            <li class="text-gray-500 text-sm">Belum ada izin yang perlu divalidasi</li>
                        @endforelse
                    </ul>
                </div>
        </div>
</div>

    </div>
    </div>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var chartDom = document.getElementById('izinChart');
            var myChart = echarts.init(chartDom);

            var option = {
                tooltip: {
                    trigger: 'axis'
                },
                legend: {
                    data: ['Total Izin', 'Disetujui'],
                    bottom: 0
                },
                grid: {
                    left: '3%',
                    right: '4%',
                    bottom: '15%',
                    containLabel: true
                },
                xAxis: {
                    type: 'category',
                    data: @json($izinPerKelas->pluck('nama_kelas')->values()),
                    axisLabel: {
                        rotate: 45, // biar ga tabrakan kalau kelas banyak
                        interval: 0
                    }
                },
                yAxis: {
                    type: 'value'
                },
                series: [{
                        name: 'Total Izin',
                        type: 'line',
                        smooth: true,
                        data: @json($izinPerKelas->pluck('total_izin')->values()),
                        lineStyle: {
                            color: '#6366F1'
                        },
                        itemStyle: {
                            color: '#6366F1'
                        }
                    },
                    {
                        name: 'Disetujui',
                        type: 'line',
                        smooth: true,
                        data: @json($izinPerKelas->pluck('disetujui')->values()),
                        lineStyle: {
                            color: '#06B6D4'
                        },
                        itemStyle: {
                            color: '#06B6D4'
                        }
                    }
                ],
                dataZoom: [{
                        type: 'slider',
                        show: true,
                        start: 0,
                        end: 100
                    },
                    {
                        type: 'inside',
                        start: 0,
                        end: 100
                    }
                ]
            };

            myChart.setOption(option);

            // Responsif
            window.addEventListener('resize', function () {
                myChart.resize();
            });


            console.log("kelas:", @json($izinPerKelas->pluck('nama_kelas')->values()));
            console.log("total izin:", @json($izinPerKelas->pluck('total_izin')->values()));
            console.log("disetujui:", @json($izinPerKelas->pluck('disetujui')->values()));
        });

    </script>



    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'title',
                    center: '',
                    right: 'prev,next',
                },
                events: @json($events)
            });
            calendar.render();
        });

    </script>


    <style>
        /* Kalender wrapper */
        #calendar {
            font-family: 'Inter', sans-serif;
        }

        /* Header Kalender */
        .fc .fc-toolbar-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #374151;
            /* gray-700 */
        }

        /* Tombol navigasi */
        .fc .fc-button {
            background-color: #017BFA;
            border: none;
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* transform: translate(50px, -10px); */
        }

        .fc .fc-button:hover {
            background-color: #025ec7;
        }

        /* Grid Kalender */
        .fc-theme-standard td,
        .fc-theme-standard th {
            border: 1px solid #e5e7eb;
            /* gray-200 */
        }

        /* Hari ini */
        .fc .fc-daygrid-day.fc-day-today {
            background-color: #e0f2fe;
            /* sky-100 */
            border-radius: 0.4rem;

        }

        /* Event */
        .fc-event {
            background-color: #017BFA !important;
            border: none !important;
            border-radius: 0.375rem;
            padding: 2px 4px;
            font-size: 0.75rem;
            font-weight: 500;
        }

    </style>

</x-app-layout>
