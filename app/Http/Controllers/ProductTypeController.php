<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\typeProducts;
use Response;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener todas las categorias y sus productos
        return Response::json(typeProducts::with('products')->get());
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
    public function store($id, Request $request)
    {
        //Guardar Tipos de productos
        //Validacion
        $rules = [
            'name' => 'required'
        ];

        $customMessage = [
            'required' => 'Por favor rellene todos los ::attribute'
        ];

        //Verificar que esten todos los campos requeridos 
        $this->validate($request, $rules, $customMessage);

        try{
            $name = $request->input('name');
            $product_id = $id;

            $product_type = typeProducts::create([
                'name' => $name,
                'product_id' => $product_id
            ]);

            return response()->json($product_type, 201);
        }catch(\Illuminate\Database\QueryException $ex){ 
            $response['status'] = false;
	        $response['message'] = $ex->getMessage();

	            return response($response, 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
