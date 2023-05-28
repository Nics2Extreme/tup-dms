<?php

namespace App\Controllers;

use App\Models\Users;
use App\Libraries\Hash;

class Auth extends BaseController
{
    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function getLogin()
    {
        return view('auth/login');
    }

    function postCheck()
    {
        $validation = $this->validate([
            'email' => [
                'rules'  => 'required|valid_email|is_not_unique[users.email]',
                'errors' => [
                    'required' => 'Email is required.',
                    'valid_email' => 'Invalid email.',
                    'is_not_unique' => 'Email has already been taken.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[5]|max_length[20]',
                'errors' => [
                    'required' => 'Password is required.',
                    'min_length' => 'Password must have atleast 8 characters in length.',
                    'max_length' => 'Password must not have characters more thant 20 in length.',
                ],
            ],
        ]);

        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        } else {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $userModel = new Users();
            $user_info = $userModel->where('email', $email)->first();

            $check_password = Hash::check($password, $user_info['password']);
            if (!$check_password) {
                return  redirect()->to('login', null, 'refresh')->with('fail', 'Incorect password.')->withInput();
            } else {
                if ($user_info['role'] === 'admin') {
                    $user = array(
                        'loggedUser' => $user_info['id'],
                        'name' => $user_info['name'],
                        'userRole' => $user_info['role']
                    );
                    session()->set($user);
                    return  redirect()->to('admin', null, 'refresh');
                } else {
                    $user = array(
                        'loggedUser' => $user_info['id'],
                        'name' => $user_info['name'],
                        'userRole' => $user_info['role']
                    );
                    session()->set($user);
                    return  redirect()->to('user/' . $user['loggedUser'], null, 'refresh');
                }
            }
        }
    }

    public function getLogout()
    {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            return redirect()->to('login?access=out')->with('fail', 'You are now logged out.');
        }
    }
}
