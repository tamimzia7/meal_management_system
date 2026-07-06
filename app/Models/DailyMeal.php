<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DailyMeal extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'meal_date',
        'breakfast_meal',
        'lunch_meal',
        'dinner_meal',
        'remarks',
    ];

    protected function casts(): array
    {
        return [
            'meal_date' => 'date',
            'breakfast_meal' => 'integer',
            'lunch_meal' => 'integer',
            'dinner_meal' => 'integer',
        ];
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    public function getTotalMealAttribute(): int
    {
        return $this->breakfast_meal + $this->lunch_meal + $this->dinner_meal;
    }
}
