<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Employee
 * 
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property int $user_id
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property User $user
 * @property Collection|Schedule[] $schedules
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Employee extends Model
{
	protected $table = 'employees';

	protected $casts = [
		'user_id' => 'int',
		'company_id' => 'int'
	];

	protected $fillable = [
		'first_name',
		'last_name',
		'user_id',
		'company_id'
	];

	protected $hidden = [
		'created_at',
		'updated_at'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class, 'service_id');
	}

	public function services()
	{
		return $this->hasMany(Service::class);
	}
}
