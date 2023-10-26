<?php

namespace App\Models;

use App\Traits\HasTokenizedSearch;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    use HasFactory, HasUlids, HasTokenizedSearch;

    protected $fillable = [
        'status',
        'product_id',
        'customer_id' ,
        'subcontractor_id',
        'tjm_client',
        'tjm_subcontractor',
        'duree',
        'start_date',
        'end_date',
        'num_session',
        'num_bdc',
        'travelling_expenses',
        'location'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class);
    }

}
