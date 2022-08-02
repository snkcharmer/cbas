<?php	
	class Assessment_model extends CI_Model
	{
		var $data = array();
		function __construct()
		{
			parent::__construct();	
		}	
		
		function checklocked($trainingid = 0,$submodid = 0)
		{
			$this->db->select("locked");
			$this->db->where("trainingid",$trainingid);
			$this->db->where("submodid",$submodid);
			$query = $this->db->get("cbas_grades");
			return $query;
		}
		
		function trainee_login()
		{
			$trid = $this->input->post("trid");
			$code = $this->input->post("code");
			
			$code = explode("-",$this->input->post("code"));
			$submodid = (!empty($code[1]) ? $code[1] : 0);
				
			$this->db->select("d.code,a.trainingid,c.lname,c.fname,c.mname,e.module, c.bdate,f.rank,h.submodule,b.submodid,g.id");
			$this->db->from("training a");
			$this->db->join("cbas_grades b","a.trainingid = b.trainingid","inner");
			$this->db->join("trainee c","a.trid = c.trid","inner");
			$this->db->join("schedule d","a.code = d.code","inner");
			$this->db->join("module e","d.modcode = e.modcode","inner");
			$this->db->join("rank f","a.rankid = f.rankid","left");
			$this->db->join("cbas_modules g","g.modcode = e.modcode and g.submodid = ".$submodid,"left");
			$this->db->join("submodule h","h.submodid = g.submodid and e.modcode = h.modcode","left");
			$this->db->where(array("b.code" => $code[0], "a.trid" => $trid,"b.submodid" => $submodid));
			$query = $this->db->get();
			return $query;
			#print_r($this->db->last_query()); die();
		}
		
		function get_limit($mcbasid)
		{
			$this->db->select("id,duration,quantity,dscrptn");
			$this->db->from("cbas_modules");
			$this->db->where(array("id" => $mcbasid));
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function get_rand_questions($modcode,$limit)
		{
			$sql = "Select * from cbas_questions where module_id = ? and active = 1 order by rand() limit ?";
			$query = $this->db->query($sql,array($modcode,$limit));
			return $query;
		}
		
		function check_if_retake($trainingid,$submodid = 0)
		{
			$this->db->select("count");
			$this->db->where("trainingid",$trainingid);
			$this->db->where("submodid",$submodid);
			$this->db->group_by("count");
			$query = $this->db->get("cbas_results");
			
			return $query;
		}
		
		function save_results($count = 0,$retake = 0)
		{
			date_default_timezone_set("Asia/Taipei"); 
			$questions = $this->input->post("question");
			$submodid = $this->input->post("submodid");
			$trainingid = $this->input->post("trainingid");
			$mcbasid = $this->input->post("mcbasid");
			
			#print_r($this->input->post("question")); die();
			
			foreach ($questions as $idnum => $answer)
			{
				$data[] = array(
					"trainingid" => $trainingid,
					"submodid" => $submodid,
					"question_id" => $idnum,
					"answer_code" => $answer,
					"created" => date('Y-m-d H:i:s'),
					"count" => $count
				);
			}
			
			
			$this->db->insert_batch("cbas_results",$data);
			
			#count correct answer
			$sql = "select count(*) as count,(select quantity from cbas_modules where id = ?) as quantity from cbas_results a inner join cbas_questions b on a.question_id = b.id where a.trainingid = ? and a.submodid = ? and a.answer_code = b.answer and count = ?";
			$query = $this->db->query($sql,array($mcbasid,$trainingid,$submodid,$count))->row_array();
			
			$exam = $query["count"];
			$item = $query["quantity"];
			#echo $exam." - ".$item;
			
			$rate = ((($exam / $item) * 50) + 50) * 0.95;
			
			if ($count == 0)
			{
				$rate = $rate;
			}
			else
			{
				if ($rate >= 75)
				{
					$rate = 75;
				}
				else
				{
					$rate = $rate;
				}
			}
			
			$rate = round($rate);
			
			$date = date('Y-m-d H:i:s');
			
			if ($count == 0){
				$sql = "update cbas_grades 
					set rate1 = ?, exam1 = ?, item1 = ?,date1 = ?, locked = 1,
					saved = 1
					where trainingid = ? and submodid = ?";
					$this->db->query($sql,array($rate,$exam,$item,$date,$trainingid,$submodid));
				
			} else {
				$sql = "update cbas_grades 
					set 
					exam3 = if(date1 is not NULL and date2 is not NULL, ?, exam3),
					item3 = if(date1 is not NULL and date2 is not NULL, ?, item3),
					rate3 = if(date1 is not NULL and date2 is not NULL, ?, rate3),
					date3 = if(date1 is not NULL and date2 is not NULL, ?, date3),
					exam2 = if(date1 is not NULL and date2 is NULL, ?, exam2),
					item2 = if(date1 is not NULL and date2 is NULL, ?, item2),
					rate2 = if(date1 is not NULL and date2 is NULL, ?, rate2),
					date2 = if(date1 is not NULL and date2 is NULL, ?, date2),
					locked = 1,
					saved = 1
					where trainingid = ? and submodid = ?";
					$this->db->query($sql,array($exam,$item,$rate,$date,$exam,$item,$rate,$date,$trainingid,$submodid));
			}
			
			#print_r($this->db->last_query()); die();
			
			#-----------------011216 added this function---------------------
			// if ($submodid == 0)
			// {
				// $trainingarr = array(
					// "fgrade" => $rate,
				// );
				// $this->db->where("trainingid",$trainingid);
				// $this->db->update("training",$trainingarr);
			// }
			// else
			// {
				// $trainingarr = array(
				// "fgrade" => $rate,
				// );
				// $this->db->where("trainingid",$trainingid);
				// $this->db->where("submodid",$submodid);
				// $this->db->update("subtraining",$trainingarr);
			// }
			#print_r($this->db->last_query()); die();
			#----------------- End of 011216 added function---------------------
		}
		
		function show_results($trainingid,$retake,$submodid = 0)
		{
			$sql = "select *,IF(a.answer_code = b.answer, 'correct', 'incorrect') as status from cbas_results a 
			inner join cbas_questions b on a.question_id = b.id 
			where a.trainingid = ? and a.count = ? and a.submodid = ?";

			return $this->db->query($sql,array($trainingid,intval($retake),$submodid));
		}
		
		function show_records($trainingid = 0,$submodid = 0)
		{
			$this->db->select("concat(d.lname,', ',d.fname,' ',d.mname) as fullname, bb.module,b.start,b.end,b.code,d.trid,e.*,c.submodule",False);
			$this->db->from("training a");
			#$this->db->join("schedule_complete b","a.code = b.code","inner");
			$this->db->join("schedule b","a.code = b.code","inner");
			$this->db->join("module bb","b.modcode = bb.modcode","inner");
			$this->db->join("submodule c","bb.modcode = c.modcode","left");
			$this->db->join("trainee d","a.trid = d.trid","left");
			$this->db->join("cbas_grades e","a.trainingid = e.trainingid","left");
			
			if ($submodid != 0)
			{
				$this->db->select("c.submodule");
				$this->db->where("a.trainingid",$trainingid);
				$this->db->where("c.submodid",$submodid);
			}
			else
			{
				$this->db->where("a.trainingid",$trainingid);
			}
			
			$query = $this->db->get();
			#print_r($this->db->last_query()); die();
			return $query;
		}
		
		function check_locked($trainingid,$submodid)
		{
			$this->db->select("locked,saved");
			$this->db->where("trainingid",$trainingid);
			$this->db->where("submodid",$submodid);
			$query = $this->db->get("cbas_grades");
			return $query;
		}
		
		function lock_question()
		{
			$trainingid = $this->input->post("trainingid");
			$submodid = $this->input->post("submodid");
			
			$data =  array("locked" => 1);
			$this->db->where("trainingid",$trainingid);
			$this->db->where("submodid",$submodid);
			$this->db->update("cbas_grades",$data);
		}
		
		
	}
?>