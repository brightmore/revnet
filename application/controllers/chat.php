<?php

class Chat extends CI_Controller{
	
	/**
	 * Constructor duh
	 * - loads the model
	 */
	function __construct()
	{
		parent::__construct();
		$this->load->model('chatmodel');
	}
	
	/**
	 * Loads the default page for the XML example
	 * 
	 */
	public function index()
	{		
		$this->load->view('chatView');		
	}
	
	/**
	 * UPDATES the DB
	 * 
	 * @param $_POST array
	 * @return bool
	 */
	public function update()
	{
		//POST up or GTFO
		if(empty($_POST))
		{
			return false;
		}
		
		// Loops through the post array and makes variables equal to the array key
		foreach($_POST AS $key => $value) {
			// sanitize for SQL Injection
		    ${$key} = mysql_real_escape_string($value);
		}
		
		/*
		 * If the key is correct, find the current time and pass all the data to 
		 * the model for insertion
		 */
		if($action == "postmsg"){
			$current = time();		
			$this->chatmodel->insertMsg($name, $message, $current);		
		}
		
		if($html_redirect == "true")
		{
			header('Location: /chat/html');
		}	
	}
	
	/**
	 * XML Backend
	 * 
	 * @return
	 */
	public function backend()
	{	
		//HTTP headers for XML							
		header("Content-type: text/xml");
		header("Cache-Control: no-cache");
		
		//get the data		
		$query = $this->chatmodel->getMsg();
		
		//if empty change the status
		if($query->num_rows()==0){
			$status_code = 2;
		}else{
			$status_code = 1;
		}
		
		//XML headers
		echo "<?xml version=\"1.0\"?>\n";
		echo "<response>\n";
		echo "\t<status>$status_code</status>\n";
		echo "\t<time>".time()."</time>\n";
		
		//Loop through all the data
		if($query->num_rows()>0){
			foreach($query->result() as $row){
				
				//sanitize so XML is valid
				$escmsg = htmlspecialchars(stripslashes($row->msg));
				echo "\t<message>\n";
				echo "\t\t<id>$row->id</id>\n";
				echo "\t\t<author>$row->user</author>\n";
				echo "\t\t<text>$escmsg</text>\n";
				echo "\t</message>\n";
			}
		}
		echo "</response>";
				
	}
	
	/**
	 * Loads the default view for the JSON example
	 * 
	 */
	public function json()
	{
		$this->load->view('jsonView');
	}
	
	/**
	 * Displays the JSON formatted data
	 */
	public function json_backend()
	{
		// Headers for the JSON
		header('Cache-Control: no-cache, must-revalidate');
		header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
		header('Content-type: application/json');
		
		//get the data
		$query = $this->chatmodel->getMsg();

		//store the results in an array
		$data = $query->result_array();
		
		//encode the array into json
		$jsonData = json_encode($data);
		
		//JSON sized dump to STDOUT
		echo $jsonData;
	}
	
	/**
	* Main for the HTML example
	* @return a web page
	*/
	public function html()
	{
		$data = array();
		
		$data['html'] = $this->html_backend();
		
		$this->load->view('htmlView',$data);
	}
	
	/** 
	* Function to display the data in HTML
	* @return HTML data
	*/	
	public function html_backend()
	{
		//create 
		$data = array();
		$ret = false;
		
		//store
		$data['query'] = $this->chatmodel->getMsg();
		
		//send to view, store the results in variable
		$ret = $this->load->view('htmlBackView',$data, true);
		
		return $ret;
	}
}
?>