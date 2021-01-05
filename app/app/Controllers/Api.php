<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Api
 *
 * @author Veerasekar
 */

use App\Models\UserModel;
use App\Helpers\RedisHelper;

class Api extends BaseController{
    
    function __construct() {
        $this->usermodel =  new UserModel();
        header('Content-Type: application/json');
    }
    
    /**
     * register api
     *
     */
    public function register()
    {           
             // Only allowed post method
        if ($this->request->getMethod() == 'post') {            
            //Validation
            $rules = [
                'name' => 'required|min_length[3]|max_length[150]',
                'email' => 'required|min_length[6]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'c_password' => 'matches[password]',
                'gender' => 'required',
            ];
            
            if (!$this->validate($rules)) {  
                $error = $this->validator->getErrors();
                return $this->sendError('validation error', $error);
            }else{
                //Saving user data
                $data = [
                    'name' => $this->request->getVar('name'),
                    'email' => $this->request->getVar('email'),
                    'password' => $this->request->getVar('password'),
                    'gender' => $this->request->getVar('gender'),
                ];
                
                $this->usermodel->save($data);
                $id = $this->usermodel->getInsertID();
                
                // Log user activity
                $redis = new RedisHelper();
                $data = array(
                    'date' => date('Y-m-d H:i:s'),
                    'activity' => 'Register',
                    'Scource' =>  'API'
                );
                $redis->setData(array('id' => $id), $data);
                        
                return $this->sendResponse(array('id' => $id), 'Registered successfully');
            }
        }
    }
    
    
    /**
     * login api
     *
     */
    public function login()
    {          
        // After submiting form
        if ($this->request->getMethod() == 'post') {            
            //Validation
            $rules = [
                'email' => 'required',
                'password' => 'required', 
            ];
            if (!$this->validate($rules)) {  
                $error = $this->validator->getErrors();
                return $this->sendError('validation error', $error);
            }else{
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $user = $this->usermodel->where('email', $email)->first();
                
                if($user){
                    if($verify_pass = password_verify($password, $user['password'])){

                        // Log user activity
                        $redis = new RedisHelper();
                        $redis_data = array(
                            'date' => date('Y-m-d H:i:s'),
                            'activity' => 'Login',
                            'Scource' =>  'API'
                        );
                        $redis->setData($user, $redis_data);
                        
                        return $this->sendResponse($user, 'Loggedin successfully');
                        
                    }else{
                        return $this->sendError('validation error', array('email' => 'Password does not match with mail.'));
                    }
                }else{
                    return $this->sendError('validation error', array('email' => 'Email not exists.'));
                }
                
            }
        }
    }
    
    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        
        return json_encode($response, 200);
    }
    
    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendError($error, $errorMessages = [], $code = 200)
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }

        return json_encode($response, $code);
    }
    
}
