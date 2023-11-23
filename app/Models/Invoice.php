<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;

class Invoice extends Model
{
    use HasFactory, hasUlids;

    protected $fillable = [
        'company_id',
        'file',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function trainings()
    {
        return $this->hasMany(Training::class, 'company_invoice_id');
    }
}
