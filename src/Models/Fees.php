<?php

namespace Fol\Fees\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fees extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'code',
        'amount',
        'status',
        'position'
    ];

    public function rules()
    {
        return $this->hasMany(FeesRule::class,'fees_id','id');
    }

    public function calculator($amount): int{
       return $amount * ($this->amount/100 - 1);
    }
}
