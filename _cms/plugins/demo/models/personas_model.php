<?php
class personas_model{
    private $db;
    private $personas;
 
    public function __construct(){
        $this->db = Conectar::conexion();
        $this->personas = array();
    }
    public function get_personas(){
        $sql = "select * from personas;";
        $this->personas = Conectar::get_data($this->db->query($sql));
        return $this->personas;
    }
}