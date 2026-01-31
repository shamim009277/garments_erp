<?php

namespace Modules\HRIS\Models;

use Illuminate\Database\Eloquent\Model;

class JobStatus extends Model
{
    protected $table = 'job_statuses';

    protected $fillable = ['job_id', 'batch_id', 'user_id', 'status', 'progress', 'message'];
}
