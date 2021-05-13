<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Email extends Mailable
{
    use Queueable, SerializesModels;

    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $paths,array $data)
    {
        //
        $this->attaches=$paths;
        $this->data=$data;


        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // print_r($this->attachments);
        // dd($this->data);
        $email= $this->view('email.format_m')
                ->from($this->data['from'])
                ->subject($this->data['title']);

        if(isset($this->attaches))
            {

                foreach ($this->attaches as $path) {
                

                    $email->attach(public_path($path));
                    
                }
            }
        $this->with('data',$this->data);
        return $email;



        // ->attachData($this->pdf, 'name.pdf', [
        //     'mime' => 'application/pdf',
        // ]);

    }
}
