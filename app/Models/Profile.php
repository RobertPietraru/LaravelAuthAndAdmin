<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'gender',
        'address',
        'school',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    use HasFactory;
}
