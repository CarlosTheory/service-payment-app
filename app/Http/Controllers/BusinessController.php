<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business;
//Validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class BusinessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Business::all();
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
        // Nuevo Negocio
        //Validacion
        $rules = [
            'name' => 'required',
            'email' => 'required',
            'rif' => 'required',
            'password' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
            'phone_number' => 'required'
        ];

          $customMessage = [
            "required" => 'Por favor rellene todos los :attribute'
        ];
        // Procesar que todos los campos requeridos esten
        $this->validate($request, $rules, $customMessage);

        // Pasar datos
        try {
            $name = $request->input('name');
            $email = $request->input('email');
            $rif = $request->input('rif');
            $password = $request->input('password');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $phone_number = $request->input('phone_number');

            $business = Business::create([
                'name' => $name,
                'email' => $email,
                'rif' => $rif,
                'password' => Hash::make($password),
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'address' => $address,
                'phone_number' => $phone_number,
            ]);

            $response['status'] = true;
            $response['message'] = 'Registro exitoso';

            return response()->json($business, 201);

        } catch(\Illuminate\Database\QueryException $ex){
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
        //Mostrar solo 1 negocio
        return Business::findOrFail($id);
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
        //Modificar Negocio
        $business = Business::findOrFail($id);
        $business->update($request->all());

        return response()->json(["message" => "Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $business = Business::findOrFail($id);
       $business->delete();

       return $business;
    }
}
