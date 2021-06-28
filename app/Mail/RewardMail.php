<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Historyreward;

class RewardMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        $created_at = Historyreward::orderBy('id','desc')->value('created_at');
        return $this->subject($created_at.' คุณมีข้อความแลกของรางวัลใหม่ กรุณาติดต่อเพื่อแลกของรางวัล!!')->view('emails.RewardMail');
    }
}
