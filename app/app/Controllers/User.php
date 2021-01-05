<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of User
 *
 * @author Veerasekar
 * Class User
 * @package App\Controllers
 * 
 */

use App\Models\UserModel;
use App\Helpers\RedisHelper;

class User extends BaseController{
    
    function __construct() {
        helper('html');
        $this->usermodel =  new UserModel();
        $this->session = session();
    }
    /**
     * list out user ativity
     *
     */
    public function index()
    { 
        $usermodel = new UserModel();
        $title = "Welcome back, ".$this->session->get('name');
        
        // Get data from session
        $id = $this->session->get('id');
        $user = $this->usermodel->where('id', $id)->first();
        
        // Get activity results from redis
        $redis = new RedisHelper();
        $histroy =  $redis->getData($user);
        
        $data = [
            'title' => $title,
            'histroy' => $histroy
        ];
        
        return view('profile', $data);
    }
     
    /**
     * login 
     *
     */
    public function login()
    {   
        $data = [
            'title' => 'Login'
        ];
        
        // CI helper for form tags
        helper(['form']);
        
        // After submiting form
        if ($this->request->getMethod() == 'post') {            
            //Validation
            $rules = [
                'email' => 'required',
                'password' => 'required', 
            ];
            if ($this->validate($rules)) {
                $email = $this->request->getVar('email');
                $password = $this->request->getVar('password');
                $user = $this->usermodel->where('email', $email)->first();
                
                if($user){
                    if($verify_pass = password_verify($password, $user['password'])){
                        
                        // Set login session
                        $session_data = [
                            'id'       => $user['id'],
                            'name'     => $user['name'],
                            'email'    => $user['email'],
                            'gender'    => $user['gender'],
                            'logged_in'     => TRUE
                        ];
                        $this->session->set($session_data);
                        
                        // Log user activity
                        $redis = new RedisHelper();
                        $redis_data = array(
                            'date' => date('Y-m-d H:i:s'),
                            'activity' => 'Login',
                            'Scource' =>  'Web'
                        );
                        $redis->setData($user, $redis_data);
                        
                        return redirect()->to('/profile');
                    }else{
                        $data['validation_msg'] = 'Password does not match with mail.';
                    }
                }else{
                    $data['validation_msg'] = 'Email not exists.';
                }
                
            }else{
                // To display validation message
                $data['validation'] = $this->validator;
            }
        }
        return view('login', $data);
    }
    
    /**
     * register 
     *
     */
    public function register()
    {   
        $data = [
            'title' => 'Register'
        ];
        
        // CI helper for form tags
        helper(['form']);
        
        // After submiting form
        if ($this->request->getMethod() == 'post') {            
            //Validation
            $rules = [
                'name' => 'required|min_length[3]|max_length[150]',
                'email' => 'required|min_length[6]|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[8]|max_length[255]',
                'c_password' => 'matches[password]',
                'gender' => 'required',
            ];
            
            if ($this->validate($rules)) {                
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
                    'Scource' =>  'Web'
                );
                $redis->setData(array('id' => $id), $data);
                        
                //Redirect to login page
                return redirect()->to('/user');
            }else{
                // To display validation message
                $data['validation'] = $this->validator;
            }
        }
  
        return view('register', $data);
    }
    
    /**
     * logout 
     *
     */
    public function logout()
    { 
        $data = array(
            'date' => date('Y-m-d H:i:s'),
            'activity' => 'Logout',
            'Scource' =>  'Web'
        );
        
        // log activity
        $redis = new RedisHelper();
        $redis->setData(array('id' => $this->session->get('id')), $data);
        
        // delete login session
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
