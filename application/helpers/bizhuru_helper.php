<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_payment_setting($userid){
    $CI = &get_instance();
    $CI->db->where('user_id',$userid);
    $row = $CI->db->get('payment_settings')->row();
    if($row){
        return $row;
    }else{
        $std = new stdClass();
        $std->user_id = $userid;
        $std->currency = 'USD';
        return $std;
    }
}

function get_user_workexperience($userid, $main_category = null, $sub_category = null, $level = null, $work_status = 'ALL') {
    $CI = &get_instance();

    $CI->db->where("user_id", $userid);
     if(!is_null($main_category)){
       $CI->db->where("professional_category", $main_category);  
    }
    if(!is_null($sub_category)){
       $CI->db->where("professional_category_sub", $sub_category);  
    }
    if($work_status != 'ALL'){
      $CI->db->where("work_status", $work_status);     
    }
    if(!is_null($level)){
       $CI->db->where("level", $level);  
    }
    $data = $CI->db->get('users_work')->result();

    $return = array(
        'TITLE' => array(),
        'LEVEL' => array(),
        'DEPARTMENT' => array(),
        'CURRENT' => array(),
        'PREVIOUS' => array(),
        'INDUSTRIES' => array(),
        'EXPERIENCE' => array(),
        'EDUCATION' => array(),
//        'AWARDS' => array()
    );

    foreach ($data as $key => $value) {
        //deal with title
        if ($value->position <> '') {
            $title = get_value('position', $value->position);
            if (array_key_exists($value->position, $return['TITLE'])) {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['TITLE'][$value->position]['experience'] += $dys;
            } else {
                $return['TITLE'][$value->position]['name'] = $title;
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['TITLE'][$value->position]['experience'] = $dys;
            }
        }


        //OVERVIEW IN LEVEL


        if ($value->level <> '') {
            $level = get_value('work_level', $value->level);
            if (array_key_exists($value->level, $return['LEVEL'])) {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['LEVEL'][$value->level]['experience'] += $dys;
            } else {
                $return['LEVEL'][$value->level]['name'] = $level;
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['LEVEL'][$value->level]['experience'] = $dys;
            }
        }



        //OVERVIEW IN DEPARTMENT
        if ($value->professional_category <> '') {
            $level = get_value('professional_category', $value->level);
            if (array_key_exists($value->professional_category, $return['DEPARTMENT'])) {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['DEPARTMENT'][$value->professional_category]['experience'] += $dys;
            } else {
                $return['DEPARTMENT'][$value->professional_category]['name'] = $level;
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['DEPARTMENT'][$value->professional_category]['experience'] = $dys;
            }
        }

        //OVERVIEW IN CURRENT
        if ($value->work_status == 'CURRENT') {
            
                $return['CURRENT'][$value->id]['name'] = $value->name;
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                $to = date('Y-m-d');
                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['CURRENT'][$value->id]['experience'] = $dys;
            
        }
        /***************************/
        
         //OVERVIEW IN PREVIOUS
        if ($value->work_status  == 'PAST') {
            if (array_key_exists($value->id, $return['PREVIOUS'])) {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['PREVIOUS'][$value->id]['experience'] += $dys;
            } else {
                $return['PREVIOUS'][$value->id]['name'] = $value->name;
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['PREVIOUS'][$value->id]['experience'] = $dys;
            }
        }
        
        
        
        //OVERVIEW IN EXPERIENCE
        if ($value->duration_fromy <> '') {
            if (array_key_exists('experience', $return['EXPERIENCE'])) {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['EXPERIENCE']['experience'] += $dys;
            } else {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['EXPERIENCE']['experience'] = $dys;
            }
        }
    }
        
       

    
        
        //END OF WORK INFORMATION LOOP
        
         
        //eEDUCATION AWARDS
        
        
    $CI->db->where("user_id", $userid);
    $data = $CI->db->get('users_education')->result();
                
   
    
     foreach ($data as $key => $value) {
        //deal with title
            if (array_key_exists($value->id, $return['EDUCATION'])) {
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                 $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
               

                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['EDUCATION'][$value->id]['experience'] += $dys;
            } else {
                $return['EDUCATION'][$value->id]['name'] = $value->program;
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                 $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                
                $dys = '';
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return['EDUCATION'][$value->id]['experience'] = $dys;
            }
        

        
     }
    
    

    return $return;
}





function get_total_experience($userid,$main_category=null,$sub_category=null,$level=null){
 $CI = &get_instance();

    $CI->db->where("user_id", $userid);
    if(!is_null($main_category)){
       $CI->db->where("professional_category", $main_category);  
    }
    if(!is_null($sub_category)){
       $CI->db->where("professional_category_sub", $sub_category);  
    }
    if(!is_null($level)){
       $CI->db->where("level", $level);  
    }
    $data = $CI->db->get('users_work')->result();  
    $return=0;
     foreach ($data as $key => $value) {
         
          if ($value->duration_fromy <> '') {
           
                $from = arrange_date($value->duration_fromy, $value->duration_fromm, $value->duration_fromd);
                if ($value->work_status == 'CURRENT') {
                    $to = date('Y-m-d');
                } else {
                    $to = arrange_date($value->duration_toy, $value->duration_tom, $value->duration_tod);
                }

                $dys = 0;
                if ($from && $to) {
                    $dys = get_dayinterval(array($from . ':' . $to));
                }
                $return += $dys;
            
        }
         
     }
     
     return number_format(($return/365),1);
    
}






function get_social_hashtag($text) {
    //Match the hashtags
    preg_match_all('/(^|[^a-z0-9_])#([a-z0-9_]+)/i', $text, $matchedHashtags);
    $hashtag = '';
    // For each hashtag, strip all characters but alpha numeric
    if (!empty($matchedHashtags[0])) {
        foreach ($matchedHashtags[0] as $match) {
            $hashtag .= preg_replace("/[^a-z0-9]+/i", "", $match) . ',';
        }
    }
    //to remove last comma in a string
    return rtrim($hashtag, ',');
}

//usage
//$text = "w3lessons.info - #php programming blog, #facebook wall script";
//echo gethashtags($text); //output - php,facebook

