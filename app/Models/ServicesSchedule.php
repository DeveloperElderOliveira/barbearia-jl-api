<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ServicesSchedule
 * 
 * @property int $service_id
 * @property int $schedule_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Schedule $schedule
 * @property Service $service
 *
 * @package App\Models
 */
class ServicesSchedule extends Model
{
	protected $table = 'services_schedules';
	public $incrementing = false;

	protected $casts = [
		'service_id' => 'int',
		'schedule_id' => 'int'
	];

	protected $fillable = [
		'service_id',
		'schedule_id'
	];

	public function schedule()
	{
		return $this->belongsTo(Schedule::class);
	}

	public function service()
	{
		return $this->belongsTo(Service::class);
	}
}
