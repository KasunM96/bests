<?php

namespace App\Http\Controllers;

use App\Client;
use App\Mail\Email;
use App\MailReport;
use App\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\VarDumper\Cloner\Data;

use function PHPUnit\Framework\isNull;

class MailController extends Controller
{
    //
    public function index(){


      $users=DB::table('users AS u')
      ->where('u.id','<>',Auth::id())
      ->get();
      $services=Service::all();
      $clients=Client::all();

      return view('email.send',compact('users','services','clients'));

    }

    
    public function basic_email() {
        $data = array('name'=>"Virat Gandhi");
     
        Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Basic Testing Mail');
           $message->from('ksmredx@gmail.com','Virat Gandhi');
        });
        echo "Basic Email Sent. Check your inbox.";
     }
     public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
           $message->from('ksmredx@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
       
     }

     public function attachment_email(Request $request) {

      // dd($request);
      // $from= $request->from;
      // $to= $request->to;
      // $cc= $request->cc;
      // $message= $request->body;

         $data["to"]=$request->to;
         $data["from"]=$request->from;
         $data["cc"]=$request->cc;
         $data["body"]=$request->body;
         $data["title"]=$request->subject;
         $files=$request->file('files');

         // dd($data['cc']);



         $mail=new MailReport();
         $mail->to=$request->to_sel;
         $mail->message=$request->body;
         $mail->s_id=$request->subject_sel;
         $mail->from=Auth::user()->id;
         $mail->subject=$request->subject;
         // $mail->save();

        

       
            $paths=[];

         if(isset($files))
            {
               $files=$request->file('files');
               foreach ($files as $file){
                  $destinationPath = 'storage/';
                  
                  $name=time().'-'.$file->getClientOriginalName();
                  $fullpath=$destinationPath.$name;
                  // $extension=$file->getClientOriginalExtension();
                  array_push($paths,$fullpath);
                  $file->move($destinationPath,$name); 
               }
            }
            

      if($data["cc"]=="")
      {
         Mail::to($request->to)
         ->send(new Email($paths,$data));
 
      }
      else
      {
        Mail::to($request->to)
        ->cc($request->cc)
        ->send(new Email($paths,$data));
      }



      //    Mail::send('email.format_m',$data, function($message) use ($data,$files){
      //       $message->to($data['to'])
      //       ->cc($data['cc'])
      //       ->subject($data['title'])
      //       ->from($data['from']);

      //       foreach ($files as $file) {
      //          $message->attach($file);
      //       }
         

  
      //   });
        echo "Email Sent with attachment. Check your inbox.";
        return redirect('/email')->with('success', 'Service saved!');
     }
}
