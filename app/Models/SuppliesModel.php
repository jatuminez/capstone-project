<?php 
namespace App\Models;
use CodeIgniter\Model;

class SuppliesModel extends Model
{
    protected $table = 'supplies_list';

    protected $primaryKey = 'sup_ID';
    
    protected $allowedFields = ['sup_Name', 'sup_Category', 'sup_Description', 'sup_ExpDate', 'sup_Quantity', 'sup_Unit', 'sup_Cost', 'sup_Total'];

   
    //show supplies inventory
    public function get_sup_inv()
    {
        return $this->db->table('supplies_inventory')
                    ->join('supplies_list','supplies_inventory.sup_ID = supplies_list.sup_ID')
                    ->get()
                    ->getResultArray();
    }

    //delete supplies inventory
    public function delete_sup_inv($id){
        $this->db->table('supplies_inventory')
                 ->where('sup_inv_ID', $id)
                 ->delete();
        $this->db->query("ALTER TABLE supplies_inventory AUTO_INCREMENT = 1");
    }

}
