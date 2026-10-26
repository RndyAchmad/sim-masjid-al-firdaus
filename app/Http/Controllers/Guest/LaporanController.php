<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function indexOperasional()
    {
        return view('guest.laporan.operasional');
    }

    public function indexPembangunan()
    {
        return view('guest.laporan.pembangunan');
    }


    public function indexInventaris(Request $request)
    {
        $inventories = Inventory::query()
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when($request->filled('condition'), function ($query) use ($request) {
                $query->where('condition', $request->input('condition'));
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $totalInventaris = Inventory::count();

        $totalBaik = Inventory::where('condition', 'Baik')->count();

        $totalPerbaikan = Inventory::where('condition', 'Repair')->count();

        $totalRusakHilang = Inventory::whereIn('condition', [
            'Rusak',
            'Hilang',
        ])->count();

        return view('guest.laporan.inventaris', compact(
            'inventories',
            'totalInventaris',
            'totalBaik',
            'totalPerbaikan',
            'totalRusakHilang'
        ));
    }
}
