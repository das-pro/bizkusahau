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
class Work {

    //put your code here
    public $work_field = array(
        'name' => 'Company',
        'position' => 'Position',
        'position_type' => 'Position Type',
        'level' => 'Level',
        'professional_category' => 'Department(Category)',
        'city' => 'City/Country',
        'description' => 'Duties & Responsibilities',
        'skills' => 'Skills Acquired',
        'duration' => 'Duration',
        'achievement' => 'Achievements',
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

    function view($user_id, $pk = '') {
        $work_data = $this->common_model->work_data($user_id, $pk);
        $display = '';
        foreach ($work_data as $key => $value) {
            /*
              if ($value->program <> '') {
              $programme = ' - ' . $value->program;
              } else {
              $programme = ' ';
              }
             */
            $from = '';
            $fromdif = '';
            $todif = '';
            if ($value->duration_fromy <> '') {
                $from = $value->duration_fromy;
                $fromdif = $value->duration_fromy . '-' . ($value->duration_fromm <> '' ? $value->duration_fromm : 1) . '-' . ($value->duration_fromd <> '' ? $value->duration_fromd : 1);
            }

            if ($value->work_status != 'CURRENT') {
                $to = '';
                if ($value->duration_toy <> '') {
                    $to = $value->duration_toy;
                    $todif = $value->duration_toy . '-' . ($value->duration_tom <> '' ? $value->duration_tom : 1) . '-' . ($value->duration_tod <> '' ? $value->duration_tod : 1);
                }
            } else {
                $to = 'Current';
                $todif = date('Y-m-d');
            }

            $date_difference = '';
            if ($fromdif <> '' && $todif <> '') {
                $date_difference = '<span class="text-black-color"> (' . date_difference($fromdif, $todif) . ') </span>';
            }

            $classof = '';
            if ($from <> '' && $to <> '') {
                $classof = $from . ' - ' . $to;
            } else if ($from <> '' && $to == '') {
                $classof = $from;
            } else if ($from == '' && $to <> '') {
                $classof = $to;
            }

            $position = autosuggest_data('position', 'name', 'id', array('id' => $value->position));
            $position_type = autosuggest_data('position_type', 'name', 'id', array('id' => $value->position_type));


            $display .= '<div  id="work-' . $user_id . '-' . $value->id . '-wrapper" class="work_listdiv">
             <div class="workform_logo"></div>
             <div class="workform_data">
             <div class="work_item_header">
              <div class="work_companytitle">
              <span class="text-black-color companytitle_wk">' . $value->name . '</span>
              ' . ($position ? $position[0]['value'] : '') . ' &nbsp;  <span class="text-black-color"> ( ' . ($position_type ? $position_type[0]['value'] : '') . ' )</span><br/>
                ' . $classof . $date_difference . ' . ' . $value->city . '
                 </div>
              <div class="work_editlink" style="display:none;"><a  href="javascript:void(0);" pk="' . $value->id . '" userid="' . $user_id . '"  class="text-brown workinfo-edit glyphicon glyphicon-pencil">Edit</a></div>
              <div class="clearboth"></div>
              </div>
              <div class="work_item_content">';


            $test_description = trim($value->description);
            if (strlen($test_description) > 0) {

                $explod_content = explode("\n", trim($value->description));
                $display .='<span style="font-weight:bold; display:block; font-size:14px; padding-top:5px;">Job Descriptions</span><ul>';
                foreach ($explod_content as $keyx => $valuex) {
                    $display.='<li>' . $valuex . '</li>';
                }
                $display.= '</ul>';
            }

            $test_achievement = trim($value->achievement);
            if (strlen($test_achievement) > 0) {

                $explod_content = explode("\n", trim($value->achievement));
                $display .='<span style="font-weight:bold; display:block; font-size:14px; padding-top:5px;">Achievements</span><ul>';
                foreach ($explod_content as $keyx => $valuex) {
                    $display.='<li>' . $valuex . '</li>';
                }
                $display.= '</ul>';
            }




            $display .='<div class="work_disp_skills"><span style="font-weight:bold;">Skills Acquired:</span>  &nbsp;';
            $skills_xlist = $this->common_model->get_user_skills($user_id, 'WORK', 1, null, $value->id);
            $skills_string = '';

            foreach ($skills_xlist as $keys => $valuexp) {
                $skills_string .= get_value('skills', $valuexp->skill_id) . ', ';
            }


            $display .=rtrim($skills_string, ', ');

            $display .='</div>';
            $display.='</div>

                </div>
             <div class="clearboth"></div>
                  </div>';

            $display.='<div  id="work-wrapper-' . $user_id . '-' . $value->id . '"></div>';
        }

        return $display;
    }

    function edit($user_id, $pk = '') {
        if ($pk <> '') {
            $inputValuesTMP = $this->common_model->work_data($user_id, $pk);
            $this->inputvalues = $inputValuesTMP;
        }
        $display = '<div class="educationinfoform" id="formxp-' . $user_id . '-' . $pk . '">';

        foreach ($this->work_field as $key => $value) {
            $display.= $this->{'edit_' . $key}($pk, $value, $user_id);
        }

        $display.='<div class="save_footer">
            <button pk="' . $pk . '"  userid="' . $user_id . '" action="save" class="workinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . $pk . '"  userid="' . $user_id . '"  action="cancel" class="workinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="workinfo-loadersave-' . $user_id . '-' . $pk . '"></span>
            </div> </div>';

        return $display;
    }

    function edit_name($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->name : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="name-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="name-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $company = autosuggest_data('pages_suggestion', 'name', 'id', array('form' => 'WORK'));
        $json = json_encode($company);

        $display.='<script type="text/javascript"> 
                text_autosugest({target:"name-' . $user_id . '-' . $pk . '-inputvalue",data:' . $json . '});';

        $display.=' </script>';
        return $display;
    }

    function edit_position($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->position : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . ($value <> '' ? get_value('position', $value) : '') . '"  class="inputbizhuru" id="position-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="position-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $position = autosuggest_data('position', 'name', 'id', array('form' => 'WORK'));
        $json = json_encode($position);

        $display.='<script type="text/javascript"> 
                text_autosugest({target:"position-' . $user_id . '-' . $pk . '-inputvalue",data:' . $json . '});';

        $display.=' </script>';
        return $display;
    }

    function edit_position_type($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->position_type : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><select class="inputbizhuru" id="position_type-' . $user_id . '-' . $pk . '-inputvalue">
                <option value="">Select Position Type</option>';
        $awardtype = autosuggest_data('position_type', 'id', 'name');
        foreach ($awardtype as $key => $v) {
            $display .= '<option ' . ($value == $v['value'] ? 'selected="selected"' : '') . ' value="' . $v['value'] . '">' . $v['data'] . '</option>';
        }
        $display .= '</select>
             <div id="position_type-error" class="error_div text-danger"></div>
            </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }

    function edit_level($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->level : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><select class="inputbizhuru" id="level-' . $user_id . '-' . $pk . '-inputvalue">
                <option value="">Select Level</option>';
        $awardtype = autosuggest_data('work_level', 'id', 'name');
        foreach ($awardtype as $key => $v) {
            $display .= '<option ' . ($value == $v['value'] ? 'selected="selected"' : '') . ' value="' . $v['value'] . '">' . $v['data'] . '</option>';
        }
        $display .= '</select>
             <div id="level-error" class="error_div text-danger"></div>
            </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }

    function edit_professional_category($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->professional_category . '#' . $this->inputvalues[0]->professional_category_sub : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><select class="inputbizhuru" id="professional_category-' . $user_id . '-' . $pk . '-inputvalue">
                <option value=""> Select Category</option>';
        $professionalism = $this->common_model->get_professional_list(null, 0)->result();
        foreach ($professionalism as $key => $v) {

            $display.='<optgroup label="' . $v->name . '">';
            $sub = $this->common_model->get_professional_list(null, $v->id)->result();
            foreach ($sub as $sub_key => $sub_value) {
                $display .= '<option ' . ($value == $v->id . '#' . $sub_value->id ? 'selected="selected"' : '') . ' value="' . $v->id . '#' . $sub_value->id . '">' . $sub_value->name . '</option>';
            }
            $display .= '</optgroup>';
        }
        $display .= '</select>
            <div id="professional_category-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        $display.='<script type="text/javascript"> 
             select2_dropdown({target:"professional_category-' . $user_id . '-' . $pk . '-inputvalue"});';
        $display.=' </script>';

        return $display;
    }

    function edit_city($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->city : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru city" id="city-' . $user_id . '-' . $pk . '-inputvalue" />
              <div id="city-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $display .='<script>
      var input = document.getElementById("city-' . $user_id . '-' . $pk . '-inputvalue");
      var autocomplete = new google.maps.places.Autocomplete(input);
    </script>';

        return $display;
    }

    function edit_description($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->description : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:100px; line-height:18px;" class="inputbizhuru allowfullscreen" id="description-' . $user_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                <a href="javascript:void(0);" targettitle="' . $label . '" target="description-' . $user_id . '-' . $pk . '-inputvalue" class="open_bootbox glyphicon glyphicon-fullscreen"></a>
                    <div class="clearboth"></div>
                <div style="font-size:10px; line-height:normal; margin-top:-10px;">(Every responsibility should start in new line)</div>
              <div id="description-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        return $display;
    }

    function edit_duration($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->work_status : '';

        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit">
<div><input type="checkbox" value="1" ' . ($value <> '' ? ($value == 'CURRENT' ? 'checked="checked"' : '') : 'checked="checked"') . ' class="workhere_checkbox" userid="' . $user_id . '" pk="' . $pk . '" id="workhere-' . $user_id . '-' . $pk . '"/> I currently work here</div>            
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
</div> to <span id="currentwork-' . $user_id . '-' . $pk . '">Current</span>  <div class="durationdiv" style="display:none;" id="durationtodiv-' . $user_id . 'X' . $pk . '"><a class="text-brown" id="Ytolink" href="javascript:void(0);">+Add Year</a>
          
 <select id="toy" style="display:none;" class="inputbizhuruauto" next-load="tom" onchange="durationchain(this)">
            <option value="">Year</option>';
        for ($x = date('Y'); $x > 1940; $x--) {
            $xx = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_toy : '';
            $display .= '<option ' . ($x == $xx ? 'selected="selected"' : '') . ' value="' . $x . '">' . $x . '</option>';
        }
        $display .= ' </select>
            <select id="tom" style="display:none;" next-load="tod" class="inputbizhuruauto" onchange="durationchain(this)">
            <option value="">Month</option>';
        foreach (monthlist() as $ky => $vx) {
            $xx = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_tom : '';
            $display .= '<option ' . ($ky == $xx ? 'selected="selected"' : '') . ' value="' . $ky . '">' . $vx . '</option>';
        }
        $display .= '</select>
            <select id="tod" style="display:none;" class="inputbizhuruauto">
            <option value="">Day</option>';
        for ($x = 1; $x < 32; $x++) {
            $xx = is_array($this->inputvalues) ? $this->inputvalues[0]->duration_tod : '';
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

    function edit_reference($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->reference : '';


        if ($value <> '') {
            $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:80px; line-height:18px;" class="inputbizhuru" id="reference-' . $user_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                 <a href="javascript:void(0);" targettitle="' . $label . '" target="reference-' . $user_id . '-' . $pk . '-inputvalue" class="open_bootbox  glyphicon glyphicon-zoom-out"></a>
              <div id="reference-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        } else {
            $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><div><a class="text-brown education_referee" href="javascript:void(0);" id="reference-' . $user_id . '-' . $pk . '-inputvalue"  >+Add Referee</a></div>
            <div style="line-height:normal;"><small>(i.e. the referee added here must officially
aware of your duties and responsibilities at mentioned company )

            <small></div>
              <div id="reference-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';
        }

        return $display;
    }

    function edit_achievement($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->achievement : '';
        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit"><textarea style="height:100px; line-height:18px;" class="inputbizhuru allowfullscreen" id="achievement-' . $user_id . '-' . $pk . '-inputvalue" >' . $value . '</textarea>
                <a href="javascript:void(0);" targettitle="' . $label . '" target="achievement-' . $user_id . '-' . $pk . '-inputvalue" class="open_bootbox  glyphicon glyphicon-fullscreen"></a>
                <div style="font-size:10px; line-height:normal; margin-top:-10px;">(Every achievement should start in new line)</div>
              <div id="achievement-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';


        return $display;
    }

    function edit_skills($pk, $label, $user_id) {
        $value = is_array($this->inputvalues) ? $this->inputvalues[0]->user_id : '';
        $ids_string = array();
        if ($value <> '') {
            $ids_stringtmp = $this->common_model->get_user_skills($value, 'WORK', 1, 'skill_id', $pk);
            $ids_string = convert_to_single_array($ids_stringtmp);
        }
        $display = '<div class="educationinfo-row-edit">
            <div class="userinfo-label-edit">' . $label . '</div>
            <div class="userinfo-value-edit" style="line-height:20px !important;"><select   class="inputbizhuru" placeholder="Add Skills" id="skills-' . $user_id . '-' . $pk . '-inputvalue" ></select>
              <div id="skills-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            
                </div>';

        $skills = tags_data('skills', 'id', 'name');
        $json = json_encode($skills);
        $display.='<script type="text/javascript"> 
              var skills = tags_select2({target:"skills-' . $user_id . '-' . $pk . '-inputvalue",data:' . $json . '});';
        if ($value <> '') {
            $display.='skills.select2("val",' . json_encode($ids_string) . ');';
        }
        $display.='</script>';
        return $display;
    }

    function workform_posted($posted) {

        $error = 0;
        $return = array();
        if ($posted['name'] == '') {
            $return[] = array('field' => 'name', 'error' => '*is required');
            $error++;
        }
        if ($posted['level'] == '') {
            $return[] = array('field' => 'level', 'error' => '*is required');
            $error++;
        }
        if ($posted['professional_category'] == '') {
            $return[] = array('field' => 'professional_category', 'error' => '*is required');
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
        if ($posted['city'] == '') {
            $return[] = array('field' => 'city', 'error' => '*is required');
            $error++;
        }
        if ($posted['position_type'] == '') {
            $return[] = array('field' => 'position_type', 'error' => '*is required');
            $error++;
        }
        if ($error == 0) {

            // 'program' => ucwords(strtolower($posted['program'])),
            //  'subject' => $posted['subject'],
            $professinal = explode('#', $posted['professional_category']);
            $data = array(
                'user_id' => $posted['userid'],
                'work_status' => $posted['is_current_work'] == 1 ? 'CURRENT' : 'PAST',
                'name' => $posted['name'],
                'duration_fromy' => $posted['duration_fromy'],
                'duration_fromm' => $posted['duration_fromm'],
                'duration_fromd' => $posted['duration_fromd'],
                'duration_toy' => $posted['duration_toy'],
                'duration_tom' => $posted['duration_tom'],
                'duration_tod' => $posted['duration_tod'],
                'level' => $posted['level'],
                'position_type' => $posted['position_type'],
                'description' => $posted['description'],
                'achievement' => $posted['achievement'],
                'city' => $posted['city'],
                'reference' => $posted['reference'],
                'professional_category' => (array_key_exists(0, $professinal) ? $professinal[0] : 0),
                'professional_category_sub' => (array_key_exists(1, $professinal) ? $professinal[1] : 0)
            );

            //create suggested page first in pages_autosuggest
            $page_id = $this->common_model->autosuggest_check('pages_suggestion', array('name' => $posted['name'], 'form' => 'WORK', 'form_category' => 1));

            // insert position
            $position_id = $this->common_model->autosuggest_check('position', array('name' => $posted['position'], 'form' => 'WORK'));
            // now insert data in users_education
            $data['name_pages'] = $page_id;
            $data['position'] = $position_id;

            $edu_id = $this->common_model->update_work($data, $posted['pk']);

            $skills_coredata = array(
                'form' => 'WORK',
                'form_category' => 1,
                'user_id' => $posted['userid'],
                'reffid' => $edu_id
            );

            $skills_list = $posted['skills'];

            $this->common_model->update_skills($skills_coredata, $skills_list);

            return $edu_id;
        } else {
            return $return;
        }
    }

    function public_view($user_id, $pk = '') {
        $work_data = $this->common_model->work_data($user_id, $pk);
        $display = '';
        foreach ($work_data as $key => $value) {
            /*
              if ($value->program <> '') {
              $programme = ' - ' . $value->program;
              } else {
              $programme = ' ';
              }
             */
            $from = '';
            $fromdif = '';
            $todif = '';
            if ($value->duration_fromy <> '') {
                $from = $value->duration_fromy;
                $fromdif = $value->duration_fromy . '-' . ($value->duration_fromm <> '' ? $value->duration_fromm : 1) . '-' . ($value->duration_fromd <> '' ? $value->duration_fromd : 1);
            }

            if ($value->work_status != 'CURRENT') {
                $to = '';
                if ($value->duration_toy <> '') {
                    $to = $value->duration_toy;
                    $todif = $value->duration_toy . '-' . ($value->duration_tom <> '' ? $value->duration_tom : 1) . '-' . ($value->duration_tod <> '' ? $value->duration_tod : 1);
                }
            } else {
                $to = 'Current';
                $todif = date('Y-m-d');
            }

            $date_difference = '';
            if ($fromdif <> '' && $todif <> '') {
                $date_difference = '<span class="text-black-color"> (' . date_difference($fromdif, $todif) . ') </span>';
            }

            $classof = '';
            if ($from <> '' && $to <> '') {
                $classof = $from . ' - ' . $to;
            } else if ($from <> '' && $to == '') {
                $classof = $from;
            } else if ($from == '' && $to <> '') {
                $classof = $to;
            }

            $position = autosuggest_data('position', 'name', 'id', array('id' => $value->position));
            $position_type = autosuggest_data('position_type', 'name', 'id', array('id' => $value->position_type));


            $display .= '<div  id="work-' . $user_id . '-' . $value->id . '-wrapper" class="work_listdiv">
             <div class="workform_logo"></div>
             <div class="workform_data">
             <div class="work_item_header">
              <div class="work_companytitle">
              <span class="text-black-color companytitle_wk">' . $value->name . '</span>
              ' . ($position ? $position[0]['value'] : '') . ' &nbsp;  <span class="text-black-color"> ( ' . ($position_type ? $position_type[0]['value'] : '') . ' )</span><br/>
                ' . $classof . $date_difference . ' . ' . $value->city . '
                 </div>
              <div class="clearboth"></div>
              </div>
              <div class="work_item_content">';
            $test_description = trim($value->description);
            if (strlen($test_description) > 0) {

                $explod_content = explode("\n", trim($value->description));
                $display .='<span style=" display:block; color:#000; margin-left:-10px; font-size:14px; padding-top:5px;">Job Descriptions</span><ul>';

                $explod_content = explode("\n", $value->description);
                foreach ($explod_content as $keyx => $valuex) {
                    $display.='<li>' . $valuex . '</li>';
                }
                $display.= '</ul>';
            }
            
            $test_achievement = trim($value->achievement);
            if (strlen($test_achievement) > 0) {

                $explod_content = explode("\n", trim($value->achievement));
                $display .='<span style=" display:block; font-size:14px; padding-top:5px; color:#000; margin-left:-10px;">Achievements</span><ul>';

                $explod_content = explode("\n", $value->achievement);
                foreach ($explod_content as $keyx => $valuex) {
                    $display.='<li>' . $valuex . '</li>';
                }
                $display.= '</ul>';
            }
            
            
            $display .='<div class="work_disp_skills"><span style="font-weight:bold;" class="skilllistcv">Skills Acquired:</span>  &nbsp;';
            $skills_xlist = $this->common_model->get_user_skills($user_id, 'WORK', 1, null, $value->id);
            $skills_string = '';

            foreach ($skills_xlist as $keys => $valuexp) {
                $skills_string .= get_value('skills', $valuexp->skill_id) . ', ';
            }


            $display .=rtrim($skills_string, ', ');

            $display .='</div>';
            $display.='</div>

                </div>
             <div class="clearboth"></div>
                  </div>';

            $display.='<div  id="work-wrapper-' . $user_id . '-' . $value->id . '"></div>';
        }

        return $display;
    }

}
