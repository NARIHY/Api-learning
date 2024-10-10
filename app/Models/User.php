<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use ApiPlatform\Metadata\ApiResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[ApiResource]
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
     * Set the user's password and hash it.
     *
     * @param string $value The password to be set.
     * @return void
     *
     * @OA\Property(property="password", type="string", format="password", description="User's password")
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = $this->hashPassword($value);
    }

     /**
     * Hash the password using SHA-256 with a salt.
     *
     * @param string $password
     * @return string
     */
    private function hashPassword(string $password): string
    {
        $salt = bin2hex(random_bytes(16)); // Generate a random salt
        $hashedPassword = hash('sha256', $salt . $password); // Hash the password with the salt
        return $salt . ':' . $hashedPassword; // Return the salt and the hashed password

    }
}
