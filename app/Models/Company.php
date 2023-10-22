<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}
