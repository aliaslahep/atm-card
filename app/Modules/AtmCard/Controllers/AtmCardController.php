<?php

namespace App\Modules\AtmCard\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class AtmCardController extends Controller
{
    public function store(Request $request) {
        
        $parameters = $request->all(); 

        try {
        
            $response = Http::post('http://10.13.13.2:3030/atm-card/create', $parameters);        

            return $this->get_response($response);
        
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function fetch_balance(Request $request) {

        $parameters = $request->all();

        try {
        
            $response = Http::post('http://10.13.13.2:3030/atm-card/balance-fetch', $parameters);

            return $this->get_response($response);
        
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage()
            ], 500);
        }

    }

    public function fund_transfer(Request $request) {

        $parameters = $request->all();

        try {
        
            $response = Http::post('http://10.13.13.2:3030/atm-card/fund-transfer', $parameters);

            return $this->get_response($response);
        
        } catch (\Exception $e) {

            return response()->json([
                'error' => 'An error occurred',
                'message' => $e->getMessage()
            ], 500);
        }
    }
    public function get_response($response) {

        if ($response->successful()) {

            $data = $response->json(); 
            
            $message = 'Request was successful!';
        
        } else {
        
            $data = $response->body(); 
        
            $message = 'An error occurred while processing the request.';
        
        }

      
        return response()->json([
          
            'Message' => $message,
            
            'ReturnMessage' => $data,
       
        ]);

    }
}
