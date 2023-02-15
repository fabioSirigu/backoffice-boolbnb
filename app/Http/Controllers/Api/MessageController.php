<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();

        dd($data);

        $validator = Validator::make(
            $data,
            [
                'home_id' => 'required',
                'name' => 'required',
                'email' => 'required|email|max:255',
                'message' => 'required',
            ],
        );


        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ]);
        }


        $newMessage  = new Message();
        if (!empty($data['object'])) {
            $newMessage->object = $data['object'];
        }
        $newMessage->home_id = $data['home_id'];
        $newMessage->name = $data['name'];
        $newMessage->email = $data['email'];
        $newMessage->message = $data['message'];
        $newMessage->save();

        return response()->json([
            "success" => true
        ]);
    }
}
