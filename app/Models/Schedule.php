<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property Carbon $scheduling_date
 * @property int $user_id
 * @property int|null $employee_id
 * @property int $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 * @property User $user
 * @property Service $service
 * 
 * @package App\Models
 */
class Schedule extends Model
{
	protected $table = 'schedules';

	protected $casts = [
		'user_id' => 'int',
		'employee_id' => 'int',
		'service_id' => 'int'
	];

	protected $dates = [
		'scheduling_date'
	];

	protected $fillable = [
		'scheduling_date',
		'user_id',
		'employee_id',
		'service_id'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class, 'service_id');
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
}
