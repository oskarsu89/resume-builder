<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume;

class PersonalDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id', 
        'first_name', 
        'last_name', 
        'email', 
        'phone', 
        'address'
    ];

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
