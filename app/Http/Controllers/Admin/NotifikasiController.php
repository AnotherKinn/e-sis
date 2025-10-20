<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Notifikasi;

class NotifikasiController extends Controller
{
    public function index()
    {
        // Ambil notifikasi milik user yang sedang login
        $notifikasi = Notifikasi::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        // Tandai semua notifikasi sebagai dibaca (opsional)
        Notifikasi::where('user_id', Auth::id())->update(['is_read' => true]);

        return view('admin.notifikasi.index', compact('notifikasi'));
    }
}
