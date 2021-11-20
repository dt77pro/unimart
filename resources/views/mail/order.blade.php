
<div class="m_-8373061094629087623main-content" align="center" id="order-custom" style="font-family: sans-serif; font-size: 16px; color: #333">

    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width:800px; border: 1px solid #ebdfdf; padding: 20px;
    color: #333">
        <div class="m_-8373061094629087623section" style="padding-top:0px">		 
            <div class="m_-8373061094629087623header-title" style="color:#0f146d;text-align:center;font-size: 16px">Cám ơn bạn đã đặt hàng tại Unimart!</div>
            <div class="m_-8373061094629087623section-content">
                <h2>Xin chào {{$name}},</h2>
            </div>
            <div class="m_-8373061094629087623hide">
            <p style="color: #333">Unimart đã nhận được yêu cầu đặt hàng của bạn và đang xử lý nhé. Bạn sẽ nhận được thông báo tiếp theo khi đơn hàng đã sẵn sàng được giao.</p>
    
        </div>
        <div class="m_-8373061094629087623section" style="padding-top:0px">
            <div class="m_-8373061094629087623section-header m_-8373061094629087623section-header--deliveredTo" style="color: #333">Đơn hàng được giao đến</div>
            <div class="m_-8373061094629087623section-content">
                <table cellpadding="2" cellspacing="0" width="100%">
                  <tbody>
                        <tr>
                            <td width="25%" valign="top" style="color:#0f146d;font-weight:bold">Tên:</td>
                            <td width="75%" valign="top">{{$name}}  </td>
                        </tr>
                        <tr>
                            <td valign="top" style="color:#0f146d;font-weight:bold">Địa chỉ nhà:</td>
                            <td valign="top">{{$address}}</td>
                        </tr>
                        <tr>
                            <td valign="top" style="color:#0f146d;font-weight:bold">Điện thoại:</td>
                            <td valign="top">{{$phone}}</td>
                        </tr>
                        <tr>
                            <td valign="top" style="color:#0f146d;font-weight:bold">Email:</td>
                            <td valign="top"><a href="mailto:dangthang20393@gmail.com" target="_blank">{{$email}}</a></td>
                        </tr>
                  </tbody>
                </table>
            </div>
        </div>
        <div class="m_-8373061094629087623section" style="padding-top:0px">
            <style>
                table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;      
                }
                .table-order {
                    font-family: arial, sans-serif;
                    border-collapse: collapse;
                    width: 100%;
                    }
                    

                    tr {
                        text-align: left;
                    }
                    td, th {
                    border: 1px solid #dddddd;
                    padding: 8px;
                    }
                }
               
            </style>
            <div style="margin-top: 30px">
                <div><h3>Chi tiết đơn hàng của bạn</h3></div>
                <table cellpadding="2" cellspacing="0" width="100%" class="table-order">
                    <tr style="text-align: left;">
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Thành Tiền</th>
                    </tr>
                    @php
                        $t = 0;
                        $carts = Cart::content();
                    @endphp
                    @foreach ($carts as $item)
                    @php
                        $t++;
                    @endphp
                    <tr>
                        <td>{{$t}}.</td>
                        <td>{{$item->name}}</td>
                        <td><img src="{{asset($item->featured_img_path)}}" width="80px" height="80px" alt=""></td>
                        <td>{{$item->qty}}</td>
                        <td>{{number_format($item->price, 0, ',', '.')}}VNĐ</td>
                        <td>{{number_format($item->price * $item->qty, 0, ',', '.')}}VNĐ</td>
                    </tr>
                    @endforeach
                    
                </table>
                <div align="right" style="margin-top: 30px; color: rgb(233, 28, 28);font-weight: bold;">TỔNG HÓA ĐƠN: {{Cart::subtotal(0, ',', '.')}}VNĐ</div>
            </div>
        </div>
    </table>
    <div>

    </div>
   
</div>     
                               
              
                           
                            
            
                                    
                                
                                
                                

      
                

                             

               