<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MealRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'rate',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'rate' => 'decimal:2',
        ];
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public static function current(): ?self
    {
        return self::latest()->first();
    }
}
