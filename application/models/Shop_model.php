<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 8:46 PM
 */

class Shop_model extends MY_Model
{

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Get a featured list of products for the first page
     *
     * @return mixed
     */
    public function getProductList($limit, $start=0, $search=false){

        if(!$search) {
            $query = $this->db->query('Select  prod.name, prod.id, min(pic.path) as path, prod.public_price, prod.discount, prod.min_price, var.id as var_id
            from product as prod left join product_variation as var on var.product_id = prod.id 
            left join product_variation_pictures as pic on var.id = pic.product_variation_id
            where prod.selling = true
            group by prod.id
            order by prod.id desc limit ' . $start . ' , ' . $limit);
        }else{

            $query = $this->db->query('Select  prod.name, prod.id, min(pic.path) as path, prod.public_price, prod.discount, prod.min_price, var.id as var_id
            from product as prod left join product_variation as var on var.product_id = prod.id 
            left join product_variation_pictures as pic on var.id = pic.product_variation_id
            where prod.selling = true AND ( 
            prod.sku like "%' . $search . '%" OR
            prod.name like "%' . $search . '%" OR
            prod.description like "%'.$search.'%"
            )
            group by prod.id
            order by prod.id desc limit ' . $start . ' , ' . $limit);
        }
        return $query->result();
    }

    /**
     * Count all the products selling
     *
     * @return mixed
     */

    public function productCount($search = false){
        if(!$search) {
            $query = $this->db->query('Select  count(prod.id) as total
            from product as prod left join product_variation as var on var.product_id = prod.id 
            left join product_variation_pictures as pic on var.id = pic.product_variation_id
            where prod.selling = true
            group by prod.id
            ');
        }else{
            $query = $this->db->query('Select   count(prod.id) as total
            from product as prod left join product_variation as var on var.product_id = prod.id 
            left join product_variation_pictures as pic on var.id = pic.product_variation_id
            where prod.selling = true AND ( 
            prod.sku like "%' . $search . '%" OR
            prod.name like "%' . $search . '%" OR
            prod.description like "%'.$search.'%"
            )
            group by prod.id');


        }
        return $query->result();
    }

    /**
     * Get product by variant id
     *
     * @param $id
     * @return mixed
     */

    public function getProduct($id){
        $query = $this->db->query('Select  prod.name, prod.id, prod.description, prod.public_price, prod.discount, prod.min_price, prod.sku, 
pic.path as path, var.name as var, brand.name as brand, brand.path as brandPath, brand.description as brandDescription
        from product as prod left join product_variation as var on var.product_id = prod.id 
        left join product_variation_pictures as pic on var.id = pic.product_variation_id
        left join brand on prod.brand = brand.id
        where prod.selling = true and var.id = ' . $id );
        return $query->result();
    }

    /**
     * Get product variants usind product id
     *
     * @param $id
     * @return mixed
     */

    public function getProductVariants($id){
        $query = $this->db->query('Select  var.name as var, var.id as var_id, prod.id 
        from product as prod left join product_variation as var on var.product_id = prod.id 
        where prod.selling = true and prod.id = ' . $id . '
        ');
        return $query->result();
    }



}