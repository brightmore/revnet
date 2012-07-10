<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of welcome
 *
 * @author Brightmore
 */
class Welcome extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model(array('miscfunctions','madministration'));
         $this->load->library('pagination');
    }
    
    function index(){
        $this->load->view('login');
    }
    
    function dashboard() {
        $data = array();
        $content = array();
        
        $config['base_url'] = site_url().'index.php/tadministration/StaffsInBranches/';
        $config['total_rows'] =$this->madministration->getTotalStaffs();
        $config['per_page'] = 15;
        $config['cur_tag_open'] = '<b>';
        $config['cur_tag_close'] = '</b>';
        $this->pagination->initialize($config);
        $content['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Administration::Active staff in all branches';
        $content['activeStaff'] = $this->madministration->getAllActiveStaffs($config['per_page'],$this->uri->segment(3));
        $data['content'] = $this->load->view('administration/staffing', $content, TRUE);
        $data['content'] = $this->load->view('dashboard',$content,true);
        $this->load->view('mainTemplate',$data);
    }
    
    function login()
    {
        $session = array();
        $this->form_validation->set_rules('username','User Name','trim|required|xss_clean');
        $this->form_validation->set_rules('password','Password','trim|required|xss_clean');
        if($this->form_validation->run()){
         
            $session['username'] = $this->input->post('username');
            $session['resources'] = $this->miscfunctions->resources($this->input->post('username'));
            $this->session->set_userdata('sessionData',$session);
            redirect('index.php/welcome/dashboard','location');
            
        }else{
             redirect('index.php/welcome/','location');
        }
    }
    
    function checkUser($str){
        $userName = $this->input->post('username');
        $query = $this->db->query('SELECT * FROM be_users WHERE username = ? AND password = ?',array($userName,$str));
        if($query->num_rows()){
            return true;
        }
        
        $this->form_validation->set_message('Password','Username and Password do not match.');
        return false;
    }
}

?>
