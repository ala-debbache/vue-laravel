<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    protected $table = 'providers';

    protected $fillable = [
        'nif', 'nis', 'user_id',
    ];

    // relations
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
