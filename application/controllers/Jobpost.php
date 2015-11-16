<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Jobpost
 *
 * @author miltone
 */
class Jobpost extends CI_Controller {

    //put your code here

    function __construct() {
        parent::__construct();
        $this->form_validation->set_error_delimiters('<div class="requiredinput">', '</div>');
    }

    function jobpost() {
        $current_user = current_user();
        $this->data['left_content'] = 'left_column/menu';
        $this->data['left_active_link'] = 'jobpost';

        if (isset($_GET['tabinfo'])) {
            $tabinfo = $_GET['tabinfo'];
            if ($tabinfo == 'jobpost_basic' || $tabinfo == '') {
                $this->jobpost_basic();
            } else if ($tabinfo == 'jobpost_salary') {
                $this->jobpost_salary();
            } else if ($tabinfo == 'jobpost_target') {
                $this->jobpost_target();
            } else if ($tabinfo == 'jobpost_location') {
                $this->jobpost_location();
            } else if ($tabinfo == 'jobpost_question') {
                $this->jobpost_question();
            } else if ($tabinfo == 'jobpost_add_edit_question') {
                $this->jobpost_add_edit_question();
            } else if ($tabinfo == 'jobpost_preview') {
                $this->jobpost_preview();
            }
        }


        $this->data['section_middle_content'] = 'middle_column/jobpost/jobpost_content';
        $this->data['middle_content'] = 'middle_content';
        $this->load->view('template', $this->data);
    }

    function popup_benefit() {
        $this->load->view('middle_column/jobpost/popup_benefit');
    }

    function popup_benefitadd() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $benefit = $_POST['name'];
            $check = $this->db->get_where('jobpost_benefit', array('name' => $benefit))->result();
            if (count($check) > 0) {
                //$return['msg'] = 'Duplicate Benefit Informations';
            } else {
                $last = $this->db->query("SELECT * FROM jobpost_benefit ORDER BY id DESC LIMIT 1")->row();
                $insert = array('name' => $benefit);
                if ($last->position == 0) {
                    $insert['position'] = 1;
                } else {
                    $insert['position'] = 0;
                }
                $in = $this->db->insert('jobpost_benefit', $insert);
                if ($in) {
                    $lastid = $this->db->insert_id();
                    $return['msg'] = $this->db->get_where('jobpost_benefit', array('id' => $lastid))->row();
                    $return['status_server'] = 1;
                } else {
                    $return['msg'] = 'Please try again later';
                }
            }
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

    function jobpost_preview() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);
            $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['jobpostinfo'] = $check_post_exist;
            } else {
                $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
            redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
        }
    }

    function jobpost_add_edit_question() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);

            $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['jobpostinfo'] = $check_post_exist;
            }



            if ($this->input->post('jobpost_id')) {
                $jobpost_idpost = $this->input->post('jobpost_id');

                if (decode_id($jobpost_idpost) == $jobpost_id) {
                    if ($this->input->post('newqn')) {
                        $test = 0;
                        $new_question = $this->input->post('newqn');
                        foreach ($new_question as $key => $value) {
                            $tmp = explode('_', $key);
                            $section_id = $tmp[0];
                            $category_id = $tmp[1];
                            $new = trim($value);
                            if ($new <> '') {
                                $test++;
                                $array2 = array(
                                    'section_id' => $section_id,
                                    'quest_cat' => $category_id,
                                    'question' => $value,
                                    'user_id' => $current_user->id
                                );

                                $qnid = $this->jobpost_model->addnew_question($array2);
                                $array = array(
                                    'jobpost_id' => $jobpost_id,
                                    'createdby' => $current_user->id,
                                    'section_id' => $section_id,
                                    'quest_cat' => $category_id,
                                    'qn_id' => $qnid
                                );
                                $add = $this->jobpost_model->jobpost_add_question($array);
                            }
                        }


                        $this->session->set_flashdata('message', show_alert('Information  saved successfully !!', 'success'));
                        redirect('jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id=' . encode_id($jobpost_id));
                    }
                } else {
                    $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                    redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                }
            }


            if (isset($_GET['rmid'])) {
                $rmid = decode_id($_GET['rmid']);
                $this->db->delete('jobpost_question', array('id' => $rmid));
                $this->session->set_flashdata('message', show_alert('Question successfully removed from your setting', 'success'));
                redirect('jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id=' . $this->data['jobpost_id']);
            }
        } else {
            $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
            redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
        }
    }

    function jobpost_question() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);

            $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['jobpostinfo'] = $check_post_exist;
            }

            $this->form_validation->set_rules('qn[]', 'jobpost_id', 'required');


            if ($this->form_validation->run() == true) {
                $jobpost_idpost = $this->input->post('jobpost_id');

                if (decode_id($jobpost_idpost) == $jobpost_id) {
                    if ($this->input->post('qn')) {
                        $question = $this->input->post('qn');
                        $insert = 0;
                        $array = array(
                            'jobpost_id' => $jobpost_id,
                            'createdby' => $current_user->id,
                        );
                        $counter = 0;
                        foreach ($question as $key => $value) {
                            $questioninfo = $this->jobpost_model->get_question($value)->row();
                            $array['section_id'] = $questioninfo->section_id;
                            $array['quest_cat'] = $questioninfo->quest_cat;
                            $array['qn_id'] = $value;
                            $add = $this->jobpost_model->jobpost_add_question($array);
                            if ($add) {
                                $counter++;
                            }
                        }

                        $this->session->set_flashdata('message', show_alert('Questions saved successfully !!', 'success'));
                        redirect('jobpost/?tabinfo=jobpost_add_edit_question&jobpost_id=' . encode_id($jobpost_id));
                    }
                } else {
                    $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                    redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
            redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
        }
    }

    function jobpost_location() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);

            $check_post_exist = $this->jobpost_model->get_jobpost_location($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['locationinfo'] = $check_post_exist;
                $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
                if ($check_post_exist) {
                    $this->data['jobpostinfo'] = $check_post_exist;
                }
            }
            $this->form_validation->set_rules('address', 'Address', 'required');

            if ($this->form_validation->run() == true) {
                $jobpost_idpost = $this->input->post('jobpost_id');

                if (decode_id($jobpost_idpost) == $jobpost_id) {
                    $array = array(
                        'jobpost_id' => $jobpost_id,
                        'address' => trim($this->input->post('address')),
                        'createdby' => $current_user->id
                    );

                    $add = $this->jobpost_model->jobpost_add_location($array);
                    if ($add) {
                        $this->session->set_flashdata('message', show_alert('Office Address information saved successfully !!', 'success'));
                        redirect('jobpost/?tabinfo=jobpost_question&jobpost_id=' . encode_id($jobpost_id));
                    } else {
                        $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                        redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                    redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
            redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
        }
    }

    function jobpost_target() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);

            $check_post_exist = $this->jobpost_model->get_jobpost_target($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['targetinfo'] = $check_post_exist;
                $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
                if ($check_post_exist) {
                    $this->data['jobpostinfo'] = $check_post_exist;
                }
            }

            $this->form_validation->set_rules('industry[]', 'Professional Industry', 'required');
            $this->form_validation->set_rules('category[]', 'Academic Category', 'required');
            $this->form_validation->set_rules('min_age', 'Minmum', 'required|integer');
            $this->form_validation->set_rules('max_age', 'Maxmun', 'required|integer');
            $this->form_validation->set_rules('nationality', 'Maxmun', 'required');
            $this->form_validation->set_rules('languages[]', 'Languages', 'required');

            if ($this->form_validation->run() == true) {
                $jobpost_idpost = $this->input->post('jobpost_id');

                if (decode_id($jobpost_idpost) == $jobpost_id) {
                    $category = array();
                    $sub_category = array();
                    foreach ($this->input->post('category') as $key => $value) {
                        $exp = explode('#', $value);
                        $category[] = $exp[0];
                        $sub_category[] = $exp[1];
                    }
                    $array = array(
                        'jobpost_id' => $jobpost_id,
                        'industry' => implode(',', $this->input->post('industry')),
                        'category' => implode(',', $category),
                        'sub_category' => implode(',', $sub_category),
                        'min_age' => $this->input->post('min_age'),
                        'max_age' => $this->input->post('max_age'),
                        'nationality' => $this->input->post('nationality'),
                        'languages' => implode(',', $this->input->post('languages')),
                        'location' => $this->input->post('location'),
                        'gender' => $this->input->post('gender'),
                        'createdby' => $current_user->id
                    );


                    $add = $this->jobpost_model->jobpost_add_target($array);
                    if ($add) {
                        $this->session->set_flashdata('message', show_alert('Job Post target information saved successfully !!', 'success'));
                        redirect('jobpost/?tabinfo=jobpost_location&jobpost_id=' . encode_id($jobpost_id));
                    } else {
                        $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                        redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                    redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
            redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
        }
    }

    function jobpost_salary() {
        $current_user = current_user();


        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);
            $check_post_exist = $this->jobpost_model->get_jobpost_salary($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['salaryinfo'] = $check_post_exist;

                $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
                if ($check_post_exist) {
                    $this->data['jobpostinfo'] = $check_post_exist;
                }
            }
            if (isset($_POST['amount'])) {
                $_POST['amount'] = str_replace(',', '', $_POST['amount']);
            }
            $this->form_validation->set_rules('currency', 'Currency', 'required');
            $this->form_validation->set_rules('amount', 'Amount', 'required|numeric');
            if ($this->input->post('benefit')) {
                $this->form_validation->set_rules('benefitlist[]', 'Benefits Items', 'required');
            }

            if ($this->form_validation->run() == true) {
                $jobpost_idpost = $this->input->post('jobpost_id');

                if (decode_id($jobpost_idpost) == $jobpost_id) {
                    $array = array(
                        'jobpost_id' => $jobpost_id,
                        'currency' => $this->input->post('currency'),
                        'amount' => $this->input->post('amount'),
                        'salary_type' => $this->input->post('salary_type'),
                        'is_benefit' => $this->input->post('benefit'),
                        'createdby' => $current_user->id
                    );

                    if ($this->input->post('benefit')) {
                        $array['benefit'] = implode(',', $this->input->post('benefitlist'));
                    }

                    $add = $this->jobpost_model->jobpost_add_salary($array);
                    if ($add) {
                        $this->session->set_flashdata('message', show_alert('Salary information saved successfully !!', 'success'));
                        redirect('jobpost/?tabinfo=jobpost_target&jobpost_id=' . encode_id($jobpost_id));
                    } else {
                        $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                        redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                    }
                } else {
                    $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
                    redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
                }
            }
        } else {
            $this->session->set_flashdata('message', show_error('This form post did not pass our security checks.', 'warning'));
            redirect('jobpost/?tabinfo=jobpost_basic', 'refresh');
        }
    }

    function jobpost_basic() {
        $current_user = current_user();
        $jobpost_id = 0;
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);
            $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();
            if ($check_post_exist) {
                $this->data['jobpostinfo'] = $check_post_exist;
            }
        }
        if ($this->input->post('savedata')) {



            $year = date('Y');
            if ($this->input->post('year')) {
                $year = $this->input->post('year');
            }

            $month = date('m');
            if ($this->input->post('month')) {
                $month = $this->input->post('month');
            }

            $day = date('d');
            if ($this->input->post('day')) {
                $day = $this->input->post('day');
            }

            $_POST['deadline'] = $year . '-' . $month . '-' . $day;
        }

        $this->form_validation->set_rules('listing', 'Listing Type', 'required');
        $this->form_validation->set_rules('recruiter', 'Recruiter', 'required');
        $this->form_validation->set_rules('academic[]', 'Academic', 'required');
        $this->form_validation->set_rules('academic_level[]', 'Academic Level', 'required');
        $this->form_validation->set_rules('experience', 'Experience', 'required');
        $this->form_validation->set_rules('jobtitle', 'Job Title', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_rules('position_type', 'Hours', 'required');
        $this->form_validation->set_rules('jobpost_introduction', 'Job Introduction', 'required');
        $this->form_validation->set_rules('jobpost_description', 'Job Description', 'required');
        $this->form_validation->set_rules('skills[]', 'Skills', 'required');
        $this->form_validation->set_rules('deadline', 'Skills', 'required');

        if ($this->form_validation->run() == true) {
            $jobpost_idpost = $this->input->post('jobpost_id');

            if (decode_id($jobpost_idpost) == $jobpost_id) {


                //Academic Qualifications
                $programmeinfo = $this->input->post('academic');
                $prog_array = array();
                foreach ($programmeinfo as $key => $value) {
                    if (!is_numeric($value)) {
                        $prog_array[] = $this->common_model->autosuggest_check('programme', array('name' => $value));
                    } else {
                        $this->db->where(array('id' => $value));
                        $result = $this->db->get('programme')->row();
                        if ($result) {
                            $prog_array[] = $result->id;
                        }
                    }
                }


                //Academic Levels
                $skillsinfo = $this->input->post('skills');

                $skill_array = array();
                foreach ($skillsinfo as $key => $value) {
                    if (!is_numeric($value)) {
                        $skill_array[] = $this->common_model->autosuggest_check('skills', array('name' => $value));
                    } else {
                        $this->db->where(array('id' => $value));
                        $result = $this->db->get('skills')->row();
                        if ($result) {
                            $skill_array[] = $result->id;
                        }
                    }
                }


                $array = array(
                    'listing' => $this->input->post('listing'),
                    'recruiter' => $this->input->post('recruiter'),
                    'academic_level' => implode(',', $this->input->post('academic_level')),
                    'academic' => implode(',', $prog_array),
                    'experience' => $this->input->post('experience'),
                    'jobtitle' => $this->input->post('jobtitle'),
                    'level' => $this->input->post('level'),
                    'position_type' => $this->input->post('position_type'),
                    'introduction' => $this->input->post('jobpost_introduction'),
                    'description' => $this->input->post('jobpost_description'),
                    'skills' => implode(',', $skill_array),
                    'deadline' => $this->input->post('deadline'),
                    'createdby' => $current_user->id
                );
                $add = $this->jobpost_model->create_job_basicinfo($array, $jobpost_id);
                if ($add) {
                    $this->session->set_flashdata('message', show_alert('Job Post Basic information saved successfully !!', 'success'));
                    redirect('jobpost/?tabinfo=jobpost_salary&jobpost_id=' . encode_id($add));
                }
            } else {
                $this->data['message'] = show_alert('This form post did not pass our security checks.', 'warning');
            }
        }
    }

    function view_jobpost() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);
            if (!is_null($jobpost_id)) {
                $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();

                if ($check_post_exist) {
                    //share_view_count
                    $array = array(
                        'user_id' => $current_user->id,
                        'reference' => $jobpost_id,
                        'type' => 'JOBPOST',
                        'action' => 'VIEW'
                    );

                    $this->common_model->view_share_count_insert($array);

                    $this->data['jobpostinfo'] = $check_post_exist;
                    $this->data['left_content'] = 'left_column/menu';
                    $this->data['advert_content'] = 'right_column/jobs_advert';
                    $this->data['section_middle_content'] = 'middle_column/jobpost/view_jobpost/view_job_post_content';
                    $this->data['middle_content'] = 'middle_content';
                    $this->load->view('template', $this->data);
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    function apply_job() {
        $current_user = current_user();
        if (isset($_GET['jobpost_id']) && $_GET['jobpost_id'] <> '') {
            $this->data['jobpost_id'] = $_GET['jobpost_id'];
            $jobpost_id = decode_id($_GET['jobpost_id']);
            if (!is_null($jobpost_id)) {
                $check_post_exist = $this->jobpost_model->get_jobpost($jobpost_id)->row();

                if ($check_post_exist) {
                    //share_view_count
                    if ($this->input->post('mybutton')) {
                        if (!is_applied($current_user->id, $jobpost_id)) {
                            $answer = $this->input->post('answer');
                            $action_id = 'BIZ' . time() . 'HURU' . $current_user->id;
                            $answer_qn = array(
                                'jobpost_id' => $jobpost_id,
                                'createdby' => $current_user->id,
                                'action_id' => $action_id
                            );
                            $apply_post = array(
                                'jobpost_id' => $jobpost_id,
                                'postedby' => $check_post_exist->createdby,
                                'applicant' => $current_user->id,
                                'action_id' => $action_id
                            );
                            $this->db->insert('jobpost_application', $apply_post);
                            if (is_array($answer)) {
                                foreach ($answer as $key => $value) {
                                    $answer_qn['answer'] = $value;
                                    $answer_qn['jobpost_question_id'] = $key;
                                    $this->db->insert('jobpost_apply_answer', $answer_qn);
                                }
                            } else {

                                $this->form_validation->set_rules('answer', 'Above', 'required');

                                if ($this->form_validation->run() == true) {
                                    $answer_qn['answer'] = $answer;
                                    $answer_qn['jobpost_question_id'] = 0;
                                    $this->db->insert('jobpost_apply_answer', $answer_qn);
                                }
                            }

                            $this->session->set_flashdata('message', show_alert('Job Application successfully submitted', 'success'));
                            redirect('view_jobpost/?jobpost_id=' . $this->data['jobpost_id'], 'refresh');
                        } else {
                            $this->session->set_flashdata('message', show_alert('The action post did not pass our security checks.', 'error'));
                            redirect('view_jobpost/?jobpost_id=' . $this->data['jobpost_id'], 'refresh');
                        }
                    }

                    $this->data['jobpostinfo'] = $check_post_exist;
                    $this->data['left_content'] = 'left_column/menu';
                    $this->data['advert_content'] = 'right_column/jobs_advert';
                    $this->data['section_middle_content'] = 'middle_column/jobpost/apply_job/apply_job_content';
                    $this->data['middle_content'] = 'middle_content';
                    $this->load->view('template', $this->data);
                } else {
                    show_404();
                }
            } else {
                show_404();
            }
        } else {
            show_404();
        }
    }

    function jobpost_list() {
        $current_user = current_user();
        $this->data['left_active_link'] = 'jobpost_list';


        $this->data['left_content'] = 'left_column/menu';
        $this->data['advert_content'] = 'right_column/jobs_advert';
        $this->data['section_middle_content'] = 'middle_column/jobpost/view_jobpost/jobpost_list_content';
        $this->data['middle_content'] = 'middle_content';
        $this->load->view('template', $this->data);
    }

    function pull_jobpost() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');
        if ($current_user) {
            $lastidload = $_POST['lastidload'];
            $jobpost_cat = $_POST['cat_id'];
            if ($jobpost_cat > 0) {
                
            } else {
                $jobpost_cat = null;
            }

            $is_scroll = $_POST['is_scroll'];
            if ($is_scroll == 'RESET') {
                $lastidload = 0;
            }

            $lastidloadx = ($lastidload == 0 ? 0 : ($lastidload * NO_JOBPOST_PER_PAGE));
            $today = date('Y-m-d');
            $sql = "SELECT jt.* FROM jobpost_target as jt INNER JOIN jobpost as jp ON jt.jobpost_id=jp.id WHERE jp.deadline > '$today' AND jp.status=1";
            if (!is_null($jobpost_cat)) {
                $sql.=" AND $jobpost_cat IN (jt.industry) ";
            }
            $sql.=" ORDER BY jp.publishedon ASC   LIMIT $lastidloadx," . NO_JOBPOST_PER_PAGE;


            $result = $this->db->query($sql)->result();
            $view = '';

            if (count($result) > 0) {
                $lastidloadx+=1;

                foreach ($result as $key => $value) {
                    $jobpostinfo = $this->jobpost_model->get_jobpost($value->jobpost_id)->row();
                    $location = $this->jobpost_model->get_jobpost_location($value->jobpost_id)->row();
                    $postedby = current_user($jobpostinfo->createdby);
                    $view.='<div class="jobpost_item_list">';
                    $view.='<span class="pull-right text-bizhuru" style="font-size: 12px;">';
                    $date2 = date('Y-m-d');
                    if ($jobpostinfo->status == 2) {
                        $view.= '<b>CLOSED</b>';
                    } else {
                        $view.=jobpost_remain_time($date2, $jobpostinfo->deadline);
                    }
                    $view.='</span> <div class="clearboth"></div>';
                    $view.='<div class="jobpost_item_list_company">
                            <img src="' . PROFILE_IMG_PATH . $postedby->profile_photo . '"/>
                        </div>';
                    $view.='<div class="jobpost_item_list_description">
                      
                         <div class="comp_name_job">' . $postedby->firstname . ' ' . $postedby->lastname . '</div>';
                    $view .= ' <div class="cvfullviewrow"><span class="cvlabel">Job Title </span> : ' . $jobpostinfo->jobtitle . ' - ' . get_value('work_level', $jobpostinfo->level, 'name') . '</div> 
  <div class="cvfullviewrow"><span class="cvlabel">Hours (Status) </span> : ' . get_value('position_type', $jobpostinfo->position_type, 'name') . '</div> 
      <div class="cvfullviewrow"><span class="cvlabel">Location </span> : ' . (($location) ? $location->address : 'Any Location') . '</div> 
    <div class="cvfullviewrow" style="text-align:right;"><a  href="' . site_url('view_jobpost/?jobpost_id=' . encode_id($value->jobpost_id)) . '">Read more...</a></div>';


                    $view .= '</div>';

                    $view.='<div class="clearboth"></div>';

                    $view.='</div>';
                }

                $return['lastidload'] = ($lastidload + 1);
                $view.='<br/><div class="clearboth page_separator"><span class="paginationno"><span>End of page ' . ($lastidload + 1) . '</span></span></div><br/>';

                $return['status_server'] = 1;
            } else {
                if ($is_scroll == 'YES') {
                    if ($lastidload > 0) {
                        $view = show_alert('No more job post found....', 'info');
                    } else {
                        $view = '';
                    }
                    $return['status_server'] = 2;
                } else {
                    $return['status_server'] = 1;
                    $view = show_alert('No job post available in selected category', 'info');
                }
            }

            $return['msg'] = $view;
        } else {
            $return['msg'] = "Session expired !, Please login again";
        }

        echo json_encode($return);
    }

}
