<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Cv
 *
 * @author miltone
 */
class Cv extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        $this->data['left_content'] = 'left_column/menu';
    }

    function create_cv() {


        if (isset($_POST) && isset($_POST['section'])) {
            $current_user = is_user_loggedin_ajax();
            $return = array('status_server' => 0, 'msg' => '');
            if ($current_user) {
                if (isset($_GET['tabinfo'])) {

                    if ($_GET['tabinfo'] == 'education') {
                        $load_content = $this->load->view("cv/education", null, TRUE);
                    } else if ($_GET['tabinfo'] == 'award') {
                        $load_content = $this->load->view("cv/award", null, TRUE);
                    } else if ($_GET['tabinfo'] == 'work') {
                        $load_content = $this->load->view("cv/work", null, TRUE);
                    } else if ($_GET['tabinfo'] == 'viewfullcv') {
                        $load_content = $this->load->view("cv/viewfullcv", null, TRUE);
                    } else {
                        $load_content = $this->load->view("cv/basic_info", null, TRUE);
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
            if (!current_user_fullregistered()) {
                
            }
            $current_user = current_user();
            $this->data['left_data'] = array('left_active_link' => 'create_cv');
            $this->data['middle_data'] = array('SHOW_COVER_PHOTO' => 1);
            $this->data['section_middle_content'] = 'cv/create_cv';
            $this->data['middle_content'] = 'middle_content';
            $this->load->view('template', $this->data);
        }
    }

    function view_cv() {
        current_user_fullregistered();
        $current_user = current_user();
        //$this->data['left_data'] = array('left_active_link' => 'create_cv');
        //$this->data['middle_data'] = array('SHOW_COVER_PHOTO' => 1);
        $middle_data = array('userinfo_user_id' => $current_user->id, 'is_current_mycv' => 0, 'showfullcv' => 0);
        if (isset($_GET['cvid'])) {
            $userinfo_user_id = decode_id($_GET['cvid']);
            if (is_data_exist($userinfo_user_id, 'users', 'id')) {
                if ($current_user != $userinfo_user_id) {
                    //is cv already purched
                    //if (is_purchased_cv($current_user->id, $userinfo_user_id)) {
                    //  $this->data['showfullcv'] = 1;
                    // }
                    $this->data['showfullcv'] = 1;
                }
            } else {
                return show_error("TEST", 404, "NOT FOUNT");
            }
        } else {
            $middle_data['is_current_mycv'] = 1;
            $middle_data['showfullcv'] = 1;
        }

        $this->data['middle_data'] = $middle_data;
        $this->data['section_middle_content'] = 'cv/viewfullcv';
        $this->data['middle_content'] = 'middle_content';
        $this->load->view('template', $this->data);
    }

    function preview_cv() {
        $current_user = is_user_loggedin_ajax();
        if ($current_user) {

            if (isset($_GET['cvid'])) {
                $userinfo_user_id = decode_id($_GET['cvid']);

                if (is_data_exist($userinfo_user_id, 'users', 'id')) {
                    if ($current_user->id == $userinfo_user_id) {
                        $this->data['showfullcv'] = 1;
                    } else if (is_purchased_cv($current_user->id, $userinfo_user_id)) {
                        $this->data['showfullcv'] = 1;
                    } else {
                        $this->data['showfullcv'] = 0;
                    }
                    $this->data['cvid'] = $userinfo_user_id;
                    $this->data['userinfo_user_id'] = $userinfo_user_id;
                    $this->load->view('cv/preview_cv', $this->data);
                } else {
                    echo '<div style="height: 100px; line-height: 100px; text-align: center;">  Security issues, Your request does not match our security.. Please Refresh page or Logout and try again</div>';
                }
            } else {
                echo '<div style="height: 100px; line-height: 100px; text-align: center;">  Security issues, Your request does not match our security.. Please Refresh page or Logout and try again</div>';
            }
        } else {
            echo '<div style="height: 100px; line-height: 100px; text-align: center;">  Session expired !, Please login again..</div>';
        }
    }

    function filter_cv() {
        current_user_fullregistered();
        $current_user = current_user();

        //$this->data['middle_data'] = $middle_data;
        $this->data['section_middle_content'] = 'middle_column/cv_filter/cv_filterpanel';
        $this->data['middle_content'] = 'middle_content';
        $this->load->view('template', $this->data);
    }

    function ajax_filter_cv() {
        //sleep(2);
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {

            $filtertype = $_POST['filtertype'];
            $main_cat = $_POST['main_cat'];
            $sub_cat = $_POST['sub_cat'];
            $level = $_POST['level'];
            $gender = $_POST['gender'];
            $education = $_POST['education'];
            $nationality = $_POST['nationality'];
            $levelx = $_POST['levelx'];
            $lastidload = $_POST['lastidload'];
            $is_scroll = $_POST['is_scroll'];
            if ($is_scroll == 'RESET') {
                $lastidload = 0;
            }
            $lastidloadx = ($lastidload == 0 ? 0 : ($lastidload * NO_CV_PER_PAGE));
            if ($main_cat == '' && $sub_cat == '' && $level == '' && $gender == '' && $education == '' && $nationality == '' && $levelx == '') {

                $sql = "SELECT * FROM users where status=1 AND deleted=0 AND  account_type='$filtertype'  ORDER BY search_priority DESC,id ASC  LIMIT  $lastidloadx, " . NO_CV_PER_PAGE;
            } else {

                $sql = "SELECT u.* FROM users as u ";

                $join_worker = '';
                $join_education = '';
                $where = '';

                if ($gender <> '') {
                    $where .=" AND u.gender='$gender'";
                }

                if ($nationality <> '') {
                    $exlo = explode(',', $nationality);
                    $tmp_nationality = '';
                    foreach ($exlo as $key => $value) {
                        $tmp_nationality .= "'" . $value . "',";
                    }

                    $nationality = rtrim($tmp_nationality, ',');
                    $where .=" AND u.nationality  IN  ($nationality)";
                }


                if ($level <> '' || $levelx <> '') {
                    $join_worker = "   INNER  JOIN users_work as w ON u.id=w.user_id";
                    if ($level <> '') {
                        $where .="  AND w.level='$level'";
                    } else if ($levelx <> '') {
                        $where .="  AND w.level IN ($levelx)";
                    }
                }

                if ($main_cat <> '') {
                    $join_worker = "   INNER  JOIN users_work as w ON u.id=w.user_id";
                    $where .= " AND w.professional_category = '$main_cat'";
                    $return['main_cat'] = get_value('professional_category', $main_cat, 'name');
                }

                if ($sub_cat <> '') {
                    $join_worker = "   INNER  JOIN users_work as w ON u.id=w.user_id";
                    $where .= " AND w.professional_category_sub IN ($sub_cat)";
                }

                if ($education <> '') {
                    $join_education = "  INNER JOIN  users_education as e ON u.id=e.user_id ";
                    $where .=" AND e.awardtype IN ($education)";
                }

                $sql.= $join_worker . $join_education . " WHERE u.status=1 AND u.deleted=0 " . $where . "  GROUP BY u.id ORDER BY u.search_priority DESC,u.id ASC LIMIT $lastidloadx," . NO_CV_PER_PAGE;
            }

//            $return['msg'] = $sql;
//            echo json_encode($return);
//            exit;

            $data = $this->db->query($sql)->result();
            $view = '';
            $i = 1;
            //$lastidloadx = $lastidload;



            if (count($data) > 0) {
                $lastidloadx+=1;

                foreach ($data as $key => $value) {
                    //$lastidloadx = $value->id;
                    $view .='<div class="' . (($i == 1) ? 'column1_cvbox' : (($i == 2) ? 'column2_cvbox' : (($i == 3) ? 'column3_cvbox' : ''))) . '">
<div class="cvbox_content">                   
<div class="cvbox_content-body">
<div class="cvbox_img"><a href="' . site_url('timeline/' . $value->username) . '"><img src="' . PROFILE_IMG_PATH . $value->profile_photo . '"/></a>
    CV No.<span style="color:#FFA500;">' . $value->id . '</span></div>
<div class="cvbox_dataview">
<a class="cvbox_user_names" href="' . site_url('timeline/' . $value->username) . '">' . $value->firstname . ' ' . $value->othername . ' ' . $value->lastname . ' </a>  
    <div class="cvbox_itemvalue">Nationality: <span>' . ($value->nationality <> '' ? $value->nationality : '.............') . '</span></div>
    <div class="cvbox_itemvalue">Age: <span>' . ($value->dob_y <> '' ? find_age($value->dob_md, $value->dob_y) : '......') . '</span></div>';
                    if ($main_cat <> '' || $sub_cat <> '') {
                        if ($main_cat <> '' && $sub_cat == '') {
                            $view .='<div class="cvbox_itemvalue">Field: <span>' . get_value('professional_category', $main_cat, 'name') . '</span></div>';
                            $view .='<div class="cvbox_itemvalue">Field Experience: <span>' . get_total_experience($value->id, $main_cat) . '</span></div>';
                        } else if ($main_cat == '' && $sub_cat <> '') {

                            $subexplode = $this->db->query("SELECT DISTINCT professional_category,professional_category_sub FROM users_work WHERE  user_id='$value->id' AND professional_category_sub IN ($sub_cat) ")->result();
                            $field_datax = array();
                            $field_dataxmain = array();

                            foreach ($subexplode as $m => $n) {
                                $field_dataxmain[$n->professional_category] = $n->professional_category;
                                $field_datax[$n->professional_category][$n->professional_category_sub] = $n->professional_category_sub;
                            }


                            $list_field = '';
                            $field_experience = 0;
                            foreach ($field_dataxmain as $xx => $vm) {
                                $list_field .= get_value('professional_category', $vm, 'name');
                                $field_experience+=get_total_experience($value->id, $vm);
                                $list_fieldsub = '';
                                foreach ($field_datax[$vm] as $xx_sub => $vm_sub) {
                                    $list_fieldsub .= get_value('professional_category', $vm_sub, 'name') . ',';
                                }
                                $list_fieldsub = rtrim($list_fieldsub, ',');
                                $list_field .= '(' . $list_fieldsub . '), ';
                            }
                            $list_field = rtrim($list_field, ', ');
                            $view .='<div class="cvbox_itemvalue">Field: <span>' . $list_field . '</span></div>';
                            $view .='<div class="cvbox_itemvalue">Field Experience: <span>' . $field_experience . '</span></div>';
                        } else if ($main_cat <> '' && $sub_cat <> '') {
                            $view .='<div class="cvbox_itemvalue">Field: <span>' . get_value('professional_category', $main_cat, 'name');
                            $subexplode = $this->db->query("SELECT DISTINCT professional_category_sub FROM users_work WHERE professional_category='$main_cat' AND user_id='$value->id'")->result();
                            $sublist = '';
                            foreach ($subexplode as $kx => $vx) {
                                $sublist.=get_value('professional_category', $vx->professional_category_sub, 'name') . ', ';
                            }
                            if ($sublist <> '') {
                                $view.= "( " . rtrim($sublist, ', ') . " )";
                            }
                            $view.='</span></div>';
                            $view .='<div class="cvbox_itemvalue">Field Experience: <span>' . get_total_experience($value->id, $main_cat) . '</span></div>';
                        }
                    }
                    $view .='<div class="cvbox_itemvalue">Total Experience: <span>' . get_total_experience($value->id) . '</span></div>
</div>
 <div class="clearboth"></div>
</div>
                   <div class="cvbox_footer">
                   <div class="cvbox_footer_preview">
                   <a  data-toggle="modal" data-remote="' . site_url('preview_cv/?cvid=' . encode_id($value->id)) . '" href="' . site_url('preview_cv/?cvid=' . encode_id($value->id)) . '"  data-target="#myModal" class="preview_userCV">Preview
</a>&nbsp; . &nbsp;<a href="' . site_url('timeline/' . $value->username) . '" class="text-brown">Page</a>
                   </div>
                   <div class="cvbox_footer_pin">
                   <a href="#">PIN</a>
                   <a href="#">dropdown</a>
                   </div>
                   <div class="clearboth"></div>
                   
                   </div>
                   </div>
                       </div>';
                    $i++;
                    if ($i > 3) {
                        $i = 1;
                    }
                }

                $return['lastidload'] = ($lastidload + 1);
                $view.='<div class="clearboth page_separator"><span class="paginationno"><span>End of page ' . ($lastidload + 1) . '</span></span></div>';


                $return['status_server'] = 1;
            } else {
                if ($is_scroll == 'YES') {
                    if ($lastidload > 0) {
                        $view = show_alert('No more record found....', 'info');
                    } else {
                        $view = '';
                    }
                    $return['status_server'] = 2;
                } else {
                    $return['status_server'] = 1;
                    $view = show_alert('No data found based on your search criteria', 'info');
                }
            }
            $return['msg'] = $view;
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

}
