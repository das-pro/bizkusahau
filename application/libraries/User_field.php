<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Userfield
 *
 * @author miltone
 */
class User_field {

    //put your code here
    private $table_users = 'users';
    public $user_fields = array(
        'firstname' => 'First Name',
        'lastname' => 'Last Name',
        'othername' => 'Other Names',
        'dob_md' => 'Birth Date',
        'dob_y' => 'Birth Year',
        'gender' => 'Gender',
        'language' => 'Languages',
        'nationality' => 'Nationality',
        'profilestatus' => 'Profile Status',
    );
    private $contact_table = 'users_contacts';
    public $contact_fields = array(
        'mobile' => 'Mobile Numbers',
        'email' => 'Email',
        'postal' => 'Address'
    );

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

    function field_value($user_id, $field) {
        $sql = "SELECT $field FROM " . $this->table_users . " WHERE id=$user_id";
        $row = $this->db->query($sql)->row();

        return $row->{$field};
    }

    function view_firstname($user_id) {
        $vl = $this->field_value($user_id, 'firstname');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="firstname" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['firstname'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['firstname'] . '</div>
    <div class="userinfo-value" id="firstname-value">' . $vltmp . '<span  class="userinfo-loader" id="firstname-loader"></span></div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="firstname" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
            
       </div>';
        return $display;
    }

    function edit_firstname($user_id) {
        $value = $this->field_value($user_id, 'firstname');
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['firstname'] . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '" class="inputbizhuru" id="firstname-inputvalue" />
              <div id="firstname-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="firstname" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="firstname" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="firstname-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_firstname($user_id, $value) {
        if ($value <> '') {
            $this->ion_auth_model->update($user_id, array('firstname' => $value));
            return 1;
        } else {
            return "* required";
        }
    }

    /*     * ***************************LAST NAME ********************* */

    function view_lastname($user_id) {
        $vl = $this->field_value($user_id, 'lastname');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="lastname" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['lastname'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['lastname'] . '</div>
    <div class="userinfo-value" id="lastname-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="lastname" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_lastname($user_id) {
        $value = $this->field_value($user_id, 'lastname');
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['lastname'] . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '" class="inputbizhuru" id="lastname-inputvalue" />
              <div id="lastname-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="lastname" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="lastname" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="flastname-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_lastname($user_id, $value) {
        if ($value <> '') {
            $this->ion_auth_model->update($user_id, array('lastname' => $value));
            return 1;
        } else {
            return "* required";
        }
    }

    /*     * ***************************OTHER NAME ********************* */

    function view_othername($user_id) {
        $vl = $this->field_value($user_id, 'othername');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="othername" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['othername'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['othername'] . '</div>
    <div class="userinfo-value" id="othername-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="othername" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_othername($user_id) {
        $value = $this->field_value($user_id, 'othername');
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['othername'] . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '" class="inputbizhuru" id="othername-inputvalue" />
              <div id="othername-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="othername" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="othername" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="othername-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_othername($user_id, $value) {

        $this->ion_auth_model->update($user_id, array('othername' => $value));
        return 1;
    }

    /*     * ***************************Birth Date ********************* */

    function view_dob_md($user_id) {
        $vl = $this->field_value($user_id, 'dob_md');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="dob_md" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['dob_md'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['dob_md'] . '</div>
    <div class="userinfo-value" id="dob_md-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="dob_md" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_dob_md($user_id) {
        $value = $this->field_value($user_id, 'dob_md');
        $expl = explode(',', $value);
        $month = array_key_exists(0, $expl) ? $expl[0] : '';
        $day = array_key_exists(1, $expl) ? $expl[1] : '';
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['dob_md'] . '</div>
            <div class="userinfo-value-edit">
            <select class="inputbizhuruhalf" id="dob_m-inputvalue">
            <option value=""> Birth Month </option>';
        foreach (monthlist() as $key => $val) {
            $display .= '<option ' . ($val == $month ? 'selected="selected"' : '') . ' value="' . $val . '">' . $val . '</option>';
        }
        $display .= '</select>
            <select class="inputbizhuruhalf" id="dob_d-inputvalue">
            <option value="">Birth Day</option>';
        for ($i = 1; $i < 32; $i++) {
            $display .= '<option ' . ($i == $day ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '</option>';
        }
        $display .= '</select>
              <div id="dob_md-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="dob_md" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="dob_md" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="dob_md-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_dob_md($user_id, $value) {
        $expl = explode(',', $value);
        $month = array_key_exists(0, $expl) ? $expl[0] : '';
        $day = array_key_exists(1, $expl) ? $expl[1] : '';
        $val = ($month <> '' ? $month . ($day <> '' ? ', ' . $day : '') : '');

        $this->ion_auth_model->update($user_id, array('dob_md' => $val));
        return 1;
    }

    /*     * ***************************Birth Year ********************* */

    function view_dob_y($user_id) {
        $vl = $this->field_value($user_id, 'dob_y');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="dob_y" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['dob_y'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['dob_y'] . '</div>
    <div class="userinfo-value" id="dob_y-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="dob_y" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_dob_y($user_id) {
        $value = $this->field_value($user_id, 'dob_y');
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['dob_y'] . '</div>
            <div class="userinfo-value-edit">
            <select class="inputbizhuruhalf" id="dob_y-inputvalue">
            <option value=""> Birth Year </option>';
        for ($i = date('Y'); $i >= 1920; $i--) {
            $display .= '<option ' . ($i == $value ? 'selected="selected"' : '') . ' value="' . $i . '">' . $i . '</option>';
        }
        $display .= '</select>
              <div id="dob_y-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="dob_y" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="dob_y" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="dob_y-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_dob_y($user_id, $value) {
        $this->ion_auth_model->update($user_id, array('dob_y' => $value));
        return 1;
    }

    /*     * *************************** Gender ********************* */

    function view_gender($user_id) {
        $vl = $this->field_value($user_id, 'gender');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="gender" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['gender'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['gender'] . '</div>
    <div class="userinfo-value" id="gender-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="gender" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_gender($user_id) {
        $value = $this->field_value($user_id, 'gender');
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['gender'] . '</div>
            <div class="userinfo-value-edit">
            <select class="inputbizhuruhalf" id="gender-inputvalue">
            <option value=""> Gender </option>';
        foreach (gender() as $key => $value1) {
            $display .= '<option ' . ($key == $value ? 'selected="selected"' : '') . ' value="' . $key . '">' . $key . '</option>';
        }
        $display .= '</select>
              <div id="gender-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="gender" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="gender" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="dob_y-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_gender($user_id, $value) {
        $this->ion_auth_model->update($user_id, array('gender' => $value));
        return 1;
    }

    /*     * *************************** Languages ********************* */

    function view_language($user_id) {
        $vl = $this->field_value($user_id, 'language');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="language" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['language'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['language'] . '</div>
    <div class="userinfo-value" id="language-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="language" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_language($user_id) {
        $value = $this->field_value($user_id, 'language');
        $vx1 = explode(',', $value);
        $vx = array();
        foreach ($vx1 as $kx => $v1) {
            if ($v1 <> '') {
                $vx[] = $v1;
            }
        }

        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['language'] . '</div>
            <div class="userinfo-value-edit"><select  class="inputbizhuru" id="language-inputvalue" ></select>
              <div id="language-error" class="error_div text-danger"></div>
              <div class="helpinput">Separate by comma</div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="language" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="language" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="language-loadersave"></span>
            </div>
                </div>';
        $json = json_encode(tags_data('languages','name','name'));
        $vx_value = json_encode($vx);
        $display.='<script type="text/javascript"> 
                var languagetags = tags_select2({target:"language-inputvalue",data:' . $json . '});';
        if (count($vx) > 0) {
          $display.='languagetags.select2("val",' . $vx_value . ');';
        }
        $display.='</script>';
        return $display;
    }

    function insert_language($user_id, $value) {

        $explode = explode(',', $value);
        $insert = '';
        foreach ($explode as $key => $value1) {
            $tmp = ucfirst(strtolower($value1));
            $check = $this->common_model->get_laguages($tmp);
            $insert.= $tmp . ',';
            if ($check) {
                
            } else {
                if ($tmp <> '') {
                    $this->db->insert('languages', array('name' => $tmp));
                }
            }
        }

        $value = rtrim($insert, ',');
        $this->ion_auth_model->update($user_id, array('language' => $value));
        return 1;
    }

    /*     * *************************** Nationality ********************* */

    function view_nationality($user_id) {
        $vl = $this->field_value($user_id, 'nationality');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="nationality" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['nationality'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['nationality'] . '</div>
    <div class="userinfo-value" id="nationality-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="nationality" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_nationality($user_id) {
        $value = $this->field_value($user_id, 'nationality');

        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['nationality'] . '</div>
            <div class="userinfo-value-edit"><input type="text" value="' . $value . '"  class="inputbizhuru" id="nationality-inputvalue" />
              <div id="nationality-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="nationality" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="nationality" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="nationality-loadersave"></span>
            </div>
                </div>';
        $language = $this->common_model->get_nationality();
        $nationality_list = array();
        foreach ($language as $kc => $vc) {
            $nationality_list [] = array('value' => $vc->name, 'data' => $vc->name);
        }
        // $language = array(convert_to_single_array($language));
        $json = json_encode($nationality_list);

        $display.='<script type="text/javascript"> 
                text_autosugest({target:"nationality-inputvalue",data:' . $json . '});';

        $display.=' </script>';
        return $display;
    }

    function insert_nationality($user_id, $value) {

        $value = ucfirst(strtolower($value));
        $check = $this->common_model->get_nationality($value);

        if ($check) {
            
        } else {
            if ($value <> '') {
                $this->db->insert('nationality', array('name' => $value));
            }
        }

        $this->ion_auth_model->update($user_id, array('nationality' => $value));

        return 1;
    }

    /*     * *************************** Profile Status ********************* */

    function view_profilestatus($user_id) {
        $vl = $this->field_value($user_id, 'profilestatus');
        $vltmp = ($vl <> '' ? $vl : '<a href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="profilestatus" class="text-brown userinfo-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->user_fields['profilestatus'] . '</a>');
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->user_fields['profilestatus'] . '</div>
    <div class="userinfo-value" id="profilestatus-value">' . $vltmp . '</div>';
        if ($vl <> '') {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" pk="' . encode_id($user_id) . '" field="profilestatus" class="text-brown userinfo-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_profilestatus($user_id) {
        $value = $this->field_value($user_id, 'profilestatus');
        $display = '<div class="userinfo-row-edit">
            <div class="userinfo-label-edit">' . $this->user_fields['profilestatus'] . '</div>
            <div class="userinfo-value-edit"><textarea style="height:50px; line-height:20px; padding-top:10px;" class="inputbizhuru" id="profilestatus-inputvalue">' . $value . '</textarea>
              <div id="profilestatus-error" class="error_div text-danger"></div>
             </div>
            <div class="clearboth"></div>
            <div class="save_footer">
            <button pk="' . encode_id($user_id) . '" field="profilestatus" action="save" class="userinfo-savedata  btn btn-sm btnsubmit">Save Changes</button>
            <button pk="' . encode_id($user_id) . '" field="profilestatus" action="cancel" class="userinfo-savedata  btn btn-sm btncancel">Cancel</button> <span id="profilestatus-loadersave"></span>
            </div>
                </div>';

        return $display;
    }

    function insert_profilestatus($user_id, $value) {

        $this->ion_auth_model->update($user_id, array('profilestatus' => $value));
        return 1;
    }

   

    function contact_field_value($user_id, $contact_type, $core = false) {
        $qry = '';
        if ($core) {
            $qry = " AND core=1";
        }
            $sql = "SELECT * FROM " . $this->contact_table . " WHERE contact_type='" . strtoupper($contact_type) . "' AND user_id=" . $user_id . " $qry ORDER BY core DESC";
       
        $result = $this->db->query($sql)->result();
        if (count($result) > 0) {
            return $result;
        }

        return FALSE;
    }

    /**     * ************************** User Mobile Numbers********************* */
    function view_mobile($user_id) {

        $vl = $this->contact_field_value($user_id, 'MOBILE');
        $mobile = '';
        if (is_array($vl)) {
            foreach ($vl as $pxx => $pc) {
                $mobile.= $pc->contact . ', ';
            }

            $mobile = rtrim($mobile, ', ');
        }
        $vltmp = ($vl ? $mobile : '<a href="javascript:void(0);"  userid="' . encode_id($user_id) . '" field="mobile" class="text-brown userinfocontact-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->contact_fields['mobile'] . '</a>');

        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->contact_fields['mobile'] . '</div>
    <div class="userinfo-value" id="mobile-value">' . $vltmp . '</div>';
        if ($vl) {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" userid="' . encode_id($user_id) . '" field="mobile" class="text-brown userinfocontact-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

//<textarea style="height:50px; line-height:20px; padding-top:10px;" class="inputbizhuru" id="profilestatus-inputvalue">'.$value.'</textarea>
    function edit_mobile($user_id) {

        $value = $this->contact_field_value($user_id, 'mobile');
        $display = '<div class="userinfo-row-edit">
          <div class="userinfo-label-edit">' . $this->contact_fields['mobile'] . '</div>
          <div class="userinfo-value-edit"><div id="containerv-mobile">';
        if ($value) {
            foreach ($value as $k1 => $vp) {
                $display .= '<div class="contactvalue-row"><input type="text" class="editcontact-mobile inputbizhuruxs" value="' . $vp->contact . '"  pk="' . encode_id($vp->id) . '" id="mobile-inputvalue"/> ' . ($vp->core == 1 ? '<span class="text-success" style="font-family:italic; font-weight:bold; "> &nbsp; &nbsp;  Primary </span>' : '<a href="javascript:void(0);" pk="' . encode_id($vp->id) . '" class="remove-contact"> &nbsp; <i class="glyphicon glyphicon-remove"></i>  Remove <span></span></a>') . '</div>';
            }
        } else {
            $display .= '<div class="contactvalue-row"><input type="text" class="editcontact-mobile inputbizhuruxs" pk="" id="mobile-inputvalue"/></div>';
        }
        $display .= '</div>';
        $display .= '<div class="contactvalue-row"><a href="javascript:void(0);" class="addanother-contactrow" pos="containerv-mobile"><i class="glyphicon glyphicon-plus"></i> Add another</a></div>';

        $display .= '<div id="mobile-error" class="error_div text-danger"></div>
          </div>
          <div class="clearboth"></div>
          <div class="save_footer">
          <button userid="' . encode_id($user_id) . '" field="mobile" action="save" class="userinfocontact-savedata  btn btn-sm btnsubmit">Save Changes</button>
          <button userid="' . encode_id($user_id) . '" field="mobile" action="cancel" class="userinfocontact-savedata  btn btn-sm btncancel">Cancel</button> <span id="mobile-loadersave"></span>
          </div>
          </div>';
        return $display;
    }

    function insert_mobile($user_id, $value) {

        $posted_data = json_decode($value);
        $error = '';
        foreach ($posted_data as $kk => $vv) {
            $pk = $vv->pk;
            $vlx = str_replace(array(' ', '+'), array('', ''), $vv->value);
            //validate phone number
            if ($vlx <> '') {
                $is_error = 0;
                if (!$this->integer($vlx)) {
                    $is_error++;
                    $error.= $vlx . " Must contain only digit number<br/>";
                }
                if (strlen($vlx) != 12) {
                    $is_error++;
                    $error.= $vlx . " Must contain  12 digit number<br/>";
                }

                if ($is_error == 0) {
                    if ($pk <> '') {
                        //update data
                        $pkv = decode_id($pk);
                        $this->common_model->contact_update($pkv, array('contact' => $vlx));
                    } else {
                        // insert new
                        $contact = array(
                            'user_id' => $user_id,
                            'contact_type' => 'MOBILE',
                            'contact' => $vlx,
                        );

                        $check_exist = $this->common_model->is_primary_contact_exist($user_id, 'MOBILE');

                        if (count($check_exist) == 0) {
                            $contact['core'] = 1;
                        }

                        $this->common_model->contact_add($contact);
                    }
                }
            }
        }
        if ($error <> '') {
            return $error;
        }
        return 1;
    }

    /**     * ************************** User Emails Emails********************* */
    function view_email($user_id) {

        $vl = $this->contact_field_value($user_id, 'EMAIL');
        $emails = '';
        if (is_array($vl)) {
            foreach ($vl as $pxx => $pc) {
                $emails.= $pc->contact . ', ';
            }
            $emails = rtrim($emails, ', ');
        }

        $vltmp = ($vl ? $emails : '<a href="javascript:void(0);"  userid="' . encode_id($user_id) . '" field="email" class="text-brown userinfocontact-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->contact_fields['email'] . '</a>');

        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->contact_fields['email'] . '</div>
    <div class="userinfo-value" id="email-value">' . $vltmp . '</div>';
        if ($vl) {
            $display .= '<div class="userinfo-action" ><a  href="javascript:void(0);" userid="' . encode_id($user_id) . '" field="email" class="text-brown userinfocontact-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

//<textarea style="height:50px; line-height:20px; padding-top:10px;" class="inputbizhuru" id="profilestatus-inputvalue">'.$value.'</textarea>
    function edit_email($user_id) {

        $value = $this->contact_field_value($user_id, 'email');
        $display = '<div class="userinfo-row-edit">
          <div class="userinfo-label-edit">' . $this->contact_fields['email'] . '</div>
          <div class="userinfo-value-edit"><div id="containerv-email">';
        if ($value) {
            foreach ($value as $k1 => $vp) {
                $display .= '<div class="contactvalue-row"><input type="text" class="editcontact-email inputbizhuruxs" value="' . $vp->contact . '"  pk="' . encode_id($vp->id) . '" id="email-inputvalue"/> ' . ($vp->core == 1 ? '<span class="text-success" style="font-family:italic; font-weight:bold; "> &nbsp; &nbsp;  Primary </span>' : '<a href="javascript:void(0);" pk="' . encode_id($vp->id) . '" class="remove-contact"> &nbsp; <i class="glyphicon glyphicon-remove"></i>  Remove <span></span></a>') . '</div>';
            }
        } else {
            $display .= '<div class="contactvalue-row"><input type="text" class="editcontact-email inputbizhuruxs" pk="" id="email-inputvalue"/></div>';
        }
        $display .= '</div>';
        $display .= '<div class="contactvalue-row"><a href="javascript:void(0);" class="addanother-contactrow" pos="containerv-email"><i class="glyphicon glyphicon-plus"></i> Add another</a></div>';

        $display .= '<div id="email-error" class="error_div text-danger"></div>
          </div>
          <div class="clearboth"></div>
          <div class="save_footer">
          <button userid="' . encode_id($user_id) . '" field="email" action="save" class="userinfocontact-savedata  btn btn-sm btnsubmit">Save Changes</button>
          <button userid="' . encode_id($user_id) . '" field="email" action="cancel" class="userinfocontact-savedata  btn btn-sm btncancel">Cancel</button> <span id="mobile-loadersave"></span>
          </div>
          </div>';
        return $display;
    }

    function insert_email($user_id, $value) {

        $posted_data = json_decode($value);
        $error = '';
        foreach ($posted_data as $kk => $vv) {
            $pk = $vv->pk;
            $vlx = str_replace(array(' ', '+'), array('', ''), trim($vv->value));
            //validate phone number
            if ($vlx <> '') {
                $is_error = 0;
                if (!$this->validate_email($vlx)) {
                    $is_error++;
                    $error.= $vlx . " Must contain valid email<br/>";
                }


                if ($is_error == 0) {
                    if ($pk <> '') {
                        //update data
                        $pkv = decode_id($pk);
                        $this->common_model->contact_update($pkv, array('contact' => strtolower($vlx)));
                    } else {
                        // insert new
                        $contact = array(
                            'user_id' => $user_id,
                            'contact_type' => 'EMAIL',
                            'contact' => trim(strtolower($vlx)),
                        );

                        $check_exist = $this->common_model->is_primary_contact_exist($user_id, 'EMAIL');

                        if (count($check_exist) == 0) {
                            $contact['core'] = 1;
                        }

                        $this->common_model->contact_add($contact);
                    }
                }
            }
        }
        if ($error <> '') {
            return $error;
        }
        return 1;
    }

    /*     * *************************** Postal Status ********************* */

    function view_postal($user_id) {
        $value = $this->contact_field_value($user_id, 'postal');
        $vltmp = ($value ? ($value[0]->contact <> '' ? $value[0]->contact : '<a href="javascript:void(0);" userid="' . encode_id($user_id) . '" field="postal" class="text-brown userinfocontact-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->contact_fields['postal'] . '</a>' ): '<a href="javascript:void(0);" userid="' . encode_id($user_id) . '" field="postal" class="text-brown userinfocontact-edit  userinfo_editnewvalue glyphicon glyphicon-plus"> Add ' . $this->contact_fields['postal'] . '</a>');
        $address = '';
        if ($value) {
            if($value[0]->contact <> ''){
            $tmp = explode("\n", $vltmp);
            foreach ($tmp as $key1 => $value1) {
                $address .=$value1 . '<br/>';
            }
            }else{
              $address = $vltmp;   
            }
        }else{
            $address = $vltmp;
        }
        $display = '<div class="userinfo-row">
    <div class="userinfo-label">' . $this->contact_fields['postal'] . '</div>
    <div class="userinfo-value" id="postal-value">' . $address . '</div>';
        if ($value) {
            $display .= '<div class="userinfo-action"><a  href="javascript:void(0);" userid="' . encode_id($user_id) . '" field="postal" class="text-brown userinfocontact-edit glyphicon glyphicon-pencil">Edit</a></div>';
        }
        $display .= '<div class="clearboth"></div>
       </div>';
        return $display;
    }

    function edit_postal($user_id) {
        $value = $this->contact_field_value($user_id, 'postal');
        $vltmp = ($value ? $value[0]->contact : '');
        $display = '<div class="userinfo-row-edit">
          <div class="userinfo-label-edit">' . $this->contact_fields['postal'] . '</div>
          <div class="userinfo-value-edit"><textarea style="height:70px; line-height:20px; padding-top:10px;" class="inputbizhuru" id="postal-inputvalue">' . $vltmp . '</textarea>
          <div id="postal-error" class="error_div text-danger"></div>
          </div>
          <div class="clearboth"></div>
          <div class="save_footer">
          <button userid="' . encode_id($user_id) . '" field="postal" action="save" class="userinfocontact-savedata  btn btn-sm btnsubmit">Save Changes</button>
          <button userid="' . encode_id($user_id) . '" field="postal" action="cancel" class="userinfocontact-savedata  btn btn-sm btncancel">Cancel</button> <span id="postal-loadersave"></span>
          </div>
          </div>';
        return $display;
    }

    function insert_postal($user_id, $value) {
        $check_exist = $this->common_model->is_primary_contact_exist($user_id, 'POSTAL');
        if (count($check_exist) == 0) {
            // insert new
            $contact = array(
                'user_id' => $user_id,
                'contact_type' => 'POSTAL',
                'contact' => $value,
            );
            $this->common_model->contact_add($contact);
        } else {
            $this->common_model->contact_update($check_exist[0]->id, array('contact' => $value));
            return 1;
        }
    }

    public function integer($str) {
        return (bool) preg_match('/^[\-+]?[0-9]+$/', $str);
    }

    public function validate_email($str) {
        return (bool) filter_var($str, FILTER_VALIDATE_EMAIL);
    }

}
