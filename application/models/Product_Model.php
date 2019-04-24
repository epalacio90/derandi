<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 6:23 PM
 */

class Product_Model extends MY_Model
{
    function __construct(){
        parent::__construct();
    }

    /**
     * Get all the products list
     * @param int
     * @param int
     * @param int
     *
     * @return array
     *
     */

    public function getProducts($limit, $start, $warehouse = false, $search = false ){

        if(!$warehouse)
            if(!$search){
                $query = $this->db->query('Select prod.*, sum(stock.quantity) as quantity from product as prod left join product_variation 
                as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id group by prod.id limit '. $start . ', ' . $limit);
            }else{
                $query = $this->db->query('Select prod.*, sum(stock.quantity) as quantity from product as prod left join product_variation 
                as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id where 
                prod.name like "%'.$search.'%" OR
                prod.sku like "%'.$search.'%" OR
                prod.description like "%'.$search.'%"
                group by prod.id limit '. $start . ', ' . $limit);
            }
        else{
            $query = $this->db->query('Select prod.*, sum(stock.quantity) as quantity from product as prod left join product_variation 
            as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id 
            where stock.warehouse_id = ' . $warehouse . ' group by prod.id limit '. $start . ', ' . $limit);
        }


        return $query->result();
    }

    /**
     * Count all products por pagination
     *
     * @param int $warehouse
     * @param int $search
     *
     * @return array
     *
     */

    public function countTotalProducts($warehouse = false, $search = false ){
        if(!$warehouse){
            if(!$search){
                $query = $this->db->query('Select count(prod.id) as total from product as prod left join product_variation 
                as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id group by prod.id  ');
            }else{
                $query = $this->db->query('Select count(prod.id) as total from product as prod left join product_variation 
                as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id where 
                prod.name like "%'.$search.'%" OR
                prod.sku like "%'.$search.'%" OR
                prod.description like "%'.$search.'%"
                group by prod.id  ');
            }

        }else{
            $query = $this->db->query('Select prod.*, sum(stock.quantity) from product as prod left join product_variation 
            as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id 
            where stock.warehouse_id = ' . $warehouse . ' group by prod.id ');
        }
    }

    /**
     * Get a single product
     *
     * @param int id
     * @param boolean group - group by variation
     *
     * @return array
     *
     */

    public function getProduct($id, $group = false){
        if($group){
            $query = $this->db->query('Select prod.*, var.name as variation, var.principal, var.id as variation_id from product as prod left join product_variation 
            as var on var.product_id = prod.id 
            where prod.id = ' . $id . ' group by var.id');
        }else {
            $query = $this->db->query('Select prod.*, var.name as variation, var.principal, stock.quantity, warehouse.name as warehouse, var.id as variation_id, warehouse.id as warehouse_id from product as prod left join product_variation 
            as var on var.product_id = prod.id left join stock on stock.product_variation_id = var.id left join warehouse on warehouse.id = stock.warehouse_id
            where prod.id = ' . $id);
        }

        return $query->result();
    }

    /**
     * Get a single product variation
     *
     * @param int id
     *
     *
     * @return array
     *
     */

    public function getProductVariant($id){

        $query = $this->db->query('Select prod.*, var.name as variation, pic.path, pic.id as pic_id, var.id as variation_id from product as prod left join product_variation 
        as var on var.product_id = prod.id left join product_variation_pictures as pic on pic.product_variation_id = var.id
        where var.id = ' . $id);


        return $query->result();
    }

    /**
     * Add a new product
     *
     * @param array
     *
     * @return int
     */

    public function addProduct($product){
        $res= $this->db->set($product)
            ->insert('product' , $product);
        if($res){
            return $this->db->insert_id();
        }else
            return false;
    }

    /**
     * Edit product
     *
     * @param array
     *
     * @return bool
     */

    public function editProduct($id, $product){
        $this->db->where('id', $id);
        return $this->db->update('product', $product);
    }

    /**
     * Add a new product variant
     *
     * @param array
     *
     * @return bool
     */

    public function addProductVariant($product){
        return $this->db->set($product)
            ->insert('product_variation' , $product);
    }

    /**
     * Add brand
     * @param $brand array
     * @return bool
     */

    public function addBrand($brand){
        return $this->db->set($brand)
            ->insert('brand' , $brand);
    }

    /**
     * Delete Brand
     * @param $id
     */
    public function deleteBrand($id){
        $this->db->where('id', $id);
        $this->db->delete('brand');
    }

    /**
     * Get all brands or a specific by id
     * @param bool $id
     *
     * @return array
     */

    public function getBrand($id = false){
        if(!$id){
            $query = $this->db->query('SELECT * FROM brand');
        }else{
            $query = $this->db->query('SELECT * FROM brand where id = ' .$id);
        }


        return $query->result();
    }


    /**
     * Add a picture to a variation
     * @param array
     *
     * @return boolean
     */

    public function addProductVariationPic($product){
        return $this->db->set($product)
            ->insert('product_variation_pictures' , $product);
    }

    /**
     * Delete picture of variation
     * @param $id
     */
    public function deleteProductVariationPicture($id){
        $this->db->where('id', $id);
        $this->db->delete('product_variation_pictures');
    }

    /**
     * Add stock movement
     * @param array
     *
     *@return bool
     *
     */

    public function addStockMovement($movement){
        return $this->db->set($movement)
            ->insert('stock_movements' , $movement);
    }

    /**
     * Get stock Movement details
     *
     * @param int $product_variant
     * @param int $warehouse
     *
     * @return array
     */

    public function getStockMovement($product_variant = false, $warehouse = false, $limit, $start){
        if($product_variant != false && $warehouse != false){
            //search by warehouse and variant

            $query = $this->db->query('SELECT mov.*, warehouse.name as warehouse, var.name as variant, prod.name as product, prod.id as product_id
            FROM stock_movements as mov left join warehouse on warehouse.id = mov.warehouse_id
            left join product_variation as var on var.id = mov.product_variant_id left join product as prod on prod.id = var.product_id
            WHERE mov.product_variant_id = '.$product_variant.' and mov.warehouse_id = '.$warehouse .
            ' order by mov.movement_date desc limit ' . $start . ' , '. $limit);
        }else if(!$product_variant){
            //Search by warehouse
            $query = $this->db->query('SELECT mov.*, warehouse.name as warehouse, var.name as variant, prod.name as product, prod.id as product_id FROM mov.stock_movements
             as mov left join warehouse on warehouse.id = mov.warehouse_id
            left join product_variation as var on var.id = mov.product_variant_id left join product as prod on prod.id = var.product_id
             WHERE  warehouse_id = '.$warehouse.
                ' order by mov.movement_date desc limit ' . $start . ' , '. $limit);

        }else{
            //search by product variant
            $query = $this->db->query('SELECT mov.*, warehouse.name as warehouse, var.name as variant, prod.name as product, prod.id as product_id FROM mov.stock_movements 
             as mov left join warehouse on warehouse.id = mov.warehouse_id
            left join product_variation as var on var.id = mov.product_variant_id left join product as prod on prod.id = var.product_id
            WHERE product_variant_id = '.$product_variant.
                ' order by mov.movement_date desc limit ' . $start . ' , '. $limit);
        }
        return $query->result();
    }

    public function countMovementTotal($product_variant = false, $warehouse = false){
        if($product_variant != false && $warehouse != false){
            //search by warehouse and variant

            $query = $this->db->query('SELECT count(mov.id) as total
            FROM stock_movements as mov 
            WHERE mov.product_variant_id = '.$product_variant.' and mov.warehouse_id = '.$warehouse);
        }else if(!$product_variant){
            //Search by warehouse
            $query = $this->db->query('SELECT count(mov.id) as total FROM mov.stock_movements
             as mov 
             WHERE  warehouse_id = '.$warehouse);

        }else{
            //search by product variant
            $query = $this->db->query('SELECT count(mov.id) as total FROM mov.stock_movements 
             as mov 
            WHERE product_variant_id = '.$product_variant);
        }
        return $query->result();
    }






}