<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = ['payment_id', 'amount', 'status'];

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

    public function transactions()
    {
        return $this->hasMany(RefundTransaction::class);
    }
}
