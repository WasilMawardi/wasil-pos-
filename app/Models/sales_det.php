<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sales_det extends Model
{
    use HasFactory;
    public $table = "t_sales_det";
    protected $guarded = [];

    public function barang()
    {
        return $this->belongsTo(barang::class);
    }
}
