<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;
use Auth;

class SendMakeAnOfferEmail implements ShouldQueue {

    use InteractsWithQueue,
        Queueable,
        SerializesModels;

    public $userData = null;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userdata) {
        $this->userData = $userdata;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Mailer $mailer) {

        $result = $mailer->send('emails.front_make_an_offer', array('userdata' => $this->userData), function($message) {
            $message->to($this->userData['UserEmail'])->subject("Make an offer")->from($this->userData['AuthEmail'], $this->userData['AuthName']);
        }, true);
    }

}
