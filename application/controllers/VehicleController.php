<?php
include_once (dirname(__FILE__) . "/MainController.php");

class VehicleController extends MainController {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel');
		$this->load->helpers(array('url','form'));
		$this->load->library(array('session','upload'));
	}
	public function Vehicles()
	{
		$vehicles=$this->MainModel->get_data_DESC('tbl_vehicle',[],'v_id');
		$result['vehicles']=$this->vehicle_display($vehicles);
		$this->load->view('Vehicles',$result);
	}
	public function vehicle_display($result)
	{
		$html='';
		$i=1;
		if($result)
		{
			foreach ($result as $value) 
			{
				$html.='<tr>
	                      <td>'.$i.'</td>
	                      <td>'.$value->registration_number.'</td>
	                      <td>'.$value->seating_capacity.'</td>
	                      <td>'.date('d-m-Y',strtotime($value->purchase_date)).'</td>
	                      <td>
	                         <button type="button" rel="tooltip" title="Edit Vehicle" class="btn btn-white btn-link btn-sm" onclick=edit_vehicle('.$value->v_id.')>
	                            <i class="material-icons">edit</i>
	                          </button>
	                      </td>
	                      <td>
	                        <button type="button" rel="tooltip" title="Remove Vehicle" class="btn btn-white btn-link btn-sm" onclick=delete_vehicle('.$value->v_id.')>
	                            <i class="material-icons">close</i>
	                          </button>
	                      </td>
	                    </tr>';
	             $i++;
			}
		}
		else
		{
			$html.='<tr>
                  <td class="text-danger" colspan="6">No Data</td>
                </tr>';
		}
		return $html;
	}
	public function Upload_Vehicle()
	{
		$reg_no=$this->input->post('reg_no');
		$seating=$this->input->post('seating');
		$pur_date=$this->input->post('pur_date');
		$vehicle_id=$this->input->post('vehicle_id');
		if($vehicle_id=='')
		{
			$data=['registration_number'=>$reg_no,'seating_capacity'=>$seating,'purchase_date'=>$pur_date];
			$this->MainModel->insertdate('tbl_vehicle',$data);
		}
		else
		{
			$condition=['v_id'=>$vehicle_id];
			$data=['registration_number'=>$reg_no,'seating_capacity'=>$seating,'purchase_date'=>$pur_date];
			$this->MainModel->update_data('tbl_vehicle',$data,$condition);
		}
		$vehicles=$this->MainModel->get_data_DESC('tbl_vehicle',[],'v_id');
		$result=$this->vehicle_display($vehicles);
		echo $result;
	}
	public function Delete_Vehicle()
	{
		$val=$this->input->post('val');
		$condition=['v_id'=>$val];
		$this->MainModel->delete_data('tbl_vehicle',$condition);
		$vehicles=$this->MainModel->get_data_DESC('tbl_vehicle',[],'v_id');
		$result=$this->vehicle_display($vehicles);
		echo $result;
	}
	public function Edit_Vehicle()
	{
		$val=$this->input->post('val');
		$condition=['v_id'=>$val];
		$result=$this->MainModel->get_data('tbl_vehicle',$condition);
		$html='';
		foreach ($result as $value) 
		{	
			$html.='<h4 class="text-light">Registration Number</h4>
            <input type="text" name="reg_no" value="'.$value->registration_number.'" placeholder="Eg:- KL-01-A-0000" class="form-control" required="">
            <h4 class="text-light mt-3">Seating Capacity</h4>
            <input type="number" name="seating" value="'.$value->seating_capacity.'" placeholder="Eg:- 1" class="form-control" required="">
            <h4 class="text-light pt-2 mt-3">Purchase Date</h4>
            <input type="Date" name="pur_date" value="'.$value->purchase_date.'" class="form-control" required="">
            <input type="hidden" name="vehicle_id" value="'.$value->v_id.'" class="form-control">';
		}
		echo $html;
	}
	

}
?>