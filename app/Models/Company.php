<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Company
 * 
 * @property int $id
 * @property string $name
 * @property string $latitude
 * @property string $longitude
 * @property string $phone
 * @property string $social_link
 * @property string $address
 * @property string|null $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|Employee[] $employees
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Company extends Model
{
	protected $table = 'companies';

	protected $fillable = [
		'name',
		'latitude',
		'longitude',
		'phone',
		'social_link',
		'address',
		'image'
	];

	public function employees()
	{
		return $this->hasMany(Employee::class);
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}
}
