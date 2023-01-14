<?php

namespace App\Controllers;
use App\Models\PatientModel;
use App\Models\MedicineModel;
use App\Models\DispenseModel;

class Dispense extends BaseController
{
    // show medicine dispense
    public function index()
    {
         helper(['form', 'url']);
        $session = session();
        $session->remove('update_validation_errors');
        // $session->remove('inv_validation_errors');
        $DispenseModel = new DispenseModel();
        $PatientModel = new PatientModel();
        $MedicineModel = new MedicineModel();
        $data['patient'] = $PatientModel->findAll();
        $data['medicine'] = $MedicineModel->findAll();
        $data['dispense'] = $DispenseModel->get_dispense();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Dispense';
        return view('admin/dispense', $data);
    }

    // add medicine Dispense
    public function add_dispense(){
        $session = session();
        $validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $pat_Name = $this->request->getPost('pat_Name');
        $med_Name = $this->request->getPost('med_Name');
        $pat_ID = $this->db->table('patient')
                        ->where("CONCAT(pat_Fname, ' ', pat_Lname) = '$pat_Name'")
                        ->get()
                        ->getRowArray();
        $med_ID = $this->db->table('medicine_list')
                        ->where('med_Name', $med_Name)
                        ->get()
                        ->getRowArray();

        if(!empty($this->request->getPost('med_Name'))){
            if($med_ID['med_Quantity'] == '0'){
                $validation->setRules([
                    'pat_Name' => [
                        'rules' => 'required',
                        'label' => 'patient',
                    ],
                    'med_Name' => [
                        'rules' => 'required',
                        'label' => 'medicine',
                    ],
                    'dis_Num' => [
                        'rules' => 'required|in_list[0]',
                        'label' => 'quantity',
                        'errors' => [
                            'in_list' => 'Unable to dispense. This medicine is out of stock.'
                        ]
                    ],
                ]);
            }else{
                $validation->setRules([
                    'pat_Name' => [
                        'rules' => 'required',
                        'label' => 'patient',
                    ],
                    'med_Name' => [
                        'rules' => 'required',
                        'label' => 'medicine',
                    ],
                    'dis_Num' => [
                        'rules' => 'required|greater_than_equal_to[0]',
                        'label' => 'quantity',
                    ],
                ]);
            }
        }else{
            $validation->setRules([
                'pat_Name' => [
                    'rules' => 'required',
                    'label' => 'patient',
                ],
                'med_Name' => [
                    'rules' => 'required',
                    'label' => 'medicine',
                ],
                'dis_Num' => [
                    'rules' => 'required',
                    'label' => 'quantity',
                ],
            ]);      
        }
        
        if($validation->withRequest($this->request)->run()){
            if(($this->request->getPost('dis_Num') <= $med_ID['med_Quantity'])){
                $data = [
                    'pat_ID' => $pat_ID['pat_ID'],
                    'med_ID' => $med_ID['med_ID'],
                    'dis_Num' => $this->request->getPost('dis_Num')
                    
                ];
                $medicine_data = [
                    'med_Quantity' => $med_ID['med_Quantity']-$this->request->getPost('dis_Num'),
                ];
                $builder = $this->db->table('dispense');
                $builder->insert($data);
                $quantity = $this->db->table('medicine_list');
                $quantity->where('med_Name', $med_Name);
                $quantity->update($medicine_data);
                $session->setFlashdata('status','Medicine Dispense Updated Succesfully');
                return redirect('dispense');
            }else{
                $session->setFlashdata('dispense_greaterthan_quantity_error','Insuffient medicine quantity');
                return redirect('dispense')->withInput();
            }
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect('dispense')->withInput();
        }
        
    }

    // delete medicine dispense
     public function delete_dispense($id){
        $session = session();
        $DispenseModel = new DispenseModel();
        $DispenseModel->delete_dispense($id);
        $session->setFlashdata('status','Medicine Deleted Succesfully');
        return redirect('dispense');
    }

}