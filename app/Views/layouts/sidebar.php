<div class="col-sm-auto bg-dark d-flex sticky-top">
    <div class="d-flex flex-sm-column flex-row flex-grow-1 align-items-center align-items-sm-start px-3 pt-2 text-white">
        <a href="<?php echo base_url('/home');?>" class="text-fluid d-flex align-items-center pb-sm-3 mb-md-0 me-md-auto text-white text-decoration-none" >
            <img class="logo px-sm-0 px-2" src="https://www.isatu.edu.ph/wp-content/uploads/2016/07/ISAT-U-logo-shadow1.png"  height="28px" alt=""><span class="brand ms-3 d-none d-sm-inline" style="width: 100px; font-size: 13px;">ISATU MEDICAL CLINIC MANAGEMENT SYSTEM</span>
        </a>
        <ul class="nav nav-pills flex-sm-column flex-row flex-nowrap flex-shrink-1 flex-sm-grow-0 flex-grow-1 mb-sm-auto mb-0 justify-content-center align-items-center align-items-sm-start"
            id="menu">
            <li class="nav-item">
                <a href="<?php echo base_url('/staff');?>" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-person-lines-fill"></i><span class="ms-1 d-none d-sm-inline">Staff</span>
                </a>
            </li>
            <li>
                <a href="<?php echo base_url('/patient');?>" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-file-medical"></i><span class="ms-1 d-none d-sm-inline">Patient</span> </a>
            </li>
            <li class="dropdown">
                <a href="#" class="nav-link dropdown-toggle px-sm-0 px-1" id="dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fs-5 bi-capsule-pill"></i><span class="ms-1 d-none d-sm-inline">Inventory</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdown">
                    <li><a class="dropdown-item" href="<?php echo base_url('medicine');?>">Medicine</a></li>
                    <li><a class="dropdown-item" href="<?php echo base_url('supplies');?>">Medical Supplies</a></li>
                </ul>
            </li>
            <li>
                <a href="<?php echo base_url('dispense');?>" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-tools"></i><span class="ms-1 d-none d-sm-inline">Medicine Dispense</span> </a>
            </li>
            <li>
                <a href="<?php echo base_url('appointment');?>" class="nav-link px-sm-0 px-2">
                    <i class="fs-5 bi-calendar-plus"></i><span class="ms-1 d-none d-sm-inline">Appointment</span></a>
            </li>
            
            <!-- Use if else statement in user role -->
          
        </ul>
        <div class="dropdown py-sm-4 mt-sm-auto ms-auto ms-sm-0 flex-shrink-1">
            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle"
                id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                <img src="/images/user_icon.png" alt="user" width="26" height="26" class="rounded-circle">
                <span class="d-none d-sm-inline mx-1"><?= session()->get('staff_Name'); ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                <li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Update_Account">Update Account</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="<?php echo base_url('/login/logout');?>">Sign out</a></li>
            </ul>
        </div>
    </div>
</div>


<!-- Update Account Script -->
<?php if(session()->getFlashdata('update_account_validation_errors')||session()->getFlashdata('wpass')):?>
    <script type="text/javascript">
        $(function() {
            $('#Update_Account').modal('show');
        });
    </script>
<?php endif;?>

   

    