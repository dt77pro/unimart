<?php

namespace App\Models;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminPage extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'pages';
    protected $fillable = [
        'title',
        'slug',
        'content',
        'active_page'
    ];
    
    const STATUS_PUBLIC = 1;
    const STATUS_PENDING = 0;
    protected $status = [
        0 => [
            'name' => 'Chờ duyệt',
            'class' => 'badge badge-warning'
        ],
        1 => [
            'name' => 'Công khai',
            'class' => 'badge badge-success'
        ]
    ];

    

    public function getStatus() {
        return Arr::get($this->status, $this->active_page, 'default');
    }

    
    
}
