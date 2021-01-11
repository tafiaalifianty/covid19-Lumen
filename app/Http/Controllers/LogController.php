<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Symptom;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

     public function logSubmit(Request $request) {
         // Validating request
        $this->validate($request, [
			'user_id' => 'required|max:3',
			'symptom_id' => 'required|max:3',
			'temperature' => 'required|max:2',
            'is_traveling' => 'required',
			'traveling_history' => 'max:100',
			'log_date' => 'required'
		]);
         $log = Log::create([
             'user_id' => $request->user_id,
             'symptom_id' => $request->symptom_id,
             'temperature' => $request->temperature,
             'is_traveling' => $request->is_traveling,
             'traveling_history' => $request->traveling_history,
             'log_date' => $request->log_date
         ]);

         if($log) {
            return  response()->json([
                'success' => true,
                'message' => 'Log Input Success',
                'data' => $log
            ], 201);
        } else {
            return response()->json([
                'success' => true,
                'message' => 'Log Input Failed'
            ], 400);
        }
     }

     public function logUpdate(Request $request, $id) {
         $log = Log::find($id);
         $requestData = $request->all();
            if(empty($log)) {
                return response()->json([
                'success' => 'false',
                'message' => 'No Such Log',
                'data' => 'For id : ' . $id
            ], 404);
            } else {
                $log->update($requestData);
                return response()->json([
                    'success' => 'true',
                    'message' => 'Log Updated Successfuly',
                    'data' => $requestData
                ], 201);
            }   
     }

     public function logHistory() {
        $logs = Log::all();
        if($logs) {
            foreach($logs as $item) {
                $log['user_name'] = $item->user->name;
                $log['symptom_name'] = $item->symptom->symptom_name;
                $log['suggestion'] = $item->symptom->suggestion;
                $log['temperature'] = $item->temperature;
                $log['is_traveling'] = $item->is_traveling;
                $log['traveling_history'] = $item->traveling_history;
                $log['log_date'] = $item->log_date;
            }
            return response()->json([
                    'success' => true,
                    'message' => 'Log History Successfully Showed',
                    'data' => $log
            ], 201);

        } else {
            return response()->json([
                    'success' => false,
                    'message' => 'Log History Failed Showed',
                    'data' => ''
            ], 400);
        }
     }

     public function logDetail($logDate) {
        $log = Log::where('log_date', $logDate)->first();
        if($log) {
            return response()->json([
                    'success' => true,
                    'message' => 'Log History Detail Successfully Showed',
                    'data' => [
                        'log_date' => $log->log_date,
                        'symptom_name' => $log->symptom->symptom_name,
                        'suggestion' => $log->symptom->suggestion
                    ]
            ], 201);
        } else {
            return response()->json([
                    'success' => false,
                    'message' => 'Log History Detail Failed Showed',
                    'data' => ''
            ], 400);
        }
     }
}
