<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'subject_code',
    ];

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Classes::class, 'classes_subject', 'subjects_id', 'classes_id')->withPivot('status');
    }
}
