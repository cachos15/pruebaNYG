<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use Illuminate\Http\Request;

class documentoController extends Controller
{
    public function index()
    {
        $documento = Documento::get();

        if ($documento->isEmpty())
        {
            return response()->json([
                    'success' => false,
                    'data' => []
                ]);
            }
        else
            {
                return response()->json([
                    'success' => true,
                    'data' => $documento
                ]);
            }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $documentoExiste=Documento::where('descripcion','=',$request->descripcion)->get();

        if ($documentoExiste->isEmpty()){
            $data=new Documento();
            $data->descripcion=$request->descripcion;
            
            $data->save();

            return response()->json([
                'success' => true,
                'error' => '',
                'data' => $data
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'error' => 'El tipo de documento ingresado ya existe',
                'data' => []
            ]);
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
        $documentoExiste=Documento::find($id);
        if ($documentoExiste!=null){
            
            return response()->json([
                'success' => true,
                'error' => '',
                'data' => $documentoExiste
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'error' => 'El documento no existe',
                'data' => []
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $documento = Documento::find($id);
        if ($documento!=null){
            if ($request->descripcion!=null){
                $existeDescripcion = Documento::where('descripcion','=',$request->descripcion)
                ->where('id','<>',$id)
                ->get();
                if ($existeDescripcion->isEmpty()){
                        $documento->descripcion=$request->descripcion;
                        $documento->save();

                        return response()->json([
                            'success' => true,
                            'error' => '',
                            'data' => $documento
                        ]);
                }
                else{
                    return response()->json([
                        'success' => false,
                        'error' => 'La descripción del documento ingresado ya existe',
                        'data' => []
                    ]);
                }
            }
            else{
                return response()->json([
                    'success' => false,
                    'error' => 'No se ha ingresado la información necesaria para actualizar el registro',
                    'data' => []
                ]);
            }
        }
        else{
            return response()->json([
                'success' => false,
                'error' => 'El documento ingresado no existe',
                'data' => []
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $documento = Documento::find($id);
       if ($documento!=null){
           $documento->delete();
            return response()->json([
                'success' => true,
                'error' => ''
            ]);
       }
       else{
        return response()->json([
            'success' => false,
            'error' => 'El documento ingresado no existe'
        ]);
       }
    }
}
