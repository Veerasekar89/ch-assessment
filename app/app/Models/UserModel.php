<?php

namespace App\Models;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use CodeIgniter\Model;
 
/**
 * Description of UserModel
 *
 * @author Veerasekar
 */
class UserModel extends Model{
    protected $table = 'users';
    protected $allowedFields = ['name', 'email', 'password', 'gender', 'status', 'created_at', 'updated_at'];
    protected $beforeInsert = ['beforeInsert'];
    protected $beforeUpdate = ['beforeUpdate'];
    
    /**
     * beforeInsert callback. update password hash and created and updated date
     *
     * @param Array $data insert data
     * @return $data = array()
     */
    protected function beforeInsert(array $data){
        $data = $this->passwordHash($data);
        $data['data']['created_at'] = date('Y-m-d H:i:s');
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        $data['data']['status'] = 0;
        return $data;
    }
    
    /**
     * beforeUpdate callback. update password hash and updated date
     *
     * @param Array $data insert data
     * @return $data = array()
     */
    protected function beforeUpdate(array $data){
        $data = $this->passwordHash($data);
        $data['data']['updated_at'] = date('Y-m-d H:i:s');
        return $data;
    }

    /**
     * Encrypt password.
     *
     * @param Array $data insert data
     * @return $data = array()
     */
    protected function passwordHash(array $data){
        if(isset($data['data']['password'])){
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }
    
}