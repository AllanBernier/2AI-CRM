<?php

namespace App\Models;

use App\Traits\HasTokenizedSearch;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUlids, HasTokenizedSearch;

    protected $fillable = [
        'code',
        'description',
        'url',
        'tjm',
        'duree',
        'company_id',
        'tjm_type_id'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function tjm_type()
    {
        return $this->belongsTo(TjmType::class);
    }

}
