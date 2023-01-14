<?php

namespace App\Controllers;
use App\Models\AppointmentModel;
use App\Models\StaffModel;
use App\Models\PatientModel;

class Appointment extends BaseController
{
    // show Appointment data
    public function index(){
        helper(['form', 'url']);
        $session = session();
        $session->remove('update_appointment_pending_errors');
        $session->remove('update_appointment_completed_errors');
        $session->remove('update_appointment_cancelled_errors');
        $AppointmentModel = new AppointmentModel();
        $data['appointment_pending'] = $AppointmentModel->pending();
        $data['appointment_completed'] = $AppointmentModel->completed();
        $data['appointment_cancelled'] = $AppointmentModel->cancelled();
        $data['patient'] = $AppointmentModel->patient();
        $data['staff'] = $AppointmentModel->staff();
        $data['title'] = 'Appointment List';
        $data['validation_errors'] = \Config\Services::validation();
        return view('admin/appointment', $data);
    }

     // add Appointment
     public function add_appointment(){
        $session = session();
        $validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $app_patient = $this->request->getPost('app_patient');
        $app_doctor = $this->request->getPost('app_doctor');
        $builder = $this->db->table('appointment');
        $pat_ID =  $this->db->table('patient')
                        ->select("pat_ID, CONCAT(pat_Fname, ' ', pat_MI,' ', pat_Lname)")
                        ->where("CONCAT(pat_Fname, ' ', pat_MI,' ', pat_Lname) = '$app_patient'")
                        ->get()
                        ->getRowArray();
                
        $staff_ID = $this->db->table('staff')
                        ->select("staff_ID, CONCAT(staff_Fname, ' ', staff_MI,' ', staff_Lname)")
                        ->where("CONCAT(staff_Fname, ' ', staff_MI,' ', staff_Lname) = '$app_doctor'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'app_patient' => [
                'rules' => 'required',
                'label' => 'patient'
            ],
            'app_doctor' => [
                'rules' => 'required',
                'label' => 'doctor'
            ],
             'app_Type' => [
                'rules' => 'required',
                'label' => 'type'
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
            'app_Status' => [
                'rules' => 'required',
                'label' => 'status'
            ]
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'pat_ID' => $pat_ID['pat_ID'],
                'staff_ID' => $staff_ID['staff_ID'],
                'app_Type' => $this->request->getPost('app_Type'),
                'app_Date' => $this->request->getPost('app_Date'),
                'app_Time' => $this->request->getPost('app_Time'),
                'app_Complain' => $this->request->getPost('app_Complain'),
                'app_Status' => $this->request->getPost('app_Status'),
            ];
            $builder->insert($data);
            $session->setFlashdata('status','Appointment Updated Succesfully');
            return redirect('appointment'); 
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect('appointment')->withInput(); 
        }
    }

    // update pending Appointment
    public function update_appointment_pending($id){
        helper(['form', 'url']);
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $AppointmentModel = new AppointmentModel();
        $app_patient = $this->request->getPost('app_patient');
        $app_doctor = $this->request->getPost('app_doctor');
        $pat_ID =  $this->db->table('patient')
                        ->where("CONCAT(pat_Fname, ' ', pat_MI,' ', pat_Lname) = '$app_patient'")
                        ->get()
                        ->getRowArray();
                
        $staff_ID = $this->db->table('staff')
                        ->where("CONCAT(staff_Fname, ' ', staff_MI,' ', staff_Lname) = '$app_doctor'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'app_patient' => [
                'rules' => 'required',
                'label' => 'patient'
            ],
            'app_doctor' => [
                'rules' => 'required',
                'label' => 'doctor'
            ],
             'app_Type' => [
                'rules' => 'required',
                'label' => 'type'
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
            'app_Status' => [
                'rules' => 'required',
                'label' => 'status'
            ]
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'pat_ID' => $pat_ID['pat_ID'],
                'staff_ID' => $staff_ID['staff_ID'],
                'app_Type' => $this->request->getPost('app_Type'),
                'app_Date' => $this->request->getPost('app_Date'),
                'app_Time' => $this->request->getPost('app_Time'),
                'app_Complain' => $this->request->getPost('app_Complain'),
                'app_Status' => $this->request->getPost('app_Status'),
            ];
            $builder = $this->db->table('appointment');
            $builder->where('app_ID', $id);
            $builder->update($data);
            $session->setFlashdata('status','Appointment Updated Succesfully');
            return redirect('appointment');
            
        }else{
            $data['validation_errors'] = $validation;
            $data['appointment_pending'] = $AppointmentModel->pending();
            $data['appointment_completed'] = $AppointmentModel->completed();
            $data['appointment_cancelled'] = $AppointmentModel->cancelled();
            $data['patient'] = $AppointmentModel->patient();
            $data['staff'] = $AppointmentModel->staff();
            $data['app_pending_update_error'] = $this->db->table('appointment')->where('app_ID', $id)->get()->getRowArray();
            $data['title'] = 'Appointment List';
            $session->setFlashdata('update_appointment_pending_errors', $data['validation_errors']);
            return view('admin/appointment', $data);
        }
    }

    // update completed Appointment
    public function update_appointment_completed($id){
        helper(['form', 'url']);
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $AppointmentModel = new AppointmentModel();
        $app_patient = $this->request->getPost('app_patient');
        $app_doctor = $this->request->getPost('app_doctor');
        $pat_ID =  $this->db->table('patient')
                        ->where("CONCAT(pat_Fname, ' ', pat_MI,' ', pat_Lname) = '$app_patient'")
                        ->get()
                        ->getRowArray();
                
        $staff_ID = $this->db->table('staff')
                        ->where("CONCAT(staff_Fname, ' ', staff_MI,' ', staff_Lname) = '$app_doctor'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'app_patient' => [
                'rules' => 'required',
                'label' => 'patient'
            ],
            'app_doctor' => [
                'rules' => 'required',
                'label' => 'doctor'
            ],
             'app_Type' => [
                'rules' => 'required',
                'label' => 'type'
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
            'app_Status' => [
                'rules' => 'required',
                'label' => 'status'
            ]
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'pat_ID' => $pat_ID['pat_ID'],
                'staff_ID' => $staff_ID['staff_ID'],
                'app_Type' => $this->request->getPost('app_Type'),
                'app_Date' => $this->request->getPost('app_Date'),
                'app_Time' => $this->request->getPost('app_Time'),
                'app_Complain' => $this->request->getPost('app_Complain'),
                'app_Status' => $this->request->getPost('app_Status'),
            ];
            $builder = $this->db->table('appointment');
            $builder->where('app_ID', $id);
            $builder->update($data);
            $session->setFlashdata('status','Appointment Updated Succesfully');
            return redirect('appointment');
            
        }else{
            $data['validation_errors'] = $validation;
            $data['appointment_pending'] = $AppointmentModel->pending();
            $data['appointment_completed'] = $AppointmentModel->completed();
            $data['appointment_cancelled'] = $AppointmentModel->cancelled();
            $data['patient'] = $AppointmentModel->patient();
            $data['staff'] = $AppointmentModel->staff();
            $data['app_completed_update_error'] = $this->db->table('appointment')->where('app_ID', $id)->get()->getRowArray();
            $data['title'] = 'Appointment List';
            $session->setFlashdata('update_appointment_completed_errors', $data['validation_errors']);
            return view('admin/appointment', $data);
        }
    }

    // update cancelled Appointment
    public function update_appointment_cancelled($id){
        helper(['form', 'url']);
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $AppointmentModel = new AppointmentModel();
        $app_patient = $this->request->getPost('app_patient');
        $app_doctor = $this->request->getPost('app_doctor');
        $pat_ID =  $this->db->table('patient')
                        ->where("CONCAT(pat_Fname, ' ', pat_MI,' ', pat_Lname) = '$app_patient'")
                        ->get()
                        ->getRowArray();
                
        $staff_ID = $this->db->table('staff')
                        ->where("CONCAT(staff_Fname, ' ', staff_MI,' ', staff_Lname) = '$app_doctor'")
                        ->get()
                        ->getRowArray();
        $validation->setRules([
            'app_patient' => [
                'rules' => 'required',
                'label' => 'patient'
            ],
            'app_doctor' => [
                'rules' => 'required',
                'label' => 'doctor'
            ],
             'app_Type' => [
                'rules' => 'required',
                'label' => 'type'
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
            'app_Status' => [
                'rules' => 'required',
                'label' => 'status'
            ]
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'pat_ID' => $pat_ID['pat_ID'],
                'staff_ID' => $staff_ID['staff_ID'],
                'app_Type' => $this->request->getPost('app_Type'),
                'app_Date' => $this->request->getPost('app_Date'),
                'app_Time' => $this->request->getPost('app_Time'),
                'app_Complain' => $this->request->getPost('app_Complain'),
                'app_Status' => $this->request->getPost('app_Status'),
            ];
            $builder = $this->db->table('appointment');
            $builder->where('app_ID', $id);
            $builder->update($data);
            $session->setFlashdata('status','Appointment Updated Succesfully');
            return redirect('appointment');
            
        }else{
            $data['validation_errors'] = $validation;
            $data['appointment_pending'] = $AppointmentModel->pending();
            $data['appointment_completed'] = $AppointmentModel->completed();
            $data['appointment_cancelled'] = $AppointmentModel->cancelled();
            $data['patient'] = $AppointmentModel->patient();
            $data['staff'] = $AppointmentModel->staff();
            $data['app_cancelled_update_error'] = $this->db->table('appointment')->where('app_ID', $id)->get()->getRowArray();
            $data['title'] = 'Appointment List';
            $session->setFlashdata('update_appointment_cancelled_errors', $data['validation_errors']);
            return view('admin/appointment', $data);
        }
    }

    // delete Pending Appointment
    public function delete_appointment_pending($id){
        $session = session();
        $AppointmentModel = new AppointmentModel();
        $AppointmentModel->delete_app($id);
        $session->setFlashdata('_pending_status','Appointment Deleted Succesfully');
        return redirect('appointment');
    }

    // delete Completed Appointment
    public function delete_appointment_completed($id){
        $session = session();
        $AppointmentModel = new AppointmentModel();
        $AppointmentModel->delete_app($id);
        $session->setFlashdata('completed_status','Completed Deleted Succesfully');
        return redirect('appointment');
    }

    // delete Cancelled Appointment
    public function delete_appointment_cancelled($id){
        $session = session();
        $AppointmentModel = new AppointmentModel();
        $AppointmentModel->delete_app($id);
        $session->setFlashdata('cancelled_status','Cancelled Deleted Succesfully');
        return redirect('appointment');
    }

    function send_notification(){
        $session = session();
        
        // SEND MESSAGE
        $curl = curl_init();
        $data = [
            'apikey'=> $this->vars['apikey'],
            'sender' => "ISATUClinic",
            'mobileno' => "63".substr($this->request->getPost('pat_ContactNum'), 1, 10),
            'text' => $this->request->getPost('message'),
        ];
        curl_setopt_array($curl, array(
        CURLOPT_URL => "https://www.smsalert.co.in/api/push",
        CURLOPT_POSTFIELDS => http_build_query($data),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        // CURLOPT_FAILONERROR => true,
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
            $session->setFlashdata('status','Notification Has Been Sent Succesfully');
            return redirect('appointment');
        } 
        
        // OTP
        // $curl = curl_init();
        // $message = "HI";
        // $data = [
        //     'apikey'=> "63678b1d7708f",
        //     'sender' => "CVDEMO",
        //     'mobileno' => "639669663078",
        // ];
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.smsalert.co.in/api/mverify.json?&template={$message}%20[otp]",
        // CURLOPT_POSTFIELDS => $data,
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // ));

        // $response = curl_exec($curl);

        // curl_close($curl);
        // echo $response;
	
        // $curl = curl_init();
        // $data  =[
        //     'apikey'=> "63669e2e10719",
        //     'sender' => "CVDEMO",
        //     'mobileno' => "639669663078",
        //     'code' => "3927",
        // ];
        // curl_setopt_array($curl, array(
        // CURLOPT_URL => "https://www.smsalert.co.in/api/mverify",
        // CURLOPT_POSTFIELDS => $data,
        // CURLOPT_RETURNTRANSFER => true,
        // CURLOPT_ENCODING => "",
        // CURLOPT_MAXREDIRS => 10,
        // CURLOPT_TIMEOUT => 0,
        // CURLOPT_FOLLOWLOCATION => true,
        // ));

        // curl_exec($curl);
        // curl_close($curl);
        // if(curl_exec($curl) === false)
        // {
        //     echo 'Curl error: ' . curl_error($curl);
        // }
        // else
        // {
        //     echo 'Operation completed without any errors';
        // }
        
            
    }
}