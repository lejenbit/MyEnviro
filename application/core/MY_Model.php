<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Model extends CI_Model {
    // single pintu ke dalam sistem
    function __construct() {
        parent::__construct();
    }

    public function load($data) {
        foreach ($data as $key => $val) {
            $this->$key = $val;
        }
    }
    
    // how to get table name
    public function table() {
        $cname = get_class($this); // return Comment_model / Person_model, etc
        $arr = explode('_', $cname); // ['Comment', 'model']
        return strtolower($arr[0]); // comment
    }
    
    // get pk
    public function pk() {
        return 'id'; // default pk
    }
    
    public function find_one($key) {
        $table = $this->table();
        $pk = $this->pk();
        return $this->db
                ->where($pk, $key)
                ->get($table)
                ->row();
    }
    
    public function count() {
        return $this->db->count_all_results($this->table());
    }
    
    public function delete($id) {
        $pk = $this->pk();
        $this->db->delete($this->table(), [$pk => $id]);
    }
    
    public function insert($data) {
        $this->db->insert($this->table(), $data);
    }
    
    public function update($data, $id) {
        $this->db->where($this->pk(), $id)->update($this->table(), $data);
    }
    
    public function all($where = []) {
        return $this->db->where($where)->get($this->table())->result();
    }
    
    function code($key, $val){
        $data = $this->all();
        
        $arr = [];
        foreach($data as $dat){
            $arr[$dat->$val] = $dat->$key;
        }
        
        return $arr;
    }
}
