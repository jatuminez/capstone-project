<?php 
namespace App\Models;
use CodeIgniter\Model;

class DispenseModel extends Model
{
    //show medicine dispense
    public function get_dispense()
    {
        return $this->db->table('dispense')
                    ->join('medicine_list','dispense.med_id = medicine_list.med_id')
                    ->join('patient','dispense.pat_id = patient.pat_id')
                    ->get()
                    ->getResultArray();
    }

    //delete medicine dispense
    public function delete_dispense($id){
        $this->db->table('dispense')
                 ->where('dis_ID', $id)
                 ->delete();
        $this->db->query("ALTER TABLE dispense AUTO_INCREMENT = 1");
    }

}
