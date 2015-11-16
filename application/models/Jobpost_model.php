<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jobpost_model
 *
 * @author miltone
 */
class Jobpost_model extends CI_Model {

    //put your code here
    function __construct() {
        parent::__construct();
    }

    function addnew_question($data) {
        $this->db->insert('question_list', $data);
        return $this->db->insert_id();
    }

    function get_question_cat($id = null, $user_id = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        if (!is_null($user_id)) {
            $this->db->where('user_id', $user_id);
        }

        return $this->db->get('question_category');
    }

    function get_question($id = null, $user_id = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }
        if (!is_null($user_id)) {
            $this->db->where('user_id', $user_id);
        }

        return $this->db->get('question_list');
    }

    function jobpost_add_question($array) {
        $this->db->where('jobpost_id', $array['jobpost_id']);
        $this->db->where('qn_id', $array['qn_id']);
        $check = $this->db->get('jobpost_question')->row();
        if ($check) {
            return $this->db->update('jobpost_question', $array, array('jobpost_id' => $array['jobpost_id'], 'qn_id' => $array['qn_id']));
        } else {
            return $this->db->insert('jobpost_question', $array);
        }
    }

    function jobpost_add_salary($array) {
        $this->db->where('jobpost_id', $array['jobpost_id']);
        $check = $this->db->get('jobpost_salary')->row();
        if ($check) {
            return $this->db->update('jobpost_salary', $array, array('jobpost_id' => $array['jobpost_id']));
        } else {
            return $this->db->insert('jobpost_salary', $array);
        }
    }

    function jobpost_add_target($array) {
        $this->db->where('jobpost_id', $array['jobpost_id']);
        $check = $this->db->get('jobpost_target')->row();
        if ($check) {
            return $this->db->update('jobpost_target', $array, array('jobpost_id' => $array['jobpost_id']));
        } else {
            return $this->db->insert('jobpost_target', $array);
        }
    }

    function jobpost_add_location($array) {
        $this->db->where('jobpost_id', $array['jobpost_id']);
        $check = $this->db->get('jobpost_location')->row();
        if ($check) {
            return $this->db->update('jobpost_location', $array, array('jobpost_id' => $array['jobpost_id']));
        } else {
            return $this->db->insert('jobpost_location', $array);
        }
    }

    function get_jobpost($id = null) {
        if (!is_null($id)) {
            $this->db->where('id', $id);
        }

        return $this->db->get('jobpost');
    }

    function get_jobpost_salary($jobpost_id = null) {
        if (!is_null($jobpost_id)) {
            $this->db->where('jobpost_id', $jobpost_id);
        }

        return $this->db->get('jobpost_salary');
    }

    function get_jobpost_target($jobpost_id = null) {
        if (!is_null($jobpost_id)) {
            $this->db->where('jobpost_id', $jobpost_id);
        }

        return $this->db->get('jobpost_target');
    }

    function get_jobpost_location($jobpost_id = null) {
        if (!is_null($jobpost_id)) {
            $this->db->where('jobpost_id', $jobpost_id);
        }

        return $this->db->get('jobpost_location');
    }

    function create_job_basicinfo($array, $jobpost_id = null) {
        if ($jobpost_id > 0) {
            $update = $this->db->update('jobpost', $array, array('id' => $jobpost_id));
            if ($update) {
                return $jobpost_id;
            } else {
                return FALSE;
            }
        } else {
            $insert = $this->db->insert('jobpost', $array);
            if ($insert) {
                return $this->db->insert_id();
            } else {
                return FALSE;
            }
        }

        return FALSE;
    }

    function job_adverts() {
        $current_user = current_user();

        $sql = "SELECT * FROM jobpost WHERE status = 1";

        return $this->db->query($sql)->result();
    }

    function get_jobpost_question($jobpost_id, $section_id) {
        $section_category = $this->db->query("SELECT DISTINCT quest_cat FROM jobpost_question WHERE jobpost_id='$jobpost_id' AND section_id='$section_id'")->result();
        $return = array();
       
        if (count($section_category)) {

            $return['section_cat'] = $section_category;

            foreach ($section_category as $key => $value) {
                $return['qn'][$value->quest_cat] = $this->db->query("SELECT * FROM jobpost_question WHERE jobpost_id='$jobpost_id' AND section_id='$section_id' AND quest_cat='$value->quest_cat' ")->result();
            }
        }

        return $return;
    }

}
