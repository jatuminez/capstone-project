<?php

namespace App\Controllers;
use App\Models\StaffModel;
use App\Models\AccountModel;

class Login extends BaseController
{
    public function index()
    {
        helper(['form','url']);
        $data['title'] = 'Login';
        return view('login', $data);
    }

    public function auth()
    {
        $session = session();
        $StaffModel = new StaffModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $StaffModel->where('staff_Email', $email)->first();
           
        if($data){
            $AccountModel = new AccountModel();
            $datapass = $AccountModel->first();
            $pass = $datapass['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'staff_Name'    => $data['staff_Fname'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('staff');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/login')->withInput();
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/login')->withInput();
        }
    }


    // update account
    public function update_account()
    {
        $session = session();
        helper(['form']);
        $oldpass = $this->request->getVar('oldpassword');
            $rules = [
                'oldpassword' => [
                    'rules' => 'required',
                    'label' => 'old password'
                    
                ],
            ];

        if($this->validate($rules)){
            $rules = [
                
                'newpassword' => [
                    'rules' => 'required|min_length[6]|max_length[200]',
                    'label' => 'new password'
                    
                ],
                'confpassword' => [
                    'rules' => 'matches[newpassword]',
                    'label' => 'confirm password'
    
                ]
            ];
            if($this->validate($rules)){
                $AccountModel = new AccountModel();
                $data = $AccountModel->first();
                $pass = $data['password'];
                $verify_pass = password_verify($oldpass, $pass);
                if($verify_pass){
                    $data['password'] = password_hash($this->request->getPost('newpassword'), PASSWORD_DEFAULT);
                    $AccountModel->save($data);
                    $session->setFlashdata('account','User Updated Succesfully');
                    return redirect()->back();  
                }else{
                    $session->setFlashdata('wpass', 'Wrong Password');
                    return redirect()->back()->withInput();
                }
                
            }else{
                $data['validation'] = $this->validator;
                $session->setFlashdata('update_account_validation_errors', $data['validation']);
                return redirect()->back()->withInput();

            }
        }else{
            $data['validation'] = $this->validator;
            $session->setFlashdata('update_account_validation_errors', $data['validation']);
            return redirect()->back()->withInput();

        }
         
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }
}
