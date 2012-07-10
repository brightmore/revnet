<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MCorporateAffairs
 *
 * @author Brightmore
 */
class MCorporateAffairs extends Model {
    public function __construct() {
        parent::__construct();
    }
    
    function allExistingContracts(){
        $data = array();
        $query =  $this->db->query('SELECT name,datacommenced,expirydate,location,branches.branchcode FROM contracts 
                                    INNER JOIN branches ON branches.branchcode = contracts.branchcode
                                    INNER JOIN client ON clientcode = contracts.clientcode WHERE status = "existing"');
        if($query->num_rows()){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function allExistingContractBranch($branchcode){
        $data = array();
        $query =  $this->db->query('SELECT name,datacommenced,expirydate FROM contracts 
                                    INNER JOIN branches ON branches.branchcode = contracts.branchcode
                                    INNER JOIN client ON clientcode = contracts.clientcode 
                                    WHERE branches.branchcode = ? AND status = "existing" OR status = "renewal"',array($branchcode));
        if($query->num_rows()){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function allExpiryContracts(){
        $data = array();
        $query =  $this->db->query('SELECT name,datacommenced,expirydate,location,branches.branchcode FROM contracts 
                                    INNER JOIN branches ON branches.branchcode = contracts.branchcode
                                    INNER JOIN client ON clientcode = contracts.clientcode 
                                    WHERE status = "expiring"');
        if($query->num_rows()){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function allExpiryContractsBranch($branchcode){
        $data = array();
        $query =  $this->db->query('SELECT name,datacommenced,expirydate FROM contracts 
                                    INNER JOIN branches ON branches.branchcode = contracts.branchcode
                                    INNER JOIN client ON clientcode = contracts.clientcode 
                                    WHERE branches.branchcode = ? AND (status = "expiring" AND branches.branchcode = ?)',
                                    array($branchcode));
        if($query->num_rows()){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function allRenewalContractBranch($branchcode,$month,$year){
       $data = array();
        $query =  $this->db->query('SELECT name,datacommenced,expirydate FROM contracts 
                                    INNER JOIN branches ON branches.branchcode = contracts.branchcode
                                    INNER JOIN client ON clientcode = contracts.clientcode 
                                    WHERE branches.branchcode = ? AND (status = "renewal" AND branches.branchcode = ?) AND(month = ? AND = ?)',
                                    array($branchcode,$month,$year));
        if($query->num_rows()){
            $data = $query->results();
        }
        
        return $data; 
    }
    
    function allRenewalContract(){
        $data = array();
        $query =  $this->db->query('SELECT name,datacommenced,expirydate,location,branches.branchcode FROM contracts 
                                    INNER JOIN branches ON branches.branchcode = contracts.branchcode
                                    INNER JOIN client ON clientcode = contracts.clientcode 
                                    WHERE branches.branchcode = ? AND (status = "renewal" AND branches.branchcode = ?)');
        if($query->num_rows()){
            $data = $query->results();
        }
        
        return $data; 
    }
    
}


