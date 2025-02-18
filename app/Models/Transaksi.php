<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $fillable = ['users_id','bukti_transfer','status'];

    public function users()
    {
        return $this->belongsTo('App\Models\User');
    }
}
