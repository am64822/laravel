<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function show() { // show the feedback form
        return view('feedback', ['messageToUser' => null]);
    }

    public function save(Request $request) { // validate and save the feedback 
        $validated = $request->validate([
            'userName' => 'required', 
            'feedbackTxt' => 'required'
        ]);
        
        $ds = DIRECTORY_SEPARATOR;
        $jsonFeedback = json_encode(array_merge(array('time' => time()), $request->only(['userName', 'feedbackTxt'])));
        //dd($jsonFeedback);

        file_put_contents(database_path().$ds.'feedback', $jsonFeedback.PHP_EOL, FILE_APPEND);

        return view('feedback', ['messageToUser' => 'Сообщение отправлено. Спасибо за Вашу обратную связь!']);    
    }


}
