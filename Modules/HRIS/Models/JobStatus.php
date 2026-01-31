<?php

namespace Modules\HRIS\Models;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $fillable = ['job_id', 'user_id', 'status', 'progress', 'message'];
}
