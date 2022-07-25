<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class EmployeesService
 * 
 * @property int $employee_id
 * @property int $service_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 * @property Service $service
 *
 * @package App\Models
 */
class EmployeesService extends Model
{
	protected $table = 'employees_services';
	public $incrementing = false;

	protected $casts = [
		'employee_id' => 'int',
		'service_id' => 'int'
	];

	protected $fillable = [
		'employee_id',
		'service_id'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
}
