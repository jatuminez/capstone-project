<?php 
namespace App\Models;
use CodeIgniter\Model;

class AppointmentModel extends Model
{
    public function pending()
    {
        return $this->db->table('appointment')
                ->join('patient','appointment.pat_ID = patient.pat_ID')
                ->join('staff','appointment.staff_ID = staff.staff_ID')
                ->where('app_Status', 'Pending')
                ->get()
                ->getResultArray();
    }

    public function completed()
    {
        return $this->db->table('appointment')
                ->join('patient','appointment.pat_ID = patient.pat_ID')
                ->join('staff','appointment.staff_ID = staff.staff_ID')
                ->where('app_Status', 'Completed')
                ->get()
                ->getResultArray();
    }

    public function cancelled()
    {
        return $this->db->table('appointment')
                ->join('patient','appointment.pat_ID = patient.pat_ID')
                ->join('staff','appointment.staff_ID = staff.staff_ID')
                ->where('app_Status', 'Cancelled')
                ->get()
                ->getResultArray();
    }

    public function patient()
    {
        return $this->db->table('patient')
                ->get()
                ->getResultArray();
    }
    public function staff()
    {
        return $this->db->table('staff')
                ->where('staff_type', 'Doctor')
                ->get()
                ->getResultArray();
    }

    public function delete_app($id)
    {
        $this->db->table('appointment')
                 ->where('app_id', $id)
                 ->delete();
        $this->db->query("ALTER TABLE appointment AUTO_INCREMENT = 1");
    }
}
