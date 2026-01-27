<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'profile_photo_path',
        'two_factor_secret',
        'two_factor_recovery_codes',
        'two_factor_confirmed_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
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
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    // Helper to check role safely
    public function hasRole($roleName)
    {
        return $this->role && $this->role->name === $roleName;
    }

    // Inside App\Models\User.php

    public function locations()
    {
        return $this->hasMany(UserLocation::class);
    }

    // Optional: Helper to check if user covers a specific area
    public function hasAccessToDistrict($districtId)
    {
        return $this->locations()
            ->where(function ($query) use ($districtId) {
                // User has this specific district assigned
                $query->where('district_id', $districtId)
                    // OR User has the parent State assigned (which covers all districts)
                    ->orWhere(function ($q) {
                        $q->whereNull('district_id'); // Implies State level
                        // You might need to check state_id matching the district's state here
                    });
            })
            ->exists();
    }
}
