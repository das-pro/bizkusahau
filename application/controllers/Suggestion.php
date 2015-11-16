<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Suggestion
 *
 * @author miltone
 */
class Suggestion extends CI_Controller {
    //put your code here
    
    function __construct() {
       parent::__construct();
    
       
    }
    
    function pages(){
        
        $return = array('1'=>'Miltone');
        echo json_encode($return);
    } 
    
    
    
}
