<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sample extends Model
{
    protected $fillable = ['ori_num', 'py_num', 'sample_type', 'sample_amount', 'sender', 'sender_contact', 'send_time', 'receive_status', 'sample_status', 'express_num', 'receive_time', 'recipient', 'store_location', 'sample_batch', 'project', 'piipeline', 'note'];
}
