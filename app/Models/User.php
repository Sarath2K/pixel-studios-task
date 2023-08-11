<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'unique_id',
        'dob',
        'phone',
        'gender',
        'address',
        'status'
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function getUserUniqueId($role)
    {
        if ($role == 'Customer') {
            $uniqueIdPattern = CUSTOMER_UNIQUE_ID;
        } else {
            $uniqueIdPattern = EMPLOYEE_UNIQUE_ID;
        }

        return self::getUniqueId($uniqueIdPattern, UNIQUE_ID_LENGTH);
    }

    public static function getUniqueId($uniqueIdPattern, $uniqueIdLength)
    {
        $previousId = self::where('unique_id', 'LIKE', $uniqueIdPattern . '%')->orderBy('unique_id', 'desc')->first()->unique_id ?? ($uniqueIdPattern . str_pad(0, $uniqueIdLength, '0', STR_PAD_LEFT));
        if (!$previousId) {
            return $uniqueIdPattern . str_pad(1, $uniqueIdLength, '0', STR_PAD_LEFT);
        }
        $previousIdNumber = (int)str_replace($uniqueIdPattern, '', $previousId);
        return $uniqueIdPattern . str_pad($previousIdNumber + 1, $uniqueIdLength, '0', STR_PAD_LEFT);
    }
}
