<?php

namespace App\Controllers;
use App\Models\PatientModel;
use App\Models\StaffModel;
use App\Models\AppointmentModel;


class Home extends BaseController
{
    public function index()
    {
        $data['title'] = 'ISATU Medical clinic';
        return view('home', $data);
    }

    public function registration_form()
    {
        helper(['form', 'url']);
        $session = session();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Registration Form';
        return view('registration_form', $data);
    }

    // register patient
    public function register_patient(){
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
                return redirect()->back()->withInput(); 
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
                return redirect()->back();
            }
        }else{
            if($pattable){
                $session->setFlashdata('already_exist_error','Patient already exist.');
                return redirect()->back()->withInput();
            }else{
                $data['validation_errors'] = $validation;
                $session->setFlashdata('validation_errors', $data['validation_errors']);
                return redirect()->back()->withInput(); 
            }
        }
    }

    public function appointment_form1()
    {
        helper(['form', 'url']);
        $session = session();
        $data['validation_errors'] = \Config\Services::validation();
        $AppointmentModel = new AppointmentModel();
        $data['staff'] = $AppointmentModel->staff();
        $data['title'] = 'Appointment Form';
        return view('appointment_form/step1', $data);
    }

    public function appointment_form2()
    {
        helper(['form', 'url']);
        $session = session();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Appointment Form';
        return view('appointment_form/step2', $data);
    }

    public function appointment_form3()
    {
        helper(['form', 'url']);
        $session = session();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Appointment Form';
        return view('appointment_form/step3', $data);
    }

    public function step1(){
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $app_doctor = $this->request->getPost('app_doctor');
        $staff_data =  $this->db->table('staff')
                        ->where("CONCAT(staff_Fname, ' ', staff_MI,' ', staff_Lname) = '$app_doctor'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'app_doctor' => [
                'rules' => 'required',
                'label' => 'doctor'
            ],
            'app_Date' => [
                'rules' => 'required',
                'label' => 'date'
            ],
             'app_Time' => [
                'rules' => 'required',
                'label' => 'time'
            ],
             'app_Complain' => [
                'rules' => 'required',
                'label' => 'complain'
            ],
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'staff_ID' => $staff_data,
                'app_Date' => $this->request->getPost('app_Date'),
                'app_Time' => $this->request->getPost('app_Time'),
                'app_Complain' => $this->request->getPost('app_Complain'),
            ];
            $session->set('step1_data', $data);
            return redirect()->to('home/appointment_form2'); 
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect()->to('home/appointment_form1')->withInput(); 
        }
    }

    public function step2(){
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $pat_data = $this->request->getPost('pat_Fname')." ".$this->request->getPost('pat_MI')." ".$this->request->getPost('pat_Lname')." ".$this->request->getPost('pat_ContactNum');
        $verify_patient =  $this->db->table('patient')
                        ->where("CONCAT(pat_Fname, ' ', pat_MI,' ', pat_Lname,' ',pat_ContactNum) = '$pat_data'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'pat_Fname' => [
                'rules' => 'required',
                'label' => 'first name'
            ],
             'pat_MI' => [
                'rules' => 'required',
                'label' => 'middle initial'
            ],
             'pat_Lname' => [
                'rules' => 'required',
                'label' => 'last name'
            ],
             'pat_ContactNum' => [
                'rules' => 'required',
                'label' => 'mobile number'
            ],
        ]);
        if($validation->withRequest($this->request)->run()){
            if($verify_patient){
                $data['pat_ID'] = $verify_patient['pat_ID'];
                $data['staff_ID'] = 1;
                $mobile_no = $this->request->getPost('pat_ContactNum');
                $session->set('step2_data', $data);
                $session->set('mobile_no', $mobile_no);

                // OTP
                $curl = curl_init();
                $message = "Your verification code is";
                $otp_data = [
                    'apikey'=> $this->vars['apikey'],
                    'sender' => "OTP",
                    'mobileno' => "63".substr($this->request->getPost('pat_ContactNum'), 1, 10),
                ];
                curl_setopt_array($curl, array(
                CURLOPT_URL => "https://www.smsalert.co.in/api/mverify.json?&template={$message}%20[otp]",
                CURLOPT_POSTFIELDS => $otp_data,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                ));

                $response = curl_exec($curl);
                $response_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

                curl_close($curl);
                if(!($response_code == 200))
                {
                    echo $response;
                }
                else
                {
                    return redirect()->to('home/appointment_form3');
                } 

                 
            }else{
                $session->setFlashdata('status','Record Not Found');
                return redirect()->to('home/appointment_form2')->withInput();
            }
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect()->to('home/appointment_form2')->withInput(); 
        }
    }

    public function step3(){
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'app_otp' => [
                'rules' => 'required',
                'label' => 'code'
            ],
        ]);
        if($validation->withRequest($this->request)->run()){
            $otp = $this->request->getPost('app_otp');
            $mobile_no = $session->get('mobile_no');
            $curl = curl_init();
            $data  =[
                'apikey'=> $this->vars['apikey'],
                'sender' => "CVDEMO",
                'mobileno' => "63".substr($mobile_no, 1, 10),
                'code' => $otp,
            ];
            curl_setopt_array($curl, array(
            CURLOPT_URL => "https://www.smsalert.co.in/api/mverify",
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            ));

            $response = curl_exec($curl);
            $response_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

            curl_close($curl);
            if(!($response == "Code does not match."))
            {
                $step1_data = $session->get('step1_data');
                $step2_data = $session->get('step2_data');
                $data = array_merge($step1_data, $step2_data);
                $builder = $this->db->table('appointment');
                $builder->insert($data);
                $index_data['title'] = 'ISATU Medical clinic';
                $index_data['show'] = 'show';
                $session->setFlashdata('status', 'show');
                return redirect()->to('home');
            }
            else
            {
                $session->setFlashdata('status', $response);
                return redirect()->to('home/appointment_form3');
            } 
         
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect()->to('home/appointment_form3')->withInput(); 
        }
    }
}