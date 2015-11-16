<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mystore
 *
 * @author miltone
 */
class Mystore extends CI_Controller {

    //put your code here
    private $last_row = 0;

    function __construct() {
        parent::__construct();
    }

    function mystore() {


        $current_user = current_user();
        $this->data['left_content'] = 'left_column/menu';
        if (isset($_GET['tabinfo'])) {

            switch ($_GET['tabinfo']) {
                case "recent_purchased":
                    $transid = $_GET['transid'];
                    $this->data['mystore_content'] = $this->recent_purchased($transid, $current_user->id);
                    $this->data['last_row'] = $this->last_row;
                    break;

                default:
                    $this->data['mystore_content'] = $this->mystore_allcv();
                    break;
            }
        } else {
            $this->data['mystore_content'] = $this->mystore_allcv();
        }

        $this->data['section_middle_content'] = 'middle_column/mystore/mystore_content';
        $this->data['middle_content'] = 'middle_content';
        $this->load->view('template', $this->data);
    }

    function mystore_allcv() {
        return 'LIST';
    }

    function recent_purchased($transid, $purchaser) {
         $category = $this->db->query("SELECT DISTINCT(type) as type FROM purchased_cv WHERE trans_id='$transid' AND createdby='$purchaser' ORDER BY type ASC")->result();
         $view='';
        if (count($category) > 0) {
            foreach ($category as $key => $value) { 
                $view .= '<h5 style="padding-bottom:5px; margin-bottom:10px; border-bottom:1px solid #ccc;">'.  strtoupper(get_recent_title($value->type)).'</h5>';
                $purcahseddata = $this->db->query("SELECT * FROM purchased_cv WHERE trans_id='$transid' AND type='$value->type' AND createdby='$purchaser'")->result();
                foreach ($purcahseddata as $key1 => $value1) {
                  
                    $view.='ssss | ';
                    
                    
                    
                    
                    
                    
                    
                }
               
                }  
        } else {
            $view .= ' <div style="font-size:19px; padding:15px;"> No data found as recent purchased/advertised</div>';
        }
        
        /*
          //return 'RECENT'.$transid;
          $sql = "SELECT u.* FROM users as u INNER JOIN purchased_cv as p ON u.id=p.cv_no ";
          $where = " AND p.purchaser = '$purchaser' AND p.trans_id='$transid'";
          $sql.=" WHERE u.status=1 AND u.deleted=0 " . $where . "  GROUP BY u.id ORDER BY u.search_priority DESC,u.id ASC ";
          //$this->last_row = 1;

          $query = $this->db->query($sql)->result();
          $i = 1;
          $view = '<h5 style="padding-bottom:5px; margin-bottom:10px; border-bottom:1px solid #ccc;">Recent Purchased CVs && Profiles</h5>';
          foreach ($query as $key => $value) {
          $overview = get_user_workexperience($value->id);
          $view .='<div class="' . (($i == 1) ? 'column1_cvbox' : (($i == 2) ? 'column2_cvbox' : (($i == 3) ? 'column3_cvbox' : ''))) . '">
          <div class="cvbox_content">
          <div class="cvbox_content-body">
          <div class="cvbox_img"><a href="' . site_url('timeline/' . $value->username) . '"><img src="' . PROFILE_IMG_PATH . $value->profile_photo . '"/></a>
          CV No.<span style="color:#FFA500;">' . $value->id . '</span></div>
          <div class="cvbox_dataview">
          <a class="cvbox_user_names" href="' . site_url('timeline/' . $value->username) . '">' . $value->firstname . ' ' . $value->othername . ' ' . $value->lastname . ' </a>
          <div class="cvbox_itemvalue">Nationality: <span>' . ($value->nationality <> '' ? $value->nationality : '.............') . '</span></div>
          <div class="cvbox_itemvalue">Age: <span>' . ($value->dob_y <> '' ? find_age($value->dob_md, $value->dob_y) : '......') . '</span></div>';

          $title = '';
          if (count($overview['TITLE']) > 0) {

          foreach ($overview['TITLE'] as $overkey => $overvalu) {
          $title .= $overvalu['name'] . ($overvalu['experience'] <> '' ? '(' . number_format(($overvalu['experience'] / 365), 1) . ')' : '') . ', ';
          }

          $title = rtrim($title, ', ');
          $view .='<div class="cvbox_itemvalue" style="display:block;">Titles: <span>' . $title . '</span></div>';
          } else {
          $view .='<div class="cvbox_itemvalue" style="display:block;">Titles: <span>N/A</span></div>';
          }

          $title = '';
          if (count($overview['DEPARTMENT']) > 0) {

          foreach ($overview['DEPARTMENT'] as $overkey => $overvalu) {
          $title .= $overvalu['name'] . ($overvalu['experience'] <> '' ? '(' . number_format(($overvalu['experience'] / 365), 1) . ')' : '') . ', ';
          }

          $title = rtrim($title, ', ');
          $view .='<div class="cvbox_itemvalue" style="display:block;">Departments: <span>' . $title . '</span></div>';
          } else {
          $view .='<div class="cvbox_itemvalue" style="display:block;">Departments: <span>N/A</span></div>';
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


         * 
         */
        
        
          return $view;
    }

}
