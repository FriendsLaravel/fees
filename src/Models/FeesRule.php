<?php

namespace Fol\Fees\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesRule extends Model
{
    use HasFactory;
    protected $fillable = [
        'fees_id',
        'type',
        'configuration'
    ];

    protected $casts = [
        'configuration' => 'array',
    ];
}
