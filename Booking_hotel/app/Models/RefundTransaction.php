<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefundTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['refund_id', 'amount', 'note'];

    public function refund()
    {
        return $this->belongsTo(Refund::class);
    }
}
