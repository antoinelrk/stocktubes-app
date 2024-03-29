<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tube extends Model
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

    public static function raw()
    {
        return self::all()->makeHidden([
            'quantity'
        ]);
    }

    public function getQuantityAttribute ()
    {
        return ($this->used + $this->unused);
    }

    public function user ()
    {
        return $this->belongsTo(User::class);
    }
}
