<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume;

class Education extends Model
{
    use HasFactory;

    protected $fillable = [
        'resume_id',
        'institution',
        'degree',
        'field_of_study',
        'start_date',
        'end_date'
    ];

    public function resume(): BelongsTo
    {
        return $this->belongsTo(Resume::class);
    }
}
