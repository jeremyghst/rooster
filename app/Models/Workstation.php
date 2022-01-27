<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workstation extends Model
{
    use HasFactory;

    protected $casts = [
        'days' => 'array'
    ];

    public function room()
    {
        $this->belongsTo(Room::class);
    }
}
