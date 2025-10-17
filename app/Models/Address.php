<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'address';
    public $timestamps = false;
    protected $fillable=[
        'user_id',
        'address_number',
        'address'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
