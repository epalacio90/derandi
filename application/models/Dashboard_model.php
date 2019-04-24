<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 9:39 PM
 */

class Dashboard_model extends MY_Model
{


    function __construct(){
        parent::__construct();
    }


    /**
     * Get an unused ID for user creation
     *
     * @return  int between 1200 and 4294967295
     */
    public function get_unused_id()
    {
        // Create a random user id between 1200 and 4294967295
        $random_unique_int = 2147483648 + mt_rand( -2147482448, 2147483647 );

        // Make sure the random user_id isn't already in use
        $query = $this->db->where( 'user_id', $random_unique_int )
            ->get_where( $this->db_table('user_table') );

        if( $query->num_rows() > 0 )
        {
            $query->free_result();

            // If the random user_id is already in use, try again
            return $this->get_unused_id();
        }

        return $random_unique_int;
    }

    /**
     * Create a new user
     *
     * @return boolean
     */
    public function create_user($user){
        return $this->db->set($user)
            ->insert('users' , $user);
    }

    /**
     * Update a user
     *
     * @return boolean
     *
     */

    public function updateUser($email, $user){

        $this->db->where('email', $email);
        return $this->db->update('users', $user);
    }

    /**
     * Get all the transactions
     *
     *@return array
     */

    public function getAllTransactions($limit, $start, $username = false, $search = false){
        if(!$username ){
            $query = $this->db->query('Select * from transaction order by sent asc, transaction_date asc limit '.$start.  ', ' . $limit);
        }else{
            if($search){
                $query = $this->db->query('Select * from transaction WHERE username ="'.$username.'"  order by sent asc, transaction_date asc limit '.$start.  ', ' . $limit  );
            }else{
                //TODO query de busqueda
            }

        }


        return $query->result();
    }

    /**
     * Count transactions
     *
     * @param $user String
     *
     * @return array
     */
    public function getTransactionCount($user = false) {


        if(!$user ) {
            return $this->db->count_all('transaction');



        }else {
            $query = $this->db->query('Select count(id) from transaction WHERE username= "'.$user .'"');
            return $query->result_array();
        }
    }

    /**
     *
     * Get 1 transaction header info
     *
     *  @param $id int
     * @param $user String
     *
     *
     * @return array
     */

    public function getTransaction($id, $user = false){
        if(!$user)
            $query = $this->db->query('Select * from transaction WHERE id = '. $id);
        else
            $query = $this->db->query('Select * from transaction WHERE username= "'.$user .'" and id = '. $id);
        return $query->result();
    }

    /**
     * Get the detail of a transaction
     *
     * @param $id int
     * @param $user $String
     *
     * @return array
     */
    public function getTransactionDetail($id, $user =  false){
        if(!$user)
            $query = $this->db->query('Select * from transaction_detail WHERE transaction_id = '. $id);
        else
            $query = $this->db->query('Select a.* from transaction_detail as a right_join transaction as b on b.id = a.transaction_id WHERE b.username= "'.$user .'" and a.transaction_id = '. $id);
        return $query->result();
    }


}
