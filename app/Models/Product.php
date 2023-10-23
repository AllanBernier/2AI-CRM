<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'code',
        'description',
        'url',
        'tjm',
        'duree',
        'company_id'
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
