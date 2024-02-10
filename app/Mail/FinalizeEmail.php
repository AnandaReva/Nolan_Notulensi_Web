<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class FinalizeEmail extends Mailable
{
    private $meetingName;
    private $LinkApproval;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($meetingName, $LinkApproval)
    {
        $this->meetingName = $meetingName;
        $this->LinkApproval = $LinkApproval;
    }


    public function build()
    {
        return $this
            ->from('namadepannamabelakang1781945@gmail.com', 'Nolan')
            ->subject('Persetujuan Notulensi Rapat') // Mengatur subjek email
            ->view('emails.finalizeEmail')->with([
                'meetingName' => $this->meetingName,
                'LinkApproval' => $this->LinkApproval,
            ]); // Mengatur tampilan email
    }





    /*
     * Get the message envelope.
    
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Finalize Email'
            // from: new Address('namadepannamabelakang1781945@gmail.com', 'cobaNolan')
        );
    }
 */
    /*
     * Get the message content definition.
   
    public function content(): Content
    {
        return new Content(
            view: 'view.name',
        );
    }  */

    /*
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
   
    public function attachments(): array
    {
        return [];
    }  */
}
