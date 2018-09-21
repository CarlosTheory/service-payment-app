<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Business;
use Response;


class ProductController extends Controller
{
	public $iva = 16;
	public $percentage = 10;

		public function index(){
			return Response::json(Product::with('businesses')->get());
			// $products = Product::with('businesses')->get();

			// var_dump($products);
			//var_dump($products); die();
			// foreach ($products as $product) {
			// 	    [
			// 		$product->id,
			// 		$product->name,
			// 		$product->price,
			// 		$product->iva,
			// 		$product->percentage,
			// 		[
			// 			$product->businesses->id,
			// 			$product->businesses->name,
			// 		],
			// 	];
			// }

			//return response()->json($products, 201);
		}

        public function store($id, Request $request)
	    {
	        // Nuevo Negocio
	        //Validacion
	        $rules = [
	            'name' => 'required',
	            'price' => 'required',
	            'state' => 'required',

	        ];

	          $customMessage = [
	            "required" => 'Por favor rellene todos los :attribute'
	        ];
	        // Procesar que todos los campos requeridos esten
	        $this->validate($request, $rules, $customMessage);

	        // Pasar datos
	        try {
	            $name = $request->input('name');
	            $price = $request->input('price');
	            $state = $request->input('state');
	            $business_id = $id;


	            $calcular_iva = ($this->iva*$price)/100;
	            $calcular_percentage = ($this->percentage*($price+$calcular_iva))/100;

	            $product = Product::create([
	                'name' => $name,
	                'price' => $price,
	                'iva' => $calcular_iva,
	                'percentage' => $calcular_percentage,
	                'state' => $state,
	                'business_id' => $business_id
	            ]);

	            $response['status'] = true;
	            $response['message'] = 'Registro exitoso';

	            return response()->json($product, 201);

	        } catch(\Illuminate\Database\QueryException $ex){
	            $response['status'] = false;
	            $response['message'] = $ex->getMessage();

	            return response($response, 500);
	        }
	    }

	    public function show($id)
	    {	
	    	// $product = Product::findOrFail($id);
	    	$product = Business::with('products')->find($id)->products;
	    	// return Response::json(Product::with('businesses')->get());

	    	// $request = Product::findOrFail($id);
	    	// $business_id = $request->business_id;

	    	// $res = [

	    	// ]
	        //Mostrar solo 1 producto
	        return Response::json($product, 201);
	    }
}
