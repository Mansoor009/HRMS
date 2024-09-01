<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use Kreait\Firebase\Messaging\CloudMessage;

class SendNotification extends Controller
{
    public function sendNotification()
    {
        $firebase_credential = (new Factory)->withServiceAccount(base_path('test-firebase-project-edf39-firebase-adminsdk-c785t-b2328de61f.json'));

        $messaging = $firebase_credential->createMessaging();

        $message = CloudMessage::fromArray([
            'notification' => [
                'title' => 'First Firebase Notification',
                'body' => 'This is our First Notification Through laravel'
            ],
            'topic' => 'global'
        ]);

        $messaging->send($message);

        return response()->json(['message' => 'Notification Sent Successfully']);
    }
}
