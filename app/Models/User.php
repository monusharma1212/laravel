<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department',
        'experience',
        'dob',
        'skill_level',
        'shift',
        'theme_color',
        'role',
        'bio',
        'newsletter',
        'images'
    ];

    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'role'
    // ];

    protected $casts = [
        'department' => 'array',
        'images' => 'array',
        'dob' => 'date'
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected static function booted()
    {
        static::deleting(function ($user) {
            if (!empty($user->images)) {
                $images = is_array($user->images)
                    ? $user->images
                    : (json_decode($user->images, true) ?? []);

                foreach ($images as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }
        });
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
}
