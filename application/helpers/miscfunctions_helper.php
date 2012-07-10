<?php

function getMonthName($monthDigit) {
    $month[1] = 'January';
    $month[2] = 'February';
    $month[3] = 'March';
    $month[4] = 'April';
    $month[5] = 'May';
    $month[6] = 'June';
    $month[7] = 'July';
    $month[8] = 'August';
    $month[9] = 'September';
    $month[10] = 'October';
    $month[11] = 'Nevember';
    $month[12] = 'December';

    return $month[$monthDigit];
}

if (!function_exists('validDate')) {

    function validDate($str) {

        $split = split(' \\/-', $str);
        $month = $split[1];
        $day = $split[0];
        $year = $split[2];

        if (! checkdate($month, $day, $year)) {
            $this->form_validation->set_message('validDate', 'The %s provided is invalid date.');
            return FALSE;
        }

        return true;
    }
}

function message() {
    $CI =& get_instance();
    if ($CI->session->flashdata('error')) {
        echo heading($CI->session->flashdata('error'), 4, array('class' => 'alert_error'));
    } elseif ($CI->session->flashdata('warning')) {
        echo heading($CI->session->flashdata('warning'), 4, array('class' => 'alert_warning'));
    } elseif ($CI->session->flashdata('success')) {
        echo heading($CI->session->flashdata('success'), 4, array('class' => 'alert_success'));
    }elseif ($CI->session->flashdata('info')) {
        echo heading($CI->session->flashdata('info'), 4, array('class' => 'alert_info'));
    }
}

function decode($str){
    $CI =& get_instance();
    $CI->load->library('encryption');
    
    $CI->encryption->decode($str);
}

function encode($str){
    $CI =& get_instance();
    $CI->load->library('encryption');
    
    $CI->encryption->encode($str);
}

function allBranches(){
    $CI =& get_instance();
    $query = $CI->db->query('SELECT * From branches');
    $data = array();
    
    if($query->num_rows()){
        foreach ($query->result() as $value) {
            $data[$value->branchcode] = $value->location;
        }
    }
    
    $query->free_result();
    return $data;
}

function departments()
{
     $CI =& get_instance();
     $data = array();
     $q = $CI->db->query('SELECT * FROM departments');
     if($q->num_rows()){
         foreach($q->result() as $value){
             $data[$value->depcode] = $value->depname;
         }
         
         return $data;
     }
     
     $q->free_result();
     return $data;
}

function  validBranchcode($str){
     $CI =& get_instance();
    if(! array_key_exists($str, allBranches())){
       $CI->form_validation->set_rules('validBranchcode','The %s selected was invalid.');
              return FALSE; 
    }
    
    return TRUE;
}