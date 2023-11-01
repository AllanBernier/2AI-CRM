<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cursus extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'product_id',
        'customer_id',
        'tjm',
        'travelling_expenses',
        'location',
        'status',
        'send_to_customer',
        'send_to_subcontractors',
    ];

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}

