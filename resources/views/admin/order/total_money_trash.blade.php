<style>
    .total-order-money span {
        color: #0e0103;font-family: sans-serif;
        font-weight: bold;
    }
    .total-order-money span strong {
        
        padding: 10px 10px;
        color: #ff0018; 
    }
   
</style>
<div class="total-order-money">
    <span>TỔNG HÓA ĐƠN: <strong>{{number_format($order_money_trash, 0, ',', '.')}}₫</strong></span>
</div>