<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the job listings for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany<\App\Models\Job>
     */
    public function jobListings()
    {
        return $this->hasMany(Job::class);
    }

    /**
     * Get the jobs bookmarked by the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany<\App\Models\Job>
     */
    public function bookmarkedJobs(): BelongsToMany
    {
        return $this->belongsToMany(Job::class, 'job_user_bookmarks')->withTimestamps();
    }

    public function applicants(): HasMany
    {
        return $this->hasMany(Applicant::class, 'user_id')->withTimestamps();
    }
}
