<?php

namespace App\Http\Controllers;

use App\Models\AdminTransaction;
use App\Models\AdminOrder;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'dashboard']);
            return $next($request);
        });
        
    }
    
    public function show() {
        $page = 10;
        $transactions = AdminTransaction::orderBy('id', 'desc')->paginate($page);
        $count_status_processing = AdminTransaction::where('status', 'đang xử lý')->count();
        $count_status_transport = AdminTransaction::where('status', 'đang vận chuyển')->count();
        $count_status_success = AdminTransaction::where('status', 'hoàn thành')->count();
        $count_status_cancel = AdminTransaction::where('status', 'hủy bỏ')->count();
        $total_of_system = AdminTransaction::where('status', 'hoàn thành')->sum('total_money');

        return view('admin.dashboard', compact('transactions', 'count_status_processing', 'count_status_transport', 'count_status_success', 'count_status_cancel', 'total_of_system'));
    }

   
    
}
