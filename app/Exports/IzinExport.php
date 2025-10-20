<?php

namespace App\Exports;

use App\Models\Izin;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class IzinExport implements FromCollection, WithHeadings, WithMapping
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = Izin::with(['user', 'user.siswaLengkap.kelas', 'user.siswaLengkap.jurusan']);

        // Terapkan filter yang sama seperti di index
        if (!empty($this->filters['jurusan_id'])) {
            $query->whereHas('user.siswaLengkap', function ($q) {
                $q->where('jurusan_id', $this->filters['jurusan_id']);
            });
        }

        if (!empty($this->filters['kelas_id'])) {
            $query->whereHas('user.siswaLengkap', function ($q) {
                $q->where('kelas_id', $this->filters['kelas_id']);
            });
        }

        if (!empty($this->filters['status_izin'])) {
            $query->where('status_izin', $this->filters['status_izin']);
        }

        return $query->latest()->get();
    }

    public function map($izin): array
    {
        return [
            $izin->user->nama,
            $izin->user->siswaLengkap->jurusan->nama_jurusan ?? '-',
            $izin->user->siswaLengkap->kelas->nama_kelas ?? '-',
            ucfirst($izin->jenis_izin),
            $izin->keterangan ?? '-',
            $izin->tanggal,
            ucfirst($izin->status_izin),
        ];
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Jurusan',
            'Kelas',
            'Jenis Izin',
            'Keterangan',
            'Tanggal',
            'Status',
        ];
    }
}
