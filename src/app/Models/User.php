<?php

namespace App\Models;

use Carbon\Carbon;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'occupation',
        'gender',
        'dob',
        'email',
        'email_verified_at',
        'password',
        'zip_code',
        'city',
        'state',
        'country',
        'county',
        'image',
        'ssn',
        'driving_license',
        'notification_id',
        'last_login',
        'active',
        'ip',
        'user_agent',
        'user_os',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
        'password',
        'remember_token',
        "email_verified_at",
        "notification_id",
        "last_login",
        "active",
        "ip",
        "user_agent",
        "user_os"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date'
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    // notice that here the attribute name is in snake_case
    protected $appends = ['full_name'];


    /** 
     * Make hash of password
    */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }


    public function setDateOfBirthAttribute($date)
    {
        $this->attributes['date_of_birth'] = Carbon::parse($date);
    }

    public function getDateOfBirthAttribute()
    {
        return Carbon::parse($this->attributes['date_of_birth'])->format('d F Y');
    }


    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
    }


     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
