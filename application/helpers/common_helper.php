<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function count_jobpost_bycategory($cat_id) {
    $CI = &get_instance();
    $today = date('Y-m-d');
    $sql = "SELECT COUNT(jt.id) as counter FROM jobpost_target as jt INNER JOIN jobpost as jp ON jt.jobpost_id=jp.id WHERE jp.deadline > '$today' AND jp.status=1";

    $sql.=" AND $cat_id IN (jt.industry) ";
    $cout = $CI->db->query($sql)->row();
    if ($cout) {
        return $cout->counter;
    }

    return 0;
}

function view_share_count($reference, $type, $action) {
    $CI = &get_instance();
    $sql = "SELECT COUNT(user_id) as counter FROM view_share_count WHERE reference='$reference' AND type='$type' AND action='$action'";
    $cout = $CI->db->query($sql)->row();
    if ($cout) {
        return $cout->counter;
    }
    return 0;
}

function jobpost_applicant_count($jobpost_id) {
    $CI = &get_instance();
    $sql = "SELECT COUNT(id) as counter FROM jobpost_application  WHERE jobpost_id='$jobpost_id'";
    $cout = $CI->db->query($sql)->row();
    if ($cout) {
        return $cout->counter;
    }
    return 0;
}

function is_applied($user, $jobpost_id) {
    $CI = &get_instance();
    $CI->db->where(array('applicant' => $user, 'jobpost_id' => $jobpost_id));
    $check = $CI->db->get('jobpost_application')->row();
    if ($check) {
        return TRUE;
    }
    return false;
}

function word_extract($string, $limit = 10) {
    $tmp = explode(" ", $string);
    $return = '';
    foreach ($tmp as $key => $value) {
        if ($key < $limit) {
            $return.= $value . ' ';
        }
    }

    return $return;
}

function combine_byhash($array1, $array2) {
    $return = array();
    foreach ($array1 as $key => $value) {
        if (array_key_exists($key, $array2)) {
            $return[] = $value . '#' . $array2[$key];
        }
    }
    return $return;
}

function find_age($month, $year) {
    if ($year <> '') {
        $tmp_month = 'January';
        $tmp_day = '01';
        if ($month <> '') {
            $expl = explode(',', $month);
            if (array_key_exists(0, $expl) && strlen($expl[0]) > 3) {
                $tmp_month = $expl[0];
            }
            if (array_key_exists(1, $expl) && is_numeric($expl[1])) {
                $tmp_day = trim($expl[1]);
            }
        }

        $mm = date_parse($tmp_month);

        $from = date("Y-m-d", strtotime(trim($year) . "-" . $mm['month'] . "-" . $tmp_day));
        $to = date('Y-m-d');
        return date_difference($from, $to, '%y');
    }
    return '';
}

function is_data_exist($value, $table, $column) {
    $CI = &get_instance();
    $CI->db->where($column, $value);
    return $CI->db->get($table)->row();
}

function is_purchased_cv($purchaser, $cvno, $type = 'USER') {
    $CI = &get_instance();
    $CI->db->where('purchaser', $purchaser);
    $CI->db->where('cv_no', $cvno);
    $CI->db->where('type', $type);
    $get = $CI->db->get('purchased_cv')->row();
    if ($get) {
        return $get;
    }

    return false;
}

function get_user_contact($user_id, $contact_type = 'MOBILE', $core = FALSE, $covert_to_onedimension = false) {
    $CI = &get_instance();
    $CI->db->where('user_id', $user_id);
    $CI->db->where('contact_type', $contact_type);
    if ($core) {
        $CI->db->where('core', 1);
    }

    $data = $CI->db->get('users_contacts')->result();
    if ($covert_to_onedimension) {
        $return = array();
        foreach ($data as $key => $value) {
            $return[] = $value->contact;
        }
        return $return;
    }

    return $data;
}

function date_difference($from, $to, $date_format = '%y years %m months %d days') {
    $datetime1 = date_create($from);
    $datetime2 = date_create($to);

    $interval = date_diff($datetime1, $datetime2);

    return $interval->format($date_format);
}

function jobpost_remain_time($from, $to) {

    $datetime1 = date_create($from . ' ' . date("H:i:s"));
    $datetime2 = date_create($to . ' 23:59:59');

    $interval = date_diff($datetime1, $datetime2);
    $date_format = "%y ,%m ,%d, %h,%i";
    // $date_format = '%y years %m months %d days';
    $return = $interval->format($date_format);
    $tmp = explode(',', $return);
    $string = '';
    if ($interval->invert == 0) {
        if ($tmp[0] > 0) {
            $string.= $tmp[0] . ' yrs ';
        }
        if ($tmp[1] > 0) {
            $string.= $tmp[1] . ' months ';
        }

        if ($tmp[2] > 0) {
            $string.= $tmp[2] . ' days ';
        }

        if ($tmp[3] > 0) {
            $string.= $tmp[3] . ' hrs ';
        }

        if ($tmp[4] > 0) {
            $string.= $tmp[4] . ' min ';
        }

        if ($string <> '') {
            $string.=' &nbsp; Left';
        }
    } else {
        $string = '<b>CLOSED</b>';
    }
    return  $string;
}

/*
 *  formart array("from1:to1","from2:to2")
 */

function get_dayinterval($array) {
    $number_days = 0;
    foreach ($array as $key => $value) {
        $tmpvalue = explode(":", $value);
        $from = $tmpvalue[0];
        $to = $tmpvalue[1];

        $number_days += date_difference($from, $to, "%r%a");
    }

    return $number_days;
}

function arrange_date($year, $month, $day) {
    $valid = true;
    $from = '';

    if ($year <> '') {
        $from .= $year;
    } else {
        $valid = false;
    }

    if ($month <> '') {
        $from .= '-' . $month;
    } else {
        $from .= '-01';
    }
    if ($day <> '') {
        $from .= '-' . $day;
    } else {
        $from .= '-01';
    }

    if ($valid) {

        return date('Y-m-d', strtotime($from));
    }

    return FALSE;
}

function online_user($user_id) {
    $CI = &get_instance();
    if ($user_id > 0) {
        $lasttime = $CI->db->get_where('users_online', array('user_id' => $user_id))->row();
        if (!$lasttime) {
            $lasttime = $CI->db->query(" SELECT last_login as lasttime FROM users  where id='$user_id'")->row();
        }
        $time_difference = time() - $lasttime->lasttime;
        $seconds = $time_difference;
        $minutes = round($time_difference / 60);
        $hours = round($time_difference / 3600);
        $days = round($time_difference / 86400);
        $weeks = round($time_difference / 604800);
        $months = round($time_difference / 2419200);
        $years = round($time_difference / 29030400);

        if ($seconds <= 60) {
            return '<span style="color:green;">Online</span>';
        } else if ($minutes <= 60) {
            if ($minutes == 1) {
                return "one minute ago";
            } else {
                return "$minutes minutes ago";
            }
        } else if ($hours <= 24) {
            if ($hours == 1) {
                return "one hour ago";
            } else {
                return "$hours hours ago";
            }
        } else if ($days <= 7) {
            if ($days == 1) {
                return "one day ago";
            } else {
                return "$days days ago";
            }
        } else if ($weeks <= 4) {
            if ($weeks == 1) {
                return "one week ago";
            } else {
                return "$weeks weeks ago";
            }
        } else if ($months <= 12) {
            if ($months == 1) {
                return "one month ago";
            } else {
                return "$months months ago";
            }
        } else {
            if ($years == 1) {
                return "one year ago";
            } else {
                return "$years years ago";
            }
        }
    }

    return '';
}

function get_value($table, $id, $column = 'name') {
    $CI = &get_instance();
    $CI->db->where('id', $id);
    $row = $CI->db->get($table)->row();
    if ($row) {
        return $row->{$column};
    }

    return '';
}

function addhashtag($data) {
    if ($data <> '') {
        $return = '';
        if (!is_array($data)) {

            $return .= "##" . trim($data) . "##";
        } else {
            foreach ($data as $key => $value) {
                $return .= "##" . trim($value) . "##";
            }
        }
        return $return;
    }
    return '';
}

function removehashtag($str) {
    if ($str <> '') {
        $tmp = str_replace("####", ',', $str);
        $tmp2 = str_replace('##', '', $tmp);
        return $tmp2;
    }
    return '';
}

function convert_to_single_array($array) {
    if (!is_array($array)) {
        return FALSE;
    }
    $result = array();
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            $result = array_merge($result, convert_to_single_array($value));
        } else {
            $result[] = $value;
        }
    }
    return $result;
}

function monthlist($month = null) {
    $monthlist = array(
        '1' => 'January',
        '2' => 'February', '3' => 'March', '4' => 'April', '5' => 'May',
        '6' => 'June', '7' => 'July', '8' => 'August', '9' => 'September',
        '10' => 'October', '11' => 'November', '12' => 'December'
    );

    if (!is_null($month)) {
        return $monthlist[$month];
    }


    return $monthlist;
}

function gender() {
    $gender_list = array(
        'Male' => 'Male',
        'Female' => 'Female'
    );

    return $gender_list;
}

// alert_type: info,success,error,warning
function show_alert($text, $alert_type) {
    $alert = '<div class="alert-message ' . $alert_type . '">
    <div class="box-icon"></div>
    <p> ' . $text . '<a href="javascript:void(0)" class="close">X</a></p>
</div>';
    return $alert;
}

function img_allowed_list() {
    $CI = &get_instance();
    return array('jpg', 'jepg', 'png', 'gif', 'bmp');
}

function is_img_allowed($img_name) {
    $CI = &get_instance();
    $ext = getExtension($img_name);
    $allowed_img = img_allowed_list();
    if (!is_null($ext)) {
        if (in_array($ext, $allowed_img)) {
            return TRUE;
        }
        return FALSE;
    }
}

function current_user_fullregistered() {
    $current_user = current_user();
    if ($current_user->status == 1) {
        return TRUE;
    } else if ($current_user->status == 2) {
        redirect(site_url('accountverification'), 'refresh');
    }

    redirect(site_url('gettingstarted/?step=' . $current_user->reg_step), 'refresh');
}

function allow_verification_page() {
    $current_user = current_user();
    $CI = &get_instance();
    $userinfo_field = $CI->user_field->user_fields;
    $contact_field = $CI->user_field->contact_fields;

    $sql = "SELECT * FROM users WHERE id=$current_user->id";
    $uinfo = $CI->db->query($sql)->row();
    $check_user_input = '';
    foreach ($userinfo_field as $key => $value) {
        if ($uinfo->{$key} == '' && !in_array($key, array('othername'))) {
            $check_user_input .= $value . ' is required, ';
        }
    }

    $check_contact_input = '';
    foreach ($contact_field as $key => $value) {
        $checkx = $CI->user_field->contact_field_value($current_user->id, $key, true);
        if ($key != 'postal') {
            if ($checkx) {
                if ($checkx[0]->contact == '') {
                    $check_contact_input .= $value . ' is required, ';
                }
            } else {
                $check_contact_input .= $value . ' is required, ';
            }
        }
    }
    if ($check_user_input <> '') {
        $check_user_input = rtrim($check_user_input, ', ');
        return array('step' => 1, 'msg' => $check_user_input);
    } else if ($check_contact_input <> '') {
        $check_contact_input = rtrim($check_contact_input, ', ');
        return array('step' => 2, 'msg' => $check_contact_input);
    } else {
        return 1;
    }
}

function current_full_url() {
    return current_url() . ($_SERVER['QUERY_STRING'] ? '/?' . $_SERVER['QUERY_STRING'] : '');
}

if (!function_exists('current_user')) {

    function current_user($id = null) {
        $CI = &get_instance();

        $id || $id = $CI->session->userdata('bizhuru_user_id');

        $user = $CI->db->get_where('users', array('id' => $id))->row();
        if ($user) {
            return $user;
        }
        $callback = redirect('login/?callback=' . current_full_url(), 'refresh');
        return FALSE;
    }

}
if (!function_exists('is_user_loggedin_ajax')) {

    function is_user_loggedin_ajax($id = null) {
        $CI = &get_instance();

        $id || $id = $CI->session->userdata('bizhuru_user_id');

        $user = $CI->db->get_where('users', array('id' => $id))->row();
        if ($user) {
            return $user;
        }
        return FALSE;
    }

}

function get_callback() {
    if (isset($_GET['callback'])) {
        return $_GET['callback'];
    }

    return FALSE;
}

function is_callback_set() {
    if (isset($_GET['callback'])) {
        return '?callback=' . $_GET['callback'];
    }

    return FALSE;
}

function getExtension($str) {

    $i = strrpos($str, ".");
    if (!$i) {
        return null;
    }

    $l = strlen($str) - $i;
    $ext = substr($str, $i + 1, $l);
    return strtolower($ext);
}

function uploadFile($file_array, $inaput, $path) {
    $current_user = current_user();
    $filename = time() . "_" . $current_user->id . '.' . getExtension($file_array[$input]['name']);
    $path = $path . basename($filename);
    if (move_uploaded_file($file_array[$input]['tmp_name'], $path)) {
        chmod($path, FILE_READ_MODE);
        return $filename;
    } else {
        return FALSE;
    }
}

if (!function_exists('encode_id')) {

    function encode_id($id) {
        $string = "ABCDEFGHIJKLMNOPQRSTUVXWZ";
        $rand = str_split($string);
        $left = array_rand($rand, 2);
        $right = array_rand($rand, 2);

        $build_query = implode('', $left) . '_' . $id . '_' . implode('', $right);
        $strt_arry = str_split($build_query);
        $arry = array();
        foreach ($strt_arry as $kx => $vx) {
            $re = unpack('C*', $vx);
            if (strlen($re[1]) === 3) {
                $arry[] = $re[1];
            } else {
                $arry[] = '0' . $re[1];
            }
        }

        return $parameter = implode('', $arry);
    }

}


if (!function_exists('decode_id')) {

    function decode_id($string) {
        $str = join(array_map('chr', str_split($string, 3)));
        $exp = explode('_', $str);
        if (count($exp) == 3) {
            return $exp[1];
        } else {
            return NULL;
        }
    }

}


if (!function_exists('tags_data')) {

    function tags_data($table, $key_column, $text_column, $where = null) {
        $CI = &get_instance();
        if (!is_null($where)) {
            $CI->db->where($where);
        }

        $data = $CI->db->get($table)->result();
        $return = array();
        foreach ($data as $key => $value) {

            $return[] = array("id" => $value->{$key_column}, "text" => $value->{$text_column});
        }
        return $return;
    }

}
if (!function_exists('autosuggest_data')) {

    function autosuggest_data($table, $key_column, $text_column, $where = null) {
        $CI = &get_instance();
        if (!is_null($where)) {
            $CI->db->where($where);
        }

        $data = $CI->db->get($table)->result();
        $return = array();
        foreach ($data as $key => $value) {

            $return[] = array("value" => $value->{$key_column}, "data" => $value->{$text_column});
        }
        return $return;
    }

}

function timeline_postedtime($postedtime) {
    $time_difference = time() - $postedtime;
    $seconds = $time_difference;
    $minutes = round($time_difference / 60);
    $hours = round($time_difference / 3600);
    $days = round($time_difference / 86400);
    $weeks = round($time_difference / 604800);
    $months = round($time_difference / 2419200);
    $years = round($time_difference / 29030400);

    if ($seconds <= 60) {
        return "$seconds seconds ago";
    } else if ($minutes <= 60) {
        if ($minutes == 1) {
            return "one minute ago";
        } else {
            return "$minutes minutes ago";
        }
    } else if ($hours <= 24) {
        if ($hours == 1) {
            return "one hour ago";
        } else {
            return "$hours hours ago";
        }
    } else if ($days <= 7) {
        if ($days == 1) {
            return "one day ago";
        } else {
            return "$days days ago";
        }
    } else if ($weeks <= 4) {
        if ($weeks == 1) {
            return "one week ago";
        } else {
            return "$weeks weeks ago";
        }
    } else if ($months <= 12) {
        if ($months == 1) {
            return "one month ago";
        } else {
            return "$months months ago";
        }
    } else {
        if ($years == 1) {
            return "one year ago";
        } else {
            return "$years years ago";
        }
    }


    return '';
}

function get_userby_username($username) {
    $CI = &get_instance();
    $CI->db->where('username', $username);
    return $CI->db->get('users')->row();
}
