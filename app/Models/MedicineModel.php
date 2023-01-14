<?php 
namespace App\Models;
use CodeIgniter\Model;

class MedicineModel extends Model
{
    protected $table = 'medicine_list';

    protected $primaryKey = 'med_ID';
    
    protected $allowedFields = ['med_Name', 'med_Category', 'med_Description', 'med_ExpDate', 'med_Quantity', 'med_Unit', 'med_Cost', 'med_Total'];

   
    //show medicine inventory
    public function get_med_inv()
    {
        return $this->db->table('medicine_inventory')
                    ->join('medicine_list','medicine_inventory.med_ID = medicine_list.med_ID')
                    ->get()
                    ->getResultArray();
    }

    //delete medicine inventory
    public function delete_med_inv($id){
        $this->db->table('medicine_inventory')
                 ->where('med_inv_ID', $id)
                 ->delete();
        $this->db->query("ALTER TABLE medicine_inventory AUTO_INCREMENT = 1");
    }

}
