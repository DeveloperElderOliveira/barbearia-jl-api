<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'users';
	public $timestamps = false;

	protected $casts = [
		'image' => 'boolean',
		'activated' => 'int'
	];

	protected $dates = [
		'email_verified_at'
	];

	protected $hidden = [
		'password',
		'remember_token',
		'email_verified_at',
		'created_at',
		'updated_at'
	];

	protected $fillable = [
		'name',
		'email',
		'email_verified_at',
		'password',
		'activated',
		'image',
		'remember_token'
	];
    
    public function employees()
	{
		return $this->hasMany(Employee::class);
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class);
	}
    
    //JWT

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
