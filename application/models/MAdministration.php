<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MAdministration
 *
 * @author Brightmore
 */
class MAdministration extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function getVehiclesPerBranch($branchCode) {
        $data = array();
        $q = $this->db->query('SELECT vehicle.*,location FROM vehicle INNER JOIN branches 
                                  USING(branchCode) WHERE branches.branchCode = ?', array($branchCode));
        if ($q->num_rows()) {
            return $q->result();
        } else {
            return $data;
        }
    }

    function getVehiclesInAllBranches() {
        $data = array();
        $query = $this->db->query('SELECT vehicle.*,location FROM vehicle INNER JOIN branches USING(branchcode)');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return $data;
        }
    }

    function getTotalVehiclePerBranch($branchCode) {
        $total = NULL;
        $query = $this->db->query('SELECT sum(total) as totalVehicle FROM 
           vehicle WHERE branchcode = ?', array($branchCode))->row();
        return $total = $query->totalVehicle;
    }

    function getVehicle($registrationNo) {
        $data = array();
        $query = $this->db->query('SELECT vehicle.*,location FROM vehicle INNER JOIN branches 
                                   USING(branchcode) WHERE registrationNo = ?', array($registrationNo));
        if ($query->num_rows()) {
            $data = $query->row();
        }

        return $data;
    }

    function getTotalVehicle() {
        $total = NULL;
        $query = $this->db->query('SELECT sum(total) as totalVehicle FROM vehicles')->row();
        return $total = $query->totalVehicle;
    }

    function getTotalStaffs() {
        $staffsTotal = $this->db->query('SELECT count(*) as totalCount From staff WHERE staffcode 
                                        NOT IN(SELECT staffcode FROM staffstate 
                                        WHERE status = "RESIGNATION" AND status = "TERMINATION")')->row()->totalCount;
        return $staffsTotal;
    }

    function getTotalStaffsAtBranch($branchCode, $month, $year) {

        $staffsTotal = $this->db->query('SELECT count(*) as totalCount From staff WHERE staffcode 
                                         NOT IN(SELECT staffcode FROM staffstate 
                                         WHERE status = "RESIGNATION" OR status ="TERMINATION" ) AND branchcode = ? 
                                         AND (month = ? AND year = ?)', array($branchCode, $month, $year))->row()->totalCount;
        return $staffsTotal;
    }

    function getStaffsInBranch($brancode, $limit, $offset) {
        $date = getdate();
        $data = array();
        $month = $date['mon'];
        $year = $date['year'];
        $queryActive = $this->db->query('SELECT name,date,contact,depName,location FROM staff,departments,staffstate
                                              WHERE departments.depcode = staff.depcode AND
                                              NOT IN( WHERE status = "RESIGNATION" OR status ="TERMINATION" ) 
                                              AND branches.branchcode = staff.branchcode
                                              AND (month = ? AND year = ?) AND branchcode = ? LIMIT ?,?', array($month, $year, $brancode, $limit, $offset));
        if ($queryActive->num_rows()) {
            $data = $queryActive->result();
        }

        return $data;
    }

    function getAllActiveStaffs($num, $offset) {
        $data = array();
        $query = $this->db->query('SELECT s.branchcode,s.contact,b.location,s.staffCode,s.id,s.dateHired,s.depCode,s.name,s.email,s.address From staff AS s INNER JOIN branches AS b using(branchcode) WHERE staffcode 
                                    NOT IN(SELECT staffcode FROM staffstate 
                                    WHERE status = "RESIGNATION" AND status = "TERMINATION") ORDER BY s.name LIMIT ?, ?', array($offset, $num));
        if ($query->num_rows()) {
            $data = $query->result();
        }

        return $data;
    }

    function getTotalStaffResigned($branchCode, $month, $year) {
        $staffsTotal = $this->db->query('SELECT count(*) as totalCount From staff WHERE staffcode 
                                         NOT IN(SELECT staffcode FROM staffstate 
                                         WHERE status = "RESIGNATION")AND (staff.branchcode = ? AND month = ? AND year = ?)', array($branchCode, $month, $year))->row()->totalCount;
        return $staffsTotal;
    }

    function getTotalStaffTerminated($branchCode, $month, $year) {
        $staffsTotal = $this->db->query('SELECT count(*) as totalCount From staff WHERE staffcode 
                                  NOT IN(SELECT staffcode FROM staffstate 
                                  WHERE status = "TERMINATION") AND (staff.branchcode = ? AND month = ? AND year = ?)', array($branchCode, $month, $year))->row()->totalCount;
        return $staffsTotal;
    }

    /*
     * @param : branchcode - default = all
     * @param : month
     * @param : year
     * @param : isAll - if true it will pull all records without any restriction
     */
    function getStaffTerminated($branchCode = 'all', $month = 0, $year = 0,$isAll = false) {
        $data = array();
        $query = NULL;
        if ($branchCode == 'all') {
            
            if($isAll){
                 $query = $this->db->query('SELECT name,date,contact,depName FROM staff,departments,staffstate
                                   WHERE departments.depcode = staff.depcode AND
                                  NOT IN(SELECT staffcode FROM staffstate WHERE status = "TERMINATION" )');
            }else{
                $query = $this->db->query('SELECT name,date,contact,depName FROM staff,departments,staffstate
                                   WHERE departments.depcode = staff.depcode AND
                                  NOT IN(SELECT staffcode FROM staffstate WHERE status = "TERMINATION" )
                                  AND (month = ? AND year = ?)', array($month, $year));
            }
            
            
        } else {
            $query = $this->db->query('SELECT name,date,contact,depName FROM staff,departments,staffstate
                                   WHERE departments.depcode = staff.depcode AND
                                  NOT IN(SELECT staffcode FROM staffstate WHERE status = "TERMINATION" )
                                  AND (staff.branchcode = ? AND month = ? AND year = ?)', array($branchCode, $month, $year));
        }
        
        if ($query->num_row() > 0) {
            $data = $query->results();
        }
        
        return $data;
    }

    function branchAnalysisInMonth() {
        
    }

    function branchStaffAnalysis() {
        $data = array();
        $termination = array();
        $resignation = array();
        $active = array();
        $date = getdate();
        $month = $date['mon'];
        $year = $date['year'];

        $this->db->trans_start();

        $queryTermination = $this->db->query('SELECT name,date,contact,depName,location FROM staff,departments,staffstate
                                              WHERE departments.depcode = staff.depcode AND
                                              NOT IN(SELECT staffcode FROM staffstate WHERE status = "TERMINATION" ) 
                                              AND branches.branchcode = staff.branchcode
                                              AND (staff.branchcode = ? AND month = ? AND year = ?)', array($month, $year));
        $queryResignation = $this->db->query('SELECT name,date,contact,depName,location FROM staff,departments,staffstate
                                              WHERE departments.depcode = staff.depcode AND
                                              NOT IN(SELECT staffcode FROM staffstate WHERE status = "Resignation" ) 
                                              AND branches.branchcode = staff.branchcode
                                              AND (month = ? AND year = ?)', array($month, $year));
        $queryActive = $this->db->query('SELECT name,date,contact,depName,location FROM staff,departments,staffstate
                                              WHERE departments.depcode = staff.depcode AND
                                              NOT IN( WHERE status = "RESIGNATION" OR status ="TERMINATION" ) 
                                              AND branches.branchcode = staff.branchcode
                                              AND (month = ? AND year = ?)', array($month, $year));
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            return false;
        }

        if ($queryTermination->num_rows()) {
            $termination = $queryTermination->result();
        } else {
            $termination = array();
        }

        if ($queryResignation->num_rows()) {
            $resignation = $queryResignation->result();
        } else {
            $resignation = array();
        }

        if ($queryActive->num_rows()) {
            $active = $queryActive->result();
        } else {
            $active = array();
        }

        $queryActive->free_result();
        $queryResignation->free_result();
        $queryTermination->free_result();

        $data['termination'] = $termination;
        $data['resignation'] = $resignation;
        $data['active'] = $active;

        return $data;
    }

    function getActiveStaff() {
        
    }

    function deleteShaff($staffCode) {
        $query = $this->db->query('DELETE FROM Staff WHERE staffcode = ?', array($staffCode));
        if ($query->affected_rows() > 0) {
            return true;
        }
        return false;
    }

    function allRentalsRecords() {
        $data = array();
        $query = $this->db->query('SELECT * FROM rentals');
        if ($query->num_rows() > 0) {
            $data = $query->result();
        }
        $query->free_result();
        return $data;
    }

    function changeStaffStatus($staffCode, $status) {
        $query = $this->db->query('UPDATE staffstate SET status = ? WHERE staffcode = ?', array($staffCode, $status));
        if ($query->affected_rows() > 0) {
            return true;
        }
        return FALSE;
    }

    function getRental($id) {
        $query = $this->db->query("SELECT * FROM rentals WHERE id = ?", array('id' => $id))->row();
        return $query;
    }

}

