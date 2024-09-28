<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\PersonalDetails;
use App\Models\EmploymentHistory;
use App\Models\Education;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'user_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function personalDetails(): HasOne
    {
        return $this->hasOne(PersonalDetails::class);
    }

    public function employmentHistory(): HasMany
    {
        return $this->hasMany(EmploymentHistory::class);
    }

    public function education(): HasMany
    {
        return $this->hasMany(Education::class);
    }
}
