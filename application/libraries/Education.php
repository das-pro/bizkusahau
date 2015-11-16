<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Work
 *
 * @author miltone
 */
class Education {

    public $education_field = array(
        'name' => 'Name',
        'graduated' => 'Graduated',
        'duration' => 'Duration',
        'program' => 'Programme/Course',
        'professional_category' => 'Department(Category)',
        'subject' => 'Key Subjets',
        'description' => 'Description',
        'skills' => 'Skills Acquired',
        'awardtype' => 'Award Type',
        'city' => 'City/Country',
        'reference' => 'Referee'
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

//    function placeholder($field_name, $replace = null) {
//        if (array_key_exists($field_name, $this->education_field_placeholder)) {
//            if (!is_null($replace)) {
//                return sprintf($this->education_field[$field_name], $replace);
//            }
//            return $this->education_field[$field_name];
//        }
//
//        return "";
//    }

    function view($user_id, $cat_id, $pk = '') {
        $education_data = $this->common_model->education_data($user_id, $cat_id, $pk);
        $display = '';
        foreach ($education_data as $key => $value) {

            if ($value->program <> '') {
                $programme = $value->program;
            } else {
                $programme = ' ';
            }

            $from = '';
            if ($value->duration_fromy <> '') {
                $from = $value->duration_fromy;
            }

            $to = '';
            if ($value->duration_toy <> '') {
                $to = $value->duration_toy;
            }

            $classof = '';
            if ($from <> '' && $to <> '') {
                $classof = $from . ' - ' . $to . '. ';
            } else if ($from <> '' && $to == '') {
                $classof = $from . '. ';
            } else if ($from == '' && $to <> '') {
                $classof = $to . '. ';
            }



            $display .= '<div  id="cat-' . $cat_id . '-' . $value->id . '-wrapper" class="work_listdiv">
             <div class="workform_logo"></div>
             <div class="workform_data">
             <div class="work_item_header">
              <div class="work_companytitle">
              <span class="text-black-color companytitle_wk">' . $value->name . '</span>
              '  . $programme . '<br/>
                ' . $classof . $value->city . '
                 </div>
             <div class="work_editlink" style="display:none;"> <a  href="javascript:void(0);" cat="' . $cat_id . '" userid="' . $user_id . '" pk="' . $value->id . '"  class="text-brown eduinfo-edit glyphicon glyphicon-pencil">Edit</a></div>
              <div class="clearboth"></div>
              </div>
              <div class="work_item_content">';

             $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Key Subjects:</span>  &nbsp;<span class="skilllistcv-contentsmall">';
               $display .=$this->common_model->get_subject_byhashtag($value->subject).'</span><div class="clearboth"></div></div>';
             
            $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Description:</span>  &nbsp;<span class="skilllistcv-contentsmall">';
              if($value->description <>''){
            $display .='<ul style="margin-bottom:0px;padding-bottom:0px;">';

            $explod_content = explode("\n", $value->description);
            foreach ($explod_content as $keyx => $valuex) {
                $display.='<li>' . $valuex . '</li>';
            }
            $display.= '</ul>';
              }
               $display .='</span><div class="clearboth"></div></div>';
             
                
            $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Skills Acquired:</span>  &nbsp;<span class="skilllistcv-contentsmall">';
            $skills_xlist = $this->common_model->get_user_skills($user_id, 'EDUCATION', $cat_id, null, $value->id);
            $skills_string = '';

            foreach ($skills_xlist as $keys => $valuexp) {
                $skills_string .= get_value('skills', $valuexp->skill_id) . ', ';
            }


            $display .=rtrim($skills_string, ', ');

            $display .='</span><div class="clearboth"></div></div>';
            $display.='</div>

                </div>
             <div class="clearboth"></div>
                  </div>';




            $display.='<div  id="edu-wrapper-' . $cat_id . '-' . $value->id . '"></div>';
        }

        return $display;
    }

    function edit($pk, $cat_id, $user_id) {
        if ($pk <> '') {
            $inputValuesTMP = $this->common_model->education_data($user_id, $cat_id, $pk);
            $this->inputvalues = $inputValuesTMP;
        }
        $display = '<div class="educationinfoform" id="formxp-' . $cat_id . '-' . $pk . '">';

        foreach ($this->education_field as $key => $value) {
            $display.= $this->{'edit_' . $key}($pk, $value, $cat_id);
        }

        $display.='<div id="largererror-' . $cat_id . '-' . $pk . '"></div><div class="save_footer">
            <button pk="' . $pk . '" cat="' . $cat_id . '"  userid="' . $user_id . '" action="save" class="educationinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . $pk . '" cat="' . $cat_id . '" userid="' . $user_id . '"  action="cancel" class="educationinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="educationinfo-loadersave-' . $cat_id . '-' . $pk . '"></span>
            </div> </div>';

        return $display;
    }

    function edit_name($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->name : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="name-' . $cat_id . $pk . '-inputvalue" />
              <div id="name-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $school_auto = autosuggest_data('pages_suggestion', 'name', 'id', array('form' => 'EDUCATION', 'form_category' => $cat_id));
        $json = json_encode($school_auto);

        $display.='<script type="text/javascript"> 
                text_autosugest({target:"name-' . $cat_id . $pk . '-inputvalue",data:' . $json . '});';

        $display.=' </script>';
        return $display;
    }

    function edit_graduated($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->graduated : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="checkbox" ' . ($value == 1 ? 'checked="checked"' : '') . ' value="1" style="width:auto !important; margin: 0px !important;"  class="inputbizhuru" id="graduated-' . $cat_id . '-' . $pk . '-inputvalue" />
              <div id="graduated-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        return $display;
    }

    function edit_duration($pk, $label, $cat_id) {
        $value = '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><div class="durationdiv"  id="durationfromdiv-' . $cat_id . 'X' . $pk . '">
            <a class="text-brown" id="Yfromlink"  href="javascript:void(0);"> +Add Year </a>
            <select id="fromy" style="display:none;" class="inputbizhuruauto" next-load="fromm" onchange="durationchain(this)">
            <option value="">Year</option>';
        for ($x = date('Y'); $x > 1940; $x--) {
            $xx = $value = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_fromy : '';
            $display .= '<option ' . ($x == $xx ? 'selected="selected"' : '') . ' value="' . $x . '">' . $x . '</option>';
        }
        $display .= ' </select>
            <select id="fromm" style="display:none;" next-load="fromd" class="inputbizhuruauto" onchange="durationchain(this)">
            <option value="">Month</option>';
        foreach (monthlist() as $ky => $vx) {
            $xx = $value = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_fromm : '';
            $display .= '<option ' . ($ky == $xx ? 'selected="selected"' : '') . ' value="' . $ky . '">' . $vx . '</option>';
        }
        $display .= '</select>
            <select id="fromd" style="display:none;" class="inputbizhuruauto">
            <option value="">Day</option>';
        for ($x = 1; $x < 32; $x++) {
            $xx = $value = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_fromd : '';
            $display .= '<option ' . ($x == $xx ? 'selected="selected"' : '') . ' value="' . $x . '">' . $x . '</option>';
        }
        $display .= ' </select>
</div> to  <div class="durationdiv" style="display:block;" id="durationtodiv-' . $cat_id . 'X' . $pk . '"><a class="text-brown" id="Ytolink" href="javascript:void(0);">+Add Year</a>
          
 <select id="toy" style="display:none;" class="inputbizhuruauto" next-load="tom" onchange="durationchain(this)">
            <option value="">Year</option>';
        for ($x = date('Y'); $x > 1940; $x--) {
            $xx = $value = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_toy : '';
            $display .= '<option ' . ($x == $xx ? 'selected="selected"' : '') . ' value="' . $x . '">' . $x . '</option>';
        }
        $display .= ' </select>
            <select id="tom" style="display:none;" next-load="tod" class="inputbizhuruauto" onchange="durationchain(this)">
            <option value="">Month</option>';
        foreach (monthlist() as $ky => $vx) {
            $xx = $value = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_tom : '';
            $display .= '<option ' . ($ky == $xx ? 'selected="selected"' : '') . ' value="' . $ky . '">' . $vx . '</option>';
        }
        $display .= '</select>
            <select id="tod" style="display:none;" class="inputbizhuruauto">
            <option value="">Day</option>';
        for ($x = 1; $x < 32; $x++) {
            $xx = $value = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_tod : '';
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

    function edit_program($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->program : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="programme-' . $cat_id . '-' . $pk . '-inputvalue" />
              <div id="program-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $programme_auto = autosuggest_data('programme', 'name', 'name', array('form' => 'EDUCATION', 'form_category' => $cat_id));
        $json = json_encode($programme_auto);

        $display.='<script type="text/javascript"> 
                text_autosugest({target:"programme-' . $cat_id . '-' . $pk . '-inputvalue",data:' . $json . '});';
        $display.=' </script>';
        return $display;
    }

    function edit_subject($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->subject : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit" style="line-height:20px !important;"><select   class="inputbizhuru" placeholder="Add Skills" id="subject-' . $cat_id . '-' . $pk . '-inputvalue" ></select>
              <div id="subject-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $subjectlist = tags_data('subjects', 'id', 'name', array('form' => 'EDUCATION', 'form_category' => $cat_id));
        $json = json_encode($subjectlist);
        $display.='<script type="text/javascript"> 
                var subjects = tags_select2({target:"subject-' . $cat_id . '-' . $pk . '-inputvalue",data:' . $json . '});';
        if ($value <> '') {
            $display.=' subjects.select2("val",' . json_encode(explode(',', removehashtag($value))) . ');';
        }
        $display.='</script>';
        return $display;
    }

    function edit_description($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->description : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:100px; line-height:18px;" class="inputbizhuru" id="description-' . $cat_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                 <a href="javascript:void(0);" targettitle="' . $label . '" target="description-' . $cat_id . '-' . $pk . '-inputvalue" class="open_bootbox glyphicon glyphicon-fullscreen"></a>
                     <div class="clearboth"></div>
              <div id="description-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }

    function edit_awardtype($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->awardtype : '';
        $value2 = is_array($this->inputvalues) ? $this->inputvalues[0]->award_certificate : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><select class="inputbizhuru" id="awardtype-' . $cat_id . '-' . $pk . '-inputvalue">
                <option value="">Award Type</option>';
        $awardtype = autosuggest_data('education_award', 'id', 'name', array('education_cat' => $cat_id));
        foreach ($awardtype as $key => $v) {
            $display .= '<option ' . ($value == $v['value'] ? 'selected="selected"' : '') . ' value="' . $v['value'] . '">' . $v['data'] . '</option>';
        }
        $display .= '</select>
            <div id="awardtype-error" class="error_div text-danger"></div>
            
                 <div>
                 <div  id="addcertificate' . $cat_id . '-' . $pk . '">
                 <a class="text-brown uploadcertificate" educat="' . $cat_id . '" pk="' . $pk . '" href="javascript:void(0);">+Attach Certificate</a> <span id="certificateloader' . $cat_id . '-' . $pk . '"></span>
                <form method="post"  style="display:none;" action="' . site_url('ajax_upload_certificate') . ' id="formcertificate-' . $cat_id . '-' . $pk . '">
                <input type="file"  name="inputfile' . $cat_id . '-' . $pk . '" onChange="uploadCertificate(' . $cat_id . ',' . ($pk <> '' ? $pk : 0) . ');" id="inputfile-' . $cat_id . '-' . $pk . '"/>   
</form>
</div>
<div class="cerificate" href="javascript:void(0);" id="certificate-' . $cat_id . '-' . $pk . '">' . ($value2 <> '' ? '<img class="certificate" src="' . CERTIFICATES_IMG_PATH . $value2 . '"/>' : '') . '</div>                 
</div>  
              
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }

    function edit_city($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->city : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru city" id="city-' . $cat_id . '-' . $pk . '-inputvalue" />
              <div id="city-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $display .='<script>
      var input = document.getElementById("city-' . $cat_id . '-' . $pk . '-inputvalue");
      var autocomplete = new google.maps.places.Autocomplete(input);
    </script>';

        return $display;
    }

    function edit_reference($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->reference : '';

        if ($cat_id == 1) {
            $catx = 'University/College';
        } else if ($cat_id == 2) {
            $catx = 'Professional';
        } else if ($cat_id == 3) {
            $catx = 'Advence Level School';
        } else if ($cat_id == 4) {
            $catx = 'O-Level School';
        } else {
            $catx = 'Level';
        }

        if ($value <> '') {
            $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:80px; line-height:18px;" class="inputbizhuru" id="reference-' . $cat_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
              <div id="reference-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        } else {
            $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><div><a class="text-brown education_referee" href="javascript:void(0);" id="reference-' . $cat_id . '-' . $pk . '-inputvalue"  >+Add Referee</a></div>
            <div style="line-height:normal;"><small>(i.e. the referee added here must officially
aware of your program and key subjects at
this ' . $catx . ')

            <small></div>
              <div id="reference-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        }

        return $display;
    }

    function edit_professional_category($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->professional_category : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><select class="inputbizhuru" id="professional_category-' . $cat_id . '-' . $pk . '-inputvalue">
                <option value=""> Select Category</option>';
        $professionalism = autosuggest_data('professional_category', 'id', 'name', array('parent' => 0));
        foreach ($professionalism as $key => $v) {
            $display .= '<option ' . ($value == $v['value'] ? 'selected="selected"' : '') . ' value="' . $v['value'] . '">' . $v['data'] . '</option>';
        }
        $display .= '</select>
            <div id="professional_category-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        $display.='<script type="text/javascript"> 
             select2_dropdown({target:"professional_category-' . $cat_id . '-' . $pk . '-inputvalue"});';
        $display.=' </script>';

        return $display;
    }

    function edit_skills($pk, $label, $cat_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->user_id : '';
        $ids_string = array();
        if ($value <> '') {
            $ids_stringtmp = $this->common_model->get_user_skills($value, 'EDUCATION', $cat_id, 'skill_id', $pk);
            $ids_string = convert_to_single_array($ids_stringtmp);
        }
        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit" style="line-height:20px !important;"><select   class="inputbizhuru" placeholder="Add Skills" id="skills-' . $cat_id . '-' . $pk . '-inputvalue" ></select>
              <div id="skills-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $skills = tags_data('skills', 'id', 'name');
        $json = json_encode($skills);
        $display.='<script type="text/javascript"> 
              var skills = tags_select2({target:"skills-' . $cat_id . '-' . $pk . '-inputvalue",data:' . $json . '});';
        if ($value <> '') {
            $display.='skills.select2("val",' . json_encode($ids_string) . ');';
        }
        $display.='</script>';
        return $display;
    }

    function educationform_posted($posted) {

        $error = 0;
        $return = array();
        if ($posted['name'] == '') {
            $return[] = array('field' => 'name', 'error' => '*is required');
            $error++;
        }
        if ($posted['program'] == '') {
            $return[] = array('field' => 'program', 'error' => '*is required');
            $error++;
        }
        if ($posted['professional_category'] == '') {
            $return[] = array('field' => 'professional_category', 'error' => '*is required');
            $error++;
        }
        if ($posted['subject'] == '') {
            $return[] = array('field' => 'subject', 'error' => '*is required');
            $error++;
        }
        if ($posted['awardtype'] == '') {
            $return[] = array('field' => 'awardtype', 'error' => '*is required');
            $error++;
        }
        if ($posted['city'] == '') {
            $return[] = array('field' => 'city', 'error' => '*is required');
            $error++;
        }
        if ($error == 0) {

            // 'program' => ucwords(strtolower($posted['program'])),
            //  'subject' => $posted['subject'],

            $data = array(
                'user_id' => $posted['userid'],
                'education_cat' => $posted['educat'],
                'name' => $posted['name'],
                'duration_fromy' => $posted['duration_fromy'],
                'duration_fromm' => $posted['duration_fromm'],
                'duration_fromd' => $posted['duration_fromd'],
                'duration_toy' => $posted['duration_toy'],
                'duration_tom' => $posted['duration_tom'],
                'duration_tod' => $posted['duration_tod'],
                'graduated' => $posted['graduated'],
                'program' => $posted['program'],
                'description' => $posted['description'],
                'awardtype' => $posted['awardtype'],
                'city' => $posted['city'],
                'reference' => $posted['reference'],
                'professional_category' => $posted['professional_category']
            );

            //create suggested page first in pages_autosuggest
            $page_id = $this->common_model->autosuggest_check('pages_suggestion', array('name' => $posted['name'], 'form' => 'EDUCATION', 'form_category' => $posted['educat']));

            // now insert data in users_education
            $data['name_pages'] = $page_id;
            $edu_id = $this->common_model->update_education($data, $posted['pk']);

            // insert programme
            $programme_id = $this->common_model->autosuggest_check('programme', array('name' => $posted['program'], 'form' => 'EDUCATION', 'form_category' => $posted['educat']));

            // Add SUBJECTS
            $subject_array = explode(',', $posted['subject']);
            $subject_array_ed = array();
            foreach ($subject_array as $key1 => $value1) {
                $subject_id = 0;
                if (is_numeric($value1)) {
                    $subject_id = $value1;
                } else if ($value1 <> '') {
                    $subject_id = $this->common_model->autosuggest_check('subjects', array('name' => $value1, 'form' => 'EDUCATION', 'form_category' => $posted['educat']));
                }

                if ($subject_id) {

                    $subject_array_ed[] = $subject_id;
                }
            }

            $this->common_model->update_education(array('subject' => addhashtag($subject_array_ed)), $edu_id);


            $skills_coredata = array(
                'form' => 'EDUCATION',
                'form_category' => $posted['educat'],
                'user_id' => $posted['userid'],
                'reffid' => $edu_id
            );

            $skills_list = $posted['skills'];

            $this->common_model->update_skills($skills_coredata, $skills_list);

            //$this->common_model->update_education(array('skills_ids' => addhashtag($insertskills)), $edu_id);


            return $edu_id;
        } else {
            return $return;
        }
    }
    
    
    function public_view($user_id, $cat_id, $pk = '') {
        $education_data = $this->common_model->education_data($user_id, $cat_id, $pk);
        $display = '';
        foreach ($education_data as $key => $value) {

            if ($value->program <> '') {
                $programme = $value->program;
            } else {
                $programme = ' ';
            }

            $from = '';
            if ($value->duration_fromy <> '') {
                $from = $value->duration_fromy;
            }

            $to = '';
            if ($value->duration_toy <> '') {
                $to = $value->duration_toy;
            }

            $classof = '';
            if ($from <> '' && $to <> '') {
                $classof = $from . ' - ' . $to . '. ';
            } else if ($from <> '' && $to == '') {
                $classof = $from . '. ';
            } else if ($from == '' && $to <> '') {
                $classof = $to . '. ';
            }



            $display .= '<div  id="cat-' . $cat_id . '-' . $value->id . '-wrapper" class="work_listdiv">
             <div class="workform_logo"></div>
             <div class="workform_data">
             <div class="work_item_header">
              <div class="work_companytitle">
              <span class="text-black-color companytitle_wk">' . $value->name . '</span>
              '  . $programme . '<br/>
                ' . $classof .''. $value->city . '
                 </div>
             
              <div class="clearboth"></div>
              </div>
              <div class="work_item_content">';
            $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Key Subjects:</span>  &nbsp;<span class="skilllistcv-content">';
               $display .=$this->common_model->get_subject_byhashtag($value->subject).'</span><div class="clearboth"></div></div>';
             
            $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Description:</span>  &nbsp;<span class="skilllistcv-content">';
            if($value->description <> ''){
               $display .='<ul style="margin-bottom:0px;padding-bottom:0px;">';

            $explod_content = explode("\n", $value->description);
            foreach ($explod_content as $keyx => $valuex) {
                $display.='<li>' . $valuex . '</li>';
            }
            $display.= '</ul>';
            }
               $display .='</span><div class="clearboth"></div></div>';
             
                
            $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Skills Acquired:</span>  &nbsp;<span class="skilllistcv-content">';
            $skills_xlist = $this->common_model->get_user_skills($user_id, 'EDUCATION', $cat_id, null, $value->id);
            $skills_string = '';

            foreach ($skills_xlist as $keys => $valuexp) {
                $skills_string .= get_value('skills', $valuexp->skill_id) . ', ';
            }


            $display .=rtrim($skills_string, ', ');

            $display .='</span><div class="clearboth"></div></div>';
            $display.='</div>

                </div>
             <div class="clearboth"></div>
                  </div>';




            $display.='<div  id="edu-wrapper-' . $cat_id . '-' . $value->id . '"></div>';
        }

        return $display;
    }


}
