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
<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <div class="col vh-100  d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
              <div class="col pt-4" id="center">
                <div class="card bg-light" style="width: 40rem;">
                  <form action="<?php echo base_url('home/step2') ?>" method="post">
                    <h5 class="card-header text-center">Patient Information</h5>                      
                    <div class="card-body">
                        <?php
                            if(session()->getFlashdata('status'))
                            {
                                ?>
                                  <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                      <strong>
                                        <?= session()->getFlashdata('status'); ?>
                                      </strong><br>
                                      Please <a href="<?php echo base_url('home/registration_form') ?>">register</a> before scheduling an appointment.
                                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                  </div>
                                <?php
                            }
                        ?>
                        <div class="tab">    
                            <div class="form-group">
                                <label for="pat_Fname" class="form-label">First Name</label>
                                <input type="text" name="pat_Fname" class="form-control" value="<?= old('pat_Fname'); ?>">
                                <?php if($validation_errors->getError('pat_Fname')): ?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Fname') ?></div>
                                <?php endif;?>
                            </div><br>

                            <div class="form-group">
                                <label for="pat_MI" class="form-label">Middle Initial</label>
                                <input type="text" name="pat_MI" class="form-control" value="<?= old('pat_MI'); ?>">
                                <?php if($validation_errors->getError('pat_MI')): ?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_MI') ?></div>
                                <?php endif;?>
                            </div><br>

                            <div class="form-group">
                                <label for="pat_Lname" class="form-label">Last Name</label>
                                <input type="text" name="pat_Lname" class="form-control" value="<?= old('pat_Lname'); ?>">
                                <?php if($validation_errors->getError('pat_Lname')): ?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Lname') ?></div>
                                <?php endif;?>
                            </div><br>
                            <div class="form-group">
                              <label for="pat_ContactNum" class="form-label">Mobile Number</label>
                              <input type="text" name="pat_ContactNum" class="form-control" maxlength="11" value="<?= old('pat_ContactNum'); ?>">
                              <?php if($validation_errors->getError('pat_ContactNum')):?>
                                  <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_ContactNum') ?></div>
                              <?php endif;?>
                            </div><br>
                        </div>    
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                      <div class="form-group">
                        <a type="button" class="btn btn-secondary"
                            href="<?php echo base_url('home/appointment_form1') ?>" >Previous</a>
                        <button type="submit" class="btn btn-success">Next</button>
                      </div>
                    </div>
                  </form>
                </div><br>
              </div>
            </main>
            <?= $this->include('layouts/footer') ?>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>

            
          
