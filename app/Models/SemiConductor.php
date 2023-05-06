<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SemiConductor extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference',
        'slug',
        'used',
        'unused',
        'warning',
        'critical',
        'datasheet',
        'user_id',
        'created_at',
        'updated_at'
    ];

    protected $appends = [
        'quantity'
    ];

    public function getQuantityAttribute ()
    {
        return ($this->used + $this->unused);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
