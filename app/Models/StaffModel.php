<?php 
namespace App\Models;
use CodeIgniter\Model;

class StaffModel extends Model
{
    protected $table = 'staff';

    protected $primaryKey = 'staff_ID';
    
    protected $allowedFields = ['staff_Type', 'staff_Fname', 'staff_Lname', 'staff_MI', 'staff_Suffix', 'staff_Address', 'staff_ContactNum', 'staff_Email', 'staff_LicenseNum', 'staff_Specialization'];


    
}
