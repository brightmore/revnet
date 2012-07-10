<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Finance
 *
 * @author Brightmore
 */
class MFinance extends Model  {
    public function __construct() {
        parent::__construct();
    }
    
    function getCommissionsAllClientInMonth($month,$year){
        $data = array();
        $query = $this->db->query('SELECT name,commission,contact,email,location 
            FROM commissions JOIN branches ON branches.branchcode = commissions.branchcode 
            WHERE month = ? AND year = ?',array($month,$year));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getCommissionsAllClientInYear($year){
        $data = array();
        $query = $this->db->query('SELECT name,commission,contact,email,location 
                                   FROM commissions JOIN branches ON branches.branchcode = commissions.branchcode
                                   WHERE year = ?',array($year));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getCommissionsClientsBranchInMonth($month,$year){
        $data = array();
        $query = $this->db->query('SELECT name,commission,contact,email,location 
                                   FROM commissions JOIN branches ON branches.branchcode = commissions.branchcode
                                   WHERE month = ? AND year = ?',array($month,$year));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getHighestCommissionInMonthBranch($month,$year,$branch){
        $data = array();
        $row = $this->db->query('SELECT name,MAX(commission) as highestCommission FROM commissions  JOIN USING(clientcode)
                                 WHERE branchcode = ? AND month = ? AND year = ?',array($branch,$month,$year))->row();
        if($row->num_rows()){
            return $data[$row->name] = $row->highestCommission;
        }
    }
    
}

