<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Comment extends CI_Controller {

	public function index($itemId)
	{
        $data = [];

        $user=$this->input->cookie('user', TRUE);
        if(!$user){
            $this->load->helper('cookie');
            $cookie = array(
                'name'   => 'user',
                'value'  => time(),
                'expire' =>  30 * 24 *60 * 60,
                'secure' => false
            );
            $this->input->set_cookie($cookie);
            $userId = $cookie['value'];
        }else{
            $cookie = $this->input->cookie('user', true);
            $userId = $cookie;
        }

        $this->load->model('Comments');
        $comments=$this->Comments->getById($itemId);

        $data['comments']=$comments;
        $data['userId'] = $userId;
        $data['itemId'] = $itemId;

        $this->load->view('comments', $data);
	}

    public function saveComment(){
        if($this->input->post('submit') && $this->input->post('description') && $this->input->post('item-id')){
            $description = $this->input->post('description');
            $itemId      = $this->input->post('item-id');

            $this->load->model('Comments');
            $this->Comments->insertComment($description,$this->input->cookie('user', TRUE), $itemId);

            redirect(base_url("comments/" . $itemId));
        }elseif($this->input->post('item-id')){
            $itemId      = $this->input->post('item-id');

            $this->load->library('session');
            $this->session->set_flashdata('empty', 'Comment can\'t be empty');

            redirect(base_url("comments/" . $itemId));
        }
    }

}
