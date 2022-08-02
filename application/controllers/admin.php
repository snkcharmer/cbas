Testing edit
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	private $limit = 10;
	var $terms = array();
		
	function __construct ()
	{
		parent:: __construct();
		$this->load->library("pagination");
		$this->load->model(array('admin_model','grades_model'));
		$this->load->library('table');
		$this->load->helper(array('url','typography'));
	}
	
	public function index()
	{
		$this->load->view('Backend/Login');
	}
	
	public function login()
	{
		$this->load->view('Backend/Login');
	}
	
	function check_session() 
	{
		if($this->session->userdata("is_logged")==FALSE)
		{
			redirect('admin/logoff');
		}
	}
	
	function checkadmin() 
	{
		if($this->session->userdata("user_level") != 1)
		{
			$this->logoff();
		}
	}
	
	public function validate()
	{
		$this->load->model('admin_model');
		$query = $this->admin_model->checklogin();
		$data['msg'] = 'asd';
		
		if ($query->num_rows() > 0)
		{
			#echo "lols"; die();
			$row = $query->row_array();
			$data = array(
				'username' => $this->input->post('username'),
				'fullname' => $row["name"],
				'userid' => $row["id"],
				'user_level' => $row['usertype'],
				'is_logged' => TRUE
				);
			$this->session->set_userdata($data);
			redirect('admin/integrate');
			
		} else {
			$data['msg'] = '<div class="errorMessage">Invalid username and/or password.</div>';
			redirect('admin/index');
		}
	}
	
	function logoff()
	{
		$this->session->sess_destroy();
		redirect("admin/index");
	}
	
	public function grades()
	{
		$this->check_session();
		#print_r($this->session->all_userdata());
		$this->load->view('Backend/Grades');
	}
	
	public function showgrades()
	{
		$this->check_session();
		$this->session->unset_userdata("code");
		$this->session->unset_userdata("submodid");
		$code = explode("-",$this->input->post("code"));
		
		if (empty($code[1]))
		{
			$this->session->set_userdata(array("code" => $code[0]));
			$data['records'] = $this->grades_model->get_trainees_grade($code[0]);
			$data["schedinfo"] = $this->grades_model->get_schedule($code[0])->row_array();
		}
		else
		{
			$this->session->set_userdata(array("code" => $code[0],"submodid" => $code[1]));
			$data['records'] = $this->grades_model->get_trainees_grade($code[0],$code[1]);
			$data["schedinfo"] = $this->grades_model->get_schedule($code[0],$code[1])->row_array();
		}
		
		#print_r($this->session->all_userdata());
		$this->load->view('Backend/GradesResult', $data);
	}
	
	public function editgrades()
	{
		$this->check_session();
		if ($this->session->userdata("user_level") == 1 || $this->session->userdata("user_level") == 2 || $this->session->userdata("user_level") == 99)
		{
			$checksess = $this->session->userdata("submodid");
			if (empty($checksess))
			{
				$data['records'] = $this->grades_model->get_trainees_grade($this->session->userdata("code"));
				$data["schedinfo"] = $this->grades_model->get_schedule($this->session->userdata("code"))->row_array();
			}
			else
			{
				$data['records'] = $this->grades_model->get_trainees_grade($this->session->userdata("code"),$this->session->userdata("submodid"));
				$data["schedinfo"] = $this->grades_model->get_schedule($this->session->userdata("code"),$this->session->userdata("submodid"))->row_array();
			}
						
			#print_r($this->session->all_userdata());
			$this->load->view('Backend/GradesResultEdit', $data);
		}
	}
	
	public function savegrades()
	{
		$this->check_session();
		$x = 0;
		
		foreach ($this->input->post("gradeid") as $rows => $key)
		{
			$this->form_validation->set_rules('gradeid['.$rows.']','Grade ID', 'required|xss');
			$this->form_validation->set_rules('trainingid['.$rows.']','Training ID', 'required|xss');
			$this->form_validation->set_rules('submodid['.$rows.']','Submodule', 'xss');
			$this->form_validation->set_rules('exam1['.$rows.']','Exam 1', 'xss');
			$this->form_validation->set_rules('exam2['.$rows.']','Exam 2', 'xss');
			$this->form_validation->set_rules('exam3['.$rows.']','Exam 3', 'xss');
			$this->form_validation->set_rules('prac['.$rows.']','Practical', 'required|xss');
			#$this->form_validation->set_rules('quiz['.$rows.']','Quiz', 'required|xss');
			$this->form_validation->set_rules('fgrade['.$rows.']','Final Grade', 'xss');
		}
		
		if($this->form_validation->run()==TRUE)
		{
			#$con = $this->admin_model->get_settings()->row_array();
			#$this->grades_model->save_grades($con["connection"]);
			$this->grades_model->save_grades();
			redirect("admin/editgrades/".$this->session->userdata("code")."/".$this->session->userdata("submodid"));
		}
		else
		{
			$this->editgrades();
		}
		#die();
	}
	
	public function integrate()
	{
		$this->check_session();
		#print_r($this->session->all_userdata());
		$this->load->view('Backend/Integrate');
	}
	
	public function integratesearch()
	{
		$this->check_session();
		
		$code = $this->input->post("code");
		$this->session->set_userdata(array("code" => $code));
		$data["schedinfo"] = $this->grades_model->get_schedule($code)->row_array();
		$data['trainrec'] = $this->grades_model->get_training_records($code);
		#$data['schedule'] = $this->grades_model->get_schedule_complete($code);
		
		#print_r($this->session->all_userdata());
		$this->load->view('Backend/IntegrateSearchResult',$data);
	}
	
	public function creategrades()
	{
		$this->check_session();
		$this->grades_model->create_grades();
		$this->session->set_flashdata('message', '<div style="text-align:ceneter; background: #222; color:#fff;">Schedule has been successfully integrated to CBAS!</div>');
		redirect('admin/grades');
	}
	
	public function modules($mode = NULL,$id = NULL)
	{
		$this->check_session();
		if ($mode == "add")
		{
			$data["modules"] = $this->admin_model->get_modules();
			$this->load->view("Backend/ModuleAdd",$data);
		}
		elseif ($mode == "save20")
		{
			$this->form_validation->set_rules('module','Module Name', 'is_unique[cbas_modules.item]|required|xss');
			$this->form_validation->set_rules('modcode','Module Code', 'is_unique[cbas_modules.modcode]|required|xss');
			$this->form_validation->set_rules('description','Description', 'required|xss');
			$this->form_validation->set_rules('quantity','Quantity', 'required|xss');
			$this->form_validation->set_rules('duration','Duration', 'required|xss');
			if($this->form_validation->run()==TRUE)
			{ 
				$this->admin_model->save_module();
				$this->session->set_flashdata('message', '<div style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span style="float: left; margin-right: .3em;"></span><strong>Successfully Added New Module on CBAS!</strong></p></div>');	
				redirect('admin/modules/add');
			}
			else
			{
				$this->modules("add");
			}
		}
		elseif ($mode == "edit")
		{
			$this->session->set_userdata(array("modid" => $id));
			$data["modules"] = $this->admin_model->get_module_cbas($id)->row_array();
			#print_r($data["modules"]); die();
			$this->load->view('Backend/ModuleEdit',$data);
		}
		elseif ($mode == "confirmedit")
		{
			$id = $this->session->userdata("modid");
			$this->form_validation->set_rules('module','Module Name', 'xss');
			$this->form_validation->set_rules('modcode','Module Code', 'xss');
			$this->form_validation->set_rules('description','Description', 'required|xss');
			$this->form_validation->set_rules('quantity','Quantity', 'required|xss');
			$this->form_validation->set_rules('duration','Duration', 'required|xss');
			if($this->form_validation->run()==TRUE)
			{ 
				$this->admin_model->edit_module($id);
				$this->session->set_flashdata('message', '<div style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span style="float: left; margin-right: .3em;"></span><strong>Successfully Added New Module on CBAS!</strong></p></div>');	
				redirect("admin/modules/edit/".$id);
			}
			else
			{
				$this->modules("edit",$id);
			}
		}
		else
		{
			$data["modules"] = $this->admin_model->searchmodule($id);
			$this->load->view('Backend/Modules',$data);
		}
	}
	
	public function settings()
	{
		$this->check_session();
		$data["settings"] = $this->admin_model->get_settings();
		$this->load->view('Backend/Options',$data);
	}
	
	public function setsettings()
	{
		$this->check_session();
		$this->admin->model->set_settings();
		$this->settings();
	}
	
	public function questions($mode = "all",$id = NULL)
	{
		$this->check_session();
		$module_id = $this->session->userdata("module_id");
		$data["module"] = $this->admin_model->get_module_cbas($module_id)->row_array();
		
		if ($mode == "edit")
		{
			$data["questions"] = $this->admin_model->get_specific_question($id)->row_array();
			$this->session->set_userdata(array("quesmode" => "edit"));
			$this->session->set_userdata(array("quesid" => $id));
			#print_r($this->session->all_userdata());
			$this->load->view("Backend/QuestionsEdit",$data);
		}
		elseif ($mode == "all")
		{
			$data["id"] = $id;
			$this->session->set_userdata(array("module_id" => $id));
			$data["module"] = $this->admin_model->get_module_cbas($id)->row_array();
			$data["questions"] = $this->admin_model->get_questions($id);
			#print_r($this->session->all_userdata());
			$this->load->view("Backend/Questions",$data);
		}
		elseif ($mode == "add")
		{
			$this->session->set_userdata(array("quesmode" => "add"));
			#print_r($this->session->all_userdata());
			$this->load->view("Backend/QuestionsAdd",$data);
		}
	}
	
	
	public function savequestions() 
	{
		$this->check_session();
		// setting up validation.
		#print_r($this->input->post("userfile")); die();
		$this->form_validation->set_rules('item', 'Question', 'required|xss');
		$this->form_validation->set_rules('opt1', 'Option 1', 'required|xss');
		$this->form_validation->set_rules('opt2', 'Option 2', 'required|xss');
		$this->form_validation->set_rules('opt3', 'Option 3', 'required|xss');
		$this->form_validation->set_rules('opt4', 'Option 4', 'required|xss');
		$this->form_validation->set_rules('answer', 'Answer', 'required|xss');
		
		if ($this->form_validation->run() == false){
			$this->questions("edit",$this->session->userdata("quesid"));
		}
		else 
		{
			$config['upload_path'] = './images/questions/';
			$config['allowed_types'] = 'jpg|jpeg|gif|png';
			$config['max_size'] = 1024*8; //2MB
			$this->load->library('upload',$config);
			
			$this->session->set_flashdata('message', '<div style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span style="float: left; margin-right: .3em;"></span><strong>Successfully Added/Updated Question on CBAS!</strong></p></div>');	
			
			if(!$this->upload->do_upload('userfile'))
			{
				#No File for upload
				
				if ($this->session->userdata("quesmode") == "edit")
				{ #---"Edit mode"
					$this->admin_model->save_question();
					$this->questions("edit",$this->session->userdata("quesid"));
				}
				elseif ($this->session->userdata("quesmode") == "add")
				{ #---"Add mode"
					$this->admin_model->add_question();
					$this->questions("add",$this->session->userdata("quesid"));
				}
				
			}
			else
			{
				#With Picture to be uploaded
				$this->upload_data['userfile'] = $this->upload->data();
				if(!empty($this->upload_data['userfile']))
				{
					if ($this->session->userdata("quesmode") == "edit")
					{ #---"Edit mode"
						$this->admin_model->save_question($this->upload_data['userfile']['file_name']);
						$this->questions("edit",$this->session->userdata("quesid"));
					}
					elseif ($this->session->userdata("quesmode") == "add")
					{
						$this->admin_model->add_question($this->upload_data['userfile']['file_name']);
						$this->questions("add",$this->session->userdata("quesid"));
					}
				}
			}
			
		}
	}
	
	public function users($mode = NULL,$empid = NULL)
	{
		$this->check_session();
		$this->checkadmin();
		if ($mode == "add")
		{
			$data['employees'] = $this->admin_model->get_employee();
			$this->load->view("Backend/UsersAdd",$data);
		}
		elseif ($mode == "activate")
		{
			$this->admin_model->activate_user($empid);
			redirect("admin/users");
		}
		elseif ($mode == "inactivate")
		{
			$this->admin_model->inactivate_user($empid);
			redirect("admin/users");
		}
		else
		{
			$data["users"] = $this->admin_model->get_users();
			$this->load->view("Backend/Users",$data);
		}		
	}
	
	function confirmadduser()
	{
		$this->check_session();
		$this->checkadmin();
		$this->form_validation->set_rules('empid', 'Employee', 'is_unique[cbas_users.empid]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]|matches[passwordf]|xss_clean');
		$this->form_validation->set_rules('passwordf', 'Password Confirmation', 'trim|min_length[5]|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['employees'] = $this->admin_model->get_employee();
			$this->users("add");
		}
		else
		{
			$this->admin_model->add_user();
			$this->session->set_flashdata('message','Successfully added a new Account!');
			$data['employees'] = $this->admin_model->get_employee();
			$this->users();
		}
	}
	
	function print_grades($code = 0,$submodid = 0)
	{
		$this->check_session();
		#$code = $this->session->userdata("code");
		#$submodid = $this->session->userdata("submodid");
		
		if (empty($submodid))
		{
			$data['records'] = $this->grades_model->get_trainees_grade($code);
			$data["schedinfo"] = $this->grades_model->get_schedule($code)->row_array();
		}
		else
		{
			$data['records'] = $this->grades_model->get_trainees_grade($code,$submodid);
			$data["schedinfo"] = $this->grades_model->get_schedule($code,$submodid)->row_array();
		}
		
		$data["head"] = $this->admin_model->get_head()->row_array();
		$this->load->view("Backend/print/classrecord", $data);
	}
	
	function print_grades2($code = 0,$submodid = 0)
	{
		$this->check_session();
		
		if (empty($submodid))
		{
			$data['records'] = $this->grades_model->get_trainees_grade($code);
			$data["schedinfo"] = $this->grades_model->get_schedule($code)->row_array();
		}
		else
		{
			$data['records'] = $this->grades_model->get_trainees_grade($code,$submodid);
			$data["schedinfo"] = $this->grades_model->get_schedule($code,$submodid)->row_array();
		}
		
		$data["head"] = $this->admin_model->get_head()->row_array();
		$this->load->view("Backend/print/classrecord2", $data);
	}
	
	function print_tcroalist($code = 0,$submodid = 0)
	{
		$this->check_session();
		
		if (empty($submodid))
		{
			$data['records'] = $this->grades_model->get_trainees_grade($code);
			$data["schedinfo"] = $this->grades_model->get_schedule($code)->row_array();
		}
		else
		{
			$data['records'] = $this->grades_model->get_trainees_grade($code,$submodid);
			$data["schedinfo"] = $this->grades_model->get_schedule($code,$submodid)->row_array();
		}
		
		$data["head"] = $this->admin_model->get_head()->row_array();
		$this->load->view("Backend/print/tcroalist", $data);
	}
	
	//TCROA Processess----------------------------------------
	
	function tcroa($mode = NULL,$submod = NULL)
	{
		$this->check_session();
		$data["modules"] = $this->admin_model->get_module_cbas_all();
		
		if ($mode == "modules")
		{
			if ($submod == "main")
			{
				
				$this->load->view('Backend/TCROAAddMainCategory', $data);
			}
			else
			{
				$data["main"] = $this->admin_model->get_module_cbas_all();
				$this->load->view('Backend/TCROAAddSpecificCategory', $data);
			}
		}
		elseif ($mode == "search")
		{
			$this->session->unset_userdata("code");
			$this->session->unset_userdata("submodid");
			$code = explode("-",$this->input->post("code"));
			
			if (empty($code[1])) 
			{ 
				$code[1] = 0; 
				$this->session->set_userdata(array("code" => $code[0])); 
			}
			else
			{
				$this->session->set_userdata(array("code" => $code[0],"submodid" => $code[1]));
			}
			
			#$data["module"] = $this->admin_model->search_tcroa_module($code[0],$code[1]);
			$data['main'] = $this->admin_model->search_tcroa_headers_main($code[0],$code[1]);
			$data['specific'] = $this->admin_model->search_tcroa_headers_specific($code[0],$code[1]);
			$data["name"] = $this->admin_model->get_tcroa_results_name($code[0],$code[1]);
			$data["assessor"] = $this->admin_model->get_assessor($code[0],$code[1])->row_array();
			$data["submodule"] = $this->admin_model->getsubmodule($code[1])->row_array();
			$data["schedule"] = $this->grades_model->get_schedule($code[0],$code[1])->row_array();
			
			print_r($this->session->all_userdata());
			$this->load->view('Backend/TCROA', $data);
			
		}
		elseif ($mode == "save")
		{
			$this->admin_model->save_tcroa();
			$this->tcroaedit($this->session->userdata("code"),$this->session->userdata("submodid"));
		}
		elseif ($mode == "print")
		{
			$code = explode("-",$submod);
	
			if (empty($code[1])) 
			{ 
				$code[1] = 0; 
				$this->session->set_userdata(array("code" => $code[0])); 
			}
			else
			{
				$this->session->set_userdata(array("code" => $code[0],"submodid" => $code[1]));
			}
			
			#$data["module"] = $this->admin_model->search_tcroa_module($code[0],$code[1]);
			$data['main'] = $this->admin_model->search_tcroa_headers_main($code[0],$code[1]);
			$data['specific'] = $this->admin_model->search_tcroa_headers_specific($code[0],$code[1]);
			$data["name"] = $this->admin_model->get_tcroa_results_name($code[0],$code[1]);
			$data["assessor"] = $this->admin_model->get_assessor($code[0],$code[1])->row_array();
			#print_r($this->session->all_userdata());
			
			$this->load->view("Backend/print/tcroa",$data);
			$html = $this->load->view("Backend/print/tcroa",$data,true);
			$this->load->library('pdf');
			$pdf = $this->pdf->load('utf-8', 'A4-L');
			$pdf->setFooter('{PAGENO} / {nb}');
			$pdf->AddPage('Letter-P', // L - landscape, P - portrait
			'', '', '', '',
			10, // margin left
			10, // margin right
			10, // margin top
			20, // margin bottom
			10, // margin header
			12);
			$pdf->WriteHTML($html);
			$pdf->Output(); 
		}
		else
		{
			#print_r($this->session->all_userdata());
			$this->session->unset_userdata("code");
			$this->session->unset_userdata("submodid");
			$this->load->view('Backend/TCROASearch');
		}
	}
	
	function tcroaedit($code = NULL, $submodid = NULL)
	{	
		$this->check_session();
		if ($this->session->userdata("user_level") == 1)
		{
			if (empty($submodid))
			{	
				$data['main'] = $this->admin_model->search_tcroa_headers_main($code);
				
				$data['specific'] = $this->admin_model->search_tcroa_headers_specific($code);

				$data["name"] = $this->admin_model->get_tcroa_results_name($code);
			}
			else
			{	
				$data['main'] = $this->admin_model->search_tcroa_headers_main($code,$submodid);

				$data['specific'] = $this->admin_model->search_tcroa_headers_specific($code,$submodid);
				
				$data["name"] = $this->admin_model->get_tcroa_results_name($code,$submodid);
			}
			#print_r($this->session->all_userdata());
			$this->load->view('Backend/TCROAEdit', $data);
		}
		else
		{
			
			redirect('admin/tcroa');
		}
		
	}
		
		
	function addmaincategory()
	{
		$this->check_session();
		$this->form_validation->set_rules('module','Grade ID', 'required|xss');
		$this->form_validation->set_rules('maincat','Main Category', 'required|xss');
		
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_model->save_main_category();
			redirect("admin/tcroa/modules/main");
		}
		else
		{
			$this->tcroa();
		}
	}
	
	function addspeccategory()
	{
		$this->check_session();
		$this->form_validation->set_rules('module','Module', 'required|xss');
		$this->form_validation->set_rules('maincat','Main Category', 'xss');
		$this->form_validation->set_rules('speccat','Specific Category', 'required|xss');
		
		if($this->form_validation->run()==TRUE)
		{
			$this->admin_model->save_specific_category();
			redirect("admin/tcroa/modules/specific");
		}
		else
		{
			$this->tcroa();
		}
	}
	
	function printtcroa()
	{
		$this->check_session();
		$code = explode("-",$this->input->post("code"));
			
		if (empty($code[1]))
		{
			$this->session->set_userdata(array("code" => $code[0])); 
			
			$data['main'] = $this->admin_model->search_tcroa_headers_main($code[0]);
			
			$data['specific'] = $this->admin_model->search_tcroa_headers_specific($code[0]);

			$data["name"] = $this->admin_model->get_tcroa_results_name($code[0]);
		}
		else
		{
			$this->session->set_userdata(array("code" => $code[0],"submodid" => $code[1]));
			
			$data['main'] = $this->admin_model->search_tcroa_headers_main($code[0],$code[1]);

			$data['specific'] = $this->admin_model->search_tcroa_headers_specific($code[0],$code[1]);
			
			$data["name"] = $this->admin_model->get_tcroa_results_name($code[0],$code[1]);
		}
		
		#$this->load->view("Backend/print/tcroa2",$data);
		
	}
	
	public function tcroamaincategory($id)
	{
		$data['maincat'] = $this->admin_model->get_tcroa_main_category($id);
		header('Content-Type: application/x-json; charset=utf-8');
		echo(json_encode($data));
	}

	//End TCROA Processess------------------------------------
	
	
	//---------------------------Assessor---------------------------
	//-------------------------------------------------------------

	public function assessor($mode = NULL, $code = NULL)
	{
		$this->check_session();
		
		if ($mode == "add")
		{
			$this->check_session();
			$this->form_validation->set_rules('lname','Last Name', 'required');
			$this->form_validation->set_rules('fname','First Name', 'required');
			$this->form_validation->set_rules('mname','Middle Name', 'required');
			$this->form_validation->set_error_delimiters("<div class='ui-widget'><div class='ui-state-error ui-corner-all' style='padding: 0 .7em; font-size:12px; margin-left:166px;'><p><span class='ui-icon ui-icon-alert' style='float: left; margin-right: .3em;'></span><strong>", "</strong></p></div></div>");
		
			if($this->form_validation->run()==TRUE)
			{ 
				$this->admin_model->save_assessor();
				$this->session->set_flashdata('message_type', 'warning'); 
				$this->session->set_flashdata('message', '<div class="ui-state-highlight ui-corner-all" style="margin-top: 10px; margin-bottom:20px; font-size:12px; padding: 0 .7em; margin-left:-50px;"><p><span class="ui-icon ui-icon-info" style="float: left; margin-right: .3em;"></span><strong>New Trainer has been Added!</strong></p></div>');	
				redirect('admin/assessor');
			}
			else
			{
			   redirect('admin/assessor');
			}
		}
		elseif ($mode == "activate")
		{
			$this->admin_model->activate_assessor($code);
			redirect("admin/assessor");
		}
		elseif ($mode == "inactivate")
		{
			$this->admin_model->inactivate_assessor($code);
			redirect("admin/assessor/");
		}
		elseif ($mode == "assign")
		{
			$data["assessors"] = $this->admin_model->total_table_result("assessor");
			$code = $this->session->userdata("code");
			$lols = $this->admin_model->check_submodules($code);
			if ($lols->num_rows() > 0)
			{
				$code = $lols->row_array();
				#print_r($code);
				$data["submodules"] = $this->admin_model->getsubmodule($code["modcode"]);
				$data["withsubmod"] = TRUE;
			} 
			else 
			{ 
				$data["withsubmod"] = false; 
			}
			
			$this->load->view('Backend/AssessorAssign',$data);
		}
		elseif ($mode == "assignconfirm")
		{
			$this->form_validation->set_rules('assessor','Assessor', 'required|xss|callback_checkassessor');
		
			if($this->form_validation->run()==TRUE)
			{
				$this->admin_model->assign_assessor();
				$this->session->set_flashdata('message', '<div style="text-align:center; background: #d92320; color:#fff;">Successfully added Assessor!</div>');
				redirect("admin/tcroa");
			}
			else
			{
				$this->assessor("assign");
			}
		}
		elseif ($mode == "delete")
		{
			$this->check_session();
			$this->check_admin();
			
			$this->admin_model->delete_table($code,'trainer','trainerid');
			redirect('admin/assessor/');
		}
		else
		{
			$config['base_url'] = site_url('admin/assessor/');
			$config['total_rows'] = $this->admin_model->total_table_result('assessor')->num_rows();
			$config['per_page'] = 10;
			$config['num_links'] = 10;
			$config['full_tag_open'] = '<div id="pagination">';
			$config['full_tag_close'] = '</div>';
			$config['cur_tag_open'] = '<span class="page active">';
			$config['cur_tag_close'] = '</span>';
			$config['next_link'] = 'Next';
			$config['prev_link'] = 'Prev';
			
			
			$data['records'] = $this->admin_model->searchtable(10,'assessor','lname,fname')->result_array();
			$this->pagination->initialize($config);
			$this->load->view('Backend/Assessor',$data);
		}
	}

	public function checkassessor($assessor)
	{
		if ($assessor == "#")
		{
			$this->form_validation->set_message('checkassessor', 'Please Select an Assessor');
			return FALSE;
		}
	}
	
	//-----------------------------------End of Assessor
	//--------------------------------------------------
	
	public function changestatusquestion($modid = 0, $id = 0,$status = 0)
	{
		$this->admin_model->change_status_question($id,$status);
		redirect('admin/questions/all/'.$modid);
	}
	
	public function changestatusmodule($id = 0,$status = 0)
	{
		$this->admin_model->change_status_module($id,$status);
		redirect('admin/modules');
	}
	
	public function traineeresults()
	{
		$this->load->view('Backend/Results');
	}
	
	public function showscore()
	{
		$this->load->model('assessment_model');
		$data["records"] = $this->admin_model->show_score();
		$row = $data["records"]->row_array();
		$data["rec"] = $this->assessment_model->show_records($row["trainingid"],$row["submodid"])->row_array();
		$data["res"] = $this->assessment_model->show_results($row["trainingid"],0,$row["submodid"]);
		$this->load->view('Backend/ResultShow',$data);
	}
	
	public function editme()
	{
		
	}
}
