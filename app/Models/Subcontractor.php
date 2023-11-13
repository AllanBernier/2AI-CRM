<?php

namespace App\Models;

use App\Traits\HasTokenizedSearch;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcontractor extends Model
{
    use HasFactory, HasUlids, HasTokenizedSearch;

    protected $fillable = [
        'first_name',
        'last_name',
        'email_perso',
        'email_company',
        'phone',
        'company_name',
        'city',
        'subcontractor_id'
    ];


    public function tjms()
    {
        return $this->belongsToMany(TjmType::class)
            ->withPivot('price')
            ->withTimestamps();
    }

    public function trainings()
    {
        return $this->hasMany(Training::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function leader()
    {
        return $this->belongsTo(Subcontractor::class,'subcontractor_id');
    }


    protected static function booted(): void
    {
        static::created(function (Subcontractor $subcontractor) {
            $subcontractor->tjms()->attach(TjmType::all());
        });
    }
}
