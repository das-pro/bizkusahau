<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Wall_model
 *
 * @author miltone
 */
class Wall_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function updatepost($data, $post_id = null) {
        if (is_null($post_id)) {
            //insert
            $this->db->insert('users_posts', $data);
           $post_id =  $this->db->insert_id();
           //update user post count by increment by one
            $userid = $data['postedby'];
            $this->db->where('id',$userid);
            $this->db->set('post_count',"post_count+1",FALSE);
            $this->db->update('users');
            return $post_id;
        } else {
            //edit
            $this->db->update('users_posts', array('id' => $post_id));
            return $post_id;
        }
    }

    function get_post($post_id) {
        $this->db->where('id', $post_id);
        return $this->db->get('users_posts')->row();
    }

    function get_postbywall($wall_id, $per_page = 10, $last_postid = 0) {

        $sql = "SELECT * FROM users_posts WHERE wall_id='$wall_id'  ORDER BY postedtime DESC LIMIT $last_postid,$per_page";

        return $this->db->query($sql)->result();
    }

    function updatepostIMG($post_id, $img_ids = array()) {
        if (!is_array($img_ids)) {
            return FALSE;
        }
        foreach ($img_ids as $key => $value) {
            $this->db->update('users_wall_img', array('post_id' => $post_id), array('id' => $value));
        }
        return TRUE;
    }

    function get_postimg($post_id) {
        $this->db->where('post_id', $post_id);
        return $this->db->get("users_wall_img")->result();
    }

    function get_wallimg($img_id) {
        $this->db->where('id', $img_id);
        return $this->db->get("users_wall_img")->result();
    }

    function get_img_comment($imgid) {
        $this->db->where('imgid', $imgid);
        //  $this->db->order_by("");
        return $this->db->get("users_wall_img_comment")->result();
    }

    function get_post_vote($post_id, $up = 1) {
        $this->db->where('post_id', $post_id);
        if ($up == 1) {
            $this->db->where('vote_up', 1);
        } else {
            $this->db->where('vote_down', 1);
        }
        $query = $this->db->get('users_post_like');

        return $query->num_rows();
    }
    

    function is_user_vote_post($post_id, $user_id, $up = 1) {
        $this->db->where('post_id', $post_id);
        $this->db->where('user_id', $user_id);
        if ($up == 1) {
            $this->db->where('vote_up', 1);
        } else {
            $this->db->where('vote_down', 1);
        }
        $query = $this->db->get('users_post_like');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    
    function get_comment_vote($commentid, $up = 1) {
        $this->db->where('comment_id', $commentid);
        if ($up == 1) {
            $this->db->where('vote_up', 1);
        } else {
            $this->db->where('vote_down', 1);
        }
        $query = $this->db->get('users_comment_like');

        return $query->num_rows();
    }

     function is_user_vote_comment($commentid, $user_id, $up = 1) {
        $this->db->where('comment_id', $commentid);
        $this->db->where('user_id', $user_id);
        if ($up == 1) {
            $this->db->where('vote_up', 1);
        } else {
            $this->db->where('vote_down', 1);
        }
        $query = $this->db->get('users_comment_like');

        if ($query->num_rows() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    function get_user_comment_vote($commentid,$user_id){
        $this->db->where('comment_id', $commentid);
        $this->db->where('user_id', $user_id);
        return $this->db->get('users_comment_like')->row();

    }
            
    function update_commentvote($data,$id=null){
        if(!is_null($id)){
            return $this->db->update('users_comment_like',$data,array('id'=>$id));   
        }else{
            return $this->db->insert('users_comment_like',$data);  
        }
        

    }
            
    
    
    function comment_update($array, $commid) {
        if ($commid > 0) {
            // update
            $this->db->update('users_post_comments', $array, array('id' => $commid));
            return $commid;
        } else {
            //insert
            $this->db->insert('users_post_comments', $array);
            
            $commid = $this->db->insert_id();
            
            //update user post count by increment by one
            $userid = $array['user_id'];
            $this->db->where('id',$userid);
            $this->db->set('comment_count',"comment_count+1",FALSE);
            $this->db->update('users');
            
            
            if($array['pcomment'] == ''){
            //update post commment count by increment by one
            $post_id = $array['post_id'];
            $this->db->where('id',$post_id);
            $this->db->set('comment_count',"comment_count+1",FALSE);
            $this->db->update('users_posts');
            }
            return $commid;
        }
    }

    function get_comment($comment_id) {
        $this->db->where('id', $comment_id);
        return $this->db->get('users_post_comments')->row();
    }

    function get_commentbypost($post_id,  $last_comment = 0,$per_page = 4) {

         $sql = "SELECT * FROM users_post_comments WHERE post_id='$post_id' ".($last_comment > 0 ? " AND id < $last_comment":'')." ORDER BY postedtime DESC LIMIT $per_page";

        return $this->db->query($sql)->result();
    }

    function count_comment($post_id, $start_form = 0, $pcomment = 0) {
        $sql = "SELECT count(id) as count_comment FROM users_post_comments WHERE  pcomment='$pcomment' AND post_id = '$post_id' ".($start_form > 0 ? " AND  id < $start_form":'')."  ORDER BY postedtime DESC";

         $result = $this->db->query($sql)->row();
        if ($result) {
            return $result->count_comment;
        }
        return 0;
    }

}
