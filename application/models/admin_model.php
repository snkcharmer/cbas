<?php	
	class Admin_model extends CI_Model
	{
		var $data = array();
		function __construct()
		{
			parent::__construct();	
			$this->load->library('typography');
		}
		
		function checklogin()
		{	
			date_default_timezone_set("Asia/Taipei"); 
			$username = $this->input->post("username");
			$password = $this->input->post("password");

			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			$this->db->where("active",1);
			$query = $this->db->get('cbas_users');
			
			$data = array(
				"lastlog" => date('Y-m-d H:i:s')
			);
			
			$this->db->where('username', $this->input->post('username'));
			$this->db->where('password', md5($this->input->post('password')));
			$this->db->where("active",1);
			
			$this->db->update("cbas_users",$data);
			
			return $query;
		}
		
		function searchmodule()
		{
			$schedule = $this->session->userdata('module');
			
			$this->db->select("a.*,count(b.module_id) as totalques");
			$this->db->from("cbas_modules a");
			$this->db->join("cbas_questions b","a.id = b.module_id","left");
			$this->db->order_by("a.item","asc");
			$this->db->group_by("a.id");
			$query = $this->db->get();
			return $query;
		}
		
		function get_modules()
		{
			$this->db->order_by("module","asc");
			return $this->db->get("module");
		}
		
		function save_module()
		{
			$data = array(
			"item" => $this->input->post("module"),
			"modcode" => $this->input->post("modcode"),
			"dscrptn" => $this->input->post("description"),
			"quantity" => $this->input->post("quantity"),
			"duration" => $this->input->post("duration"),
			"active" => 1,
			"created" => date('Y-m-d H:i:s'),
			"user" => $this->session->userdata("userid")
			);
			
			$this->db->insert("cbas_modules",$data);
			
		}
		
		function edit_module($id)
		{
			$data = array(
			"dscrptn" => $this->input->post("description"),
			"quantity" => $this->input->post("quantity"),
			"duration" => $this->input->post("duration"),
			"user" => $this->session->userdata("userid")
			);
			
			$this->db->where("id",$id);
			$this->db->update("cbas_modules",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function get_questions($id = NULL)
		{
			return $this->db->get_where("cbas_questions",array("module_id" => $id));
		}
		
		function get_specific_question($id = NULL)
		{
			return $this->db->get_where("cbas_questions",array("id" => $id));
		}
		
		function save_question($file = NULL)
		{
			$quesid = $this->session->userdata("quesid");
			
			$item = $this->input->post("item");
			$opt1 = $this->input->post("opt1");
			$opt2 = $this->input->post("opt2");
			$opt3 = $this->input->post("opt3");
			$opt4 = $this->input->post("opt4");
			$answer = $this->input->post("answer");
			
			$data = array(
				"item" => $this->typography->nl2br_except_pre($item),
				"opt1" => $opt1,
				"opt2" => $opt2,
				"opt3" => $opt3,
				"opt4" => $opt4,
				"answer" => $answer,
				"banner" => $file
			);
			
			$this->db->where("id",$quesid);
			$this->db->update("cbas_questions",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function add_question($file = NULL)
		{
			$module_id = $this->session->userdata("module_id");
			$item = $this->input->post("item");
			$opt1 = $this->input->post("opt1");
			$opt2 = $this->input->post("opt2");
			$opt3 = $this->input->post("opt3");
			$opt4 = $this->input->post("opt4");
			$answer = $this->input->post("answer");
			
			$data = array(
				"item" => $this->typography->nl2br_except_pre($item),
				"opt1" => $opt1,
				"opt2" => $opt2,
				"opt3" => $opt3,
				"opt4" => $opt4,
				"answer" => $answer,
				"banner" => $file,
				"module_id" => $module_id
			);
			
			$this->db->insert("cbas_questions",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function get_module_cbas($id = NULL)
		{
			$this->db->where("id",$id);
			$query = $this->db->get("cbas_modules");
			return $query;
		}
		
		function get_module_cbas_all()
		{
			$this->db->where("active","1");
			$this->db->order_by("item","asc");
			$query = $this->db->get("cbas_modules");
			return $query;
		}
		
		function get_settings()
		{
			return $this->db->get("settings");
		}
		
		function set_settings()
		{
			$con = $this->input->post("connection");
			
			$data = array(
				"connection" => $con
			);
			$this->db->update("settings",$con);
		}
		
		function get_users()
		{
			$this->db->select("concat(b.lname,', ',b.fname,' ',b.mname) as fulllname, a.*",false);
			$this->db->from("cbas_users a");
			$this->db->join("hrm_employee b","a.empid = b.empid","inner");
			$query = $this->db->get();
			
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function add_user()
		{
			date_default_timezone_set("Asia/Taipei"); 
			$empid =  $this->input->post("empid");
			$username =  $this->input->post("username");
			$password =  $this->input->post("password");
			$acctype =  $this->input->post("acctype");
			
			$data = array(
				"empid" => $empid,
				"username" => $username,
				"password" => md5($password),
				"usertype" => $acctype,
				"active" => 1,
				"created" => date('Y-m-d H:i:s'),
			);
			
			$this->db->insert("cbas_users",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function activate_user($empid = NULL)
		{
			$data = array(
				"active" => 1
			);
			$this->db->where("empid",$empid);
			$this->db->update("cbas_users",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function inactivate_user($empid = NULL)
		{
			$data = array(
				"active" => 0
			);
			
			$this->db->where("empid",$empid);
			$this->db->update("cbas_users",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function get_employee()
		{
			$this->db->order_by("lname, fname", "asc");
			$query = $this->db->get('hrm_employee');
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function save_logs($remarks = NULL)
		{
			date_default_timezone_set("Asia/Taipei");
			$userid = $this->session->userdata("userid");
			$data = array(
				"userid" => $userid,
				"remarks" => $remarks,
				"activity" => date('Y-m-d H:i:s')
			);
			
			$this->db->insert("cbas_logs",$data);
		}
		
		function get_head()
		{
			return $this->db->get("cbas_head");
		}
		
		//--------------------------------------------------------
		//-------------------- TCROA Processess ------------------
		//--------------------------------------------------------
		
		function search_tcroa_module($code = 0,$submodid = 0)
		{
			$this->db->select("descrptn");
			$this->db->where("a.code",$code);
			$this->db->where("a.submodid",$submodid);
			$query = $this->db->get();
			
			return $query;
		}
		
		function search_tcroa_headers_main($code = 0,$submodid = 0)
		{
			$this->db->select("c.competency,count(distinct(b.specid)) as col",false);
			$this->db->from("cbas_tcroa_results a");
			$this->db->join("cbas_tcroa_specific b","a.specid = b.specid","left");
			$this->db->join("cbas_tcroa_maincategory c","c.mainid = b.mainid","left");
			$this->db->where("a.code",$code);
			$this->db->where("a.submodid",$submodid);
			$this->db->group_by("c.mainid");
			$this->db->order_by("c.mainid");
			$query = $this->db->get();
			
			#print_r($this->db->last_query());  die();
			return $query;
		}
		
		function search_tcroa_headers_specific($code = 0,$submodid = 0)
		{
			$this->db->select("b.speccompetency",false);
			$this->db->from("cbas_tcroa_results a");
			$this->db->join("cbas_tcroa_specific b","a.specid = b.specid","left");
			$this->db->join("cbas_tcroa_maincategory c","c.mainid = b.mainid","left");
			$this->db->where("a.code",$code);
			$this->db->where("a.submodid",$submodid);
			$this->db->group_by("b.specid");
			$this->db->order_by("b.specid");
			$query = $this->db->get();
			
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function search_tcroa_grades($code = 0,$submodid = 0,$trid = 0)
		{
			$sql = "select * from cbas_tcroa_results where code = ? and submodid = ? and trainingid = ? order by trainingid,specid";
			
			$query = $this->db->query($sql,array($code,$submodid,$trid));
			
			#print_r($this->db->last_query()); die();
			foreach ($query->result() as $comp)
			{
				
				$data[] = array(
					"specid" => $comp->specid,
					"resid" => $comp->resid,
					"competent" => $comp->competent,
				);
			}
			
			return $data;
		}
		
		function get_tcroa_results_name($code = 0, $submodid = 0)
		{
			$sql = "select distinct(concat(c.lname,', ',c.fname,' ',left(c.mname,1))) as fullname,a.trainingid,c.bplace,date_format(c.bdate,'%y-%m-%d') as bdate,f.rankshort,e.dscrptn,b.certnumber,b.fgrade,d.code,d.batch,g.fgrade as fgradesub,
			(case
				when d.end = d.start then d.end
				when month(d.end) = month(d.start) then concat(DATE_FORMAT(d.start,'%b'),' ',day(d.start),'-',day(d.end),', ',year(d.end))
				when month(d.end) <> month(d.start) then concat(DATE_FORMAT(d.start,'%b'),' ',day(d.start),'-',DATE_FORMAT(d.end,'%b'),' ',day(d.end),', ',year(d.end))
			end) as mydate 
			from cbas_tcroa_results a 
			left join training b on a.trainingid = b.trainingid
			left join trainee c on b.trid = c.trid
			left join schedule d on d.code = b.code
			left join cbas_modules e on d.modcode = e.modcode and e.submodid = ?
			left join rank f on c.rankid = f.rankid
			left join subtraining g on a.trainingid = g.trainingid and g.submodid = ?
			where a.code = ? and a.submodid = ? order by c.lname,c.fname";
			
			$query = $this->db->query($sql,array($submodid,$submodid,$code,$submodid));
			
			#print_r($this->db->last_query()); die();
			foreach ($query->result() as $row)
			{
				$data[] = array(
					"name" => $row->fullname,
					"grades" => $this->search_tcroa_grades($code,$submodid,$row->trainingid),
					"rankshort" => $row->rankshort,
					"description" => $row->rankshort,
					"rankshort" => $row->rankshort,
					"mydate" => $row->mydate,
					"bplace" => $row->bplace,
					"bdate" => $row->bdate,
					"module" => $row->dscrptn,
					"certnumber" => $row->certnumber,
					"fgrade" => $row->fgrade,
					"batch" => $row->batch,
					"fgradesub" => $row->fgradesub
				);
			}
			
			#print_r($data); die();
			#print_r($this->db->last_query()); die();
			if (empty($data))
			{
				return 0;
			} else { return $data;	}
			
			
		}
		
		function save_tcroa()
		{
			$checkbox = $this->input->post("inc");
			$submodid = $this->session->userdata("submodid");
			$code = $this->session->userdata("code");
			
			$data = array(
				"competent" => 0
			);
			$this->db->where("code",$code);
			$this->db->where("submodid",$submodid);
			$this->db->update("cbas_tcroa_results",$data);
			
			foreach ($checkbox as $lols => $key)
			{
				$resid_all[] = array(
				"resid" => $lols,
				"competent" => 1
				);
				#echo $lols." ".$key." <br>";
			}
			#die();
			$this->db->update_batch("cbas_tcroa_results",$resid_all,"resid");
		}
		
		function get_tcroa_main_category($id = NULL)
		{
			$this->db->where("id",$id);
			$query = $this->db->get("cbas_tcroa_maincategory");
			
			if($query->result()){
				foreach ($query->result() as $mod) 
				{
					$data[] = array(
						'mainid' => $mod->mainid,
						'id' => $mod->id,
						'competency' => $mod->competency,
						);
				}
				return $data;
				
			}else{
				
				return FALSE;
			}
		}
		
		function save_main_category()
		{
			date_default_timezone_set("Asia/Taipei");
			$id = $this->input->post("module");
			$maincat = $this->input->post("maincat");
			
			$data = array(
				"id" => $id,
				"competency" => $maincat,
				"created" => date('Y-m-d H:i:s'),
				"active" => 1,
			);
			
			$this->db->insert("cbas_tcroa_maincategory",$data);
		}
		
		function save_specific_category()
		{
			date_default_timezone_set("Asia/Taipei");
			$id = $this->input->post("module");
			$maincat = $this->input->post("maincat");
			$speccat = $this->input->post("speccat");
			
			#echo $maincat; die();
			$data = array(
				"mainid" => $maincat,
				"id" => $id,
				"speccompetency" => $speccat,
				"created" => date('Y-m-d H:i:s'),
				"active" => 1,
			);
			
			$this->db->insert("cbas_tcroa_specific",$data);
		}
		
		
		
		//------------------------------------------------------------
		//---------------End TCROA Processess-------------------------
		//------------------------------------------------------------
		
		function total_table_result($table)
		{
			return $this->db->get($table);
		}
		
		function searchtable($count,$table,$colname)
		{	
			$this->db->select('*');
			$this->db->order_by($colname,'asc');
			$query = $this->db->get($table, $count,intval($this->uri->segment(3)));
			return $query;
		}
		
		function delete_table($code,$table,$colname)
		{
			$this->db->delete($table, array($colname => $code)); 
		}
		
		function save_assessor()
		{
			$data = array(
				'lname' => strtoupper($this->input->post('lname')),
				'fname' => strtoupper($this->input->post('fname')),
				'mname' => strtoupper($this->input->post('mname')),
				'suffix' => strtoupper($this->input->post('suffix')),
				'bday' => strtoupper($this->input->post('bday')),
				'sex' => strtoupper($this->input->post('sex')),
				'address' => strtoupper($this->input->post('address')),
				'zipcode' => strtoupper($this->input->post('zipcode')),
				'active' => strtoupper($this->input->post('active')),
				);
				
			$this->db->insert('assessor', $data);
		}
		
		function assign_assessor()
		{
			$submodid = $this->session->userdata("submodid");
			$submod = ($submodid != NULL ? $submodid : 0);
			
			$data = array(
				"assessorid" => $this->input->post("assessor"),
				"code" => $this->session->userdata("code"),
				"submodid" => $submod,
			);
			
			$this->db->insert("assessor_sched",$data);
		}
		
		function activate_assessor($assessorid = NULL)
		{
			$data = array(
				"active" => 1
			);
			$this->db->where("assessorid",$assessorid);
			$this->db->update("assessor",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function inactivate_assessor($assessorid = NULL)
		{
			$data = array(
				"active" => 0
			);
			
			$this->db->where("assessorid",$assessorid);
			$this->db->update("assessor",$data);
			
			$this->save_logs($this->db->last_query());
		}
		
		function get_assessor($code = 0, $submodid = 0)
		{
			$this->db->select("b.lname,b.fname,b.mname");
			$this->db->from("assessor_sched a");
			$this->db->join("assessor b","a.assessorid = b.assessorid");
			$this->db->where("a.code",$code);
			$this->db->where("a.submodid",$submodid);
			$this->db->order_by("a.asschedid");
			$query = $this->db->get();
			return $query;
		}
		
		public function check_submodules($code = NULL)
		{
			$this->db->select("code, modcode");
			return $this->db->get_where("schedule_with_submod",array("code" => $code));
		}
		
		function getsubmodule($modcode = NULL)
		{
			$this->db->where("modcode",$modcode);
			return $this->db->get("submodule");
		}
		
		function change_status_question($id = 0,$status = 0)
		{
			$data = array(
				"active" => $status
			);
			$this->db->where("id",$id);
			$this->db->update("cbas_questions",$data);
		}
		
		function change_status_module($id = 0,$status = 0)
		{
			$data = array(
				"active" => $status
			);
			$this->db->where("id",$id);
			$this->db->update("cbas_modules",$data);
		}
		
		function show_score()
		{
			$trid = $this->input->post("trid");
			$code = $this->input->post("code");
			
			$code = explode("-",$this->input->post("code"));
			$submodid = (!empty($code[1]) ? $code[1] : 0);
			
			$sql = "select e.lname,e.fname,e.mname,b.*,c.opt1,c.opt2,c.opt3,c.opt4,c.item as ques,c.answer as ans,d.* from training a
				inner join cbas_results b on a.trainingid = b.trainingid
				inner join cbas_questions c on b.question_id = c.id
				inner join cbas_modules d on c.module_id = d.id
				inner join trainee e on a.trid = e.trid
				where a.trid = ? and a.code = ? and b.submodid = ?";
			
			$query = $this->db->query($sql,array($trid,$code[0],$submodid));
			#print_r($this->db->last_query()); die();
			return $query;
		}
	}
?>
