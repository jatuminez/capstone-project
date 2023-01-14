<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<style>
   main {
    display: flex;
    flex: 1;
    flex-direction: row;
    align-items: center;
  }
  #center {
    display: flex;
    flex: 1;
    flex-direction: column;
    align-items: center;
  }
</style>
<?php if(session()->getFlashdata('status')):?>
    <script type="text/javascript">
        $(function() {
            $('#Appointment_Request').modal('show');
        });
    </script>
<?php endif;?>
<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <div class="col vh-100 d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
                <div class="col pt-4" id="center">
                  <div class="card bg-light" style="width: 32rem;">
                    <div class="card-header">
                      <div class="text-center">
                        <img src="https://www.isatu.edu.ph/wp-content/uploads/2016/07/ISAT-U-logo-shadow1.png"  height="50px" alt="">
                      </div>
                      <div class="text-center">
                        <h5>ISATU MEDICAL CLINIC MANAGEMENT SYSTEM</h5>
                      </div>
                    </div>
                    <div class="card-body d-flex justify-content-center">
                      <div>
                        <a class="btn bi bi-eye-fill" style="background-color: green; border: green; color: white;" href="<?php echo base_url('home/appointment_form1/');?>"> Appointment</a>
                        <a class="btn bi bi-eye-fill" style="background-color: blue; border: blue; color: white;" href="<?php echo base_url('home/registration_form/');?>">Register</a>
                        <a class="btn bi bi-eye-fill" style="background-color: #FFBF00; border: #FFBF00; color: white;" href="<?php echo base_url('login');?>">Login</a>
                      </div>
                    </div>
                    <!-- Add Staff -->
                    <div class="modal fade" id="Appointment_Request" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                            <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="staticBackdropLabel">Appointment Request</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                                </div>

                                <div class="modal-body">                                                                                                    
                                  <p>Appointment request has been made. Wait for the confirmation SMS shortly.</p>
                                </div>

                                <div class="modal-footer d-flex justify-content-center">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>                             
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
          
                  </div>
                </div>
            </main>
            <?= $this->include('layouts/footer') ?>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>
        
