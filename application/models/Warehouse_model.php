<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 6:23 PM
 */

class Warehouse_model extends MY_Model{

    function __construct(){
        parent::__construct();
    }

    /**
     * Get all the warehouse list
     *
     * @return array
     *
     */

    public function getAllWarehouse(){

        $query = $this->db->query('Select * from warehouse');


        return $query->result();
    }

    /**
     * Add a new Warehouse
     *
     * @param array
     *
     * @return bool
     */

    public function addWarehouse($warehouse){
        return $this->db->set($warehouse)
            ->insert('warehouse' , $warehouse);
    }

}