<?php

namespace App\Models;

use App\Enums\TaskStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'created_at',
        'deleted_at',
        'order',
        'user_id',
    ];

    protected $casts = [
        'status' => TaskStatus::class,
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
