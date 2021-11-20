<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;


class AdminTransaction extends Model
{
    use HasFactory;
    use SoftDeletes;


    protected $table = 'transactions';

    protected $guarded = [];

    protected $transaction_status = [
        'đang xử lý' => [
            'class' => 'warning',
            'name'  => 'Đang xử lý'
        ],
        'đang vận chuyển' => [
            'class' => 'info',
            'name' => 'Đang vận chuyển'
        ],
        'hoàn thành' => [
            'class' => 'success',
            'name' => 'Thành công'
        ],
        'hủy bỏ' => [
            'class' => 'danger',
            'name' => 'Đã hủy'
        ],
    ];

    public function getStatus() {
        return Arr::get($this->transaction_status, $this->status, 'default');
    }
}
