<?php

namespace App\Controllers;
use App\Models\StaffModel;

class Staff extends BaseController
{
    // show staff data
    public function index()
    {
        helper(['form', 'url']);
        $session = session();
        $session->remove('update_validation_errors');
        $session->remove('update_already_exist_error');
        $StaffModel = new StaffModel();
        $data['staff'] = $StaffModel->findAll();
        $data['title'] = 'Staff Records';
        $data['validation_errors'] = \Config\Services::validation();
        return view('admin/staff', $data);
    }

    // add staff
    public function add_staff(){ 
        $session = session();
        $validation = \Config\Services::validation();
        $StaffModel = new StaffModel();
        $staff_name = $this->request->getPost('staff_Fname')." ".$this->request->getPost('staff_Lname')." ".$this->request->getPost('staff_MI');
        $stafftable = $StaffModel->where("CONCAT(staff_Fname, ' ', staff_Lname, ' ', staff_MI) = '$staff_name'")->first();
        $validation->setRules([
            'staff_Type' => [
                'rules' => 'required',
                'label' => 'staff type'
            ],
            'staff_Fname' => [
                'rules' => 'required',
                'label' => 'firstname'
            ],
            'staff_Lname' => [
                'rules' => 'required',
                'label' => 'lastname'
            ],
            'staff_MI' => [
                'rules' => 'required',
                'label' => 'middle initial'
            ],
            'staff_Suffix' => [
                'rules' => 'required',
                'label' => 'suffix'
            ],
            'staff_Address' => [
                'rules' => 'required',
                'label' => 'address'
            ],
            'staff_ContactNum' => [
                'rules' => 'required',
                'label' => 'contact number'
            ],
            'staff_Email' => [
                'rules' => 'required|valid_email',
                'label' => 'email'
            ],
            'staff_LicenseNum' => [
                'rules' => 'required',
                'label' => 'license number'
            ],
            'staff_Specialization' => [
                'rules' => 'required',
                'label' => 'specialization'
            ],
            
        ]);
        
        if($validation->withRequest($this->request)->run()){
            if($stafftable){
                $session->setFlashdata('already_exist_error','Staff already exist.');
                return redirect('staff')->withInput(); 
            }else{
                $data = [
                    'staff_Type' => $this->request->getPost('staff_Type'),
                    'staff_Fname' => $this->request->getPost('staff_Fname'),
                    'staff_Lname'  => $this->request->getPost('staff_Lname'),
                    'staff_MI' => $this->request->getPost('staff_MI'),
                    'staff_Suffix'  => $this->request->getPost('staff_Suffix'),
                    'staff_Address' => $this->request->getPost('staff_Address'),
                    'staff_ContactNum'  => $this->request->getPost('staff_ContactNum'),
                    'staff_Email'  => $this->request->getPost('staff_Email'),
                    'staff_LicenseNum'  => $this->request->getPost('staff_LicenseNum'),
                    'staff_Specialization'  => $this->request->getPost('staff_Specialization'),
                ];
                $StaffModel->save($data);
                $session->setFlashdata('status','Staff Added Succesfully');
                return redirect('staff');
            }
        }else{
            if($stafftable){
                $session->setFlashdata('already_exist_error','Staff already exist.');
                return redirect('staff')->withInput();
            }else{
                $data['validation_errors'] = $validation;
                $session->setFlashdata('validation_errors', $data['validation_errors']);
                return redirect('staff')->withInput(); 
            }
        }
    }

    // update staff
    public function update_staff($id){
        helper(['form', 'url']);
        $session = session();
        $validation = \Config\Services::validation();
        $StaffModel = new StaffModel();
        $staff_name = $this->request->getPost('staff_Fname')." ".$this->request->getPost('staff_Lname')." ".$this->request->getPost('staff_MI');
        $stafftable = $StaffModel->where("CONCAT(staff_Fname, ' ', staff_Lname, ' ', staff_MI) = '$staff_name'")->first();
        $validation->setRules([
            'staff_Type' => [
                'rules' => 'required',
                'label' => 'staff type'
            ],
            'staff_Fname' => [
                'rules' => 'required',
                'label' => 'firstname'
            ],
            'staff_Lname' => [
                'rules' => 'required',
                'label' => 'lastname'
            ],
            'staff_MI' => [
                'rules' => 'required',
                'label' => 'middle initial'
            ],
            'staff_Suffix' => [
                'rules' => 'required',
                'label' => 'suffix'
            ],
            'staff_Address' => [
                'rules' => 'required',
                'label' => 'address'
            ],
            'staff_ContactNum' => [
                'rules' => 'required',
                'label' => 'contact number'
            ],
            'staff_Email' => [
                'rules' => 'required|valid_email',
                'label' => 'email'
            ],
            'staff_LicenseNum' => [
                'rules' => 'required',
                'label' => 'license number'
            ],
            'staff_Specialization' => [
                'rules' => 'required',
                'label' => 'specialization'
            ]
        ]);
        
        if($validation->withRequest($this->request)->run()){
            if(!$stafftable || $stafftable['staff_ID'] == $id){
                $data = [
                    'staff_Type' => $this->request->getPost('staff_Type'),
                    'staff_Fname' => $this->request->getPost('staff_Fname'),
                    'staff_Lname'  => $this->request->getPost('staff_Lname'),
                    'staff_MI' => $this->request->getPost('staff_MI'),
                    'staff_Suffix'  => $this->request->getPost('staff_Suffix'),
                    'staff_Address' => $this->request->getPost('staff_Address'),
                    'staff_ContactNum'  => $this->request->getPost('staff_ContactNum'),
                    'staff_Email'  => $this->request->getPost('staff_Email'),
                    'staff_LicenseNum'  => $this->request->getPost('staff_LicenseNum'),
                    'staff_Specialization'  => $this->request->getPost('staff_Specialization'),
                ];
                $StaffModel->update($id, $data);
                $session->setFlashdata('status','Staff Updated Succesfully');
                return redirect('staff');
            }elseif($stafftable){
                $session->setFlashdata('update_already_exist_error','Staff already exist.');
                $data['staff'] = $StaffModel->findAll();
                $data['staff_update_error'] = $StaffModel->where('staff_ID', $id)->first();
                $data['title'] = 'Staff Records';
                $data['validation_errors'] = $validation;
                return view('admin/staff', $data);
            }
        }else{
           if(!$validation->withRequest($this->request)->run()){
                $data['validation_errors'] = $validation;
                $data['staff'] = $StaffModel->findAll();
                $data['staff_update_error'] = $StaffModel->where('staff_ID', $id)->first();
                $data['title'] = 'Staff Records';
                $session->setFlashdata('update_validation_errors', $data['validation_errors']);
                return view('admin/staff', $data);
            }
            elseif(!$stafftable['staff_ID'] == $id && $stafftable){
                $session->setFlashdata('update_already_exist_error','Staff already exist.');
                $data['staff'] = $StaffModel->findAll();
                $data['staff_update_error'] = $StaffModel->where('staff_ID', $id)->first();
                $data['title'] = 'Staff Records';
                $data['validation_errors'] = $validation;
                return view('admin/staff', $data);
            }
        }
    }

    // delete staff data
    public function delete_staff($id){
        $session = session();
        $StaffModel = new StaffModel();
        $StaffModel->where('staff_ID', $id)->delete();
        $StaffModel->query("ALTER TABLE staff AUTO_INCREMENT = 1");
        $session->setFlashdata('status','Staff Deleted Succesfully');
        return redirect('staff');
    }
}
