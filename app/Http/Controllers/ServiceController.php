<?php

namespace App\Http\Controllers;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    protected $service;

    public function __construct(Service $service)
    {
        $this->middleware('auth:api');
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$services = $this->service->with('employees.services')->get())
             return response()->json(['error' => 'services not found.'],401);

        return response()->json($services);
    }  
}
