<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Common_model
 *
 * @author miltone
 */
class Common_Model extends CI_Model {

    //put your code here
    protected $message = array();
    protected $error = array();

    function __construct() {
        parent::__construct();
        $this->load->dbforge();
    }

    function currency($code = null) {
        if (!is_null($code)) {
            $this->db->where('code', $code);
        }

        return $this->db->get('currency');
    }

    function credit_package($id = null, $credit = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($credit)) {
            $this->db->where('credit', $credit);
        }

        return $this->db->get('payment_package');
    }

    
    
    function get_front_slide_img() {
        return $this->db->get('front_side_slide')->result();
    }

    function insertData($table, $data) {
        if ($this->db->table_exists($table)) {
            $fields = $this->db->list_fields($table);
            foreach ($data as $key => $value) {
                if (!in_array($key, $fields)) {
                    $fields = array(
                        $key => array('type' => 'TEXT', 'null' => TRUE)
                    );
                    $this->dbforge->add_column($table, $fields);
                }
            }

            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
        return FALSE;
    }

    function get_laguages($lang = null) {
        if (!is_null($lang)) {
            $this->db->like("name", $lang);
            return $this->db->get('languages')->row();
        }
        return $this->db->query(" SELECT name FROM languages ORDER BY name ASC")->result();
    }

    function get_nationality($nationality = null) {
        if (!is_null($nationality)) {
            $this->db->like("name", $nationality);
            return $this->db->get('nationality')->row();
        }
        return $this->db->query(" SELECT name FROM nationality ORDER BY name ASC")->result();
    }

    function contact_update($id, $data) {
        return $this->db->update('users_contacts', $data, array('id' => $id));
    }

    function contact_add($data) {
        return $this->db->insert('users_contacts', $data);
    }

    function is_primary_contact_exist($user_id, $contacttype) {
        return $this->db->get_where('users_contacts', array('user_id' => $user_id, 'contact_type' => strtoupper($contacttype)))->result();
    }

    function education_award($id = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        return $this->db->get('education_award');
    }

    function education_cat($id = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        return $this->db->get('education_cat');
    }

    function update_education($data, $id = null) {
        if (!is_null($id) && $id > 0) {
            $this->db->update('users_education', $data, array('id' => $id));
        } else {
            $this->db->insert('users_education', $data);
            $id = $this->db->insert_id();
        }

        return $id;
    }

    function update_work($data, $id = null) {
        if (!is_null($id) && $id > 0) {
            $this->db->update('users_work', $data, array('id' => $id));
        } else {
            $this->db->insert('users_work', $data);
            $id = $this->db->insert_id();
        }

        return $id;
    }

    function update_award($data, $id = null) {
        if (!is_null($id) && $id > 0) {
            $this->db->update('users_awards', $data, array('id' => $id));
        } else {
            $this->db->insert('users_awards', $data);
            $id = $this->db->insert_id();
        }

        return $id;
    }

    function update_skills($core_array, $string_skills) {
        $this->db->where($core_array);
        $get_user_skills = $this->db->get('users_skills')->result();
        $posted_skills = explode(',', $string_skills);
        $return_ids = array();
        foreach ($get_user_skills as $key => $value) {
            if (in_array($value->id, $posted_skills)) {
                $index = array_search($value->id, $posted_skills);
                $return_ids[] = $index;
                unset($posted_skills[$index]);
            } else {
                //user delete skills:: then delete also from users_skills table
                $this->db->delete('users_skills', array('id' => $value->id));
            }
        }


        //add remaining skills as new skills
        foreach ($posted_skills as $key1 => $value1) {
            if (!is_numeric($value1)) {
                $newid = $this->autosuggest_check('skills', array('name' => $value1));
            } else {
                $newid = $value1;
            }
            $newarray = $core_array;
            $newarray['skill_id'] = $newid;
            $this->db->insert('users_skills', $newarray);
        }
    }

    function autosuggest_check($table, $data) {
        //$str = ucwords(strtolower($name));
        $this->db->where($data);

        $result = $this->db->get($table)->row();
        if ($result) {
            return $result->id;
        } else {
            $this->db->insert($table, $data);
            return $this->db->insert_id();
        }
    }

    function education_data($user_id, $education_cat, $pk = '') {
        $this->db->where('user_id', $user_id);
        $this->db->where('education_cat', $education_cat);
        if ($pk <> '' && $pk > 0) {
            $this->db->where('id', $pk);
        }
        return $this->db->get('users_education')->result();
    }

    function get_user_skills($user_id, $form = null, $form_category = null, $column = null, $reffid = null) {

        if (!is_null($form)) {
            $this->db->where('form', $form);
        }
        if (!is_null($form_category)) {
            $this->db->where('form_category', $form_category);
        }
        if (!is_null($reffid) && $reffid <> '') {
            $this->db->where('reffid', $reffid);
        }

        $this->db->where('user_id', $user_id);

        if (!is_null($column)) {
            $this->db->select($column);

            return $this->db->get('users_skills')->result_array();
        }

        return $this->db->get('users_skills')->result();
    }

    function get_subject($id) {
        $this->db->where('id', $id);
        return $this->db->get('subjects')->row();
    }

    function get_subject_byhashtag($hash_ids) {
        $remove_hashtag = removehashtag($hash_ids);
        $retun_subject = array();
        foreach (explode(',', $remove_hashtag) as $key => $value) {
            $is_exist = $this->get_subject($value);
            if ($is_exist) {
                $retun_subject[] = $is_exist->name;
            }
        }

        return implode(',', $retun_subject);
    }

    function get_professional_list($id = null, $parent = null, $type = 'USER') {

        $this->db->where('type', $type);
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        if (!is_null($parent)) {
            $this->db->where('parent', $parent);
        }

        $this->db->order_by('parent', 'ASC');

        return $this->db->get('professional_category');
    }

    function work_data($user_id, $id = null) {

        if (!is_null($id) && $id <> '') {
            $this->db->where('id', $id);
        }
        $this->db->where('user_id', $user_id);
        $this->db->order_by('duration_fromy', 'DESC');
        $this->db->order_by('work_status', 'ASC');
        return $this->db->get('users_work')->result();
    }

    function award_data($user_id, $id = null) {

        if (!is_null($id) && $id <> '') {
            $this->db->where('id', $id);
        }
        $this->db->where('user_id', $user_id);
        $this->db->order_by('duration_fromy', 'DESC');
        return $this->db->get('users_awards')->result();
    }

    function insert_wall_img($user_id, $filename) {
        $this->db->insert('users_wall_img', array('user_id' => $user_id, 'photo' => $filename));
        return $this->db->insert_id();
    }
    
    
    function view_share_count_insert($data){
        $this->db->where($data);
        $check = $this->db->get('view_share_count')->row();
        if(!$check){
            $this->db->insert('view_share_count',$data);
        }
    }

}
