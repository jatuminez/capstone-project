<?php 
namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'account';

    protected $primaryKey = 'acc_ID';
    
    protected $allowedFields = ['acc_ID', 'password'];
}
