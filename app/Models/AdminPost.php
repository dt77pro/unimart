<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;



class AdminPost extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'posts';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'description',
        'thumbnail',
        'cat_id',
        'user_id',
        'status',
        'created_at'
    ];

    public function AdminPostCategory() {
        return $this->belongsTo(AdminPostCategory::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    const STATUS_PENDING = 'pending';
    const STATUS_PUBLIC = 'public';
    protected $show_status = [
        'pending' => [
            'name' => 'Chờ duyệt',
            'class' => 'badge badge-dark'
        ],
        'public' => [
            'name' => 'Công khai',
            'class' => 'badge badge-primary'
        ]
    ];

    public function getStatus() {
        return Arr::get($this->show_status,$this->status, 'default');
    }
}
