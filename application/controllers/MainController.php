<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('MainModel');
		$this->load->helpers(array('url','form'));
		$this->load->library(array('session','upload'));
	}
	public function index()
	{
		$this->load->view('login');
	}
	public function Logout()
	{
		$this->session->sess_destroy();
		redirect('', 'refresh');
	}
	public function session_check()
	{
		$username = $this->session->userdata('username');
		$password = $this->session->userdata('password');
		$condition = array('username' => $username,'password' => md5($password));
		$result=$this->MainModel->get_data('tbl_user',$condition);
		if($result)
		{
			return 0;
		}
		else
		{
			return 1;
		}
	}
	public function Login_Check()
	{
		$username=$this->input->post('username');
		$password=$this->input->post('password');

		$condition=['username'=>$username,'password'=>md5($password)];
		$result=$this->MainModel->get_data('tbl_user',$condition);
		if($result)
		{
			foreach ($result as $value)
			{
				$this->session->set_userdata('username',$username);
				$this->session->set_userdata('password',$password);
				$this->session->set_userdata('name',$value->name);
			}
			redirect('Dashboard','reload');
		}
		else
		{
			$this->session->set_userdata('logmsg','Username/Password invalid....!!');
			redirect('Login','reload');
		}
	}
	public function Dashboard()
	{
		$result['vehicles']=$this->MainModel->get_data('tbl_vehicle',[]);
		// $from=date('Y-m').'-01';
		// $to=date('Y-m-d');
		// $condition=['date(timestamp)>='=>$from,'date(timestamp)<='=>$to];
		$condition=[];
		$report=$this->MainModel->get_report($condition);
		$total=0;
		foreach ($report as $value) 
		{
			$total+=$value->total;
		}
		$result['total_cost']=$total;
		$result['report']=$this->report_display($report);
		$this->load->view('Dashboard',$result);
	}
	public function report_display($result)
	{
		$html='';
		$total=0;
		if($result)
		{
			foreach ($result as $value) 
			{
				$total+=$value->total;
				$html.='<tr>
	                      <td>'.$value->registration_number.'</td>
	                      <td>₹'.$value->total.'</td>
	                      <td>'.date('d-m-Y h:i A',strtotime($value->timestamp)).'</td>
	                    </tr>';
			}
		}
		else
		{
			$html.='<tr>
                  <td class="text-danger" colspan="2">No Data</td>
                </tr>';
		}
		
		$html.='<tr>
                  <td class="text-danger">Grand Total</td>
                  <td class="text-danger">₹'.$total.'</td>
                </tr>';
		return $html;
	}
	public function Search_Report()
	{
		$reg_no=$this->input->post('reg_no');
		$from=$this->input->post('from');
		$to=$this->input->post('to');
		$condition=[];
		if($from!='' && $to=='')
		{
			$condition=['date(timestamp)>='=>$from,'date(timestamp)<='=>$from];
		}
		if($from=='' && $to!='')
		{
			$condition=['date(timestamp)>='=>$to,'date(timestamp)<='=>$to];
		}
		if($from!='' && $to!='')
		{
			$condition=['date(timestamp)>='=>$from,'date(timestamp)<='=>$to];
		}
		if($reg_no!='')
		{
			$condition['v_id']=$reg_no;
		}

		$report=$this->MainModel->get_report($condition);
		$html=$this->report_display($report);
		echo $html;
	}
	
}
?>
