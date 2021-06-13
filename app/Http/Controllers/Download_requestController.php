<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Downlreq;
use Auth;

class Download_requestController extends Controller
{
    public function show() { // show the feedback form
        return view('download_request', ['messageToUser' => null]);
    }

    public function save(Request $request) { // validate and save the feedback 
        $this->validate($request, [
            //'userName' => 'required', 
            'phone' => 'required|regex:/^\+[1-9]([0-9]{0,2})\([0-9]{3}\)[0-9]{7}$/',
            //'email' => 'required|email:rfc',
            'content' => 'required'           
        ], [], [
            'userName' => "'Имя пользователя'",
            'phone' => "'Телефон'",
            'email' => "'E-Mail'",
            'content' => "'Что необходимо'"          
        ]);        
        
        /*$validated = $request->validate([
            'userName' => 'required', 
            'phone' => 'required|regex:/^\+[1-9]([0-9]{0,2})\([0-9]{3}\)[0-9]{7}$/',
            'email' => 'required|email:rfc',
            'content' => 'required'
        ]);*/
        
        $user = Auth::user();

        $downlreq = new Downlreq();
        $downlreq->user_name = $user->name;
        $downlreq->phone = $request->phone;
        $downlreq->email = $user->email;
        $downlreq->content = $request->content;
        $downlreq->save();

        //$ds = DIRECTORY_SEPARATOR;
        //$jsonFeedback = json_encode(array_merge(array('time' => time()), $request->only(['userName', 'phone', 'email', 'content'])));
        //dd($jsonFeedback);
        //file_put_contents(database_path().$ds.'downl_req', $jsonFeedback.PHP_EOL, FILE_APPEND);

        return view('download_request', ['messageToUser' => "Заказ номер $downlreq->id принят."]);    
    }


}
