<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    public function track()
    {
        return $this->belongsTo(Track::class);
    }

    public function workstations()
    {
        return $this->hasMany(Workstation::class);
    }

    public function getName()
    {
        return $this->name;
    }
}
