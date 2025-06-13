<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Model: PaymentSetting.php
class PaymentSetting extends Model
{
    use HasFactory;

    protected $fillable = ['gateway', 'is_enabled', 'config'];
}
