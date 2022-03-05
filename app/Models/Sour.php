<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sour extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'company', 'name', 'percent', 'comments', 'rating', 'hasLactose', 'image', 'category_id'];

    protected $casts = [
        'hasLactose' => 'boolean',
    ];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('company', 'like', '%' . $search . '%')
                ->orWhere('comments', 'like', '%' . $search . '%');
        });

//        $query->when($filters['category'] ?? false, function ($query, $category) {
//            $query->whereHas('category', function ($query, $category) {
//                $query->where('category_id', $category);
//            });
//        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
