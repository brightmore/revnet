<?php

 function RentExpiriedIN30days(){
     $CI =& get_instance();
     
     $data = array();
     $query = $CI->db->query('SELECT');
 }

 function rentExpiriedIN20days(){
     $CI =& get_instance();  
     $data = array();
     $query = $CI->db->query('SELECT'); 
 }
 
 function rentExpiriedIN10days(){
     $CI =& get_instance();  
     $data = array();
     $query = $CI->db->query('SELECT');
 }
 
 function rentExpiriedIN5days(){
     $CI =& get_instance();  
     $data = array();
     $query = $CI->db->query('SELECT');
 }
 
 if(function_exists('alpha_space_numeric')){
     function alpha_space_numeric($str){
          $CI =& get_instance();
          if(! preg_match('/^[a-zA-Z\s_\d-]+$/', $str)){
              $CI->form_validation->set_rules('alpa_space_numeric','The %s provided was invalid. It must contains letter,number and space only');
              return FALSE;
          }
          return TRUE;
     }
 }
 
 if(function_exists('valid_name')){
     function valid_name($str){
         $CI =& get_instance();
         if(! preg_match("/^[a-zA-Z]{1}[']?[a-zA-Z]+$/", $str)){
            $CI->form_validation->set_rules('valid_name','The %s provided was invalid.');
              return FALSE; 
         }
         
         return TRUE;
     }
 }
 
 if(function_exists('valid_contact')){
     function valid_contact($str){
         $CI =& get_instance();
         if(!preg_match('/^[\d]{3}[\ \-][\d]+$/', $str)){
             $CI->form_validation->set_rules('valid_name','The %s provided was invalid.');
              return FALSE; 
         }
         
         return TRUE;
     }
 }
 