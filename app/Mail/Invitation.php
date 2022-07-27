<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invitation extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $invitation;
    public $url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($invitation)
    {
        $this->url = config('app.url') . '/invited-register?invitation_token=' . $invitation->invitation_token;
        $this->invitation = $invitation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.invitation', [
            'url' => $this->url,
            'inviter' => User::query()->find($this->invitation->user_id)
        ]);
    }
}
