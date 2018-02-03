<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    /**
     * The users that belong to the department.
     */
    public function newsletter_attachments() {
        return $this->hasMany('App\models\NewsletterAttachment');
    }

    /**
     * The users that belong to the department.
     */
    public function newsletter_subscribers() {
        return $this->hasMany('App\models\NewsletterSubscriber');
    }

    public function delete()
    {
        // delete all related photos 
        $this->newsletter_attachments()->delete();
        
        // delete the user
        return parent::delete();
    }
}
