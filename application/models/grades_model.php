<?php	
	class Grades_model extends CI_Model
	{
		var $data = array();
		function __construct()
		{
			parent::__construct();
		}	
		
		function schedule_with_submodule()
		{
			return $this->db->get("schedule_with_submodule");
		}
		
		function get_schedule($code = NULL,$submod = 0)
		{
			#$this->db->from("schedule_complete a");
			$this->db->select("a.code,c.module,c.modcode,b.submodule,a.end,a.start,a.batch,a.size,a.ndays");
			$this->db->from("schedule a");
			$this->db->join("submodule b","a.modcode = b.modcode","left");
			$this->db->join("module c","a.modcode = c.modcode","left");
			$this->db->where("a.code",$code);
			
			if (!empty($submod))
			{
				$this->db->where("b.submodid",$submod);
			}
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function get_trainees_grade($code = NULL,$submodid = 0)
		{	
			$this->db->select("concat(d.lname,', ',d.fname,' ',d.mname,' ',d.suffix) as fullname,c.prac,c.inc,c.dna,c.locked,c.saved,c.date1,c.date2,c.date3,c.rate1,c.rate2,c.rate3,c.gradeid,c.trainingid,c.submodid,c.fgrade,d.trid,d.bplace,d.sex",false);
			$this->db->from("schedule a");
			$this->db->join("training b","a.code = b.code","inner");
			$this->db->join("cbas_grades c","b.trainingid = c.trainingid","inner");
			$this->db->join("trainee d","b.trid = d.trid","inner");
			$this->db->join("submodule e","e.submodid = c.submodid","left");
			$this->db->where(array("a.code" => $code, "c.submodid" => $submodid));
			$this->db->order_by("lname,fname");
			$query = $this->db->get();
			print_r($this->db->last_query());
			return $query;
		}
		
		function get_schedule_complete($code = NULL)
		{
			$sql = "select a.code, a.modcode, a.batch, a.start, a.end, a.ndays, a.hours, a.fee,
			a.max, a.size, a.section, a.trainerid, a.lastupdate, a.gradeok, a.certiok, a.module,
			a.remarks, a.verified, b.module, b.descriptn, 
			group_concat(d.lname, ' ',d.fname separator ', ') as trainergroup
			from schedule a 
			inner join module b on a.modcode = b.modcode
			left join trainers_sched c on a.code = c.code
			left join trainer d on c.trainerid = d.trainerid
			where a.code = ?
			group by a.code desc";
			
			$query = $this->db->query($sql,array($code));
			#$query = $this->db->get_where('schedule_complete',array('code'=>$code));
			#print_r($this->db->last_query()); die();
			
			return $query;
		}
		
		function get_training_records($code = NULL)
		{
			$sql = "select * from training a 
			inner join trainee b on a.trid = b.trid
			LEFT JOIN license c on a.licid = c.licid
			LEFT JOIN rank d ON a.rankid = d.rankid
			LEFT JOIN employer e ON a.employid = e.employid			
			where a.code = ?";
			$query = $this->db->query($sql,array($code));
			return $query;
		}
		
		function hassubmodule($code = NULL)
		{
			#$this->db->where("code",$code);
			#return $this->db->get("schedule_with_submodule");
			
			$this->db->select("a.code,b.modcode,b.module");
			$this->db->from("schedule a");
			$this->db->join("module b","a.modcode = b.modcode","inner");
			$this->db->join("submodule c","b.modcode = c.modcode","inner");
			$this->db->where("a.code",$code);
			return $this->db->get();
		}
		
		function create_grades()
		{
			$code = $this->session->userdata("code");
			$userid = $this->session->userdata("userid");
			
			$sql = "Insert into cbas_grades(code,trainingid,submodid,created,user) 
			select ?,a.trainingid,d.submodid,now(),? 
			from training a 
			inner join schedule b on a.code = b.code
			inner join module c on b.modcode = c.modcode
			left join submodule d on c.modcode = d.modcode 
			where a.trainingid not in (select trainingid from cbas_grades where code = ?) and a.code = ?";
			$this->db->query($sql,array($code,$userid,$code,$code));
			
			/** $sql = "Insert into cbas_tcroa_results(specid,trainingid,code,submodid,created) 
			select d.specid,a.trainingid,b.code,c.submodid,now() from training a 
			inner join schedule_complete b on a.code = b.code 
			inner join cbas_modules c on c.modcode = b.modcode
			inner join cbas_tcroa_specific d on d.id = c.id
			where c.tcroa = 1 and b.code = ? and a.trainingid not in (select trainingid from cbas_tcroa_results where code = ?)"; **/
			
			$sql = "Insert into cbas_tcroa_results(specid,trainingid,code,submodid,created) 
			select d.specid,a.trainingid,b.code,c.submodid,now() from training a 
			inner join schedule b on a.code = b.code
			inner join module cc on b.modcode = cc.modcode
			inner join cbas_modules c on c.modcode = cc.modcode
			inner join cbas_tcroa_specific d on d.id = c.id
			where c.tcroa = 1 and b.code = ? and a.trainingid not in (select trainingid from cbas_tcroa_results where code = ?)";
		
			$this->db->query($sql,array($code,$code));
			
		}
		
		function save_grades()
		{
			$gradeid = $this->input->post("gradeid");
			$trainingid = $this->input->post("trainingid");
			$submodid = $this->input->post("submodid");
			$exam1 = $this->input->post("exam1");
			$exam2 = $this->input->post("exam2");
			$exam3 = $this->input->post("exam3");
			$date1 = $this->input->post("date1");
			$date2 = $this->input->post("date2");
			$date3 = $this->input->post("date3");
			$prac = $this->input->post("prac");
			$fgrade = $this->input->post("fgrade");
			
			#save to cbas_grades-----------------------------
			foreach ($this->input->post("gradeid") as $rows => $key)
			{
				$inc = $this->input->post("inc".$key);
				$dna = $this->input->post("dna".$key);
				$locked = $this->input->post("locked".$key);
				$saved = $this->input->post("saved".$key);
				$date1_ = (empty($date1[$rows]) ? NULL : $date1[$rows]);
				$date2_ = (empty($date2[$rows]) ? NULL : $date2[$rows]);
				$date3_ = (empty($date3[$rows]) ? NULL : $date3[$rows]);
				$data[] = array(
					"gradeid" => $gradeid[$rows],
					"trainingid" => $trainingid[$rows],
					"submodid" => $submodid[$rows],
					"rate1" => $exam1[$rows],
					"rate2" => $exam2[$rows],
					"rate3" => $exam3[$rows],
					"date1" => $date1_,
					"date2" => $date2_,
					"date3" => $date3_,
					"prac" => $prac[$rows],
					"inc" => $inc,
					"dna" => $dna,
					"locked" => $locked,
					"saved" => $saved,
					"fgrade" => $fgrade[$rows],
					"created" => date('Y-m-d H:i:s'),
					"user" => $this->session->userdata("userid"),
				);
			}
			$this->db->update_batch("cbas_grades",$data,"gradeid");
			#end save to cbas_grades-----------------------------
			
			/*
			#save to training(Registrar)-----------------------------
			$exam1 = $this->input->post("exam1");
			$exam2 = $this->input->post("exam2");
			$exam3 = $this->input->post("exam3");
			
			foreach ($this->input->post("gradeid") as $rows2 => $key2)
			{
				if ($exam3[$rows2] == 0)
				{
					if($exam2[$rows2] == 0)
					{
						$fgrade = $exam1[$rows2];
					}
					else
					{
						$fgrade = $exam2[$rows2];
					}
				}
				else
				{
					$fgrade = $exam3[$rows2];
				}
				$fgrade = round($fgrade);
				$fgrade = ($this->input->post("dna".$key2) == 1 ? "DNA" : $fgrade);
				$fgrade = ($this->input->post("inc".$key2) == 1 ? "INC" : $fgrade);
				
				if ($submodid[$rows2] == 0)
				{
					$data2[] = array(
						"trainingid" => $trainingid[$rows2],
						"fgrade" => $fgrade,
						"user" => $this->session->userdata("userid"),
					);
					$trigger = 1;
				}
				else
				{
					$data2 = array(
						"fgrade" => $fgrade,
						"user" => $this->session->userdata("userid"),
					);
					
					$this->db->where("submodid",$submodid[$rows2]);
					$this->db->where("trainingid",$trainingid[$rows2]);
					$this->db->update("subtraining",$data2);
				}
			}
			
			if ($trigger == 1)
			{
				$this->db->update_batch("training",$data2,"trainingid");
			}
			*/
			/*print_r($this->db->last_query()); 
			echo "<br><br>";
			print_r($this->input->post("gradeid")); 
			print_r($this->input->post("exam1")); 
			print_r($fgrade); 
			die(); */
			#end save to training(Registrar)-----------------------------
			
		}
		
	}
?>