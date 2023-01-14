<?php

namespace App\Controllers;
use App\Models\PatientModel;
use App\Models\ConsultationModel;
use App\Models\StaffModel;
use App\Models\DispenseModel;

class Patient extends BaseController
{
    // show patient data
    public function index(){
        helper(['form', 'url']);
        $session = session();
        $session->remove('update_validation_errors');
        $session->remove('update_already_exist_error');
        $PatientModel = new PatientModel();
        $data['patient'] = $PatientModel->findAll();
        $data['title'] = 'Patient Records';
        $data['validation_errors'] = \Config\Services::validation();
        return view('admin/patient', $data);
    }

    // add patient
    public function add_patient(){
        $session = session();
        $PatientModel = new PatientModel();
        $validation = \Config\Services::validation();
        $pat_name = $this->request->getPost('pat_Fname')." ".$this->request->getPost('pat_Lname')." ".$this->request->getPost('pat_MI');
        $pattable = $PatientModel->where("CONCAT(pat_Fname, ' ', pat_Lname, ' ', pat_MI) = '$pat_name'")->first();
        $validation->setRules([
            'pat_Type' => [
                'rules' => 'required',
                'label' => 'patient type'
            ],
            'pat_Fname' => [
                'rules' => 'required',
                'label' => 'firstname'
            ],
            'pat_Lname' => [
                'rules' => 'required',
                'label' => 'lastname'
            ],
            'pat_MI' => [
                'rules' => 'required',
                'label' => 'middle initial'
            ],
            'pat_Suffix' => [
                'rules' => 'required',
                'label' => 'suffix'
            ],
            'pat_Address' => [
                'rules' => 'required',
                'label' => 'address'
            ],
            'pat_Gender' => [
                'rules' => 'required',
                'label' => 'gender'
            ],
            'pat_Bdate' => [
                'rules' => 'required',
                'label' => 'birth date'
            ],
            'pat_BloodType' => [
                'rules' => 'required',
                'label' => 'blood type'
            ],
            'pat_FamHistory' => [
                'rules' => 'required',
                'label' => 'family history'
            ],
            'pat_ContactNum' => [
                'rules' => 'required',
                'label' => 'contact number'
            ],
            'pat_EmergencyNum' => [
                'rules' => 'required',
                'label' => 'emergency number'
            ],
            'pat_Email' => [
                'rules' => 'required|valid_email',
                'label' => 'email'
            ]
        ]);
        
        if($validation->withRequest($this->request)->run()){
            if($pattable){
                $session->setFlashdata('already_exist_error','Patient already exist.');
                return redirect('patient')->withInput(); 
            }else{
                $data = [
                    'pat_Type' => $this->request->getPost('pat_Type'),
                    'pat_Fname' => $this->request->getPost('pat_Fname'),
                    'pat_Lname'  => $this->request->getPost('pat_Lname'),
                    'pat_MI' => $this->request->getPost('pat_MI'),
                    'pat_Suffix'  => $this->request->getPost('pat_Suffix'),
                    'pat_Address' => $this->request->getPost('pat_Address'),
                    'pat_Gender'  => $this->request->getPost('pat_Gender'),
                    'pat_Bdate' => $this->request->getPost('pat_Bdate'),
                    'pat_BloodType'  => $this->request->getPost('pat_BloodType'),
                    'pat_FamHistory' => $this->request->getPost('pat_FamHistory'),
                    'pat_ContactNum'  => $this->request->getPost('pat_ContactNum'),
                    'pat_EmergencyNum'  => $this->request->getPost('pat_EmergencyNum'),
                    'pat_Email'  => $this->request->getPost('pat_Email'),
                ];
                $PatientModel->save($data);
                $session->setFlashdata('status','Patient Added Succesfully');
                return redirect('patient');
            }
        }else{
            if($pattable){
                $session->setFlashdata('already_exist_error','Patient already exist.');
                return redirect('patient')->withInput();
            }else{
                $data['validation_errors'] = $validation;
                $session->setFlashdata('validation_errors', $data['validation_errors']);
                return redirect()->back()->withInput(); 
            }
        }
    }

    // update patient data
    public function update_patient($id){
        helper(['form', 'url']);
        $session = session();
        $validation = \Config\Services::validation();
        $PatientModel = new PatientModel();
        $pat_name = $this->request->getPost('pat_Fname')." ".$this->request->getPost('pat_Lname')." ".$this->request->getPost('pat_MI');
        $pattable = $PatientModel->where("CONCAT(pat_Fname, ' ', pat_Lname, ' ', pat_MI) = '$pat_name'")->first();
        $validation->setRules([
            'pat_Type' => [
                'rules' => 'required',
                'label' => 'patient type'
            ],
            'pat_Fname' => [
                'rules' => 'required',
                'label' => 'firstname'
            ],
            'pat_Lname' => [
                'rules' => 'required',
                'label' => 'lastname'
            ],
            'pat_MI' => [
                'rules' => 'required',
                'label' => 'middle initial'
            ],
            'pat_Suffix' => [
                'rules' => 'required',
                'label' => 'suffix'
            ],
            'pat_Address' => [
                'rules' => 'required',
                'label' => 'address'
            ],
            'pat_Gender' => [
                'rules' => 'required',
                'label' => 'gender'
            ],
            'pat_Bdate' => [
                'rules' => 'required',
                'label' => 'birth date'
            ],
            'pat_BloodType' => [
                'rules' => 'required',
                'label' => 'blood type'
            ],
            'pat_FamHistory' => [
                'rules' => 'required',
                'label' => 'family history'
            ],
            'pat_ContactNum' => [
                'rules' => 'required',
                'label' => 'contact number'
            ],
            'pat_EmergencyNum' => [
                'rules' => 'required',
                'label' => 'emergency number'
            ],
            'pat_Email' => [
                'rules' => 'required|valid_email',
                'label' => 'email'
            ]
        ]);
        
        if($validation->withRequest($this->request)->run()){
            if(!$pattable || $pattable['pat_ID'] == $id){
                $data = [
                    'pat_Type' => $this->request->getPost('pat_Type'),
                    'pat_Fname' => $this->request->getPost('pat_Fname'),
                    'pat_Lname'  => $this->request->getPost('pat_Lname'),
                    'pat_MI' => $this->request->getPost('pat_MI'),
                    'pat_Suffix'  => $this->request->getPost('pat_Suffix'),
                    'pat_Address' => $this->request->getPost('pat_Address'),
                    'pat_Gender'  => $this->request->getPost('pat_Gender'),
                    'pat_Bdate' => $this->request->getPost('pat_Bdate'),
                    'pat_BloodType'  => $this->request->getPost('pat_BloodType'),
                    'pat_FamHistory' => $this->request->getPost('pat_FamHistory'),
                    'pat_ContactNum'  => $this->request->getPost('pat_ContactNum'),
                    'pat_EmergencyNum'  => $this->request->getPost('pat_EmergencyNum'),
                    'pat_Email'  => $this->request->getPost('pat_Email'),
                ];
                $PatientModel->update($id, $data);
                $session->setFlashdata('status','Patient Updated Succesfully');
                return redirect('patient');
            }elseif($pattable){
                $session->setFlashdata('update_already_exist_error','Patient already exist.');
                $data['patient'] = $PatientModel->findAll();
                $data['patient_update_error'] = $PatientModel->where('pat_ID', $id)->first();
                $data['title'] = 'Patient Records';
                $data['validation_errors'] = $validation;
                return view('admin/patient', $data);
            }
        }else{
            if(!$validation->withRequest($this->request)->run()){
                $data['patient'] = $PatientModel->findAll();
                $data['patient_update_error'] = $PatientModel->where('pat_ID', $id)->first();
                $data['title'] = 'Patient Records';
                $data['validation_errors'] = $validation;
                $session->setFlashdata('update_validation_errors', $data['validation_errors']);
                return view('admin/patient', $data);
            }elseif(!$pattable['pat_ID'] == $id && $pattable){
                $session->setFlashdata('update_already_exist_error','Patient already exist.');
                $data['patient'] = $PatientModel->findAll();
                $data['patient_update_error'] = $PatientModel->where('pat_ID', $id)->first();
                $data['title'] = 'Patient Records';
                $data['validation_errors'] = \Config\Services::validation();
                return view('admin/patient', $data);
            }
        }
    }

    // delete patient data
    public function delete_patient($id){
        $session = session();
        $PatientModel = new PatientModel();
        $PatientModel->where('pat_ID', $id)->delete();
        $PatientModel->query("ALTER TABLE patient AUTO_INCREMENT = 1");
        $session->setFlashdata('status','Patient Deleted Succesfully');
        return redirect('patient');
    }
    
    // view patient data
    public function patient_view($id){
        helper(['form', 'url']);
        $PatientModel = new PatientModel();
        $StaffModel = new StaffModel();
        $ConsultationModel = new ConsultationModel();
        $data['patient'] = $PatientModel->find($id);
        $data['consultation'] = $ConsultationModel->get_consultation($id);
        $data['cons_data'] = $ConsultationModel->view_consultation($id);
        $data['dispense'] = $ConsultationModel->con_dispense($id);
        $data['staff'] = $StaffModel->findAll();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Patient Records';
        return view('admin/patient_view', $data);
    }

    // view consultation data
    public function consultation($id){
        $ConsultationModel = new ConsultationModel();
        $data['consultation'] = $ConsultationModel->view_consultation($id);
        $data['title'] = 'Patient Records';
        return view('admin/consultation', $data);
    }

     // add consultation
    public function add_consultation(){
        $session = session();
        $this->db = \Config\Database::connect();
        $ConsultationModel = new ConsultationModel();
        $validation = \Config\Services::validation();
        $staff_Name = $this->request->getPost('staff_Name');
        $staff_ID = $this->db->table('staff')
                        ->where("CONCAT(staff_Fname, ' ', staff_MI, ' ', staff_Lname) = '$staff_Name'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'staff_Name' => [
                'rules' => 'required',
                'label' => 'staff name'
            ],
            'app_ID' => [
                'rules' => 'required',
                'label' => 'app no.'
            ],
            'con_Date' => [
                'rules' => 'required',
                'label' => 'date'
            ],
            'pat_Fname' => [
                'rules' => 'required',
                'label' => 'firstname'
            ],
            'pat_Lname' => [
                'rules' => 'required',
                'label' => 'lastname'
            ],
            'pat_Suffix' => [
                'rules' => 'required',
                'label' => 'suffix'
            ],
            'con_VitalSigns' => [
                'rules' => 'required',
                'label' => 'vital signs'
            ],
            'con_Assessment' => [
                'rules' => 'required',
                'label' => 'assessment'
            ],
            'con_MedDose' => [
                'rules' => 'required',
                'label' => 'medicine dosage'
            ],
        ]);
        
        if($validation->withRequest($this->request)->run()){
            $data = [
                'staff_ID' => $staff_ID['staff_ID'],
                'pat_ID' => $this->request->getPost('pat_ID'),
                'dis_ID' => $this->request->getPost('dis_ID'),
                'app_ID' => $this->request->getPost('app_ID'),
                'con_Date'  => $this->request->getPost('con_Date'),
                'con_VitalSigns' => $this->request->getPost('con_VitalSigns'),
                'con_Assessment'  => $this->request->getPost('con_Assessment'),
                'con_MedDose'  => $this->request->getPost('con_MedDose'),
                
            ];
            $this->db->table('consultation')->insert($data);
            $session->setFlashdata('status','Consultation Added Succesfully');
            return redirect()->back();
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect()->back()->withInput();       
        }
    }

     // edit consultation
    public function edit_consultation($id){
        $session = session();
        $this->db = \Config\Database::connect();
        $ConsultationModel = new ConsultationModel();
        $validation = \Config\Services::validation();
        $staff_Name = $this->request->getPost('staff_Name');
        $staff_ID = $this->db->table('staff')
                        ->where("CONCAT(staff_Fname, ' ', staff_MI, ' ', staff_Lname) = '$staff_Name'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'staff_Name' => [
                'rules' => 'required',
                'label' => 'staff name'
            ],
            'app_ID' => [
                'rules' => 'required',
                'label' => 'app no.'
            ],
            'con_Date' => [
                'rules' => 'required',
                'label' => 'date'
            ],
            'pat_Fname' => [
                'rules' => 'required',
                'label' => 'firstname'
            ],
            'pat_Lname' => [
                'rules' => 'required',
                'label' => 'lastname'
            ],
            'pat_Suffix' => [
                'rules' => 'required',
                'label' => 'suffix'
            ],
            'con_VitalSigns' => [
                'rules' => 'required',
                'label' => 'vital signs'
            ],
            'con_Assessment' => [
                'rules' => 'required',
                'label' => 'assessment'
            ],
            'con_MedDose' => [
                'rules' => 'required',
                'label' => 'medicine dosage'
            ],
        ]);
        
        if($validation->withRequest($this->request)->run()){
            $data = [
                'staff_ID' => $staff_ID['staff_ID'],
                'pat_ID' => $this->request->getPost('pat_ID'),
                'dis_ID' => $this->request->getPost('dis_ID'),
                'app_ID' => $this->request->getPost('app_ID'),
                'con_Date'  => $this->request->getPost('con_Date'),
                'con_VitalSigns' => $this->request->getPost('con_VitalSigns'),
                'con_Assessment'  => $this->request->getPost('con_Assessment'),
                'con_MedDose'  => $this->request->getPost('con_MedDose'),
                
            ];
            $this->db->table('consultation')->where('con_ID', $id)->update($data);
            $session->setFlashdata('status','Consultation Updated Succesfully');
            return redirect()->back();
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect()->back()->withInput();       
        }
    }

    // delete consultation
     public function delete_consultation($id){
        $session = session();
        $ConsultationModel = new ConsultationModel();
        $ConsultationModel->delete_consultation($id);
        $session->setFlashdata('status','Consultation Deleted Succesfully');
        return redirect()->back();
    }
}