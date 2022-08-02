<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * 
 * @property int $id
 * @property Carbon $scheduling_date
 * @property int $user_id
 * @property int $employee_id
 * @property int $confirmado
 * @property string $observacao
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Employee $employee
 * @property User $user
 * @property AgendamentoDiaHorario $agendamento_dia_horario
 * @property Collection|Service[] $services
 *
 * @package App\Models
 */
class Schedule extends Model
{
	protected $table = 'schedules';

	protected $casts = [
		'user_id' => 'int',
		'employee_id' => 'int',
		'confirmado' => 'int'
	];

	protected $dates = [
		'scheduling_date'
	];

	protected $fillable = [
		'scheduling_date',
		'user_id',
		'employee_id',
		'confirmado',
		'observacao'
	];

	public function employee()
	{
		return $this->belongsTo(Employee::class);
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function agendamento_dia_horario()
	{
		return $this->hasOne(AgendamentoDiaHorario::class);
		
	}

	public function services()
	{
		return $this->belongsToMany(Service::class, 'services_schedules')
					->withTimestamps();
	}
}
