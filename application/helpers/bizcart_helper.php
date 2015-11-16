<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function count_number_occurence($table,$count_column,$where=array()){
    $CI = &get_instance();
    $where2 = '';
    if($where){
     $where2 = " WHERE 1 AND ".implode(' AND ', $where) ; 
    }
    $sql = "SELECT count($count_column) as number FROM $table ".$where2;
    $get = $CI->db->query($sql)->row();
    if($get){
        return $get->number;
    }
    
    return 0;
}

function is_cvno_exist_in_cart($cv_no) {
    $CI = &get_instance();
    $cart_data = $CI->cart->contents();
    foreach ($cart_data as $item) {
        if ($item['id'] == 'sku_' . $cv_no) {
            return TRUE;
            break;
        }
    }

    return FALSE;
}
function is_jobpost_exist_in_cart($jobpost_id) {
    $CI = &get_instance();
    $cart_data = $CI->cart->contents();
    foreach ($cart_data as $item) {
        if ($item['id'] == 'job_' . $jobpost_id) {
            return TRUE;
            break;
        }
    }

    return FALSE;
}

function account_balance($user_id) {
    $CI = &get_instance();
    $CI->db->where('user_id', $user_id);
    $get = $CI->db->get('users_account_balance')->row();
    if ($get) {
        return $get;
    } else {
        $std = new stdClass();
        $std->user_id = $user_id;
        $std->cvs = 0;
        $std->jobpost = 0;
        $std->ads = 0;
        $std->profile = 0;
        return $std;
    }
}

function cart_purchase_summary() {
    $CI = &get_instance();
    $std = new stdClass();
    $std->cvs = 0;
    $std->profile = 0;
    $std->ads = 0;
    $std->jobpost = 0;

    foreach ($CI->cart->contents() as $item) {
        if ($item['type'] == 'USER') {
            $std->cvs +=1;
        } else if ($item['type'] == 'PAGE') {
            $std->profile +=1;
        } else if ($item['type'] == 'JOBPOST') {
            $std->jobpost +=1;
        } else if ($item['type'] == 'ADS') {
            $std->ads +=1;
        }
    }


    return $std;
}

function get_cart_categorize_title($key) {
    $array = array(
        'cvs' => 'CVs',
        'profile' => 'Profiles',
        'ads' => 'Ads',
        'jobpost' => 'Job Posts',
    );

    return array_key_exists($key, $array) ? $array[$key] : 'Other Category';
}

function cart_categorize() {
    $CI = &get_instance();
    $array = array(
        'cvs' => array(),
        'profile' => array(),
        'ads' => array(),
        'jobpost' => array()
    );
        
    foreach ($CI->cart->contents() as $item) {
        if ($item['type'] == 'USER') {
            $array['cvs'][] = $item;
        } else if ($item['type'] == 'PAGE') {
            $array['profile'][] = $item;
        } else if ($item['type'] == 'JOBPOST') {
            $array['jobpost'][] = $item;
        } else if ($item['type'] == 'ADS') {
            $array['ads'][] = $item;
        }
    }

    return $array;
}

function get_cart_info_display($id, $type) {
    $CI = &get_instance();
    switch ($type) {
        case "USER":
            $user_info = current_user($id);
            $return['img'] = PROFILE_IMG_PATH . $user_info->profile_photo;
            $info = '<div class="checkout-small-content"><span class="checkout-small-label">Name : </span>' . $user_info->firstname . ' ' . $user_info->lastname . '</div>';
            $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Gender : </span>' . $user_info->gender . '</div>';
            $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Nationality : </span>' . ($user_info->nationality <> '' ? $user_info->nationality : '...........') . '</div>';
            $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Age : </span>' . ($user_info->dob_y <> '' ? find_age($user_info->dob_md, $user_info->dob_y) : '..............') . '</div>';
            $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Languages : </span>' . $user_info->language . '</div>';

            $overview = get_user_workexperience($id);

            if (count($overview['TITLE']) > 0) {
                $title = '';
                foreach ($overview['TITLE'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Titles : </span>' . $title . '</div>';
            }



            if (count($overview['LEVEL']) > 0) {
                $title = '';
                foreach ($overview['LEVEL'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }
                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Level : </span>' . $title . '</div>';
            }



            if (count($overview['DEPARTMENT']) > 0) {
                $title = '';
                foreach ($overview['DEPARTMENT'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Departments : </span>' . $title . '</div>';
            }



            if (count($overview['CURRENT']) > 0) {

                $title = '';
                foreach ($overview['CURRENT'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Current : </span>' . $title . '</div>';
            }


            if (count($overview['PREVIOUS']) > 0) {

                $title = '';
                foreach ($overview['PREVIOUS'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Previous : </span>' . $title . '</div>';
            }





            if (count($overview['EXPERIENCE']) > 0) {
                $title = '';
                foreach ($overview['EXPERIENCE'] as $key => $value) {
                    $title .= ($value <> '' ? number_format(($value / 365), 1) . ' years' : '') . ', ';
                }

                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Total Experience : </span>' . $title . '</div>';
            }


            if (count($overview['EDUCATION']) > 0) {
                $title = '';
                foreach ($overview['EDUCATION'] as $key => $value) {
                    $title .= $value['name'] . ($value['experience'] <> '' ? '(' . number_format(($value['experience'] / 365), 1) . ')' : '') . ', ';
                }

                $title = rtrim($title, ', ');
                $info .= '<div class="checkout-small-content"><span class="checkout-small-label">Educational Awards : </span>' . $title . '</div>';
            }




            $return['info'] = $info;
            return $return;
            break;
            
        case "JOBPOST":
            $jobpostinfo = $CI->jobpost_model->get_jobpost($id)->row();
            $user_info = current_user($jobpostinfo->createdby);
            $return['img'] = PROFILE_IMG_PATH . $user_info->profile_photo;
            $dx['jobpostinfo'] = $jobpostinfo;
            $dx['check_out_page'] = 1;
            $return['info'] = $CI->load->view('middle_column/jobpost/jobpost_preview',$dx,TRUE);
            return $return;
            break;

        default:
            break;
    }
}


function get_recent_title($type){
    $arry=array(
        'USER'=>'Recent Purchased CVs',
        'PAGE'=>'Recent Purchased Profiles',
        'JOBPOST'=>'Recent Advertised Job Posts',
        'ADS'=>'Recent Advertised Ads',
    );
    
    return array_key_exists($type, $arry) ? $arry[$type]:" Recent Purchased Other";
}
