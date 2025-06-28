<?php

namespace App\Http\Controllers;

use App\Models\Klub;
use App\Models\Negara;
use App\Models\Prestasi;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Mengambil statistik untuk dashboard
        $stats = [
            'total_negara' => Negara::count(),
            'total_klub' => Klub::count(),
            'total_prestasi' => Prestasi::count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        // Mengambil data untuk ditampilkan di dashboard
        $latest_clubs = Klub::with('negara')
            ->latest()
            ->take(5)
            ->get();

        $latest_countries = Negara::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'latest_clubs', 'latest_countries'));
    }
} 