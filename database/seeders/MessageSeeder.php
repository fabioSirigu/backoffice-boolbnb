<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $messages = config('homes_messages');
        foreach ($messages as $message) {
            $new_message = new Message();
            $new_message->homes_id = $message['homes_id'];
            $new_message->name = $message['name'];
            $new_message->email = $message['email'];
            $new_message->message = $message['message'];
            $new_message->save();
        }
    }
}
