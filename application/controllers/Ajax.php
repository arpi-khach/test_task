<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function logCommentActivity(){
        if($this->input->post('userId')
            && $this->input->post('itemId')
            && $this->input->post('username')){

            $itemId   = $this->input->post('itemId');
            $userId = $this->input->post('userId');
            $userName = $this->input->post('username');

            $this->load->model('LogCommentActivity');

            $result = $this->LogCommentActivity->createLog($itemId, $userId, $userName);

            if($result){
                $this->responseJson([
                    "result" => 'true'
                ]);
            }else{
                $this->responseJson([
                    "result" => 'false'
                ]);
            }
        }else{
            $this->responseBadRequest();
        }
    }

    public function updateCommentActivity(){
        if( $this->input->post('userId')
            && $this->input->post('itemId')){

            $itemId   = $this->input->post('itemId');
            $userId   = $this->input->post('userId');
            $status = $this->input->post('status');
            $statusBool = $status ? 1 : 0;

            $this->load->model('LogCommentActivity');
            $result = $this->LogCommentActivity->updateStatus($userId, $itemId, $statusBool);

            if($result){
                $this->responseJson([
                    "result" => 'true'
                ]);
            }else{
                $this->responseJson([
                    "result" => 'false'
                ]);
            }
        }else{
            $this->responseBadRequest();
        }
    }

    public function getUserActivities(){
        if( $this->input->post('itemId')){
            $itemId   = $this->input->post('itemId');
            $cookie = $this->input->cookie('user', true);
            $userId = $cookie;

            $this->load->model('LogCommentActivity');
            $userActivities = $this->LogCommentActivity->userActivities($itemId, $userId);

            $this->responseJson(json_encode($userActivities));
        }else{
            $this->responseBadRequest();
        }
    }

    public function checkForNewComments(){
        if( $this->input->post('itemId')) {

            $itemId           = $this->input->post('itemId');
            $oldCommentsCount = $this->input->post('oldCommentsCount');

            $this->load->model('Comments');
            $comments = $this->Comments->getNewAddedComments($oldCommentsCount, $itemId);

            $this->responseJson(json_encode($comments));
        }else{
            $this->responseBadRequest();
        }
    }

    private function responseJson($resp){
        //add the header
        header('Content-Type: application/json');
        die(json_encode( $resp ));
    }

    private function responseBadRequest(){
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json; charset=UTF-8');
        die(json_encode(array('message' => 'Missing request parameter', 'code' => 402)));
    }
}