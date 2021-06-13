<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Auth;

class FeedbackController extends Controller
{
    public function show() { // show the feedback form
        return view('feedback', ['messageToUser' => null]);
    }

    public function save(Request $request) { // validate and save the feedback 
        $this->validate($request, [
            //'userName' => 'required', 
            'feedbackTxt' => 'required'            
        ], [], [
            'userName' => "'Имя пользователя'", 
            'feedbackTxt' => "'Комментарий / отзыв'"           
        ]);
        
        /*$validated = $request->validate([
            'userName' => 'required', 
            'feedbackTxt' => 'required'
        ]);*/
        
        //$ds = DIRECTORY_SEPARATOR;
        //$jsonFeedback = json_encode(array_merge(array('time' => time()), $request->only(['userName', 'feedbackTxt'])));
        //dd($jsonFeedback);
        //file_put_contents(database_path().$ds.'feedback', $jsonFeedback.PHP_EOL, FILE_APPEND);

        $user = Auth::user();

        $feedback = new Feedback();
        $feedback->user_name = $user->name;
        $feedback->feedbacktxt = $request->feedbackTxt;
        $feedback->save();

        return view('feedback', ['messageToUser' => 'Сообщение отправлено. Спасибо за Вашу обратную связь!']);    
    }


}
