<?php

use App\constants\MessageTypes;
use App\Events\LogEvent;
use App\Mail\sendMessageToBlockNumber;
use App\Mail\sendMessageToUnBlockNumber;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/sendMessageToBlockNumber', function () {

    $Validator = Validator::make(request()->all(),[
        'phone_number' => ['required','regex:/([+]20)..*/']
    ]);

    if($Validator->fails()){
        return response()->json(['message'=>'validation has failed','error'=>$Validator->getMessageBag()]);
    };

    try{
        Mail::to(env("SUPPORTER_EMAIL"))->send(new sendMessageToBlockNumber(request()->phone_number));
        event(new LogEvent(request()->phone_number,MessageTypes::BLOCK));
        return response()->json(['message'=>'successfully','status'=>200],200);
    }catch(Throwable $e){
        return response()->json(['message'=>'failed','status'=>500,'error'=>$e],200);
    }

});


Route::post('/sendMessageToUnBlockNumber', function () {

    $Validator = Validator::make(request()->all(),[
        'phone_number' => ['required','regex:/([+]20)..*/']
    ]);

    if($Validator->fails()){
        return response()->json(['message'=>'validation has failed','error'=>$Validator->getMessageBag()]);
    };

    Mail::to(env('SUPPORTER_EMAIL'))->send(new sendMessageToUnBlockNumber(request()->phone_number));
    event(new LogEvent(request()->phone_number,MessageTypes::UNBLOCK));
    return response()->json(['message'=>'successfully','status'=>200],200);
});


Route::get('/Logs',function(){
    return Log::all();
});
