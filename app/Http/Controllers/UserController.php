<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
//Validator
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function login()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request ('password')]))    
        {
            $user=Auth::user();
            $success['token'] = $user->createToken('ServicePayment')-> accessToken;

            return response()->json(['success' => $success], 201);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

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
    public function register(Request $request)
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
            'zip_code' => 'required',
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
            $zip_code = $request->input('zip_code');
            $latitude = $request->input('latitude');
            $longitude = $request->input('longitude');
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
                'zip_code' => $zip_code,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'phone_number' => $phone_number,
            ]);

            $success['token'] =  $user->createToken('ServicePayment')->accessToken; 
            $success['email'] = $user->email;

            $response['status'] = true;
            $response['message'] = 'Registro exitoso';

            return response()->json(['success' => $success], 201);

        } catch(\Illuminate\Database\QueryException $ex){
            $response['status'] = false;
            $response['message'] = $ex->getMessage();

            return response($response, 500);
        }
    }

    public function details(){
        $user=Auth::user();

        return response()->json(['success' => $user], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Mostrar solo 1 usuario
        return User::findOrFail($id);
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
        //Modificar Usuaruio
        $usuario = User::findOrFail($id);
        $usuario->update($request->all());

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
       $user = User::findOrFail($id);
       $user->delete();

       return $user;
    }
}
