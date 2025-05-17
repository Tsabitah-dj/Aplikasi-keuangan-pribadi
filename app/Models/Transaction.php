<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'amount',
        'description',
        'transaction_date',
        'category_id',
    ];

      public function category(): BelongsTo
    {
        return $this->belongsTo(category::class);
    }

    public function scopeExpenses($query)
    {
        return $query->wherehas('category', function ($query) {
            $query->where('is_expensive', true);
        });
    }

    public function scopeIncomes($query)
    {
        return $query->wherehas('category', function ($query) {
            $query->where('is_expensive', false);
        });
    }
}
