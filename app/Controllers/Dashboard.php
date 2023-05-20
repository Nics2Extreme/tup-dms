<?php

namespace App\Controllers;
use App\Models\Users;
use App\Libraries\Hash;

class Dashboard extends BaseController
{
    public function __construct(){
        helper(['url','form']);
    }

    public function getRegister(){
        $usersModel = new \App\Models\Users();
        $loggedUserId = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserId);
        $data = [
            'title' => 'Register',
            'userInfo' => $userInfo
        ];
        
        return view('auth/register', $data);
    }

    public function getAdminDashboard()
    {
        $usersModel = new \App\Models\Users();
        $loggedUserId = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserId);
        $data = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo
        ];
        
        return view('dashboard/admin/dashboard', $data);
    }

    public function getUserDashboard()
    {
        $usersModel = new \App\Models\Users();
        $loggedUserId = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserId);
        $data = [
            'title' => 'Dashboard',
            'userInfo' => $userInfo
        ];
        
        return view('dashboard/user/userdashboard', $data);
    }

    public function getUserProfile(){
        $usersModel = new \App\Models\Users();
        $loggedUserId = session()->get('loggedUser');
        $userInfo = $usersModel->find($loggedUserId);
        $data = [
            'title' => 'Profile',
            'userInfo' => $userInfo
        ];
        
        return view('dashboard/user/profile', $data);
    }

    public function postSave(){

        $validation = $this->validate([
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'This field is required' 
                ]
            ],
            'email' => [
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => 'This field is required',
                    'valid_email' => 'Please enter a valid email',
                    'is_unique' => 'Email already taken'
                ]
            ],
            'role' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'This field is required' 
                ]
            ],
            'password' => [
                'rules' => 'required|min_length[8]|max_length[12]',
                'errors' => [
                    'required' => 'This field is required',
                    'min_length' => 'Password must have atleast 8 characters',
                    'max_length' => 'Password must not have more than 12 characters'
                ]
            ],
            'cpassword' => [
                'rules' => 'required|min_length[8]|max_length[12]|matches[password]',
                'errors' => [
                    'required' => 'This field is required',
                    'min_length' => 'Confirmed password must have atleast 8 characters',
                    'max_length' => 'Confirmed password must not have more than 12 characters',
                    'matches' => 'Confirmed password does not match'
                ]
            ]
            
        ]);

        if(!$validation){
            return view('auth/register', ['validation' => $this->validator]);
        }else{
            $name = $this->request->getPost('name');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $role = $this->request->getPost('role');

            $values = [
               'name'=>$name,
               'email'=>$email,
               'role'=>$role,
               'password'=>Hash::make($password),
            ];


            $userModel = new Users();
            $query = $userModel->insert($values);
            if( !$query ){
                return  redirect()->to('register')->with('fail', 'Something went wrong.');
            }else{
                return redirect()->to('register')->with('success', 'User successfully registered.');
            }
        }
    }
}
