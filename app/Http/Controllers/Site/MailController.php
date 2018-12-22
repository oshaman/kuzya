<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Mail\MainCallback;
use App\Models\Callback;
use Illuminate\Http\Request;
use Mail;
use Validator;

class MailController extends Controller
{
    public function footerMail(Request $request)
    {
        Mail::send(
            'emails.request',
            $request->all(),
            function ($message) use ($request) {
                $message->from('sender@kuzia.ua', 'Kuzia');
                $message->to('sergsova25@gmail.com', 'Admin')->subject($request->get('subject','Письмо со страницы '.$request->get('title')));
                $message->cc('sergeysova@ukr.net', '');
            }
        );

        if (count(Mail::failures())) {
            return response()->json(Mail::failures(), 418);
        }

        return response()->json(['success'=>1,'message'=>'форма отправлена'], 200);
    }

    public function contactMail(Request $request)
    {
        Mail::send(
            'emails.request',
            $request->all(),
            function ($message) use ($request) {
                $message->from($request->get('email', 'sender@kuzia.ua'), $request->get('name', 'Kuzia'));
                $message->to('sergsova25@gmail.com', 'Admin')->subject($request->get('subject','Письмо со страницы '.$request->get('title')));
                $message->cc('sergeysova@ukr.net', '');
            }
        );

        if (count(Mail::failures())) {
            return response()->json(Mail::failures(), 418);
        }

        return response()->json(['success'=>1,'message'=>'форма контактов отправлена'], 200);
    }

    public function mainMail(Request $request)
    {
        $data = Validator::make($request->all(), [
            'address' => 'required|string|max:1000',
            'name' => 'required|string|max:1000',
            'phone' => 'required|string|max:1000',
        ])->validate();

        $callback = Callback::where('name', 'main')->first();

        $email = new MainCallback($data);


        Mail::to($callback->email)
            ->cc($callback->copies_array)
            ->send($email);


        if (count(Mail::failures())) {
            return response()->json(Mail::failures(), 418);
        }

        return response()->json(['success'=>1,'message'=>'форма отправлена'], 200);
    }
    
}
