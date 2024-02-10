<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class rejectEmail extends Mailable
{
    private $meeting_name;
    private $noteTakerName;
    private $writerName;
    private $linkEdit;
    private $rejectionMessage;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($meeting_name, $writerName, $noteTakerName, $linkEdit, $rejectionMessage)
    {
        $this->meeting_name = $meeting_name;
        $this->writerName = $writerName;
        $this->noteTakerName = $noteTakerName;
        $this->linkEdit = $linkEdit;
        $this->rejectionMessage = $rejectionMessage;
    }


    public function build()
    {
        return $this
            ->from('namadepannamabelakang1781945@gmail.com', 'NOLAN')
            ->subject('Penolakan Hasil Diskusi Rapat') // Mengatur subjek email
            ->view('emails.rejectionEmail')->with([
                'meeting_name' => $this->meeting_name, //
                'writerName' => $this->writerName,
                'noteTakerName' => $this->noteTakerName,
                'linkEdit' =>   $this->linkEdit,
                'rejectionMessage' => $this->rejectionMessage,
            ]); // Mengatur tampilan email
    }
}
