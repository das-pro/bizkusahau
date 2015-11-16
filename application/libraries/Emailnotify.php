<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of emailnotify
 *
 * @author miltone
 */
class Emailnotify {
    //put your code here
    
     public function __get($var) {
        return get_instance()->$var;
    }
    
    
    function send_email($subject, $message, $recipient=array(), $bcc=array(), $attachment=null) {
    
        $this->load->library('email');
        $this->email->set_mailtype('html');
        $this->email->from(FROM_EMAIL,'BizHuru');
        $this->email->subject($subject);
        $this->email->to($recipient);
        
        if($bcc){
        $this->email->bcc($bcc);
        }
        
        if (!is_null($attachment)) {
            $this->email->attach($attachment);
        }
        
     
        $this->email->message($message);
        if ($this->email->send()) {
            
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
