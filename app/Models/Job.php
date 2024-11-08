<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job_listings';

    protected $fillable = [
        'title',
        'description',
        'salary',
        'tags',
        'job_type',
        'remote',
        'requirements',
        'benefits',
        'address',
        'city',
        'state',
        'zipcode',
        'contact_email',
        'contact_phone',
        'company_name',
        'company_description',
        'company_website',
        'company_logo',
        'user_id',
    ];


    /**
     * Get the user that posted the job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*************  ✨ Codeium Command ⭐  *************/
    /**
     * Get the users who have bookmarked the job.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    /******  2b4c2d96-060f-4380-9d4d-6e758d2fae0d  *******/
    public function bookmarkedByUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'job_user_bookmarks')->withTimestamps();
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class)->withTimestamps();
    }
}
