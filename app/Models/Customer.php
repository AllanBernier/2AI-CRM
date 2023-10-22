<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Customer extends Model
{
    use HasFactory, hasUlids;

    protected $fillable = [
        'first_name',
        'last_name',
        'role',
        'phone',
        'email',
        'city',
        'company_id',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
