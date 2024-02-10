<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class picReminderEmail extends Mailable
{
    private $meeting_name;
    private $meeting_date;
    private $picEmail;
    private $picName;
    private $due_date;
    private $action;
    // cth view http://127.0.0.1:8000/nolan.com/meeting/150
    private $linkView;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($meeting_name, $meeting_date, $picEmail, $picName, $due_date, $action, $linkView)
    {
        $this->meeting_name = $meeting_name;
        $this->meeting_date = $meeting_date;
        $this->picEmail = $picEmail;
        $this->picName = $picName;
        $this->due_date = $due_date;
        $this->action = $action;
        $this->linkView = $linkView;
    }


    public function build()
    {
        return $this
            ->from('namadepannamabelakang1781945@gmail.com', 'NOLAN')
            ->subject('Hasil Diskusi Rapat') // Mengatur subjek email
            ->view('emails.picReminderEmail')->with([
                'meeting_name' => $this->meeting_name, //
                'meeting_date' => $this->meeting_date,
                'picEmail' =>   $this->picEmail,
                'picName' => $this->picName,
                'due_date'=> $this->due_date,
                'action'=> $this->action,
                'linkView' => $this->linkView,


            ]); // Mengatur tampilan email
    }
}
