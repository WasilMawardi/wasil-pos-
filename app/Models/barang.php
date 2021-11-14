<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;
    public $table = "m_barang";
    protected $fillable = [
        'kode', 'nama', 'harga'
    ];
    public function sales_det()
    {
        return $this->hasMany(sales_det::class);
    }
}
