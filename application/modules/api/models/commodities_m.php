<?php

class commodities_m extends MY_Model{

	function __construct() {

		parent::__construct();
	}

	public function create(){

	}

	public function read($id=NULL){

		$reporting_status = 0;

		if($this->input->get('reportingOnly') && $this->input->get('reportingOnly')!='false'){

			$reporting_status = 1;
		}

		$comodities = R::getAll("CALL `proc_get_commodities`('$id','$reporting_status')");

		if($this->input->get('fcdrr_format') && $this->input->get('fcdrr_format')!='false'){

			$comodity_categories = R::getAll("CALL `proc_get_commodity_categories`('')");

			$i=0;
			foreach ($comodity_categories  as $cat) {
				
				$j=0;
				foreach($comodities as $commodity){

					if($cat['commodity_category_id']==$commodity["commodity_category_id"]){
						$commodities_results[$i]['category_id']=$cat['commodity_category_id'];
						$commodities_results[$i]['category_name']=$cat['commodity_category_name'];

						$commodities_results[$i]["commodities"][$j]['id']=$commodity['commodity_id'];
						$commodities_results[$i]["commodities"][$j]['name']=$commodity['commodity_name'];
						$commodities_results[$i]["commodities"][$j]['unit']=$commodity['commodity_unit'];
						if($commodity['commodity_reporting_status']==1){
							$commodities_results[$i]["commodities"][$j]['is_reporting']=true;
						}else{							
							$commodities_results[$i]["commodities"][$j]['is_reporting']=false;
						}
						

						$j++;
					}	
				}
				$i++;
			}

			return $commodities_results;

		}else{

			return $comodities;	 
		}

	}

	public function update($id){

	}

	public function remove($id){

	}

}