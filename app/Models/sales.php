<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales extends Model
{
    use HasFactory;
    public $table = "t_sales";
    protected $guarded = [];

    public function customer()
    {
        return $this->belongsTo(customer::class, 'cust_id', 'id');
    }
    // public function barang()
    // {
    //     return $this->belongsTo(barang::class);
    // }
    public function sales_det()
    {
        return $this->hasMany(sales_det::class, 'sales_id', 'id');
    }
}
