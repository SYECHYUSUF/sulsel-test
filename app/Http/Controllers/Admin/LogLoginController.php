<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LogLogin;
use Illuminate\Http\Request;

class LogLoginController extends Controller
{
    public function index()
    {
        // Mengambil data log dengan eager loading user, diurutkan dari yang terbaru
        $logs = LogLogin::with('user')
                ->orderBy('id', 'desc') 
                ->paginate(20);
        
        return view('admin.log-login.index', compact('logs'));
    }
}