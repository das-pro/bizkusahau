<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bizhuru
 *
 * @author miltone
 */
class Bizhuru extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
    }
    
  
    

    function index() {
        if (!$this->ion_auth->logged_in()) {
            $this->site_front();
        } else {
            if (current_user_fullregistered()) {
                $this->home();
            }
        }
    }

    function site_front() {
        $this->form_validation->set_error_delimiters('<div class="text-primary" style="display:inline-block;">', '</div>');
        $this->data['slider'] = $this->common_model->get_front_slide_img();
        $this->form_validation->set_rules('firstname', 'Firstname', 'required');
        $this->form_validation->set_rules('lastname', 'Lastname', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[5]');

        if ($this->form_validation->run() == true) {

            $password = $this->input->post('password');
            $email = $this->input->post('email');

            $firstname = $this->input->post('firstname');
            $lastname = $this->input->post('lastname');
            $gender = $this->input->post('gender');

            $username = strtolower($firstname) . '.' . strtolower($lastname);
            $additional_data = array(
                'firstname' => trim($this->input->post('firstname')),
                'lastname' => trim($this->input->post('lastname')),
                'confirm_code' => sha1(md5($email)),
                'gender' => $gender,
                'profile_photo' => $gender . '.png'
            );


            $register = $this->ion_auth->register($username, $password, $email, $additional_data);

            if ($register) {
                $contact = array(
                    'user_id' => $register,
                    'contact_type' => 'EMAIL',
                    'contact' => $email,
                    'core' => 1
                );
                $this->common_model->contact_add($contact);
                $login = $this->ion_auth_model->login($email, $password, 1);
                redirect(site_url('gettingstarted/?step=1'), 'refresh');
            }
        }

        $this->load->view('auth/template', $this->data);
    }

    function gettingstarted() {
        if (isset($_POST) && isset($_POST['section'])) {
            $current_user = is_user_loggedin_ajax();
            $return = array('status_server' => 0, 'msg' => '');
            if ($current_user) {
                if (isset($_GET['step'])) {

                    if ($_GET['step'] == 2) {
                        $load_content = $this->load->view("userinfo/user_contact", null, TRUE);
                    } else if ($_GET['step'] == 3) {
                        $load_content = $this->load->view("userinfo/upload_profile", null, TRUE);
                    } else {
                        $load_content = $this->load->view("userinfo/basic_info", null, TRUE);
                    }
                    $return['msg'] = $load_content;
                    $return['status_server'] = 1;
                }
            } else {
                $return['msg'] = show_alert("Session expired !, Please login again", 'info');
            }


            echo json_encode($return);
            exit;
        } else {
            $current_user = current_user();
            if($current_user->status != 0){
                redirect(site_url(),'refresh');
            }

            $this->data['middle_data'] = array('SHOW_COVER_PHOTO' => 1);

            $this->data['section_middle_content'] = 'auth/account_setup';
            $this->data['middle_content'] = 'middle_content';

            $this->load->view('template', $this->data);
        }
    }

    function accountverification() {
        $current_user = current_user();
        
        if ($current_user->status == 0) {
            $is_valid_request = allow_verification_page();

            if (!is_array($is_valid_request)) {
                $this->ion_auth_model->update($current_user->id, array('status' => 2));
                //send email for varification
                if (current_user()->email_sent == 0) {
                    $this->data2['current_user'] = $current_user;
                    $message = $this->load->view('emailtmpl/account_verification', $this->data2, TRUE);
                    $send = $this->emailnotify->send_email('Account Verification - BizHuru', $message, array($current_user->email));
                    $this->ion_auth_model->update($current_user->id, array('email_sent' => 1));
                }
            } else {
                $this->session->set_flashdata('notify', show_alert($is_valid_request['msg'], 'error'));
                redirect(site_url('gettingstarted/?step=' . $is_valid_request['step']), 'refresh');
            }
        }
           $current_user = current_user();
         if($current_user->status != 2){
                redirect(site_url(),'refresh');
            }
        
        $this->data['middle_data'] = array('SHOW_COVER_PHOTO' => 1);

        $this->data['section_middle_content'] = 'auth/accont_verification';
        $this->data['middle_content'] = 'middle_content';

        $this->load->view('template', $this->data);
    }

    function account_activation() {
        if (isset($_GET['id']) && isset($_GET['code']) && $_GET['code'] <> '' && $_GET['id'] <> '') {
            $user_id = decode_id($_GET['id']);
            $code = $_GET['code'];
            $this->db->where(array('id' => $user_id, 'confirm_code' => $code));
            $check = $this->db->get('users')->row();
            if ($check) {
                $this->ion_auth_model->update($user_id, array('status' => 1, 'confirm_code' => ''));
                $this->session->set_flashdata('notify', show_alert("Account verified successfully", 'success'));
                redirect(site_url(), 'refresh');
            }
        }

        return show_error("Sorry! Bad request, Please follow the right way to  verify your account or Login to resend verification email", '', 'Account Verification Failed');
    }

    function home() {
        if (!current_user_fullregistered()) {
            
        }

        $current_user = current_user();

        $this->data['middle_data'] = array('SHOW_COVER_PHOTO' => 1);
        $this->data['left_content'] = 'left_column/menu';
        $this->data['section_middle_content'] = 'timeline/timeline';
        $this->data['middle_content'] = 'middle_content';
        $this->data['advert_content'] = 'right_column/jobs_advert';

        $this->load->view('template', $this->data);
    }
    
    
    function timeline($username=null){
        $current_user = current_user();
       if (!current_user_fullregistered()) {
            
        }
        if(!is_null($username)){
        $selecteduser = get_userby_username($username);
        }else{
           $selecteduser = $current_user; 
        }

        if($selecteduser){
        

        $this->data['middle_data'] = array('SHOW_COVER_PHOTO' => 1);
        $this->data['left_content'] = 'left_column/menu';
        $this->data['section_middle_content'] = 'timeline/timeline';
        $this->data['middle_content'] = 'middle_content';
        $this->data['selected_user_id'] = $selecteduser->id;
        $this->load->view('template', $this->data); 
        }else{
        
        show_404();
        }
        
        
            //$this->load->view('errors/html/error_404');
        
    }
    
    
    
    
    
    
    

}
