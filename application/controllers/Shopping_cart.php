<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shopping_cart
 *
 * @author miltone
 */
class Shopping_cart extends CI_Controller {

    //put your code 
    //
    function __construct() {
        parent::__construct();
        $this->load->library('cart');
        $this->form_validation->set_error_delimiters('<div class="form-error">', '</div>');
        if (!current_user_fullregistered()) {
            
        }

        $this->load->model('ShoppingCart_model');
    }

    function cart_purchase() {
        $current_user = current_user();
        $accountbalance = account_balance($current_user->id);
        $cart_summary = cart_purchase_summary();
        if ($accountbalance->cvs >= $cart_summary->cvs && $accountbalance->profile >= $cart_summary->profile && $accountbalance->ads >= $cart_summary->ads && $accountbalance->jobpost >= $cart_summary->jobpost) {
            //everythigs is fine.. Allow purchase
            $total_items = $this->cart->total_items();
            $start = 0;
            $trans_id = $current_user->id . time() . mt_rand();
            foreach ($this->cart->contents() as $item) {

                if ($item['type'] == 'USER' || $item['type'] == 'PAGE') {
                    $purchase = $this->ShoppingCart_model->purchase_cv($item, $trans_id, $current_user->id);
                    if ($purchase) {
                        $start++;
                        $this->cart->remove($item['rowid']);
                    }
                } else if ($item['type'] == 'JOBPOST') {
                    $purchase = $this->ShoppingCart_model->advertise_jobpost($item, $trans_id, $current_user->id);
                    if ($purchase) {
                        $start++;
                        $this->cart->remove($item['rowid']);
                    }
                }
            }

            if ($start == $total_items) {
                $this->session->set_flashdata('message', show_alert('Congratulations, Cart processed successfully', 'success'));
                redirect('mystore/?tabinfo=recent_purchased&transid=' . $trans_id, 'refresh');
            } else if ($start == 0) {
                $this->session->set_flashdata('message', show_alert('Fail to process data in Cart ', 'warning'));
                redirect('cart_checkout', 'refresh');
            } else {
                $this->session->set_flashdata('message', show_alert('Some of the Item in cart fail to process', 'info'));
                redirect('cart_checkout', 'refresh');
            }
        } else {
            $this->session->set_flashdata('message', show_alert('Insufficient credits in your account balance, Please credit your account first', 'warning'));
            redirect('credit_package/?function=cart_purchase', 'refresh');
        }
    }

    function cart_item_remove($row_id) {
        $remove = $this->cart->remove($row_id);
        redirect('cart_checkout', 'refresh');
    }

    function cart_checkout() {


        $current_user = current_user();
        $this->data['left_content'] = 'left_column/menu';

        $this->data['section_middle_content'] = 'middle_column/check_out/check_out_content';
        $this->data['middle_content'] = 'middle_content';
        $this->data['hide_cart_checkout'] = 1;
        $this->load->view('template', $this->data);
    }

    function cv_no_exist_in_cart($cv_no) {
        $cart_data = $this->cart->contents();
        foreach ($cart_data as $item) {
            if ($item['id'] == 'sku_' . $cv_no) {
                return TRUE;
                break;
            }
        }

        return FALSE;
    }

    function addto_cart() {
        $current_user = is_user_loggedin_ajax();
        $return = array('status_server' => 0, 'msg' => '');

        if ($current_user) {
            $cv_no = $_POST['cv_no'];
            $type = $_POST['type'];

            $array = array(
                'id' => ($type == 'JOBPOST' ? 'job_' : ( $type == 'ADS' ? 'ads_' : 'sku_')) . $cv_no,
                'qty' => 1,
                'price' => CV_PRICE_USD,
                'name' => $cv_no,
                'type' => $type
            );

            if (!$this->cv_no_exist_in_cart($cv_no)) {
                $add = $this->cart->insert($array);
                if ($add) {
                    $return['status_server'] = 1;
                    $return['msg'] = $this->cart->total_items();
                    $return['msg2'] = '<img src="' . base_url() . 'media/img/tick.png"/> Added successfully';
                } else {
                    $return['status_server'] = 0;
                    $return['msg2'] = '<img src="' . base_url() . 'media/img/warning.png"/> Fail to add in cart';
                }
            } else {
                $return['status_server'] = 0;
                $return['msg2'] = '<img src="' . base_url() . 'media/img/warning.png"/> CV already exist in cart';
            }
        } else {
            $return['msg'] = 'Session expired!, Please login again';
        }
        echo json_encode($return);
    }

}
