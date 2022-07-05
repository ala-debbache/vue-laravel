<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    
    protected $fillable = [
        'client_id', 'provider_id', 'total'
    ];

    // relations

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }
}
