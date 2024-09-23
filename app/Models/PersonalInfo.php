<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Resume;

class PersonalInfo extends Model
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

    public function resume()
    {
        return $this->belongsTo(Resume::class);
    }
}
