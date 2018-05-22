<?php
require 'tad-php/vendor/autoload.php';

use TADPHP\TADFactory;
use TADPHP\TAD;

class Main {

    private $connection_prop;
    public $users;

    const NOTIFICATION = [
        "DELETE_SUCCESS" => 'Delete Successful'
    ];

    public function __construct($device_ip){
        $this->connection_prop = (new TADFactory(['ip'=>$device_ip, 'com_key'=>0]))->get_instance();
    }

    private function refresh_db(){
        $this->connection_prop->refresh_db();;
    }

    public function allLogs(){
        $this->refresh_db();
        return $this->connection_prop->get_att_log()->to_array();
    }

    public function Users(){
        $this->refresh_db();
        $this->users = $this->connection_prop
            ->get_all_user_info();
        return $this;
    }

    // Sample Card NO: 13452272
    public function findByCard($card_no){
        $this->refresh_db();
        return $this->users->filter_by_Card(['like'=>$card_no])
            ->to_array();
    }

    public function findByPIN($pin){
        $this->refresh_db();
        return $this->connection_prop->get_user_info(['pin'=>$pin])
            ->to_array();
    }

    public function getUserPIN2($card_no){
        $this->refresh_db();
        return $this->users->filter_by_Card(['like'=>$card_no])
            ->to_array()['Row']['PIN2'];
    }

    public function getUser($card_no){
        $this->refresh_db();
        return $this->users->filter_by_Card(['like'=>$card_no])
            ->to_array();
    }

    public function getLogByUser($card_no){
        $this->refresh_db();
        $pin = $this->getUserPIN2($card_no);
        return $this->connection_prop->get_att_log(['pin'=> $pin])->to_array();
    }

    public function deleteUser($card_no){
        $this->refresh_db();
        $pin = $this->getUserPIN2($card_no);
        $this->connection_prop->delete_user(['pin'=> $pin]);
        return "User Delete Successful";
    }

    public function createUser($args){
        return $this->connection_prop->set_user_info($args);
    }

}

?>