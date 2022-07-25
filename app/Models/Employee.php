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
 * @property string|null $image
 * @property int $user_id
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property User $user
 * @property Collection|Service[] $services
 * @property Collection|Schedule[] $schedules
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
		'image',
		'user_id',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function services()
	{
		return $this->belongsToMany(Service::class, 'employees_services')
					->withTimestamps();
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class, 'employee_id');
	}
}
