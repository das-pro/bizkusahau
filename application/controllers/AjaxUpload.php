<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AjaxUpload
 *
 * @author miltone
 */
class AjaxUpload extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    function ajax_is_session_active() {
        $current_user = is_user_loggedin_ajax();
        if ($current_user) {
            $update_onlineuser = array(
                        'ip_used' => $this->input->ip_address(),
                        'user_id' => $current_user->id,
                        'lasttime' => time());
                    $this->ion_auth_model->update_onlineusers($update_onlineuser, $current_user->id);
                   
            echo '1';
        } else {
            echo '0';
        }
    }

    function is_value_unique($str, $field) {
        $expl = explode('=', $field);
        list($table, $field) = explode('.', $expl[0]);
        $query = $this->db->limit(1)->get_where($table, array($field => $str));
        if ($query->num_rows() == 1) {
            $row = $query->row();
            $user_id = $expl[1];
            if ($user_id === $row->id) {
                return TRUE;
            } else {
                return FALSE;
            }
        } else if ($query->num_rows() > 1) {
            return FALSE;
        } else {

            return $query->num_rows() === 0;
        }

        return false;
    }

    function ajax_verifychangeemail() {

        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $email = (isset($_POST['email']) ? strtolower($_POST['email']) : '');
            if ($this->user_field->validate_email($email)) {
                if ($this->is_value_unique($email, "users.email=" . $current_user->id)) {
                    // now change 
                    $this->ion_auth_model->update($current_user->id, array('email' => $email));
                    $return['msg'] = show_alert("Email changed successfully !!", 'success');
                    $return['email'] = $email;
                    $return['status_server'] = 1;
                } else {
                    $return['msg'] = show_alert("Email " . $email . " already exist in our database", 'error');
                }
            } else {
                $return['msg'] = show_alert("Invalid email format !", 'error');
            }
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }

        echo json_encode($return);
    }

    function ajax_resendemailverification() {
        $current_user = is_user_loggedin_ajax();

        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $this->ion_auth_model->update($current_user->id, array('confirm_code' => sha1(md5(rand(100, 1000)))));
            $current_user = is_user_loggedin_ajax();
            $this->data['current_user'] = $current_user;
            $message = $this->load->view('emailtmpl/account_verification', $this->data, TRUE);
            $send = $this->emailnotify->send_email('Account Verification - BizHuru', $message, array($current_user->email));
            if ($send) {
                $return['msg'] = show_alert("Email sent successfully !!", 'success');
                $this->ion_auth_model->update($current_user->id, array('email_sent' => 1));
            } else {
                $return['msg'] = show_alert("Network problem, try again", 'info');
            }
            $return['status_server'] = 1;
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }

        echo json_encode($return);
    }

    function ajax_uploadProfilePic() {

        $current_user = is_user_loggedin_ajax();
        $return = array('statusr' => 0, 'msg' => '');
        if ($current_user) {
            if (isset($_FILES)) {
                if (is_img_allowed($_FILES['userphoto']['name'])) {
                    if ($_FILES['userphoto']['size'] <= (1024 * 1024 * MAX_FILE_UPLOAD)) {
                        // now upload image
                        $filename = uploadFile($_FILES, 'userphoto', UPLOAD_PROFILE_IMG);

                        if ($filename) {

                            // update in db now
                            $this->ion_auth_model->update($current_user->id, array('profile_photo' => $filename));
                            $return['path'] = PROFILE_IMG_PATH . $filename;
                            $return['statusr'] = 1;
                            $return['msg'] = show_alert("Your profile picture updated successfully !!", 'success');
                        } else {
                            $return['msg'] = show_alert("Network issue, Please try again", 'info');
                        }
                    } else {
                        $return['msg'] = show_alert('Maximum image size allowed is ' . MAX_FILE_UPLOAD . ' MB', 'warning');
                    }
                } else {
                    $return['msg'] = show_alert('Invalid Image extension, Only ' . implode(',', img_allowed_list()) . ' is allowed', 'warning');
                }
            } else {
                $return['msg'] = show_alert('Bad request!', 'warning');
            }
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }

        echo json_encode($return);
    }

    function ajax_uploadCoverPhoto() {

        $current_user = is_user_loggedin_ajax();
        $return = array('statusr' => 0, 'msg' => '');
        if ($current_user) {
            if (isset($_FILES)) {
                if (is_img_allowed($_FILES['bgphotoimg']['name'])) {
                    if ($_FILES['bgphotoimg']['size'] <= (1024 * 1024 * MAX_FILE_UPLOAD)) {
                        // now upload image
                        $filename = uploadFile($_FILES, 'bgphotoimg', UPLOAD_PROFILE_IMG);

                        if ($filename) {

                            // update in db now
                            $this->ion_auth_model->update($current_user->id, array('profile_background' => $filename));
                            $return['path'] = PROFILE_IMG_PATH . $filename;
                            $return['statusr'] = 1;
                            $return['msg'] = show_alert("Your Cover Photo updated successfully !!", 'success');
                        } else {
                            $return['msg'] = show_alert("Network issue, Please try again", 'info');
                        }
                    } else {
                        $return['msg'] = show_alert('Maximum image size allowed is ' . MAX_FILE_UPLOAD . ' MB', 'warning');
                    }
                } else {
                    $return['msg'] = show_alert('Invalid Image extension, Only ' . implode(',', img_allowed_list()) . ' is allowed', 'warning');
                }
            } else {
                $return['msg'] = show_alert('Bad request!', 'warning');
            }
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }

        echo json_encode($return);
    }

    function ajax_saveCoverPhotoPosition() {
        $current_user = is_user_loggedin_ajax();
        $return = array('statusr' => 0, 'msg' => '');
        if ($current_user) {
            $xposition = $_POST['positionX'];
            $yposition = $_POST['positionY'];
            $pos = $xposition . ':' . $yposition;
            $this->ion_auth_model->update($current_user->id, array('profile_background_position' => $pos));
            $return['positionX'] = $xposition;
            $return['positionY'] = $yposition;
            $return['statusr'] = 1;
            $return['msg'] = show_alert("Your Cover Photo Position updated successfully !!", 'success');
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }

        echo json_encode($return);
    }

    function ajax_educationform() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $edu_cat = $_POST['educat'];
            $pk = $_POST['pk'];
            $user_id = $_POST['userid'];
            $return['status_server'] = 1;
            $return['msg'] = $this->education->edit($pk, $edu_cat, $user_id);
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }
        echo json_encode($return);
    }

    function ajax_saveeducationinfo() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $edu_cat = $_POST['educat'];
            $pk = $_POST['pk'];
            $action = $_POST['action'];
            $user_id = $_POST['userid'];
            if ($action == 'cancel') {
                if ($pk == '') {
                    $return['status_server'] = 2;
                } else {
                    $return['msg'] = $this->education->view($user_id, $edu_cat, $pk);
                    $return['status_server'] = 1;
                }
            } else if ($action == 'save') {
                $post = $this->education->educationform_posted($_POST);
                if (!is_array($post)) {
                    if ($pk == '') {
                        $return['status_server'] = 1;
                        $return['newnode'] = 1;
                        $return['msg'] = $this->education->view($user_id, $edu_cat, $post);
                    } else {
                        $return['msg'] = $this->education->view($user_id, $edu_cat, $pk);
                        $return['status_server'] = 1;
                        $return['newnode'] = 0;
                    }
                } else {
                    $return['status_server'] = 3;
                    $return['errorinfo'] = json_encode($post);
                }
            }
            // $return['status_server'] = 1;
            //$return['msg'] = $this->education->edit($pk, $edu_cat);
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }
        echo json_encode($return);
    }

    function ajax_workform() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $pk = $_POST['pk'];
            $user_id = $_POST['userid'];
            $return['status_server'] = 1;
            $return['msg'] = $this->work->edit($user_id, $pk);
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }
        echo json_encode($return);
    }

    function ajax_saveworkinfo() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $pk = $_POST['pk'];
            $action = $_POST['action'];
            $user_id = $_POST['userid'];
            if ($action == 'cancel') {
                if ($pk == '') {
                    $return['status_server'] = 2;
                } else {
                    $return['msg'] = $this->work->view($user_id, $pk);
                    $return['status_server'] = 1;
                }
            } else if ($action == 'save') {
                $post = $this->work->workform_posted($_POST);
                if (!is_array($post)) {
                    if ($pk == '') {
                        $return['status_server'] = 1;
                        $return['newnode'] = 1;
                        $return['msg'] = $this->work->view($user_id, $post);
                    } else {
                        $return['msg'] = $this->work->view($user_id, $pk);
                        $return['status_server'] = 1;
                        $return['newnode'] = 0;
                    }
                } else {
                    $return['status_server'] = 3;
                    $return['errorinfo'] = json_encode($post);
                }
            }
            // $return['status_server'] = 1;
            //$return['msg'] = $this->education->edit($pk, $edu_cat);
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }
        echo json_encode($return);
    }

    function ajax_is_online() {
        $userid = $_POST['userid'];
        $type = $_GET['type'];
        $gap = 3; // gap is 1 minutes
        $json = array('server_status' => 0, 'msg' => '');
        switch ($type) {
            case "long":
                if ($userid > 0) {
                     $json['server_status'] = 1;
                    $json['msg'] = online_user($userid);
                }
                echo json_encode($json);
                break;

            default:
                echo json_encode($json);
                break;
        }
    }

    function ajax_postimg_upload() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {

            if (isset($_FILES)) {
                if (is_img_allowed($_FILES['imgphotoupload']['name'])) {
                    if ($_FILES['imgphotoupload']['size'] <= (1024 * 1024 * MAX_FILE_UPLOAD)) {
                        // now upload image
                        $filename = uploadFile($_FILES, 'imgphotoupload', UPLOAD_WALL_IMG);

                        if ($filename) {

                            // update in db now
                            $returnid = $this->common_model->insert_wall_img($current_user->id, $filename);
                            $return['path'] = WALL_IMG_PATH . $filename;
                            $return['img_id'] = $returnid;
                            $return['status_server'] = 1;
                            //$return['msg'] = show_alert("Your profile picture updated successfully !!", 'success');
                        } else {
                            $return['msg'] = "Network issue, Please try again";
                        }
                    } else {
                        $return['msg'] = 'Maximum image size allowed is ' . MAX_FILE_UPLOAD . ' MB';
                    }
                } else {
                    $return['msg'] = 'Invalid Image extension, Only ' . implode(',', img_allowed_list()) . ' is allowed';
                }
            } else {
                $return['msg'] = 'Bad request!';
            }
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }
        echo json_encode($return);
    }

    function ajax_remove_timelinephoto() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $imgid = $_POST['imgid'];
            if ($imgid > 0) {
                $this->db->delete('users_wall_img', array('id' => $imgid));
                
             $return['status_server'] = 1;
            }else{
             $return['msg'] = "Bad Request";   
            }
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }
        echo json_encode($return);
    }
    
    
    //
    
    function ajax_awardform() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $pk = $_POST['pk'];
            $user_id = $_POST['userid'];
            $return['status_server'] = 1;
            $return['msg'] = $this->award->edit($user_id, $pk);
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }
        echo json_encode($return);
    }  
    
    function ajax_saveawardinfo() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $pk = $_POST['pk'];
            $action = $_POST['action'];
            $user_id = $_POST['userid'];
            if ($action == 'cancel') {
                if ($pk == '') {
                    $return['status_server'] = 2;
                } else {
                    $return['msg'] = $this->award->view($user_id, $pk);
                    $return['status_server'] = 1;
                }
            } else if ($action == 'save') {
                $post = $this->award->awardform_posted($_POST);
                if (!is_array($post)) {
                    if ($pk == '') {
                        $return['status_server'] = 1;
                        $return['newnode'] = 1;
                        $return['msg'] = $this->award->view($user_id, $post);
                    } else {
                        $return['msg'] = $this->award->view($user_id, $pk);
                        $return['status_server'] = 1;
                        $return['newnode'] = 0;
                    }
                } else {
                    $return['status_server'] = 3;
                    $return['errorinfo'] = json_encode($post);
                }
            }
            // $return['status_server'] = 1;
            //$return['msg'] = $this->education->edit($pk, $edu_cat);
        } else {
            $return['msg'] = show_alert("Session expired !, Please login again", 'info');
        }
        echo json_encode($return);
    }

    
    
    

}
