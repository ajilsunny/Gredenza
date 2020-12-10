<?php
defined('BASEPATH') OR exit('No direct script access allowed');
Class MainModel extends CI_Model
{
  function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('email');
	}
  function insertdate($table,$data)
  {
    $this->db->insert($table,$data);
    $insert_id = $this->db->insert_id();
    return $insert_id;
  }
  function check_data($table,$condition)
  {
    $querys=$this->db->get_where($table,$condition);
	  $num=$querys->num_rows();
    if($num>0)
    {
      return 1;
    }
    else {
      return 0;
    }
  }
  function get_data($table,$condition)
  {
    $querys=$this->db->get_where($table,$condition);
    $result=$querys->result();
    return $result;
  }
  function get_data_DESC($table,$condition,$id)
  {
    $this->db->order_by($id,'DESC');
    $querys=$this->db->get_where($table,$condition);
    $result=$querys->result();
    return $result;
  }
  function get_data_ASC($table,$condition,$id)
  {
    $this->db->order_by($id,'ASC');
    $querys=$this->db->get_where($table,$condition);
    $result=$querys->result();
    return $result;
  }
  function get_data_members_order($table,$condition,$id,$order)
  {
    $this->db->order_by($id,$order);
    $querys=$this->db->get_where($table,$condition);
    $result=$querys->result();
    return $result;
  }
  function update_data($table,$data,$condition)
  {
    $this->db->where($condition);
    $this->db->update($table,$data);
  }
  function delete_data($table,$condition)
  {
    $this->db->where($condition);
    $this->db->delete($table);
  }
  function get_limit($table,$condition,$value,$order,$start,$limit)
  {
    $this->db->order_by($value,$order);
    $this->db->limit($limit, $start );
    $querys=$this->db->get_where($table,$condition);
    $result=$querys->result();
    return $result;
  }
  function get_fuel_filling($condition)
  {
    $this->db->order_by('f_id','DESC');
    $this->db->join('tbl_vehicle', 'tbl_fuel_filling.vehicle_id = tbl_vehicle.v_id');
    $querys=$this->db->get_where('tbl_fuel_filling',$condition);
    $result=$querys->result();
    return $result;
  }
  function get_report($condition)
  {
    // $this->db->select('registration_number, SUM(amount) as total');
    $this->db->select('registration_number, amount as total,timestamp');
    $this->db->join('tbl_vehicle', 'tbl_fuel_filling.vehicle_id = tbl_vehicle.v_id');
    // $this->db->group_by('registration_number '); 
    // $this->db->order_by('registration_number ','ASC');
    $this->db->order_by('timestamp ','DESC');
    $querys=$this->db->get_where('tbl_fuel_filling',$condition);
    $result=$querys->result();
    return $result;
  }

}
?>
