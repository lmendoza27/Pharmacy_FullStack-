<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Farmacia;
use Datatables;

class FarmaciaController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            return datatables()->of(Farmacia::select('*'))
            ->addColumn('action', 'company-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('home');
    }


        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
 
        $companyId = $request->id;
 
        $company   =   Farmacia::updateOrCreate(
                    [
                     'id' => $companyId
                    ],
                    [
                    'nombre' => $request->name, 
                    'dirección' => $request->direccion,
                    'latitud' => $request->latitud,
                    'longitud' => $request->longitud
                    ]);    
                         
        return Response()->json($company);
 
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $company  = Farmacia::where($where)->first();
      
        return Response()->json($company);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  \App\company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $company = Farmacia::where('id',$request->id)->delete();
      
        return Response()->json($company);
    }
}
