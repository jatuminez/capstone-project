<?php

namespace App\Controllers;
use App\Models\MedicineModel;

class Medicine extends BaseController
{
   // show Medicine list & Inventory
    public function index(){
        helper(['form', 'url']);
        $session = session();
        $session->remove('update_validation_errors');
        // $session->remove('inv_validation_errors');
        $MedicineModel = new MedicineModel();
        $data['medicine'] = $MedicineModel->findAll();
        $data['med_inv'] = $MedicineModel->get_med_inv();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Medicine List';
        return view('admin/medicine_list', $data);
    }

     // add Medicine
     public function add_medicine(){
        $session = session();
        $validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $MedicineModel = new MedicineModel();
        $validation->setRules([
            'med_Name' => [
                'rules' => 'required|is_unique[medicine_list.med_Name]',
                'label' => 'medicine name',
                'errors' => [
                    'is_unique' => 'The medicine already exist.'
                ]
            ],
            'med_Category' => [
                'rules' => 'required',
                'label' => 'medicine category'
            ],
            'med_Description' => [
                'rules' => 'required',
                'label' => 'medicine description'
            ],
            'med_ExpDate' => [
                'rules' => 'required',
                'label' => 'medicine expiration date'
            ],
            'med_Unit' => [
                'rules' => 'required',
                'label' => 'medicine unit'
            ],
            // 'med_Quantity' => [
            //     'rules' => 'required',
            //     'label' => 'medicine quantity'
            // ],
            // 'med_Cost' => [
            //     'rules' => 'required',
            //     'label' => 'medicine price'
            // ]
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'med_Name' => $this->request->getPost('med_Name'),
                'med_Category' => $this->request->getPost('med_Category'),
                'med_Description' => $this->request->getPost('med_Description'),
                'med_ExpDate' => $this->request->getPost('med_ExpDate'),
                'med_Unit' => $this->request->getPost('med_Unit'),
                'med_Quantity' => $this->request->getPost('med_Quantity'),
                // 'med_Cost' => $this->request->getPost('med_Cost'),
                // 'med_Total' => $this->request->getPost('med_Quantity')*$this->request->getPost('med_Cost')
            ];
            $builder = $this->db->table('medicine_list');
            $builder->insert($data); 
            $session->setFlashdata('status','Medicine Added Succesfully');
            return redirect('medicine');
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect('medicine')->withInput(); 
        }
        
    }

    // update Medicine
    public function update_medicine($id){
        helper(['form', 'url']);
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $MedicineModel = new MedicineModel();
        $data['title'] = 'Medicine List';  
        $med_update = $this->db->table('medicine_list')
                         ->where('med_ID', $id)
                         ->get()
                         ->getRowArray();
        $validation->setRules([
            'med_Name' => [
                'rules' => 'required',
                'label' => 'medicine name',
            ],
            'med_Category' => [
                'rules' => 'required',
                'label' => 'medicine category'
            ],
            'med_Description' => [
                'rules' => 'required',
                'label' => 'medicine description'
            ],
            'med_ExpDate' => [
                'rules' => 'required',
                'label' => 'medicine expiration date'
            ],
            'med_Unit' => [
                'rules' => 'required',
                'label' => 'medicine unit'
            ],
            'med_Quantity' => [
                'rules' => 'required',
                'label' => 'medicine quantity'
            ],
            // 'med_Cost' => [
            //     'rules' => 'required',
            //     'label' => 'medicine price'
            // ]
        ]);
        if($med_update['med_Name'] != $this->request->getPost('med_Name')){
            $validation->setRules([
                'med_Name' => [
                    'rules' => 'required|is_unique[medicine_list.med_Name]',
                    'label' => 'medicine name',
                    'errors' => [
                        'is_unique' => 'The medicine already exist.'
                    ]
                ]
            ]);
        }
        if($validation->withRequest($this->request)->run()){
            $data = [
                'med_Name' => $this->request->getPost('med_Name'),
                'med_Category' => $this->request->getPost('med_Category'),
                'med_Description' => $this->request->getPost('med_Description'),
                'med_ExpDate' => $this->request->getPost('med_ExpDate'),
                'med_Unit' => $this->request->getPost('med_Unit'),
                'med_Quantity' => $this->request->getPost('med_Quantity'),
                // 'med_Cost' => $this->request->getPost('med_Cost'),
                // 'med_Total' => $this->request->getPost('med_Quantity')*$this->request->getPost('med_Cost')
            ];
            $builder = $this->db->table('medicine_list');
            $builder->where('med_ID', $id);
            $builder->update($data);
            $session->setFlashdata('status','Medicine Updated Succesfully');
            return redirect('medicine');
            
        }else{
            $data['medicine'] = $MedicineModel->findAll();
            $data['med_update_error'] = $med_update;
            $data['title'] = 'Medicine List';
            $data['validation_errors'] = $validation;
            $session->setFlashdata('update_validation_errors', $data['validation_errors']);
            return view('admin/medicine_list', $data);
        }
    }

    // delete Medicine
    public function delete_medicine($id){
        $session = session();
        $MedicineModel = new MedicineModel();
        $MedicineModel->where('med_ID', $id)->delete();
        $MedicineModel->query("ALTER TABLE medicine_list AUTO_INCREMENT = 1");
        $session->setFlashdata('status','Medicine Deleted Succesfully');
        return redirect('medicine');
    }



    

    // **********Medicine Inventory**********

    // add medicine inventory
    public function add_med_inv(){
        $session = session();
        $validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $med_name = $this->request->getPost('med_Name');
        $med_id = $this->db->table('medicine_list')
            ->where('med_Name', $med_name)
            ->get()
            ->getRowArray();
        $validation->setRules([
            'med_Name' => [
                'rules' => 'required',
                'label' => 'medicine name',
            ],
            'med_invQuantity' => [
                'rules' => 'required',
                'label' => 'medicine quantity'
            ],
            'med_invUnit' => [
                'rules' => 'required',
                'label' => 'medicine unit'
            ],
            'med_invCost' => [
                'rules' => 'required',
                'label' => 'medicine cost'
            ],
            // 'med_Quantity' => [
            //     'rules' => 'required',
            //     'label' => 'medicine quantity'
            // ],
            // 'med_Cost' => [
            //     'rules' => 'required',
            //     'label' => 'medicine price'
            // ]
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'med_ID' => $med_id['med_ID'],
                'med_invQuantity' => $this->request->getPost('med_invQuantity'),
                'med_invUnit' => $this->request->getPost('med_invUnit'),
                'med_invCost' => $this->request->getPost('med_invCost'),
                'med_invTotal' => $this->request->getPost('med_invQuantity')*$this->request->getPost('med_invCost'),
                // 'med_Cost' => $this->request->getPost('med_Cost'),
                // 'med_Total' => $this->request->getPost('med_Quantity')*$this->request->getPost('med_Cost')
            ];
            $med_qty_data = ['med_Quantity' => $med_id['med_Quantity']+$this->request->getPost('med_invQuantity'),];
            $builder = $this->db->table('medicine_inventory');
            $builder->insert($data);
            $med_qty = $this->db->table('medicine_list');
            $med_qty->where('med_ID', $med_id['med_ID']);
            $med_qty->update($med_qty_data);
            $session->setFlashdata('inv_status','Medicine Added Succesfully');
            return redirect('medicine');
            
        }else{
            $data['validation_errors'] = $validation;
            $session->set('inv_validation_errors', $data['validation_errors']);
            return redirect('medicine')->withInput(); 
        }
    }

     // delete medicine inventory
     public function delete_med_inv($id){
        $session = session();
        $MedicineModel = new MedicineModel();
        $MedicineModel->delete_med_inv($id);
        $session->setFlashdata('inv_status','Medicine Deleted Succesfully');
        return redirect('medicine');
    }





    // **********Medicine Dispense**********
    // show Medicine list & Inventory
    public function med_dispense(){
        helper(['form', 'url']);
        $session = session();
        $session->remove('update_validation_errors');
        // $session->remove('inv_validation_errors');
        $MedicineModel = new MedicineModel();
        $data['medicine'] = $MedicineModel->findAll();
        $data['med_inv'] = $MedicineModel->get_med_inv();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Medicine List';
        return view('admin/med_dispense', $data);
    }
}