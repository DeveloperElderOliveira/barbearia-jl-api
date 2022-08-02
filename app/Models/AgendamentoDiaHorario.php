<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AgendamentoDiaHorario
 * 
 * @property int $schedule_id
 * @property string $dia
 * @property string $horario
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Schedule $schedule
 *
 * @package App\Models
 */
class AgendamentoDiaHorario extends Model
{
	protected $table = 'agendamento_dia_horario';
	public $incrementing = false;

	protected $casts = [
		'schedule_id' => 'int'
	];

	protected $fillable = [
		'schedule_id',
		'dia',
		'horario'
	];

	public function schedule()
	{
		return $this->belongsTo(Schedule::class);
	}
}
