<?php

class users_m extends MY_Model{

	function __construct() {

		parent::__construct();

		$this->load->model("facilities_m");	
		$this->load->model("sub_counties_m");	
		$this->load->model("counties_m");	
		$this->load->model("partners_m");	
	}

	public function create(){
		
	}

	public function read($id=NULL){

		$users = array();

		$verbose = $this->input->get('verbose');

		$is_datatable = $this->input->get("datatable");

		$search = $this->input->get("search");
		$order = $this->input->get("order");
		$limit_start = $this->input->get("limit_start");
		$limit_items = $this->input->get("limit_items");
		
		$draw;$order_col;$order_dir;


		$total_records = 0;
		$records_filtered = 0;

		if($is_datatable){
			$search = $search['value'];
			$search = addslashes($search);

			$columns = $this->input->get("columns");

			$order_col_index = $order[0]['column'];
			$order_col = $columns[$order_col_index]['data'];
			$order_dir = $order[0]['dir'];


			$limit_start = $this->input->get("start");
			$limit_items = $this->input->get("length");
			$draw = $this->input->get("draw");

			
			$total_records		=	(int) $this->api_get_users($id,NULL,$order_col,$order_dir,NULL,NULL,'true')[0]['count'];
			$records_filtered	=	(int) $this->api_get_users($id,NULL,$order_col,$order_dir,$limit_start,$limit_items,'true')[0]['count'];
		}

		$search = addslashes($search);


		$counties_res = $this->api_get_users($id,$search,$order_col,$order_dir,$limit_start,$limit_items,'false');

		if($id==NULL){

			$users =  $counties_res;	

			foreach ($users as $key => $value) {
				// $this->aauth->add_member($users[$key]['id'],'facility_default');
				
				// $mfl = $users[$key]['email'];
				 
				// $f_id = (int) R::getAll("SELECT f.id FROM aauth_users  u LEFT JOIN facility f ON f.mfl_code = u.email WHERE f.mfl_code ='$mfl'")[0]['id'];

				// $this->aauth->set_user_var('linked_entity_id',$f_id,$users[$key]['id']);

				$users[$key]['default_user_group']  = (array) $this->aauth->get_user_groups($users[$key]['id'])[0];
				$users[$key]['user_groups']  = (array) $this->aauth->get_user_groups($users[$key]['id']);
				$users[$key]['linked_entity_id']  = (int) $this->aauth->get_user_var("linked_entity_id",$users[$key]['id']);

				if($users[$key]['default_user_group']['group_id']== 4){

					$mfl = $users[$key]['email'];

					$f_email =  R::getAll("SELECT f.email FROM aauth_users  u LEFT JOIN facility f ON f.mfl_code = u.email WHERE f.mfl_code ='$mfl'")[0]['id'];

					$users[$key]['email'] = $f_email;

				}

			}

		}else{

			$users =  $counties_res[0];	

			if(!is_null($users['id'])){	

				$users['default_user_group']  = (array) $this->aauth->get_user_groups($users['id'])[0];
				$users['user_groups']  = (array) $this->aauth->get_user_groups($users['id']);
				$users['linked_entity_id']  = (int) $this->aauth->get_user_var("linked_entity_id",$users['id']);

				if($users['default_user_group']['group_id']== 2) {
					$users['linked_entity'] = array(
							        "filter_type"=> 0,
							        "filter_id"=> 0
						);
				}	
				else if($users['default_user_group']['group_id']== 3) {
					$users['linked_entity'] = $this->facilities_m->read($users['linked_entity_id']);
				}
				else if($users['default_user_group']['group_id']== 4 ){
					$users['linked_entity'] = $this->facilities_m->read($users['linked_entity_id']);

					$mfl = $users['email'];

					$f_email =  R::getAll("SELECT f.email FROM aauth_users  u LEFT JOIN facility f ON f.mfl_code = u.email WHERE f.mfl_code ='$mfl'")[0]['id'];

					$users['email'] = $f_email;

				}
				else if($users['default_user_group']['group_id']== 6){
					$users['linked_entity'] = $this->sub_counties_m->read($users['linked_entity_id']);
				}
				else if($users['default_user_group']['group_id']== 5){
					$users['linked_entity'] = $this->counties_m->read($users['linked_entity_id']);
				}
				else if($users['default_user_group']['group_id']== 7){
					$users['linked_entity'] = $this->partners_m->read($users['linked_entity_id']);
				}
				else{
					$users['linked_entity'] = array(
							        "filter_type"=> -1,
							        "filter_id"=> -1
						);
				}
			}

		}

		if($is_datatable && $id==NULL){

			$users = $this->arr_to_dt_response($users,$draw,$total_records,$records_filtered);

		}

		return $users;
	}

	public function update($id=NULL){
		
		$request_fields = file_get_contents('php://input');

		$user = json_decode($request_fields, true);

		if(!is_null($id)){
			$this->aauth->update_user($id, $user['email'],$user['pass'], $user['user_name']);
		}
	
	}

	public function remove($id){
	}

}