<?php

namespace App\Http\Controllers;

use App\Http\Requests\ScheduleRequest;
use App\Models\AgendamentoDiaHorario;
use App\Models\Schedule;
use App\Models\ServicesSchedule;
use Exception;
use Illuminate\Http\Request;

class SchedulesController extends Controller
{
    protected $schedule;

    public function __construct(Schedule $schedule)
    {
        // $this->middleware('auth:api');
        $this->schedule = $schedule;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {    
        $valor_total_agendamento = 0;
        $concat_nome_servicos = '';   
        $user = auth('api')->user();
        
        if(!$schedules = $this->schedule->with('employee','user','services','agendamento_dia_horario')->where('user_id',$user['id'])->orderBy('scheduling_date')->get())
             return response()->json(['error' => 'schedules not found.']);

             foreach($schedules as $schedule){
                    for($i = 0; $i < count($schedule->services); $i++){
                        $valor_total_agendamento += $schedule->services[$i]['price'];
                        $concat_nome_servicos .= $schedule->services[$i]['name'];
                        if( count($schedule->services) > ($i + 1) ){
                            $concat_nome_servicos .= ' + ';
                        }                     
                    }
                    $schedule->valor_total_agendamento = $valor_total_agendamento;
                    $schedule->concat_nome_servicos = $concat_nome_servicos;
                    $concat_nome_servicos = '';
                    $valor_total_agendamento = 0;        
             }
        return response()->json($schedules);
    }
    
    public function loadHorarios($dia)
    {   
        $escala_horarios_disponiveis = ["08:00 - 09:00",
        "09:00 - 10:00","10:00 - 11:00",
        "11:00 - 12:00","12:00 - 13:00",
        "13:00 - 14:00","14:00 - 15:00", 
        "15:00 - 16:00","16:00 - 17:00",
        "17:00 - 18:00","18:00 - 19:00",
        "19:00 - 20:00","20:00 - 21:00"];

        $horarios_disponiveis = [];

        $horarios_agendados = AgendamentoDiaHorario::where('dia',$dia)->get();
        unset($escala_horarios_disponiveis[array_search($horarios_agendados[0]->horario,$escala_horarios_disponiveis)]);
        dd($escala_horarios_disponiveis);
        foreach($horarios_agendados as $hora_agendada){
                if(array_search($hora_agendada->horario,$escala_horarios_disponiveis) != false) {
                    $horarios_disponiveis[] = $hora_agendada->horario;
                }
            // foreach($escala_horarios_disponiveis as $horario_disp)
            // {       
            //         if($horario_disp != $hora_agendada->horario)
            //         {
            //             $horarios_disponiveis[] = $horario_disp;
            //         }
            // }
        }

        return response()->json($horarios_disponiveis);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleRequest $request)
    {
        try{
            $dados = $request->all();
        
            $schedule = $this->schedule->create($request->all());

            $schedule->agendamento_dia_horario()->create(["dia" => $dados['scheduling_date'],"horario" => $dados['horario']]);

            foreach($dados['servicos'] as $servico) {
                ServicesSchedule::create(["service_id" => $servico['id'], "schedule_id" => $schedule->id]);
            }

            return response()->json(['schedule' => $schedule]);
        }catch (Exception $e){
            return response()->json(['error' => $e->getMessage()],404);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$schedule = $this->schedule->find($id))
             return response()->json(['error' => 'schedule not found.']);

        return response()->json(['schedule' => $schedule]);
    }

     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ScheduleRequest $request, $id)
    {
        if(!$schedule = $this->schedule->find($id))
            return response()->json(['error' => 'update not possible']);

        $schedule = $schedule->update($request->all());
        return response()->json(['schedule' => $schedule]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$schedule = $this->schedule->find($id))
            return response()->json(['error' => 'delete not possible']);

        $schedule = $schedule->delete();
        return response()->json(['schedule' => $schedule]);
    }
}
