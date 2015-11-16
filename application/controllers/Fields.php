<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of fields
 *
 * @author miltone
 */
class Fields extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    function userinfo() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $fieldname = $_POST['field'];
            $pk = decode_id($_POST['pk']);
            $action = $_POST['action'];


            //Show edit form
            if (array_key_exists($fieldname, $this->user_field->user_fields)) {
                $is_valid_pk = $this->ion_auth_model->user($pk)->row();
                if ($is_valid_pk) {
                    if ($action == 'edit') {
                        $form = $this->user_field->{'edit_' . $fieldname}($pk);
                        $return['msg'] = $form;
                        $return['status_server'] = 1;
                    } else if ($action == 'cancel') {
                        $form = $this->user_field->{'view_' . $fieldname}($pk);
                        $return['msg'] = $form;
                        $return['status_server'] = 1;
                    } else if ($action == 'save') {
                        $posted_value = $_POST['value'];
                        $form = $this->user_field->{'insert_' . $fieldname}($pk, $posted_value);
                        if ($form == 1) {
                            $form = $this->user_field->{'view_' . $fieldname}($pk);
                            $return['msg'] = $form;
                            $return['status_server'] = 1;
                            $return['reflect'] = $posted_value;
                        } else {
                            $return['msg'] = $form;
                            $return['status_server'] = 0;
                        }
                    }
                } else {
                    $return['msg'] = show_alert('Bad request !!', 'warning');
                }
            } else {
                $return['msg'] = show_alert('Bad request !!', 'warning');
            }
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }


        echo json_encode($return);
    }

    function rmcontact() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $pk = decode_id($_POST['pk']);
            $delete = $this->db->delete('users_contacts', array('id' => $pk));
            if ($delete){
                $return['status_server'] = 1;
            } else {
                $return['msg'] = show_alert("Bad request", 'warning');
            }
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }


        echo json_encode($return);
    }

    function userinfocontact() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $fieldname = $_POST['field'];
            $userid = decode_id($_POST['userid']);
            $action = $_POST['action'];


            //Show edit form
            if (array_key_exists($fieldname, $this->user_field->contact_fields)) {
                $is_valid_user = $this->ion_auth_model->user($userid)->row();

                if ($is_valid_user) {
                    if ($action == 'edit') {
                        $form = $this->user_field->{'edit_' . $fieldname}($userid);
                        $return['msg'] = $form;
                        $return['status_server'] = 1;
                    } else if ($action == 'cancel') {
                        $form = $this->user_field->{'view_' . $fieldname}($userid);
                        $return['msg'] = $form;
                        $return['status_server'] = 1;
                    } else if ($action == 'save') {
                        $posted_value = $_POST['value'];
                        $form = $this->user_field->{'insert_' . $fieldname}($userid, $posted_value);
                        if ($form == 1) {
                            $form = $this->user_field->{'view_' . $fieldname}($userid);
                            $return['msg'] = $form;
                            $return['status_server'] = 1;
                            $return['reflect'] = $posted_value;
                        } else {
                            //$formedit = $this->user_field->{'edit_' . $fieldname}($userid);
                            // $return['msg'] = $formedit;
                            $return['status_server'] = 2;
                            $return['msg_error'] = $form;
                        }
                    }
                } else {
                    $return['msg'] = show_alert('Bad request !!', 'warning');
                }
            } else {
                $return['msg'] = show_alert('Bad request !!', 'warning');
            }
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }


        echo json_encode($return);
    }

}
