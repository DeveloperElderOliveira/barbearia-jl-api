<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanieRequest;
use Illuminate\Http\Request;
use App\Models\Company;

class CompaniesController extends Controller
{
    protected $company;

    public function __construct(Company $company)
    {
        $this->middleware('auth:api');
        $this->company = $company;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!$companies = $this->company->with('services.employees')->get())
             return response()->json(['error' => 'companies not found.'],401);

        return response()->json($companies);
    }  

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanieRequest $request)
    {
        if(!$company = $this->company->create($request->all()))
            return response()->json(['error' => 'company not created'],401);

        return response()->json(['company' => $company]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$company = $this->company->find($id))
             return response()->json(['error' => 'company not found.'],401);

        return response()->json(['company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanieRequest $request, $id)
    {
        if(!$company = $this->company->find($id))
            return response()->json(['error' => 'update not possible'],401);

        $company = $company->update($request->all());
        return response()->json(['company' => $company]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$company = $this->company->find($id))
            return response()->json(['error' => 'delete not possible'],401);

        $company = $company->delete();
        return response()->json(['company' => $company]);
    }
}
