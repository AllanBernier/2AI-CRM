<?php

namespace App\Models;

use App\Traits\HasTokenizedSearch;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use const http\Client\Curl\Versions\CURL;

class Training extends Model
{
    use HasFactory, HasUlids, HasTokenizedSearch;

    protected $fillable = [
        'status',
        'product_id',
        'customer_id',
        'subcontractor_id',
        'tjm_client',
        'tjm_subcontractor',
        'duree',
        'start_date',
        'end_date',
        'num_session',
        'num_bdc',
        'travelling_expenses',
        'location',
        'text',
        'action_customer',
        'action_subcontractor',
        'name',
        'cursus_id'
    ];

    public function cursus()
    {
        return $this->belongsTo(Cursus::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function subcontractor()
    {
        return $this->belongsTo(Subcontractor::class);
    }

    protected static function booted(): void
    {
        static::creating(function (Training $training) {
            if ( isset($training->product_id) ){
                $training->name = $training->product->code;
                if (!isset($training->duree)){
                    $training->duree = $training->product->duree;
                }
                if (!isset($training->tjm_client)){
                    $training->tjm_client = $training->product->tjm;
                }
            }
        });

        static::updating(function (Training $training) {
            if (isset($training->product_id) && isset($training->subcontractor_id)){
                $product_tjm_type = $training->product->tjm_type;
                if (isset($product_tjm_type->id)){
                    $training->tjm_subcontractor = $training->subcontractor->tjms()->find($product_tjm_type->id)->pivot->price;
                }
            }
        });
    }
}
