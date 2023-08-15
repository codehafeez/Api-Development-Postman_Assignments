<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $token;
    public function __construct($user, $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    public function build()
    {
        return $this->view('reset_password')->with([
            'user' => $this->user,
            'token' => $this->token
        ]);
    }

    public function envelope()
    {
        return new Envelope(
            subject: 'Reset Password',
        );
    }

    public function content()
    {
        return new Content(view: 'reset_password');
    }


    public function attachments()
    {
        return [];
    }
}
