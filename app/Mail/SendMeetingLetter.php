<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMeetingLetter extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $dept;
    public $dept_chairman;
    public $letter;
    public $agendas;
    public $letter_number;
    public $meetingMember;
    public function __construct($dept,$dept_chairman,$letter,$agendas,$letter_number,$meetingMember)
    {
        //
        $this->dept = $dept;
        $this->dept_chairman = $dept_chairman;
        $this->letter = $letter;
        $this->agendas = $agendas;
        $this->letter_number = $letter_number;
        $this->meetingMember = $meetingMember;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = 'Meeting letter';
        return $this->subject($subject)
                    ->view('department.letter_layouts.meeting_letter_email');
    }
}
