<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Comments extends CI_Model{
    public function getAll(){
        $q=$this->db->get('comments');
        return $row=$q->result_array();

    }

}


