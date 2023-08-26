<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public function getDesignation()
    {
        return $this->belongsTo(Designation::class, 'degn_id', 'id');
    }
}
