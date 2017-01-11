<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class logCommentActivity extends CI_Model{
    public $tableName = 'log_comment_activity';

    public function createLog($itemId, $userId, $userName){
        $data = [];

        $this->db->where('user_id', $userId);
        $this->db->where('item_id', $itemId);
        $q = $this->db->get($this->tableName);

        if ( $q->num_rows() > 0 )
        {
            $result = $this->updateStatus($userId, $itemId, 1);
        } else {
            $data['status']  = 1;
            $data['item_id']   = $itemId;
            $data['user_id']   = $userId;
            $data['user_name'] = $userName;

            $result = $this->db->insert($this->tableName, $data);
        }

        return $result;
    }

    public function updateStatus($userId, $itemId, $status){
        $data['status'] = $status;
        $this->db->where('user_id',$userId);
        $this->db->where('item_id',$itemId);

        return $this->db->update($this->tableName, $data);
    }

    public function userActivities($itemId, $userId){
        $this->db->select('user_name');
        $this->db->where('item_id', $itemId);
        $this->db->where('user_id !=', $userId);
        $this->db->where('status', 1);
        $q = $this->db->get($this->tableName);

        return $row = $q->result_array();
    }
}


