<?php

namespace App\Controllers;
use App\Models\SuppliesModel;

class Supplies extends BaseController
{
   // show Supplies list & Inventory
    public function index(){
        helper(['form', 'url']);
        $session = session();
        $session->remove('update_validation_errors');
        $SuppliesModel = new SuppliesModel();
        $data['supplies'] = $SuppliesModel->findAll();
        $data['sup_inv'] = $SuppliesModel->get_sup_inv();
        $data['validation_errors'] = \Config\Services::validation();
        $data['title'] = 'Supplies List';
        return view('admin/supplies_list', $data);
    }

     // add Supplies
     public function add_supplies(){
        $session = session();
        $validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $validation->setRules([
            'sup_Name' => [
                'rules' => 'required|is_unique[supplies_list.sup_Name]',
                'label' => 'supplies name',
                'errors' => [
                    'is_unique' => 'The supplies already exist.'
                ]
            ],
            'sup_Description' => [
                'rules' => 'required',
                'label' => 'supplies description'
            ],
            'sup_ExpDate' => [
                'rules' => 'required',
                'label' => 'supplies expiration date'
            ],
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'sup_Name' => $this->request->getPost('sup_Name'),
                'sup_Description' => $this->request->getPost('sup_Description'),
                'sup_ExpDate' => $this->request->getPost('sup_ExpDate'),
                'sup_Quantity' => $this->request->getPost('sup_Quantity'),
            ];
            $builder = $this->db->table('supplies_list');
            $builder->insert($data); 
            $session->setFlashdata('status','Supplies Added Succesfully');
            return redirect('supplies');
            
        }else{
            $data['validation_errors'] = $validation;
            $session->setFlashdata('validation_errors', $data['validation_errors']);
            return redirect('supplies')->withInput(); 
        }
        
    }

    // update Supplies
    public function update_supplies($id){
        helper(['form', 'url']);
        $session = session();
        $this->db = \Config\Database::connect();
        $validation = \Config\Services::validation();
        $SuppliesModel = new SuppliesModel();
        $data['title'] = 'Supplies List';  
        $sup_update = $this->db->table('supplies_list')
                         ->where('sup_ID', $id)
                         ->get()
                         ->getRowArray();
        $validation->setRules([
            'sup_Name' => [
                'rules' => 'required',
                'label' => 'supplies name',
            ],
            'sup_Description' => [
                'rules' => 'required',
                'label' => 'supplies description'
            ],
            'sup_ExpDate' => [
                'rules' => 'required',
                'label' => 'supplies expiration date'
            ],
            'sup_Quantity' => [
                'rules' => 'required',
                'label' => 'supplies quantity'
            ],
        ]);
        if($sup_update['sup_Name'] != $this->request->getPost('sup_Name')){
            $validation->setRules([
                'sup_Name' => [
                    'rules' => 'required|is_unique[supplies_list.sup_Name]',
                    'label' => 'supplies name',
                    'errors' => [
                        'is_unique' => 'The supplies already exist.'
                    ]
                ]
            ]);
        }
        if($validation->withRequest($this->request)->run()){
            $data = [
                'sup_Name' => $this->request->getPost('sup_Name'),
                'sup_Description' => $this->request->getPost('sup_Description'),
                'sup_ExpDate' => $this->request->getPost('sup_ExpDate'),
                'sup_Quantity' => $this->request->getPost('sup_Quantity'),
            ];
            $builder = $this->db->table('supplies_list');
            $builder->where('sup_ID', $id);
            $builder->update($data);
            $session->setFlashdata('status','Supplies Updated Succesfully');
            return redirect('supplies');
            
        }else{
            $data['supplies'] = $SuppliesModel->findAll();
            $data['sup_update_error'] = $sup_update;
            $data['title'] = 'Supplies List';
            $data['validation_errors'] = $validation;
            $session->setFlashdata('update_validation_errors', $data['validation_errors']);
            return view('admin/supplies_list', $data);
        }
    }

    // delete Supplies
    public function delete_supplies($id){
        $session = session();
        $SuppliesModel = new SuppliesModel();
        $SuppliesModel->where('sup_ID', $id)->delete();
        $SuppliesModel->query("ALTER TABLE supplies_list AUTO_INCREMENT = 1");
        $session->setFlashdata('status','Supplies Deleted Succesfully');
        return redirect('supplies');
    }





// **********Supplies Inventory**********

    // add supplies inventory
    public function add_sup_inv(){
        $session = session();
        $validation = \Config\Services::validation();
        $this->db = \Config\Database::connect();
        $sup_name = $this->request->getPost('sup_Name');
        $sup_id = $this->db->table('supplies_list')
            ->where('sup_Name', $sup_name)
            ->get()
            ->getRowArray();
        $validation->setRules([
            'sup_Name' => [
                'rules' => 'required',
                'label' => 'supplies name',
            ],
            'sup_invQuantity' => [
                'rules' => 'required',
                'label' => 'supplies quantity'
            ],
            'sup_invCost' => [
                'rules' => 'required',
                'label' => 'supplies cost'
            ],
        ]);
        if($validation->withRequest($this->request)->run()){
            $data = [
                'sup_ID' => $sup_id['sup_ID'],
                'sup_invQuantity' => $this->request->getPost('sup_invQuantity'),
                'sup_invCost' => $this->request->getPost('sup_invCost'),
                'sup_invTotal' => $this->request->getPost('sup_invQuantity')*$this->request->getPost('sup_invCost'),
            ];
            $sup_qty_data = ['sup_Quantity' => $sup_id['sup_Quantity']+$this->request->getPost('sup_invQuantity'),];
            $builder = $this->db->table('supplies_inventory');
            $builder->insert($data);
            $sup_qty = $this->db->table('supplies_list');
            $sup_qty->where('sup_ID', $sup_id['sup_ID']);
            $sup_qty->update($sup_qty_data);
            $session->setFlashdata('inv_status','Supplies Added Succesfully');
            return redirect('supplies');
            
        }else{
            $data['validation_errors'] = $validation;
            $session->set('inv_validation_errors', $data['validation_errors']);
            return redirect('supplies')->withInput(); 
        }
    }

     // delete supplies inventory
     public function delete_sup_inv($id){
        $session = session();
        $SuppliesModel = new SuppliesModel();
        $SuppliesModel->delete_sup_inv($id);
        $session->setFlashdata('inv_status','Supplies Deleted Succesfully');
        return redirect('supplies');
    }

}