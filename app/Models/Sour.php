<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sour extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company', 'name', 'percent', 'comments', 'rating', 'hasLactose'];

    protected $casts = [
        'hasLactose' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
