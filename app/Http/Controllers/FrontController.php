<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Traits\Actions;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Auth;
use Illuminate\Support\Facades\Mail;


class FrontController extends Controller
{

    public function mailSend(Request $request)
    {
        $data = [];
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['messages'] = $request->message;

        try {
            Mail::send('message', $data, function ($message) use ($data) {
                // $message->to('asim.sagir@gmail.com');
                $message->to('admin@example.com');
                $message->from('demo@example.com');
                $message->subject('New Message Received');
            });
        } catch (Exception $e) {
            echo $e->error();
        }
    }
}
