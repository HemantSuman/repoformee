<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Contracts\Mail\Mailer;
use Mail;

class SendReminderEmail implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
   protected $loginusername;
    protected $loginemail;
    protected $users;
    protected $userdata;
  
    public function __construct($userdata=null,$users=null,$loginusername=null, $loginemail=null)
    {
        //dd('yes');
//        $this->userdata = $userdata;
//        $this->users = $users;
        $this->loginusername = $loginusername;
        $this->loginemail = $loginemail;
        $this->users = $users;
        $this->userdata = $userdata;
        
      
     //dd($this->userdata);
        
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
       $loginusername = $this->loginusername ;
       $loginemail = $this->loginemail ;
       $users = $this->users ;
       $userdata = $this->userdata ;
        
        
         $mail = Mail::send('emails.front_send_message', array('userdata' => $userdata), function($message) use ($users, $loginusername, $loginemail) {
                                                $message->from($loginemail, $loginusername);
                                                $message->to($users['email'])->subject("User message");
                                            }, true);
        //
//         Mail::send('emails.front_send_message1', array(), function($message)  {
//                                                $message->from('avinesh@gmail.com', $this->loginusername);
//                                                $message->to('avinesh.mathur@planetwebsolution.com')->subject("User message");
//                                            }, true);
    }
    

}
