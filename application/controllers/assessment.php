<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Assessment extends CI_Controller {
	
	private $limit = 10;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('assessment_model','admin_model'));
		$this->load->library('table');
		$this->load->helper('url');
	}
	
	public function index()
	{
		$this->load->view('Frontend/Login');
	}
	
	public function inventory()
	{
		$this->check_session();
		$this->load->model('');
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('assessment/index');
		}
	}
	
	function check_locked($trainingid = 0,$submodid = 0)
	{
		$locked = $this->assessment_model->check_locked($trainingid,$submodid)->row_array();
		#print_r($this->db->last_query());
		#print_r($locked); die();
		if ($locked["locked"] == 1)
		{
			
			$this->session->set_flashdata('error', 'Your Exam is already locked, please inform Administrator!');
			redirect('assessment/index');
		}
	}
	
	public function login()
	{	
		$this->form_validation->set_rules('trid','Trainee ID', 'required|xss');
		$this->form_validation->set_rules('code','Schedule Code', 'required|xss');
		
		if($this->form_validation->run()==TRUE)
		{
			$code = explode("-",$this->input->post("code"));
			$submodid = (!empty($code[1]) ? $code[1] : 0);
			
			$query = $this->assessment_model->trainee_login();
			#echo $query->num_rows(); die();
			if ($query->num_rows() > 0)
			{
				$rows = $query->row_array();
				$lols["rows"] = $rows;
				
				$lols["retake"] = $this->assessment_model->check_if_retake($rows["trainingid"],$submodid)->num_rows();
				#echo $rows["trainingid"]; die();
				$this->check_locked($rows["trainingid"],$submodid);

				#print_r($this->session->all_userdata());
				$this->load->view("Frontend/Welcome",$lols);
				
			} else {
				$this->session->set_flashdata('error','Please inform Administrator for Validation');
				#print_r($this->session->all_userdata());
				redirect("assessment/index");
			}
		}
		else
		{
			$this->index();
		}
	}
	
	function questions()
	{
		#$this->check_session();
		#$code = $this->session->userdata("code");
		$mcbasid = $data["mcbasid"] = $this->input->post("mcbasid");
		$code = $data["code"] = $this->input->post("code");
		$trainingid = $data["trainingid"] = $this->input->post("trainingid");
		if (empty($trainingid)){ 
			$this->session->set_flashdata("error","Error loading page");
			redirect("assessment/index");
		}
		$retake = $data["retake"] = $this->input->post("retake");
		$submod = $data["submodid"] = $this->input->post("submodid");
		
		$duration = $this->assessment_model->get_limit($mcbasid)->row_array();
		
		$check_dur = $duration["duration"];
		
		#----Added Sep13,2016; Lock student;
		$this->check_locked($trainingid,$submod);
		$this->assessment_model->lock_question();
		#----End
		if (empty($check_dur))
		{
			$this->load->view("Frontend/ErrorAssessment");
		}
		else
		{
			$data["questions"] = $this->assessment_model->get_rand_questions(intval($duration["id"]),intval($duration["quantity"]));
			#$this->session->set_userdata(array("modcode" => $duration["id"]));
			$data["modcode"] = $duration["id"];
			$data["duration"] = $duration["duration"];
			$data["module"] = $duration["dscrptn"];
			#$this->session->set_userdata(array("duration" => $duration["duration"]));
			#print_r($this->session->all_userdata());
			#print_r($data); die();
			$this->load->view("Frontend/Assessment",$data);
		}
	}
	
	function finish()
	{
		#print_r($this->input->post("question")); die();
		
		$trainingid = $data["trainingid"] =  $this->input->post("trainingid");
		
		if (empty($trainingid)){ 
			$this->session->set_flashdata("error","Error loading page");
			redirect("assessment/index");
		}
		
		$data["submodid"] =  $this->input->post("submodid");
		$data["retake"] = $retake = $this->input->post("retake");
		$rec = $this->assessment_model->check_locked($data["trainingid"],$data["submodid"])->row_array();
		
		if ($rec["saved"] == 1)
		{
			$this->session->set_flashdata("error","Please see Administrator for your Grades");
			redirect("assessment/index");
		}
		
		// $result["count"] = $this->assessment_model->check_if_retake($data["trainingid"],$data["submodid"]);
		// $this->assessment_model->save_results($data["retake"]);
		
		$thiscount = $this->assessment_model->check_if_retake($data["trainingid"],$data["submodid"])->num_rows();
		$this->assessment_model->save_results($thiscount,$retake);
		
		$this->session->sess_destroy();
		#print_r($this->session->all_userdata());asd
		$this->load->view("Frontend/Finish",$data);
	}
	
	function showresults($trainingid,$count = 0,$submodid = 0)
	{
		$data["records"] = $this->assessment_model->show_records($trainingid,$submodid)->row_array();
		$data["results"] = $this->assessment_model->show_results($trainingid,$count,$submodid);
		#print_r($this->session->all_userdata());
		#print_r($data["records"]); die();
		
		$this->load->view("Frontend/Results",$data);
	}
	
	function savegrades()
	{
		$this->grades_model->save_grades();
		
	}
}
