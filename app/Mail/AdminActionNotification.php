<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminActionNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $action;
    public $details;

    public function __construct($user, $action, $details = [])
    {
        $this->user = $user;
        $this->action = $action;
        $this->details = $details;
    }

    public function build()
    {
        $subjectMap = [
            'created' => 'Perubahan Data: Data Anda Ditambahkan oleh Admin',
            'updated' => 'Perubahan Data: Data Anda Diperbarui oleh Admin',
            'deleted' => 'Perubahan Data: Data Anda Dihapus oleh Admin',
        ];

        $subject = $subjectMap[$this->action] ?? 'Perubahan Data oleh Admin';

        return $this->subject($subject)
                    ->view('emails.admin_action_notification')
                    ->with([
                        'user' => $this->user,
                        'action' => $this->action,
                        'details' => $this->details,
                    ]);
    }
}
