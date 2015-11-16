<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Award
 *
 * @author miltone
 */
class Award {
    //put your code here
    
    //put your code here
    public $award_field = array(
        'name' => 'Awards',
        'description' => 'Awards Description',
        'category_won' => 'Category Won',
        'won_description'=>'Award Won Description',
        'position' => 'Position',
        'duration' => 'In',
        'certificate' => 'Certificate',
        'award_issuedby' => 'Awards issued by'
    );
    private $inputvalues;

    //put your code here
    function __construct() {
        
    }

    /**
     * __get
     *
     * Enables the use of CI super-global without having to define an extra variable.
     *
     * I can't remember where I first saw this, so thank you if you are the original author. -Militis
     *
     * @access	public
     * @param	$var
     * @return	mixed
     */
    public function __get($var) {
        return get_instance()->$var;
    }
    
    function view($user_id, $pk = '') {
        $work_data = $this->common_model->award_data($user_id, $pk);
        $display = '';
        foreach ($work_data as $key => $value) {
           $position = $value->position <> '' ? '('.$value->position.')':'';
            $display .= '<div  id="award-' . $user_id . '-' . $value->id . '-wrapper" class="work_listdiv">
             <div class="workform_logo"></div>
             <div class="workform_data">
             <div class="work_item_header">
              <div class="work_companytitle">
              <span class="text-black-color companytitle_wk">' . $value->award . '</span>
              '.$value->description.'</div>
              <div class="work_editlink" style="display:none;"><a  href="javascript:void(0);" pk="' . $value->id . '" userid="' . $user_id . '"  class="text-brown awardinfo-edit glyphicon glyphicon-pencil">Edit</a></div>
              <div class="clearboth"></div>
              </div>
              <div class="work_item_content">
              <div class="award-row"><span class="award-lebel">Category :</span> <span class="award-content"><span class="awardcategory">'.$value->category_won.$position.'</span>'.$value->won_description.'</span> <div class="clearboth"></div></div>
              <div class="award-row"><span class="award-lebel">Certificate:</span> <span class="award-content">'.($value->certificate <> ''? '<a href="javascript:void(0);" class="viewcertificate text-brown" path="'.CERTIFICATES_IMG_PATH.$value->certificate.'" >Click here to view certificate copy</a>':'Not attached').'</span>  <div class="clearboth"></div> </div>
              <div class="award-row"><span class="award-lebel">Issue by :</span> <span class="award-content">'.$value->award_issuedby.'</span>  <div class="clearboth"></div> </div>';
           
            $display.='</div>

                </div>
             <div class="clearboth"></div>
                  </div>';

            $display.='<div  id="award-wrapper-' . $user_id . '-' . $value->id . '"></div>';
        }

        return $display;
    }
            
     function edit($user_id, $pk = '') {
       if ($pk <> '') {
           $inputValuesTMP = $this->common_model->award_data($user_id, $pk);
           $this->inputvalues = $inputValuesTMP;
       }
        $display = '<div class="educationinfoform" id="formxp-' . $user_id . '-' . $pk . '">';

        foreach ($this->award_field as $key => $value) {
            $display.= $this->{'edit_' . $key}($pk, $value, $user_id);
        }

        $display.='<div class="save_footer">
            <button pk="' . $pk . '"  userid="' . $user_id . '" action="save" class="awardinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . $pk . '"  userid="' . $user_id . '"  action="cancel" class="awardinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="awardinfo-loadersave-' . $user_id . '-' . $pk . '"></span>
            </div> </div>';

        return $display;
    }
    
    
    function edit_name($pk, $label, $user_id){
         $value = is_array($this->inputvalues) ? $this->inputvalues[0]->award : '';
       $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="name-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="name-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;  
    }
    
    function edit_description($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->description : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:100px; line-height:18px;" class="inputbizhuru allowfullscreen" id="description-' . $user_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                <a href="javascript:void(0);" targettitle="' . $label . '" target="description-' . $user_id . '-' . $pk . '-inputvalue" class="open_bootbox glyphicon glyphicon-fullscreen"></a>
                    <div class="clearboth"></div>
              <div id="description-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }
    
     function edit_category_won($pk, $label, $user_id) {
         $value =  is_array($this->inputvalues) ? $this->inputvalues[0]->category_won : '';
       $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="category_won-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="category_won-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }
    
      function edit_won_description($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->won_description : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:100px; line-height:18px;" class="inputbizhuru allowfullscreen" id="won_description-' . $user_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                <a href="javascript:void(0);" targettitle="' . $label . '" target="won_description-' . $user_id . '-' . $pk . '-inputvalue" class="open_bootbox glyphicon glyphicon-fullscreen"></a>
                    <div class="clearboth"></div>
              <div id="description-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }
    
    
    
     function edit_position($pk, $label, $user_id){
         $value = $value =  is_array($this->inputvalues) ? $this->inputvalues[0]->position : '';
       $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input placeholder="Add won position e.g 1st, 2nd etc" type="text" value="' . $value . '"  class="inputbizhuru" id="position-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="position-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;  
    }
    
    
    function edit_duration($pk, $label, $user_id) {
        $value = '';// is_array($this->inputvalues) ? $this->inputvalues[0]->work_status : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit">

<div class="durationdiv"  id="durationfromdiv-' . $user_id . 'X' . $pk . '">
            <a class="text-brown" id="Yfromlink"  href="javascript:void(0);"> +Add Year </a>
            <select id="fromy" style="display:none;" class="inputbizhuruauto" next-load="fromm" onchange="durationchain(this)">
            <option value="">Year</option>';
        for ($x = date('Y'); $x > 1940; $x--) {
            $xx = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_fromy : '';
            $display .= '<option ' . ($x == $xx ? 'selected="selected"' : '') . ' value="' . $x . '">' . $x . '</option>';
        }
        $display .= ' </select>
            <select id="fromm" style="display:none;" next-load="fromd" class="inputbizhuruauto" onchange="durationchain(this)">
            <option value="">Month</option>';
        foreach (monthlist() as $ky => $vx) {
            $xx = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_fromm : '';
            $display .= '<option ' . ($ky == $xx ? 'selected="selected"' : '') . ' value="' . $ky . '">' . $vx . '</option>';
        }
        $display .= '</select>
            <select id="fromd" style="display:none;" class="inputbizhuruauto">
            <option value="">Day</option>';
        for ($x = 1; $x < 32; $x++) {
            $xx = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_fromd : '';
            $display .= '<option ' . ($x == $xx ? 'selected="selected"' : '') . ' value="' . $x . '">' . $x . '</option>';
        }
        $display .= ' </select>
</div> 
              <div id="duration-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        return $display;
    }
    
    function edit_certificate($pk, $label, $user_id) {
        $value = '';// is_array($this->inputvalues) ? $this->inputvalues[0]->reference : '';


        if ($value <> '') {
            $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:80px; line-height:18px;" class="inputbizhuru" id="reference-' . $user_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                 <a href="javascript:void(0);" targettitle="' . $label . '" target="reference-' . $user_id . '-' . $pk . '-inputvalue" class="open_bootbox  glyphicon glyphicon-zoom-out"></a>
              <div id="certificate-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        } else {
            $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><div><a class="text-brown certificate_upload" href="javascript:void(0);" id="certificate-' . $user_id . '-' . $pk . '-inputvalue"  >+Upload your copy of certificate won</a></div>
            
              <div id="certificate-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        }

        return $display;
        
    }
            
    
            
      function edit_award_issuedby($pk, $label, $user_id) {
        $value =  is_array($this->inputvalues) ? $this->inputvalues[0]->award_issuedby : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="award_issuedby-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="award_issuedby-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $company = autosuggest_data('pages_suggestion', 'name', 'id');
        $json = json_encode($company);

        $display.='<script type="text/javascript"> 
                text_autosugest({target:"award_issuedby-' . $user_id . '-' . $pk . '-inputvalue",data:' . $json . '});';

        $display.=' </script>';
        return $display;
    }
    
    function awardform_posted($posted){
       
        $error = 0;
        $return = array();
        if ($posted['name'] == '') {
            $return[] = array('field' => 'name', 'error' => '*is required');
            $error++;
        }
        
        if ($posted['category_won'] == '') {
            $return[] = array('field' => 'category_won', 'error' => '*is required');
            $error++;
        }
        if ($posted['position'] == '') {
            $return[] = array('field' => 'position', 'error' => '*is required');
            $error++;
        }
        if ($posted['description'] == '') {
            $return[] = array('field' => 'description', 'error' => '*is required');
            $error++;
        }
        if ($posted['won_description'] == '') {
            $return[] = array('field' => 'won_description', 'error' => '*is required');
            $error++;
        }
        
        if ($posted['award_issuedby'] == '') {
           $return[] = array('field' => 'award_issuedby', 'error' => '*is required');
           $error++;
        }
       
       
        if ($error == 0) {

            
            $data = array(
                'user_id' => $posted['userid'],
                'award' => $posted['name'],
                'duration_fromy' => $posted['duration_fromy'],
                'duration_fromm' => $posted['duration_fromm'],
                'duration_fromd' => $posted['duration_fromd'],
                'description' => $posted['description'],
                'won_description' => $posted['won_description'],
                'position' => $posted['position'],
                'award_issuedby' => $posted['award_issuedby'],
                'category_won' => $posted['category_won']
               
            );

            //create suggested page first in pages_autosuggest
            $page_id = $this->common_model->autosuggest_check('pages_suggestion', array('name' => $posted['award_issuedby'], 'form' => 'AWARD', 'form_category' => 2));
            $awardpage_id = $this->common_model->autosuggest_check('pages_suggestion', array('name' => $posted['name'], 'form' => 'AWARD', 'form_category' => 1));

            
            // now insert data in users_education
            $data['name_pages'] = $awardpage_id;
            $data['award_issuedby_pageid'] = $page_id;

           

            return $this->common_model->update_award($data,$posted['pk']);
        } else {
            return $return;
        }
    }

}
