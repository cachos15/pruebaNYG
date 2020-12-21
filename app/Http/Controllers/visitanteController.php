<?php

namespace App\Http\Controllers;

use App\Models\Documento;
use App\Models\Visitante;
use Illuminate\Http\Request;


class visitanteController extends Controller
{
    public function index()
    {
        $visitante = visitante::get();

        if ($visitante->isEmpty())
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
                    'data' => $visitante
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
        $documentoExiste=Documento::find($request->tipoDocumento);

        if ($documentoExiste!=null){
            $data=new Visitante();
            $data->nombres=$request->nombres;
            $data->apellidos=$request->apellidos;
            $data->tipoDocumento=$request->tipoDocumento;
            $data->numeroDocumento=$request->numeroDocumento;
            $data->motivoVisita=$request->motivoVisita;
            
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
                'error' => 'El tipo de documento ingresado no existe',
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
        $usuarioExiste=Visitante::find($id);
        if ($usuarioExiste!=null){
            
            return response()->json([
                'success' => true,
                'error' => '',
                'data' => $usuarioExiste
            ]);
        }
        else{
            return response()->json([
                'success' => false,
                'error' => 'El usuario no existe',
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
       $visitante = Visitante::find($id);
       if ($visitante!=null){
           if ($request->nombres!=null){
                $visitante->nombres=$request->nombres;
           }
           if ($request->apellidos!=null){
                $visitante->apellidos=$request->apellidos;
           }
            if ($request->tipoDocumento!=null){
                $documentoExiste=Documento::find($request->tipoDocumento);
                if ($documentoExiste!=null){
                    $visitante->tipoDocumento=$request->tipoDocumento; 
                }
                else{
                    return response()->json([
                        'success' => false,
                        'error' => 'El tipo de documento ingresado no existe',
                        'data' => []
                    ]);
                }
            }
            if ($request->numeroDocumento!=null){
                $visitante->numeroDocumento=$request->numeroDocumento;
            }
            if ($request->motivoVisita!=null){
                $visitante->motivoVisita=$request->motivoVisita;
            }

            $visitante->save();

            return response()->json([
                'success' => true,
                'error' => '',
                'data' => $visitante
            ]);
       }
       else{
        return response()->json([
            'success' => false,
            'error' => 'El usuario ingresado no existe',
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
        $visitante = Visitante::find($id);
       if ($visitante!=null){
           $visitante->delete();
            return response()->json([
                'success' => true,
                'error' => ''
            ]);
       }
       else{
        return response()->json([
            'success' => false,
            'error' => 'El usuario ingresado no existe'
        ]);
       }
    }

}
