<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

   
    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function registration($data){

        $this->db->set('user_name',$data['user_name']);
        $this->db->set('name',$data['name']);
        $this->db->set('email',$data['email']);
        $this->db->set('password',$data['password']);

        $this->db->insert('users');

    }


    public function range_search($data){

        $this->db->select('*');
        $this->db->where('price >=',$data['min']);
        $this->db->where('price <=',$data['max']);
        $this->db->from($data['pagename']);
        $query = $this->db->get();
        return $query->result();

    }


    //insert into user table
	function insert_record($data)
    {
		return $this->db->insert('users', $data);
    }
    
    public function getData($str)
    {
        $this->db->select('*');
        $this->db->from($str);
        $query = $this->db->get();
        return $query->result();
    } 
    public function getproduct($str){

        $this->db->from($str);
        $query = $this->db->get();
        return $query->result();
    }

    public function getproductsingle($str,$id){
        $this->db->select('*');
        $this->db->from($str);
        $this->db->where('ID',$id);
        $query = $this->db->get();
        return $query->result();
    }

    public function createTable(){

        $this->db->set('user_name',$this->session->userdata('user'));
        $this->db->set('id',$this->session->userdata('build_table'));
        $this->db->set('ischeck','0');
        $this->db->insert('build');

    }

    public function updateTable($id,$str){
        $this->db->set($str,$id);
        $this->db->where('user_name',$this->session->userdata('user'));
        $this->db->where('id',$this->session->userdata('build_table'));
        $this->db->where('ischeck','0');
        $this->db->update('build');
    }

    public function getTable(){
        $this->db->select('*');
        $this->db->from('build');
        $this->db->where('user_name',$this->session->userdata('user'));
        $this->db->where('id',$this->session->userdata('build_table'));
        $this->db->where('ischeck','0');
        $query = $this->db->get();
        return $query->result();
    }

    public function delete($str){

        $this->db->set($str,'');
        $this->db->where('user_name',$_SESSION['user']);
        $this->db->where('id',$_SESSION['build_table']);
        $this->db->update('build');
    }

    public function getReviews($id,$type){
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->where('type',$type);
        $this->db->from('review');
        $q = $this->db->get();
        return $q->result();
    }

    public function addReview($id,$type,$body,$rating){
        $data = array(
            'id' => $id,
            'type' => $type,
            'user_name' => $this->session->userdata('name'),
            'body' => $body,
            'rating' => $rating
        );

        $this->db->insert('review',$data);
    }


    public function cpu_in($data){
        $t = $this->db->insert('cpu',$data);
        //echo $t;
        return $t;
    }

    public function gpu_in($data){
        $t = $this->db->insert('gpu',$data);
        //echo $t;
        return $t;
    }

    public function psu_in($data){
        $t = $this->db->insert('psu',$data);
        //echo $t;
        return $t;
    }
    public function ram_in($data){
        $t = $this->db->insert('ram',$data);
        //echo $t;
        return $t;
    }
    public function ssd_in($data){
        $t = $this->db->insert('ssd',$data);
        //echo $t;
        return $t;
    }
    public function hdd_in($data){
        $t = $this->db->insert('hdd',$data);
        //echo $t;
        return $t;
    }
    public function mboard_in($data){
        $t = $this->db->insert('motherboard',$data);
        //echo $t;
        return $t;
    }
    public function casing_in($data){
        $t = $this->db->insert('casing',$data);
        //echo $t;
        return $t;
    }

}
?>