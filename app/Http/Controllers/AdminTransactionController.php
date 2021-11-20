<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use Illuminate\Http\Request;
use App\Models\AdminTransaction;
use Illuminate\Support\Facades\DB;


class AdminTransactionController extends Controller
{
    function __construct()
    {
        $this->middleware(function($request, $next) {
            session(['module_active' => 'transaction']);
            return $next($request);
        });
    }

    public function list(Request $request) {
        $page = 5;
        $status_transactions = $request->input('status');
        $list_act = [
            'delete' => 'Xóa tạm thời'
        ];
        if ($status_transactions) {
           switch ($status_transactions) {
               case 'đang xử lý':
                    $transactions = AdminTransaction::where('status', 'đang xử lý')->orderBy('id', 'desc')->paginate($page)->withQueryString();                     
                   break;
               case 'đang vận chuyển':
                    $transactions = AdminTransaction::where('status', 'đang vận chuyển')->orderBy('id', 'desc')->paginate($page)->withQueryString();                     
                   break;
               case 'hoàn thành':
                    $transactions = AdminTransaction::where('status', 'hoàn thành')->orderBy('id', 'desc')->paginate($page)->withQueryString();                     
                   break;
               case 'hủy bỏ':
                    $transactions = AdminTransaction::where('status', 'hủy bỏ')->orderBy('id', 'desc')->paginate($page)->withQueryString();                     
                   break;
            }   
           
        } else {
            $keyword = "";
            if ($request->input('keyword')) {
                $keyword = $request->input('keyword');
            }
            $transactions = AdminTransaction::where('name', 'LIKE', "%{$keyword}%")->orWhere('email', 'LIKE', "%{$keyword}%")->orderBy('id', 'desc')->paginate($page); 

        }

        $count_status_processing = AdminTransaction::where('status', 'đang xử lý')->count();
        $count_status_transport = AdminTransaction::where('status', 'đang vận chuyển')->count();
        $count_status_success = AdminTransaction::where('status', 'hoàn thành')->count();
        $count_status_cancel = AdminTransaction::where('status', 'hủy bỏ')->count();
        $count_transactions = [$count_status_processing, $count_status_transport, $count_status_success, $count_status_cancel];
        $count_transactions = $count_transactions[0] +  $count_transactions[1] +  $count_transactions[2] +  $count_transactions[3];
        $count_trash_transactions = AdminTransaction::onlyTrashed()->count();
        
        return view('admin.transaction.list_transaction', compact('transactions', 'count_status_processing', 'count_status_transport', 'count_status_success', 'count_status_cancel', 'list_act', 'count_trash_transactions', 'count_transactions'));
    }

    public function trash_transaction(Request $request) {
        $page = 10;
        $list_act = [
            'restore' => 'Khôi phục',
            'forceDelete' => 'Xóa vĩnh viễn'
        ];
        $keyword = "";
        if ($request->input('keyword')) {
            $keyword = $request->input('keyword');
        }
        $transactions = AdminTransaction::where('name', 'LIKE', "%{$keyword}%")->orderBy('id', 'desc')->onlyTrashed()->paginate($page);
        $count_trash_transactions = AdminTransaction::onlyTrashed()->count();
        $count_status_processing = AdminTransaction::where('status', 'đang xử lý')->count();
        $count_status_transport = AdminTransaction::where('status', 'đang vận chuyển')->count();
        $count_status_success = AdminTransaction::where('status', 'hoàn thành')->count();
        $count_status_cancel = AdminTransaction::where('status', 'hủy bỏ')->count();
        $count_transactions = [$count_status_processing, $count_status_transport, $count_status_success, $count_status_cancel];
        $count_transactions = $count_transactions[0] +  $count_transactions[1] +  $count_transactions[2] +  $count_transactions[3];
        $data = [
            'transactions' => $transactions,
            'list_act' => $list_act,
            'count_trash_transactions' => $count_trash_transactions,
            'count_status_processing' => $count_status_processing,
            'count_status_transport' => $count_status_transport,
            'count_status_success' => $count_status_success,
            'count_status_cancel' => $count_status_cancel,
            'count_transactions' => $count_transactions
        ];
        
        return view('admin.transaction.list_trash_transaction', $data);
    }

    public function action(Request $request) {
        $list_check = $request->input('list_check');
        if ($list_check) {
            if (!empty($list_check)) {
                $act = $request->input('act');
                if ($act == 'delete') {
                    AdminTransaction::destroy($list_check);
                    return redirect('admin/transaction/list')->with('status', 'Đã xóa tạm thời thành công');
    
                }
                if ($act == 'restore') {
                    AdminTransaction::withTrashed()
                    ->whereIn('id', $list_check)
                    ->restore();
                    return redirect('admin/transaction/trash')->with('status', 'Bạn đã khôi phục thành công');
    
                }
                if ($act == 'forceDelete') {
                    AdminTransaction::withTrashed()
                    ->whereIn('id', $list_check)
                    ->forceDelete();
                    return redirect('admin/transaction/trash')->with('status', 'Đã xóa vĩnh viễn thành công');
                }
            }
            return redirect()->back()->with('status', 'Cần lựa chọn tác vụ!');
        } else {
            return redirect()->back()->with('status', 'Bạn chưa lựa chọn thông tin khách hàng!');

        }
    }

    public function delete($id) {
        $transaction = AdminTransaction::find($id);
        if ($transaction) {
            $transaction->delete();
        }
        return redirect('admin/transaction/list')->with('status', 'Xóa đơn hàng thành công!');
    }

    public function detail(Request $request, $id) {
        if ($request->ajax()) {
            $transaction = AdminTransaction::find($id);
            $orders = AdminOrder::with('product')->where('transaction_id', $id)->get();
            $order_money = AdminTransaction::where('id', $id)->sum('total_money');
            $order_money_trash = AdminTransaction::where('id', $id)->onlyTrashed()->sum('total_money');
            $html = view('admin.order.list_order', compact('orders'))->render();
            $total_money = view('admin.order.total_money', compact('order_money', 'transaction'))->render();
            $info_order = view('admin.order.personal_information', compact('transaction'))->render();
            $total_money_trash = view('admin.order.total_money_trash', compact('order_money_trash'))->render();
            return response([
                'html' => $html,
                'total_money' => $total_money,
                'total_money_trash' => $total_money_trash,
                'info_order' =>  $info_order
            ]);
        }

    }

    public function deleteOrderItem(Request $request, $id) {
        if ($request->ajax()) {
            $order = AdminOrder::find($id);
            if ($order) {
                $order_money = $order->qty * $order->price;
                DB::table('transactions')->where('id', $order->transaction_id)->decrement('total_money', $order_money);
                $order->delete();
            }
            return response(['code' => 200]);
        }
    }

    public function status_order($status, $id) {
        $transaction = AdminTransaction::find($id);

        if ($transaction) {
            switch ($status) {
                case 'đang vận chuyển':
                    $transaction->status = 'đang vận chuyển';
                    break;
                
                case 'hoàn thành':
                    $transaction->status = 'hoàn thành';
                    break;

                case 'hủy bỏ':
                    $transaction->status = 'hủy bỏ';
                    break;

                default:
                    $transaction->status = 'đang xử lý';
                    break;

            }
            $transaction->save();
        }
        return redirect()->back();
     
    }
}
