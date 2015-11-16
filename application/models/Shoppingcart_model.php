<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ShoppingCart_model
 *
 * @author miltone
 */
class Shoppingcart_Model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function purchase_cv($item, $trans_id,$user_id) {
        $array = array(
            'purchaser' => $user_id,
            'createdby' => $user_id,
            'trans_id' => $trans_id,
            'cv_no' => $item['name'],
            'type' => $item['type'],
        );
        $this->db->trans_start();

        $this->db->where('user_id', $user_id);
        if ($item['type'] == 'USER') {
            $this->db->set("cvs", 'cvs-1', FALSE);
        } else if ($item['type'] == 'PAGE') {
            $this->db->set("profile", 'profile-1', FALSE);
        }

        $update = $this->db->update('users_account_balance');
        $this->db->insert('purchased_cv', $array);


        $this->db->trans_complete();


        if ($this->db->trans_status()) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function advertise_jobpost($item, $trans_id,$user_id) {
      
        $array = array(
            'purchaser' => $user_id,
            'createdby' => $user_id,
            'trans_id' => $trans_id,
            'cv_no' => $item['name'],
            'type' => $item['type'],
        );
        $this->db->trans_start();

        $this->db->where('user_id', $user_id);
        if ($item['type'] == 'USER') {
            $this->db->set("cvs", 'cvs-1', FALSE);
        } else if ($item['type'] == 'PAGE') {
            $this->db->set("profile", 'profile-1', FALSE);
        
        } else if ($item['type'] == 'JOBPOST') {
            $this->db->set("jobpost", 'jobpost-1', FALSE);
        }

       $update = $this->db->update('users_account_balance');
        $this->db->insert('purchased_cv', $array);


        $this->db->trans_complete();


        if ($this->db->trans_status()) {
            if($item['type'] == 'JOBPOST'){
                $this->db->update('jobpost',array('status'=>1,'publishedon'=>date('Y-m-d H:i:s')),array('id'=>$item['name']));
            }
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
