<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MBusinessDevt
 *
 * @author Brightmore
 */
class MBusinessDevt extends CI_Model{
    public function __construct() {
        parent::__construct();
    }
    
    function getEpccCardsIssuedInMonthAll($month){
        $data = array();
        $query = $this->db->query('SELECT e.id,location,b.branchcode,epccIssued FROM epccIssued e
                                   INNER JOIN branches AS b ON e.branchcode = b.branchcode  
                                   WHERE month = ? ORDER BY epccIssued,location',array($month));
        if($query->num_rows() > 0){
            $data = $query->result();
        }
        
        return $data;
    }
    
    function getEpccCardsRequestedInMonthAll($month){
         $data = array();
        $query = $this->db->query('SELECT location,branchcode,epccRequest FROM epccRequested AS e 
                                   INNER JOIN branches AS b ON e.branchcode = b.branchcode  
                                   WHERE month = ? ORDER BY epccRequest,location',array($month));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getEpccCardsRequestedInMonth($branch,$month){
         $data = array();
        $query = $this->db->query('SELECT e.id,location,branchcode,epccRequest FROM epccRequested AS e 
                                   INNER JOIN branches AS b ON e.branchcode = b.branchcode  
                                   WHERE month = ? AND e.branchcode = ?',array($month,$branch));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
     function getEpccCardsIssuedInMonth($month,$branch){
        $data = array();
        $query = $this->db->query('SELECT e.id,location,branchcode,epccIssued FROM epccIssued 
                                   INNER JOIN branches AS b ON e.branchcode = b.branchcode  
                                   WHERE month = ? AND b.branchcode = ?',array($month,$branch));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getEpccCardsIssuedInYear($year){
        $data = array();
        $query = $this->db->query('SELECT e.id,location,b.branchcode,sum(epccIssued) AS totalIssued,AVG(epccIssued) AS average FROM epccIssued 
                                   INNER JOIN branches AS b ON e.branchcode = b.branchcode
                                   GROUP BY b.branchcode
                                   WHERE year = ?',array($year));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getEpccCardsRequestInYear($year){
         $data = array();
        $query = $this->db->query('SELECT location,b.branchcode,sum(epccRequested) AS totalIssued,AVG(epccRequested) AS average FROM epccRequest 
                                   INNER JOIN branches AS b ON e.branchcode = b.branchcode 
                                   GROUP BY b.branchcode
                                   WHERE year = ?',array($year));
        if($query->num_rows() > 0){
            $data = $query->results();
        }
        
        return $data;
    }
    
    function getTotalEpccCardIssued($month,$year){
        $data =array();
        $row  = $this->db->query('SELECT sum(epccIssued) as totalIssued,AVG(epccIssued) AS average 
                                  FROM epccIssued WHERE month = ? AND year = ?',array($month,$year));
        if($row->num_rows()){
            $data = $row->result();
        }
        
        return $data;
    }
    
    function getTotalEpccCardRequsted($month,$year){
        $data =array();
        $row  = $this->db->query('SELECT sum(epccRequested) AS totalRequested,AVG(epccRequested) AS average 
                                  FROM epccRequested WHERE month = ? AND year = ?',array($month,$year));
        if($row->num_rows()){
            $data = $row->result();
        }
        
        return $data;
    }
    
    function getTotalEpccCardIssuedInBra($month,$year){
        
    }
    
    function trainingForStaffsInBranches($month,$year){
        $data = array();
        $query = $this->db->query('SELECT *,location FROM training AS t,branches AS b 
                                    WHERE type = "staff" AND t.branchcode = b.branchcode
                                    AND (month = ? AND year = ?)',array($month,$year));
        if($query->num_rows()){
            $data = $query->result();
        }
        
        return $data;
    }
    
    function getNumberTrainingOrganizedForStakeholderInMonth($month,$year)
    {
        $count = 0;
        $count = $this->db->query('SELECT count(*) AS total FROM training 
                                    WHERE type = "Stakeholder" 
                                    AND (month = ? AND year = ?)',array($month,$year))->row()->total;
        
        return $count;
    }
    
    function getNumberTrainingOrganizedForStaffInMonth($month,$year)
    {
        $count = 0;
        $count = $this->db->query('SELECT count(*) AS total FROM training 
                                    WHERE type = "Staff" 
                                    AND (month = ? AND year = ?)',array($month,$year))->row()->total;
        
       return $count;
    }
    
     function trainingForStakeholderInBranches($month,$year)
     {
        $data = array();
        $query = $this->db->query('SELECT *,location FROM training AS t,branches AS b 
                                    WHERE type = "Stakeholder" AND t.branchcode = b.branchcode
                                    AND (month = ? AND year = ?)',array($month,$year));
        if($query->num_rows()){
            $data = $query->result();
        }
        
        return $data;
    }
    
    function getAllTraining($month,$year,$sortby){
         $data = array();
        $query = $this->db->query('SELECT id,topic,totalPeopleTrained,type,note,dateEnd,dateStart,b.branchcode,location 
                                   FROM training AS t INNER JOIN branches AS b ON  t.branchcode = b.branchcode
                                   WHERE (month = ? AND year = ?) ORDER BY ?',array($month,$year,$sortby));
        if($query->num_rows()){
            $data = $query->result();
        }
        
        return $data;
    }
    
    function getTrainingDetail($id)
    {
        $row = null;
        $query = $this->db->query('SELECT topic,dateEnd,note,dateStart,totalPeopleTrained,type,location FROM training t 
                                    INNER JOIN branches b ON t.branchcode = b.branchcode WHERE t.id = ?',array('id'=>$id));
        if($query->num_rows() > 0){
            $row = $query->row();
        }
        
        return $row;
    }
    
    function getTraining($id){
        $row = null;
        $query = $this->db->query('SELECT id,topic,dateEnd,note,dateStart,totalPeopleTrained,type FROM training WHERE id = ?',$id);
        if($query->num_rows > 0){
            $row = $query->row();
        }
        
       return $row;
    }
}

