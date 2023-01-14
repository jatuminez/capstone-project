<?php 
namespace App\Models;
use CodeIgniter\Model;

class PatientModel extends Model
{
    protected $table = 'patient';

    protected $primaryKey = 'pat_ID';
    
    protected $allowedFields = ['pat_Type', 'pat_Date', 'pat_Fname', 'pat_Lname', 'pat_MI', 'pat_Suffix', 'pat_Address', 'pat_Gender', 'pat_Bdate', 'pat_BloodType', 'pat_FamHistory', 'pat_ContactNum', 'pat_EmergencyNum', 'pat_Email'];


   

    // // search data
    // public function getSearch(){
    //     $request = \Config\Services::request();
    //     if($search = $request->getPost('search'))
    //     {
    //         session()->setFlashdata('status','Search Result For');
    //         return $this->query("SELECT * FROM patients WHERE (fname LIKE '%$search%') OR (lname LIKE '%$search%')")->getResultArray();
    //     }
    //     else
    //     {
    //         return $this->findAll();
    //     }      
    // }
    // public function updateProduct($data, $id)
    // {
    //     $query = $this->db->table('patients')->update($data, array('id' => $id));
    //     return $query;
    // }

}
