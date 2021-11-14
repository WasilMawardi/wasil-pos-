<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    use HasFactory;
    public $table = "m_costumer";
    protected $fillable = [
        'kode', 'nama', 'telp'
    ];
    public function sales()
    {
        return $this->hasMany(sales::class, 'cust_id', 'id');
    }
}
