<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wall
 *
 * @author miltone
 */
class Wall extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
    }

    function wall_sendpost() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $post_content = trim($_POST['content']);
            $wall_id = trim($_POST['wall_id']);
            $post_img = trim($_POST['post_img']);
            $post_id = $this->walllib->update_post($post_content, $post_img, $wall_id);
            if ($post_id) {
                $return['status_server'] = 1;
                $return['msg'] = $this->walllib->get_post($post_id);
            } else {
                $return['msg'] = "Network error, Please try again";
            }
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

    function ajax_imgpopup() {

        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $imgid = $_POST['imgid'];
            $return['status_server'] = 1;
            $return['msg'] = $this->walllib->get_imgpopup($imgid);
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

    function ajax_postcomment() {

        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $comment = $_POST['comment'];
            $postid = $_POST['postid'];
            $pcomment = $_POST['pcomment'];
            $commid = $_POST['commid'];

            $cm_id = $this->walllib->comment_update($commid, $postid, $comment, $pcomment, $current_user);

            $return['status_server'] = 1;
            $return['msg'] = $this->walllib->get_comment($cm_id);
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

    function ajax_morecomment() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $lastcommentid = $_POST['lastcommentid'];
            $postid = $_POST['postid'];
            $return['status_server'] = 1;
            $return['msg'] = $this->walllib->get_comments($postid, $lastcommentid);
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

    function ajax_commentvote() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $commid = $_POST['commid'];
            $action = $_POST['action'];
            $return['status_server'] = 1;
            $this->walllib->vote_comment($commid, $action, $current_user);

            $vote_up = $this->wall_model->get_comment_vote($commid);
            $vote_down = $this->wall_model->get_comment_vote($commid, 0);
            if ($vote_up > 0) {
              $user_vote = $this->wall_model->is_user_vote_comment($commid,$current_user->id);
              if($user_vote){
                $return['up'] = '<i class="bizhuru- bizhuru-orange-rate-up"></i><span>'.$vote_up.'</span>';     
              }else{
                $return['up'] = '<i class="bizhuru- bizhuru-orange-white-rate-up"></i><span>'.$vote_up.'</span>';   
              }
            } else {
                $return['up'] = '<i class="bizhuru- bizhuru-gray-rate-up"></i><span>0</span>';
            }

            if ($vote_down > 0) {
               $user_vote = $this->wall_model->is_user_vote_comment($commid,$current_user->id,0);
              if($user_vote){
                $return['down'] = '<i class="bizhuru- bizhuru-red-rate-down"></i><span>'.$vote_down.'</span>';     
              }else{
                $return['down'] = '<i class="bizhuru- bizhuru-red-white-rate-down"></i><span>'.$vote_down.'</span>';   
              }  
            } else {
                $return['down'] = '<i class="bizhuru- bizhuru-gray-rate-down"></i><span>0</span>';
            }
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

}
