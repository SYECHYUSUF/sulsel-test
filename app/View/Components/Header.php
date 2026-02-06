<?php

namespace App\View\Components;

use App\Models\KategoriInformasi;
use App\Models\MasterTahun;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Header extends Component
{
    public $kategoriInfo;
    public $daftarTahun;
    
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->kategoriInfo = Cache::remember('kategori_informasi', 3600, function () {
            return KategoriInformasi::where('is_active', 1)
                            ->orderBy('nm_kat_info', 'asc')
                            ->get();
        });
        $this->daftarTahun = Cache::remember('daftar_tahun', 3600, function () {
            return MasterTahun::whereNotNull('waktu')
                            ->orderBy('waktu', 'desc')
                            ->get();
        });
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
