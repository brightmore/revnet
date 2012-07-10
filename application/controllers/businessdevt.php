<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of businessDevt
 *
 * @author Brightmore
 */
class BusinessDevt extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model(array('miscfunctions', 'mbusinessdevt'));
    }

    public function index() {
        $epcc['branches'] = $this->miscfunctions->getBranches();
        $data['content'] = $this->load->view('businessDevt/epccSection', $epcc, TRUE);
        $this->load->view('mainTemplate', $data);
    }

    public function submitEpcc() {
        $form = $this->input->post('section');
        ($form == 'issued') ? $this->form_validation->set_rules('epcc', 'Card Issued', 'required|xss_clean|trim|is_numeric') : $this->form_validation->set_rules('epcc', 'Card Request', 'required|xss_clean|trim|is_numeric');

        if ($this->form_validation->run()) {
            
        } else {
            
        }
    }

    function getEpccCardsIssuedInMonthAllBranch() {
        $data = array();
        $date = getdate();
        $content['month'] = $date['mon'];
        $content['year'] = $date['year'];

        $totalIssued = $this->mbusinessdevt->getTotalEpccCardIssued($content['month'], $content['year']);
        //   $content['totalCardIssued'] = $totalIssued->totalIssued;
        //  $content['average'] = $totalIssued->average;
        $content['results'] = $this->mbusinessdevt->getEpccCardsIssuedInMonthAll($content['month']);
        $data['content'] = $this->load->view('businessDevt/EpccCardsIssuedInMonthAllBranch', $content, true);
        $this->load->view('mainTemplate', $data);
    }

    function getEpccCardsRequestedInMonthAllBranch() {
        $data = array();
        $date = getdate();
        $content['month'] = $date['mon'];
        $content['year'] = $date['year'];

        $totalIssued = $this->mbusinessdevt->getTotalEpccCardRe($content['month'], $content['year']);
        //   $content['totalCardIssued'] = $totalIssued->totalIssued;
        //  $content['average'] = $totalIssued->average;
        $content['results'] = $this->mbusinessdevt->getEpccCardsIssuedInMonthAll($content['month']);
        $data['content'] = $this->load->view('businessDevt/EpccCardsIssuedInMonthAllBranch', $content, true);
        $this->load->view('mainTemplate', $data);
    }

    function training($group = 'staffs') {
        if ($this->input->post('year') && $this->input->post('month')) {
            $month = $this->input->post('mont');
            $year = $this->input->post('year');
        } else {
            $date = getdate();
            $month = $date['mon'];
            $year = $date['year'];
        }

        if($group == 'staffs'){
           $group = 'stakeholder' ;
        }else{
            $group = 'staff';
        }

        $this->session->set_userdata('train_group_sort', 'staff');

        $data = array();
        $content = array();

        $data['title'] = 'Business Development:Training';
        $content['month'] = $month;
        $content['year'] = $year;
        $content['group'] = $group;
        $content['training'] = $this->mbusinessdevt->getAllTraining($month, $year, $group);
        $content['staffs'] = $this->mbusinessdevt->trainingForStaffsInBranches($month, $year);
        $content['stakeholders'] = $this->mbusinessdevt->trainingForStakeholderInBranches($month, $year);
        $content['totalStakeholders'] = $this->mbusinessdevt->trainingForStakeholderInBranches($month, $year);
        $content['totalStaffs'] = $this->mbusinessdevt->getNumberTrainingOrganizedForStaffInMonth($month, $year);

        $data['content'] = $this->load->view('businessDevt/training', $content, TRUE);
        $this->load->view('mainTemplate', $data);
    }

    function submitTraining() {
        $this->form_validation->set_rules('topic', 'Topic', 'required|trim|max_lenght|xss_clean');
        $this->form_validation->set_rules('dateStarted', 'Started Date', 'required|callback_validDate');
        $this->form_validation->set_rules('dateEnd', 'Ended Date', 'required|callback_validDate');
        $this->form_validation->set_rules('group', 'Group', 'callback_group');
        $this->form_validation->set_rules('total', 'Total Trainees', 'required|is_numric');
        $this->form_validation->set_rules('summary', 'Training Summary', 'xss_clean');
        if (!$this->form_validation->run()) {
            $topic = $this->input->post('topic');
            $summary = $this->input->post('summary');
            $group = $this->input->post('group');
            $total = $this->input->post('total');
            $dateEnded = $this->input->post('dateEnded');
            $dateStarted = $this->input->post('dateStarted');

            $splitStartDate = split(' \\/-', $dateStarted);
            $sDay = $splitStartDate[0];
            $sMonth = $splitStartDate[1];
            $sYear = $splitStartDate[2];

            $dateStarted = mktime(0, 0, 0, $sMonth, $sDay, $sYear);

            $splitEndDate = split(' \\/-', $dateEnded);
            $eDay = $splitEndDate[0];
            $eMonth = $splitEndDate[1];
            $eYear = $splitEndDate[2];

            $dateEnd = mktime(0, 0, 0, $eMonth, $eDay, $eYear);

            if ($dateStarted > $dateEnd) {
                $this->session->set_flashdata('error', 'Please the start date can\' be greater than end date of training');
                redirect('index.php/businessdevt/training', 'refresh');
                return;
            }

            try {
                $data = array();
                $data['branchcode'] = $this->session->userdata('branchcode');
                $data['month'] = $sMonth;
                $data['year'] = $sYear;
                $data['dateStart'] = $dateStarted;
                $data['dateEnd'] = $dateEnd;
                $data['topic'] = $topic;
                $data['totalPeopleTrained'] = $total;
                $data['type'] = $group;
                $data['note'] = $summary;

                $this->db->insert('training', $data);
                $this->session->set_flashdata('success', 'The information was successfully saved.');
                redirect('index.php/businessdevt/training', 'refresh');
                return;
            } catch (Exception $exc) {
                //TODO
                echo trigger_error($exc->getTraceAsString());
                return;
            }
        }
    }

    function editTraining($group,$id) {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('warning', 'illi');
            redirect('index.php/businessdevt/training', 'refresh');
            return;
        }

        if($group == 'staffs'){
           $group = 'stakeholder' ;
        }else{
            $group = 'staff';
        }
        
        $this->session->set_flashdata('info','The record is ready to be update.');
        
        $date = getdate();
        $month = $date['mon'];
        $year = $date['year'];

        $data = array();
        $content = array();
        $data['title'] = 'Business Development:Training';
        $content['month'] = $month;
        $content['year'] = $year;
        $content['group'] = $group;
        $content['training'] = $this->mbusinessdevt->getAllTraining($month, $year, $group);
        $data['title'] = 'Business Development:Training';
        $content['result'] = $this->mbusinessdevt->getTraining($id);
        $data['content'] = $this->load->view('businessdevt/editTraining', $content, true);
        $this->load->view('mainTemplate', $data);
    }
    
    function viewTraining($id)
    {
       $content =array();
       $content['training'] = $this->mbusinessdevt->getTrainingDetail($id);
        $data['title'] = 'Business Development:'.$content['training']->topic;
       $data['content'] = $this->load->view('businessdevt/viewTraining',$content,true);
       $this->load->view('mainTemplate',$data);
    }

    function editSubmitTraining() {
        $this->form_validation->set_rules('topic', 'Topic', 'required|trim|max_lenght|xss_clean');
        $this->form_validation->set_rules('dateStarted', 'Started Date', 'required|callback_validDate');
        $this->form_validation->set_rules('dateEnd', 'Ended Date', 'required|callback_validDate');
        $this->form_validation->set_rules('group', 'Group', 'callback_group');
        $this->form_validation->set_rules('total', 'Total Trainees', 'required|is_numric|xss_clean');
        $this->form_validation->set_rules('summary', 'Training Summary', 'xss_clean');
        if (!$this->form_validation->run()) {
            $topic = $this->input->post('topic');
            $summary = $this->input->post('summary');
            $group = $this->input->post('group');
            $total = $this->input->post('total');
            $dateEnded = $this->input->post('dateEnded');
            $dateStarted = $this->input->post('dateStarted');
            $id = $this->input->post('id');

            $splitStartDate = split(' \\/-', $dateStarted);
            $sDay = $splitStartDate[0];
            $sMonth = $splitStartDate[1];
            $sYear = $splitStartDate[2];

            $dateStarted = mktime(0, 0, 0, $sMonth, $sDay, $sYear);

            $splitEndDate = split(' \\/-', $dateEnded);
            $eDay = $splitEndDate[0];
            $eMonth = $splitEndDate[1];
            $eYear = $splitEndDate[2];

            $dateEnd = mktime(0, 0, 0, $eMonth, $eDay, $eYear);

            if ($dateStarted > $dateEnd) {
                $this->session->set_flashdata('error', 'Please the start date can\' be greater than end date of training');
                redirect('index.php/businessdevt/training', 'refresh');
                return;
            }

            try {
                $data = array();

                $data['branchcode'] = $this->session->userdata('branchcode');
                $data['month'] = $sMonth;
                $data['year'] = $sYear;
                $data['dateStart'] = $dateStarted;
                $data['dateEnd'] = $dateEnd;
                $data['topic'] = $topic;
                $data['totalPeopleTrained'] = $total;
                $data['type'] = $group;
                $data['note'] = $summary;

                $this->db->update('training', $data, array('id' => $id));
                $this->session->set_flashdata('success', 'The record was updated successfully.');
                redirect('index.php/businessdevt/editTraining/' . $id, 'location');
                return;
            } catch (Exception $exc) {
                $this->session->set_flashdata('error', 'The record failed to update,Please if problem persist inform your System Administrator. ');
                redirect('index.php/businessdevt/editTraining/' . $id, 'location');
                return;
            }
        }
    }

    function deleteTraining($id) {
        
    }

    function branchAnalysis($branchcode) {
        
    }

    function eduNcampaign() {
        
    }

    function group($str) {
        if (strcasecmp($str, 'error')) {
            $this->form_validation('group', 'Please select an option from the list');
            return FALSE;
        }

        return true;
    }

}

?>
