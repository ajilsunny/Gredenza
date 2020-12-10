<?php
include_once (dirname(__FILE__) . "/MainController.php");

class FuelController extends MainController {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel');
		$this->load->helpers(array('url','form'));
		$this->load->library(array('session','upload'));
	}
	public function Fuel_Filling()
	{
		$fuel=$this->MainModel->get_fuel_filling([]);
		$result['fuel_filling']=$this->fuel_display($fuel);
		$result['vehicles']=$this->MainModel->get_data_ASC('tbl_vehicle',[],'registration_number');
		$this->load->view('Fuel_Filling',$result);
	}
	public function fuel_display($result)
	{
		$html='';
		if($result)
		{
			foreach ($result as $value) 
			{
				$html.='<tr>
	                      <td>'.$value->registration_number.'</td>
	                      <td>'.$value->quantity.'</td>
	                      <td>₹'.$value->amount.'</td>
	                      <td>'.date('d-m-Y h:i A',strtotime($value->timestamp)).'</td>
	                    </tr>';
			}
		}
		else
		{
			$html.='<tr>
                  <td class="text-danger" colspan="4">No Data</td>
                </tr>';
		}
		return $html;
	}
	public function Upload_Fuel()
	{
		$vehicle_id=$this->input->post('vehicle_id');
		$qty=$this->input->post('qty');
		$amount=$this->input->post('amount');
		$data=['vehicle_id'=>$vehicle_id,'quantity'=>$qty,'amount'=>$amount];
		$this->MainModel->insertdate('tbl_fuel_filling',$data);
		$fuels=$this->MainModel->get_fuel_filling([]);
		$result=$this->fuel_display($fuels);
		echo $result;
	}
}
?>