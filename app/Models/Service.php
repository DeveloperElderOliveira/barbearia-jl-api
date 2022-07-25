<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $name
 * @property float $price
 * @property int $company_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Company $company
 * @property Collection|Employee[] $employees
 *
 * @package App\Models
 */
class Service extends Model
{
	protected $table = 'services';
	public $timestamps = false;
	
	protected $casts = [
		'price' => 'float',
		'company_id' => 'int'
	];

	protected $fillable = [
		'name',
		'price',
		'company_id'
	];

	public function company()
	{
		return $this->belongsTo(Company::class);
	}

	public function employees()
	{
		return $this->belongsToMany(Employee::class, 'employees_services')
					->withTimestamps();
	}

	public function schedules()
	{
		return $this->hasMany(Schedule::class);
	}
}
