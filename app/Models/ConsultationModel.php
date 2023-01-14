<?php 
namespace App\Models;
use CodeIgniter\Model;

class ConsultationModel extends Model
{

    //show consultation
    public function get_consultation($id)
    {
        return $this->db->table('consultation')
                    ->join('staff', 'consultation.staff_ID = staff.staff_ID')
                    ->join('patient', 'consultation.pat_ID = patient.pat_ID')
                    ->join('dispense', 'consultation.dis_ID = dispense.dis_ID')
                    ->where('consultation.pat_ID', $id)
                    ->get()
                    ->getResultArray();
    }

    public function view_consultation($id)
    {
        return $this->db->table('consultation', 'dispense')
                    ->join('staff', 'consultation.staff_ID = staff.staff_ID')
                    ->join('patient', 'consultation.pat_ID = patient.pat_ID')
                    ->join('dispense', 'consultation.dis_ID = dispense.dis_ID')
                    ->join('medicine_list', 'dispense.med_ID = medicine_list.med_ID')
                    ->where('consultation.pat_ID', $id)
                    ->get()
                    ->getRowArray();
    }

    //dispense in consultation 
    public function con_dispense($id)
    {
        return $this->db->table('dispense')
                    ->join('medicine_list','dispense.med_id = medicine_list.med_id')
                    ->join('patient','dispense.pat_id = patient.pat_id')
                    ->where('dispense.pat_ID', $id)
                    ->get()
                    ->getLastRow('array');
    }
   
    //delete consultation
    public function delete_consultation($id){
        $this->db->table('consultation')
                 ->where('con_ID', $id)
                 ->delete();
        $this->db->query("ALTER TABLE consultation AUTO_INCREMENT = 1");
    }
}
