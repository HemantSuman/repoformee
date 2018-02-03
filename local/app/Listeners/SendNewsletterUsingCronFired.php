<?php

namespace App\Listeners;

use App\Events\SendNewsletterUsingCron;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;
use Mail;, 'token' => $token->token
use App\Newsletter;
use App\SubscriberList;

class SendNewsletterUsingCronFired
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendNewsletterUsingCron  $event
     * @return void
     */
    public function handle(SendNewsletterUsingCron $event)
    {
        //set params
        $is_default_template = $event->is_default_template;
        $title = $event->title;
        $body = $event->body;
        $users = $event->users;
        $filesArray = $event->filesArray;

        if($is_default_template == 1) {

            foreach($users as $key => $user) {
                $token = SubscriberList::where("email", "=", $user)
                    ->select('id', 'token')
                    ->first();

                Mail::send('emails.sample_newsletter', array('email' => $user, 'body' => $body, 'token' => $token->token, 'title' => $title), function($message) use ($user, $filesArray, $title) {
                    $message->from('avinesh.mathur@planetwebsolution.com');
                    $message->to($user)->subject($title);
                    
                    foreach($filesArray as $file) {
                        $message->attach(asset("/upload_images/newsletters/".$file));
                    }
                },true);        
            }
        } else {
            // if any newsletter template not selected by the admin
            foreach($users as $key => $user) {
                $token = SubscriberList::where("email", "=", $user)
                    ->select('id', 'token')
                    ->first();

                Mail::send('emails.demoNewsletter', array('emails' => $user, 'body' => $body, 'token' => $token->token), function($message) use ($user, $filesArray, $title) {
                    $message->from('avinesh.mathur@planetwebsolution.com');
                    $message->to($user)->subject($title);
                    
                    foreach($filesArray as $file) {
                        $message->attach(asset("/upload_images/newsletters/".$file));
                    }
                },true);
            }
        }
    }
}
