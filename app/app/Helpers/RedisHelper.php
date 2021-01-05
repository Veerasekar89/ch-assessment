<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\Helpers;

/**
 * Description of Redis
 *
 * @author Veerasekar
 */

use App\Models\UserModel;

class RedisHelper {
    
    protected $redis;
    
    function __construct() {
        $this->redis = new \Redis();
        $this->redis->connect('redis', 6379);

        if (!$this->redis->ping()) {
            throw new \Exception('Redis not connecting');
        }
    }
    
    public function setData($user, array $value){
        
        $key = $this->generate_key($user['id']);
        $this->redis->lpush($key, json_encode($value)); 
        
    }
  
    protected function generate_key($id){
        
        $key = 'user-'.$id;
        return $key;
        
    }
    
    public function getData($user){
        
        $key = $this->generate_key($user['id']);
        $data = $this->redis->lrange($key, 0 ,-1);
        
        return $data;
    }
    
    
}
