<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Download_requestController extends Controller
{
    public function show() { // show the feedback form
        return view('download_request', ['messageToUser' => null]);
    }

    public function save(Request $request) { // validate and save the feedback 
        $validated = $request->validate([
            'userName' => 'required', 
            'phone' => 'required|regex:/^\+[1-9]([0-9]{0,2})\([0-9]{3}\)[0-9]{7}$/',
            'email' => 'required|email:rfc',
            'content' => 'required'
        ]);
        
        $ds = DIRECTORY_SEPARATOR;
        $jsonFeedback = json_encode(array_merge(array('time' => time()), $request->only(['userName', 'phone', 'email', 'content'])));
        //dd($jsonFeedback);

        file_put_contents(database_path().$ds.'downl_req', $jsonFeedback.PHP_EOL, FILE_APPEND);

        return view('download_request', ['messageToUser' => 'Запрос принят.']);    
    }


}
