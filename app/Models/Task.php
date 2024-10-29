<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\{Builder, Model};

class Task extends Model
{
    use HasFactory;

    protected $with = ['assignedTo'];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function scopeNotDone(Builder $query): Builder
    {
        return $query->whereNull('done_at');
    }

    public function scopeDone(Builder $query): Builder
    {
        return $query->whereNotNull('done_at');
    }
}
