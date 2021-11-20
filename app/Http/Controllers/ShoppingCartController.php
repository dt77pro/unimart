<?php

namespace App\Http\Controllers;

use App\Models\AdminOrder;
use App\Models\User;
use App\Models\AdminTransaction;
use App\Models\FrontEnd\District;
use App\Models\FrontEnd\Product;
use App\Models\FrontEnd\Province;
use App\Models\FrontEnd\Ward;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ShoppingCartController extends Controller


{
    //Show Cart
    public function show_cart() {
        return view('shopping_cart.index');
    }

    //Add Cart
    public function add_cart(Request $request, $id) {
        $request->session()->get('cart');
        $product_id = Product::find($id);

        if ($request->input('qty')) {
            $qty = $request->qty;
        } else {
            $qty = 1;
        }
        
        //Kiểm tra số lượng sản phẩm tồn kho
        $qty_in_warehouse = Product::select('qty')->where('id', $id)->first();
        $qty_in_warehouse = $qty_in_warehouse->qty;

        $cart_add = Cart::add([
            'id' => $product_id->id,
            'name' => $product_id->name,
            'qty' => $qty,
            'price' => $product_id->price,
            'weight' => 550,
            'options' => [
                'featured_img_path' => $product_id->featured_img_path,
                'slug' => $product_id->slug
            ],
        ]);
 
        //Check sản phẩm tồn kho
        if ($cart_add->qty > $qty_in_warehouse) {
            $cart_add->qty = $qty_in_warehouse;
            return response(['status' => 'Sản phẩm chỉ mua tối đa số lượng '.$qty_in_warehouse.','.' '.'giỏ hàng của bạn đang có '.$cart_add->qty.''.'']);
        } 
        $rowId = $cart_add->rowId;
        $qty = $cart_add->qty;
        $id = $cart_add->id;
        // if ($id = $rowId) {
            $total = Cart::subtotal(0, ',', '.').'đ';
            $sub_qty = Cart::get($rowId)->qty;
            $qty = Cart::get($rowId)->qty;
            $total_qty = Cart::count();
        // }
        $data = [
            'total'     => $total,
            'sub_qty'   => 'Số lượng: '.$sub_qty,
            'qty'       => $qty,
            'total_qty' => $total_qty,
            'id'        => $id,
        ];
        return response()->json(['data' => $data]);
        
        // decrement
        
    }

    public function buy_now_cart($slug) {
        $product_id = Product::where('slug', $slug)->first();

        //Check số lượng sản phẩm trong kho hàng
        if ($product_id->qty < 1) {
            Session::flash('toastr', [
                'type' => 'error',
                'message' => 'Sản phẩm đã tạm thời hết hàng!'
            ]);
            return redirect()->back();
        } else {

            //Thêm sản phẩm vào giỏ hàng với qty là 1;
            $cart_add = Cart::add([
                'id' => $product_id->id,
                'name' => $product_id->name,
                'qty' => 1,
                'price' => $product_id->price,
                'weight' => 550,
                'options' => [
                    'featured_img_path' => $product_id->featured_img_path,
                    'slug' => $product_id->slug
                ],
            ]);
        }
        $provinces = Province::all();
        return view('shopping_cart.checkout', compact('provinces'));

    }


    //Update Cart
    public function update_cart(Request $request, $id) {

        if($request->ajax()) { 
            $rowId = $request->rowId;
            $qty = $request->qty;
            // return $qty;
            $product_id = Product::find($id);
            $qty_in_warehouse = Product::select('qty')->where('id', $id)->first();
            $qty_in_warehouse = $qty_in_warehouse->qty;
           
           
            if ($qty > $qty_in_warehouse) {
                return response(['status' => 'Sản phẩm chỉ mua tối đa số lượng là '.$qty_in_warehouse.'']);
            } 

            $cart_update = Cart::update($rowId, $qty);
       
            $sub_total = Cart::get($rowId)->subtotal(0, ',', '.').'đ';
            $total = Cart::subtotal(0, ',', '.').'đ';
            $total_qty = Cart::count();
            $sub_qty = Cart::get($rowId)->qty;
            
            $data = [
                'sub_total' => $sub_total,
                'total'     => $total,
                'total_qty' => $total_qty,
                'sub_qty'   => 'Số lượng: '.$sub_qty,
            ];
            
            return response()->json($data);

        }
    
    }

    //Delete Cart
    public function delete_cart(Request $request, $id) {
        $id = $request->id;
        Cart::remove($id);
        return view('shopping_cart.index');
    }

    //Destroy Cart
    public function destroy_cart() {
        Cart::destroy();
        return redirect()->back();
    }


    // Checkout Cart
    public function getPayment() {
        $provinces = Province::all();
        return view('shopping_cart.checkout', compact('provinces'));
    }

    public function postPayment(Request $request) {
        if ($request->input('payment')) {

            //Validate dữ liệu truyền vào
            $request->validate([
                'fullname' => 'required|string|max:255',
                'email'=> 'required|email',
                'phone' => 'required|numeric',
                'province'=> 'required',
                'district'=> 'required',
                'ward'=> 'required',
                'other'=> 'required',
                'note'=> 'required'
            ]);


            //Chèn dữ liệu vào database
    //    if (isset(Auth::user()->id)) {
            $request->district = explode(':', $request->district);
            $request->district = $request->district[1];
            $request->province = explode(':', $request->province);
            $request->province = $request->province[1];
            // $data['user_id'] = Auth::user()->id;
            $data['total_money'] = Cart::subtotal(0, 0, '');
            $data['name'] = $request->fullname;
            $data['address'] = $request->input('other') .'-'. $request->ward .'-'. $request->district .'-'. $request->province;
            $data['phone_number'] = $request->phone;
            $data['email'] = $request->email;
            $data['note'] = $request->note;
            $data['payment'] = $request->payment;
            $data['created_at'] = Carbon::now('Asia/Ho_Chi_Minh');

            //Lưu thông tin khách hàng khi đã thanh toán
            $transactions = AdminTransaction::create($data);
            $transactionId = $transactions->id;

            // Lưu chi tiết sản phẩm đã mua
            if (!empty($transactionId)) {
                $carts = Cart::content();
                foreach ($carts as $item) {
                    $product_id = $item->id;
                    $qty = $item->qty;
                    $price = $item->price;

                    $order = new AdminOrder;
                    $order->transaction_id = $transactionId;
                    $order->product_id = $product_id;
                    $order->qty =  $qty;
                    $order->price =  $price;
                    $order->created_at = Carbon::now('Asia/Ho_Chi_Minh');
                    $order->save();

                    //Tăng số lượng sản phẩm bán chạy khi mua sản phẩm
                    DB::table('products')->where('id', $item->id)->increment('sell', $qty);

                    //Số lượng sản phẩm trong kho trừ đi sau khi mua
                    DB::table('products')->where('id', $item->id)->decrement('qty', $qty);
                }
            }    
            
            // Mail xác nhận đơn đặt hàng
            $name = $request->fullname;
            $email = $request->email;
            $phone = $request->phone;
            $address = $request->input('other').','.' '.$request->ward.','.' '.$request->district.','.' '.$request->province;
            $payment = $request->payment;

            Mail::send('mail.order', [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'payment' => $payment,
                'address' => $address,
                'carts' => $carts,
            ], function ($mail) use($request) {
                $mail->to($request->email);
                $mail->from('dt77pro@gmail.com', 'Unimart');
                $mail->subject('Cảm ơn bạn đã xác nhận địa chỉ email trên Unimart');

            });
            
            //Xóa giỏ hàng sau khi đã thanh toán
            Cart::destroy();
            return redirect()->back()->with(['level'=> 'success', 'status' => 'Đặt hàng thành công']);
            
        } else {
            Cart::destroy();
            return redirect()->back()->with(['level'=> 'warning', 'status' => 'Đặt hàng không thành công!']);
            
        }
    }

    public function get_district(Request $request) {
        $province_id = $request->get('province_id');
        $districts = District::where('province_id', $province_id)->get();
        $html = view('shopping_cart.district', compact('districts'))->render();
        return response([
            'html' => $html,
        ]);
      
    } 
    
    # Get Ward
    public function get_ward(Request $request) {
        $district_id = $request->get('district_id');
        $wards = Ward::where('district_id', $district_id)->get();
        $html = view('shopping_cart.ward', compact('wards'))->render();
        return response([
            'html' => $html
        ]);
      
    }

    
}
