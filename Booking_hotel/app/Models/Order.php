<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Định nghĩa bảng này tương ứng với bảng 'orders' trong cơ sở dữ liệu
    protected $table = 'orders';

    // Các trường được phép gán giá trị hàng loạt (mass assignment)
    protected $fillable = [
        'customer_name',
        'room_type',
        'check_in_date',
        'check_out_date',
        'total_amount',
        'status',
    ];

    // Nếu cần khai báo kiểu dữ liệu của một số trường (ví dụ: ngày tháng)
    protected $dates = ['check_in_date', 'check_out_date'];

    // Cần khai báo nếu bạn muốn kiểm soát thời gian tạo và cập nhật
    public $timestamps = true;
}
