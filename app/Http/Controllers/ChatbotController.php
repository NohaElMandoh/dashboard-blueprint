<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function handleMessage(Request $request)
    {
        $message = $request->input('message');
        // Add your chatbot logic here or connect to a third-party API.
        $reply = $this->generateReply($message);

        return response()->json(['reply' => $reply]);
    }

    private function generateReply($message)
    {
        // Simple example of a response
        if (stripos($message, 'hello') !== false) {
            return 'Hi there! How can I assist you?';
        }
        return 'I am not sure how to respond to that.Please contact us for further assistance at +02121212121.';
    }
}
