<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Miscfunctions
 *
 * @author Brightmore
 */
class Miscfunctions extends CI_Model {
    public function __construct() {
        parent::__construct();
       
    }
    
    public function getBranches()
    {
        $data = array();
        $query = $this->db->query('SELECT branchcode,location FROM branches');
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $data[$row->branchcode] = $row->location;
            }
        }
        
        return $data;
    }
    
    function resources($user){
        
    }
    
    function benchmark()
    {
        
    }
}

?>
