<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments extends CI_Model{
    public function getAll(){
        $q=$this->db->get('comments');

        return $row=$q->result_array();
    }
    public function getById($id){
        $this->db->where('item_id', $id);
        $q=$this->db->get('comments');

        return $row=$q->result_array();
    }
    public function insertComment($description,$user_id, $itemId){

        $this->item_id   = $itemId;
        $this->description = $description;
        $this->userid = $user_id;
        $this->date    = time();

        if($this->db->insert('comments', $this)){
            return 1;
        }
        else return 0;
    }
}


