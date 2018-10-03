<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//Validator
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtener todos los usuarios
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Nuevo Usuario
        //Validacion
        $rules = [
            'name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'dni' => 'required',
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
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $dni = $request->input('dni');
            $password = $request->input('password');
            $country = $request->input('country');
            $state = $request->input('state');
            $city = $request->input('city');
            $address = $request->input('address');
            $phone_number = $request->input('phone_number');

            $user = User::create([
                'name' => $name,
                'last_name' => $last_name,
                'email' => $email,
                'dni' => $dni,
                'password' => Hash::make($password),
                'country' => $country,
                'state' => $state,
                'city' => $city,
                'address' => $address,
                'phone_number' => $phone_number,
            ]);

            $response['status'] = true;
            $response['message'] = 'Registro exitoso';

            return response()->json($user, 201);

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
    public function show(User $user)
    {
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //Modificar Usuaruio
        $user->update($request->all());

        return response()->json(["message" => "Actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
       $user->delete();

       return $user;
    }
}
