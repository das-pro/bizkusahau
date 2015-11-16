<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Payment
 *
 * @author miltone
 */
class Payment extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        if (!current_user_fullregistered()) {
            
        }
    }

    function credit_package() {
        $current_user = current_user();
        if (isset($_GET['function'])) {
            $this->data['function'] = $_GET['function'];
             $this->data['hide_cart_checkout'] = 1;
        }
        
        
         $this->data['left_content'] = 'left_column/menu';

        $this->data['section_middle_content'] = 'middle_column/payment/credit_package';
        $this->data['middle_content'] = 'middle_content';
       
        $this->data['credit_package'] = $this->common_model->credit_package()->result();
        $this->load->view('template', $this->data);
        
        
        
        
    }

}
