<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of administration
 *
 * @author Brightmore
 */
class Administration extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array('madministration'));
        $this->load->library('pagination');
    }

    function index() {
        
    }

    function StaffsInBranches() 
    {
        $data = array();
        $content = array();
        
        $config['base_url'] = site_url().'index.php/administration/StaffsInBranches/';
        $config['total_rows'] =$this->madministration->getTotalStaffs();
        $config['per_page'] = 15;
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        $this->pagination->initialize($config);
        $content['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Administration::Active staff in all branches';
        $content['activeStaff'] = $this->madministration->getAllActiveStaffs($config['per_page'],$this->uri->segment(3,0));
        $data['content'] = $this->load->view('administration/staffing', $content, TRUE);

        $this->load->view('mainTemplate', $data);
    }
    
    function editStaff($id){
        $data = array();
        $content= array();
    }

    function newStaff() {
        $data = array();
        $content = array();
        $content['departmemts'] = departments();
        $content['branches'] = allBranches();
        $data['title'] = 'Administration:: New Staff';
        $data['content'] = $this->load->view('administration/newStaff', $content, TRUE);
        $this->load->view('mainTemplate', $data);
    }

    function previewNewStaff() {
        $this->form_validation->set_rules('name', 'required|max_length[255]|xss_clean');
        //$this->form_validation->set_rules('address', 'max_length[1000]');
        //$this->form_validation->set_rules('contact', 'required|trim');
        // $this->form_validation->set_rules('email', 'valid_emails|xss_clean|trim');
        //  $this->form_validation->set_rules('dateHired', 'required');
        //|callback_valid_contact |callback_validDate callback_valid_name|
        if ($this->form_validation->run()) {
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $contact = $this->input->post('contact');
            $email = $this->input->post('email');
            $dateHired = $this->input->post('dateHired');
            $branchcode = $this->input->post('branchCode');
            $depcode = $this->input->post('depcode');

            $splitDate = preg_split("/[\s\\-]+/", $dateHired);

            $day = $splitDate[0];
            $month = $splitDate[1];
            $year = $splitDate[2];

            $dateMKHired = mktime(0, 0, 0, $month, $day, $year);

            $data = array(
                'name' => $name,
                'address' => $address,
                'contact' => $contact,
                'email' => $email,
                'dateHired' => $dateMKHired,
                'branchcode' => $branchcode,
                'depCode' => $depcode
            );

            print_r($data);
        } else {
            $this->newStaff();
        }
    }

    function StaffsInBranch($code) {
        $data[] = array();
        $content[] = array();
        $config['base_url'] = site_url().'index.php/administration/StaffsInBranch/'.$code.'/';
        $config['total_rows'] =$this->madministration->getTotalStaffs();
        $config['per_page'] = 15;
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        $this->pagination->initialize($config);
        $content['pagination'] = $this->pagination->create_links();
        
        $branchName = $this->db->query('SELECT location FROM branches WHERE branchcode = ? ',array($code))->row()->location;
        $data['title'] = 'Staffs at '.(strcasecmp($branchName, 'head office'))? '' : $branchName;
        $content['activeStaff'] = $this->madministration->getStaffsInBranch($code,$config['per_page'],$this->uri->segment(4,0));
        //$content['activeStaff'] = $this->madministration->getAllActiveStaffs($config['per_page'],$this->uri->segment(3,0));
        $data['content'] = $this->load->view('administration/staffing', $content, TRUE);

        $this->load->view('mainTemplate',$data);
    }

    function RecruitmentInBranches() 
    {
        
    }

    function terminationAndResignation() 
    {
        
    }

    function vehicles() 
    {
        $data = array();
        $content = array();
        $content['vehicles'] = $this->madministration->getVehiclesInAllBranches();
        $data['title'] = 'Administration::Vehicles';
        $data['content'] = $this->load->view('administration/vehicles', $content, true);
        $this->load->view('mainTemplate', $data);
    }

    function rentals() {
        $content = array();
        $data = array();
        $content['rentals'] = $this->madministration->allRentalsRecords();
        $data['title'] = 'Administration::Rentals';
        $data['content'] = $this->load->view('administration/rentals', $content, true);
        $this->load->view('mainTemplate', $data);
    }

    function editRentals($id) {
        $content = array();
        $data = array();
        $content['rentals'] = $this->madministration->allRentalsRecords();
        $content['rental'] = $this->madministration->getRental($id);
        $content['id'] = $id;
        $data['title'] = 'Administration::Rental::Edit';
        $data['content'] = $this->load->view('administration/rentalsEdit', $content, true);
        $this->load->view('mainTemplate', $data);
    }
    
    function rentalGroup($group){
        $content = array();
        $data = array();
        $content['rentals'] = $this->db->query("SELECT * FROM rentals WHERE rentalType = ?",array($group))->result();
        $data['title'] = 'Administration:: Rental under '.$group;
        $data['content'] = $this->load->view('administration/rentals',$content,true);
        $this->load->view('mainTemplate',$data);
       
    }

    function editVehicle($registrationNo) {
       $content = array();
       $data = array();
       $data['title'] = 'Administration:: Editing vehicle with registration number:: '.$registrationNo;
       $content['vehicle'] = $this->madministration->getVehicle($registrationNo);
       $data['content'] = $this->load->view('administration/editVehicle',$content,true);
       $this->load->view('mainTemplate',$data);
    }

    function submitRental() {
        
    }

    function previewRentals() {
        $content = array();
        $data = array();
        $data['title'] = 'Administration:Rental Comfirm';
        $content['agreementDate'] = date('d m y', $this->session->userdata('agreementDate'));
        $content['expiryDate'] = date('d m y', $this->session->userdata('expiryDate'));
        $content['rentalType'] = $this->session->userdata('rentalType');
        $content['location'] = $this->session->userdata('location');
        $content['description'] = $this->session->userdata('description');

        if ($this->session->userdata('id')) {
            $content['id'] = $this->session->userdata('id');
        }

        $data['content'] = $this->load->view('administration/previewRentals', $content, true);
        $this->load->view('mainTemplate', $data);
    }

    function previewSubmittedRentals() {
        $this->form_validation->set_rules('propertyType', 'Rent Type', 'required|max_lenght[225]|xss_clean');
        $this->form_validation->set_rules('agreementDate', 'Agreement Date', 'required|callback_validDate');
        $this->form_validation->set_rules('expiryDate', 'Expiry Date', 'required|callback_validDate');
        $this->form_validation->set_rules('location', 'Address', 'required|max_lenght[500]');
        $this->form_validation->set_rules('description', 'Description', 'max_lenght[1000]');

        if ($this->form_validation->run()) {

            $agreementDate = $this->input->post('agreementDate');
            $expiryDate = $this->input->post('expiryDate');
            $location = $this->input->post('location');
            $rentType = $this->input->post('propertyType');
            $description = $this->input->post('description');

            $isUpdate = false;

            if ($this->input->post('id')) {
                $isUpdate = true;
                $id = $this->input->post('id');
            }

            if (!$this->session->userdata('agreementDate')) { //
                $rentalSession = array('agreementDate' => $agreementDate,
                    'expiryDate' => $expiryDate,
                    'location' => $location,
                    'rentalType' => $rentType,
                    'description' => $description
                );

                if ($isUpdate) {
                    $rentalSession['id'] = $id;
                }

                $this->session->set_userdata($rentalSession);
                redirect("index.php/administration/previewRentals", 'refresh');
            } else {
                $splitAgreementDate = array();
                $splitExpiryDate = array();

                $splitAgreementDate = split('\\/- ', $agreementDate);
                $agreementMonth = $splitAgreementDate[1];
                $agreementDay = $splitAgreementDate[0];
                $agreementYear = $splitAgreementDate[2];

                $splitExpiryDate = split('\\/- ', $expiryDate);
                $expiryMonth = $splitExpiryDate[1];
                $expiryDay = $splitExpiryDate[0];
                $expiryYear = $splitExpiryDate[2];

                $data = array();
                $data['agreementDate'] = mktime(0, 0, 0, $agreementMonth, $agreementDay, $agreementYear);
                $data['expiryDate'] = mktime(0, 0, 0, $expiryMonth, $expiryDay, $expiryYear);
                $data['location'] = $location;
                $data['rentalType'] = $rentType;
                $data['description'] = $description;

                try {
                    if (!$isUpdate) {
                        $this->db->insert('rentals', $data);
                        $this->session->set_flashdata('success', 'The record was saved successfully.');
                        redirect('index.php/administration/rentals', 'refresh');
                    } else {
                        $this->db->update('rental', $data, array('id' => $id));
                        $this->session->set_flashdata('success', 'This record was updated successfully');
                        redirect('index.php/administration/editRentals/' . $id, 'refresh');
                    }
                } catch (Exception $ex) {
                    trigger_error($ex->getMessage());
                }

                $sessionDestroy = array('location' => '', 'agreementDate' => '', 'expiryDate' => '', 'rentalType' => '', 'description' => '');
                $this->session->unset_userdata($sessionDestroy);
            }
        } else {
            if (!$isUpdate) {
                $content = array();
                $data = array();
                $content['rentals'] = $this->madministration->allRentalsRecords();
                $data['title'] = 'Administration::Rentals';
                $data['content'] = $this->load->view('administration/rentals', $content, true);
                $this->load->view('mainTemplate', $data);
            } else {
                $this->editRentals($id);
            }
        }
    }

    function previewSubmittedVehicle() {
        $isUpdate = false;

        $this->form_validation->set_rules('type', 'Type', 'callback_valid_Type|xss_clean');
        $this->form_validation->set_rules('name', 'name', 'required|callback_alpha_space_numeric|max_lenght[300]');
        $this->form_validation->set_rules('model', 'Model', 'required|callback_alpha_space_numeric|max_lenght[300]');
        $this->form_validation->set_rules('regNo', 'Registration No', 'required|callback_alpha_space_numeric|max_lenght[300]');
        $this->form_validation->set_rules('location', 'Branch Name', 'callback_validBranchcode|max_lenght[500]');
        $this->form_validation->set_rules('note', 'Note', 'max_lenght[1000]');

        if ($this->form_validation->run()) {

            $type = $this->input->post('type');
            $name = $this->input->post('name');
            $model = $this->input->post('model');
            $regno = $this->input->post('regNo');
            $location = $this->input->post('location');
            $note = $this->input->post('note');

            if ($this->input->post('id')) {
                $id = $this->input->post('id');
                $isUpdate = TRUE;
            }

            if (!$this->session->userdata('registrationNo')) {

                $vehicleSession = array(
                    'type' => $type,
                    'name' => $name,
                    'model' => $model,
                    'registrationNo' => $regno,
                    'branchcode' => $location,
                    'note' => $note
                );

                if ($isUpdate) {
                    $vehicleSession['id'] = $id;
                }

                $this->session->set_userdata($vehicleSession);
                redirect("index.php/administration/previewVehicle", 'location');
            } else {

                try {

                    $data = array('type' => $type,
                        'name' => $name,
                        'model' => $model,
                        'registrationNo' => $regno,
                        'branchcode' => $location,
                        'note' => $note
                    );

                    if ($isUpdate) {
                        $this->up->update('vehicle', $data, array('id' => $id));
                        $this->session->set_flashdata('success', 'The record was updated successfully.');
                        redirect('index.php/administration/editVehicle/' . $id, 'refresh');
                    } else {
                        $this->db->insert('vehicle', $data);
                        $this->session->set_flashdata('success', 'The record was added successfully.');
                        redirect('index.php/administration/vehicles', 'refresh');
                    }

                    $sessionDestroy = array('type' => '', 'name' => '', 'model' => '', 'registrationNo' => '', 'branchcode' => '', 'note' => '');
                    $this->session->unset_userdata($sessionDestroy);
                } catch (Exception $ex) {
                    trigger_error($ex->getMessage());
                }
            }
        } else {

            if ($isUpdate) {
                $this->editVehicle($id);
            } else {
                $this->vehicles();
            }
        }
    }

    function vehicleGroup($group) {
        
    }

    function previewVehicle() {
        $content = array();
        $data = array();
        $data['title'] = 'Administration:: Vehicle Comfirm';
        $content['note'] = $this->session->userdata('note');
        $content['name'] = $this->session->userdata('name');
        $content['type'] = $this->session->userdata('type');
        $content['registrationNo'] = $this->session->userdata('registrationNo');
        $content['branchCode'] = $this->session->userdata('branchCode');

        $data['content'] = $this->load->view('administration/previewVehicle', $content, true);
        $this->load->view('mainTemplate', $data);
    }

    function deleteRentals($id) {
        
    }

    function valid_Type($str) {
        $type = array('Saloon', 'Van', 'Motor Bike', 'Truck', 'Bicycle');
        if (array_search($str, $type) === FALSE) {
            $this->form_validation->set_message('valid_Type', 'Please select vehicle type');
            return false;
        }

        return true;
    }

}

?>
