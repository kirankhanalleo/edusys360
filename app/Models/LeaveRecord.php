<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeaveRecord extends Model
{
    public function getEmployee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'id');
    }
    public function getReason()
    {
        return $this->belongsTo(LeaveReason::class, 'leave_reason_id', 'id');
    }
}
