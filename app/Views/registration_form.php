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
                <div class="card bg-light" style="width: 56rem;">
                  <form action="<?php echo base_url('home/register_patient') ?>" method="post">
                    <h5 class="card-header text-center">Registration Form</h5>                      
                    <div class="card-body">
                      <?php if(session()->getFlashdata('already_exist_error')):?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('already_exist_error'); ?></div>
                      <?php endif;?>
                      <div class="row g-3">
                        <div class="row gy-2 gx-3">
                          <div class="col-md-3">
                              <label for="pat_Type" class="form-label">Patient Type</label>
                              <select class="form-select" name="pat_Type">
                                <option value="">Select Patient Type</option>
                                <option <?php if(old('pat_Type') == "Applicants"):?>selected="selected"<?php endif;?> value="Applicants">Applicants</option>
                                <option <?php if(old('pat_Type') == "Student"):?>selected="selected"<?php endif;?> value="Student">Student</option>
                                <option <?php if(old('pat_Type') == "Employee/Faculty"):?>selected="selected"<?php endif;?> value="Employee/Faculty">Employee/Faculty</option>
                              </select>
                              <?php if($validation_errors->getError('pat_Type')):?>
                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Type') ?></div>
                              <?php endif;?>
                          </div>
                        </div><br>
                        <div class="col-md-4">
                          <label for="pat_Fname" class="form-label">First Name</label>
                          <input type="text" name="pat_Fname" class="form-control" value="<?= old('pat_Fname'); ?>">
                          <?php if($validation_errors->getError('pat_Fname')): ?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Fname') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col-md-4">
                          <label for="pat_Lname" class="form-label">Last Name</label>
                          <input type="text" name="pat_Lname" class="form-control" value="<?= old('pat_Lname'); ?>">
                          <?php if($validation_errors->getError('pat_Lname')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Lname') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col">
                          <label for="pat_MI" class="form-label">Middle Initial</label>
                          <input type="text" name="pat_MI" class="form-control" value="<?= old('pat_MI'); ?>">
                          <?php if($validation_errors->getError('pat_MI')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_MI') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col">
                          <label for="pat_Suffix" class="form-label">Suffix</label>
                          <input type="text" name="pat_Suffix" class="form-control" value="<?= old('pat_Suffix'); ?>">
                          <?php if($validation_errors->getError('pat_Suffix')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Suffix') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col-md-4">
                          <label for="pat_Address" class="form-label">Address</label>
                          <input type="text" name="pat_Address" class="form-control" value="<?= old('pat_Address'); ?>">
                          <?php if($validation_errors->getError('pat_Address')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Address') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col">
                          <label for="pat_Bdate" class="form-label">Birth Date</label>
                          <input type="date" name="pat_Bdate" class="form-control" value="<?= old('pat_Bdate'); ?>">
                          <?php if($validation_errors->getError('pat_Bdate')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Bdate') ?></div>
                          <?php endif;?>
                        </div>

                        <div class="col">
                          <label for="pat_Gender" class="form-label">Gender</label>
                          <select class="form-select" name="pat_Gender">
                              <option value="">Select Gender</option>
                              <option <?php if(old('pat_Gender') == "Male"):?>selected="selected"<?php endif;?> value="Male">Male</option>
                              <option <?php if(old('pat_Gender') == "Female"):?>selected="selected"<?php endif;?> value="Female">Female</option>
                          </select>
                          <?php if($validation_errors->getError('pat_Gender')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Gender') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col">
                          <label for="pat_BloodType" class="form-label">Blood Type</label>
                          <select class="form-select" name="pat_BloodType" class="form-control">
                              <option value="">Select Blood Type</option>
                              <option <?php if(old('pat_BloodType') == "O"):?>selected="selected"<?php endif;?> value="O">O</option>
                              <option <?php if(old('pat_BloodType') == "AB"):?>selected="selected"<?php endif;?> value="AB">AB</option>
                              <option <?php if(old('pat_BloodType') == "A"):?>selected="selected"<?php endif;?> value="A">A</option>
                              <option <?php if(old('pat_BloodType') == "B"):?>selected="selected"<?php endif;?> value="B">B</option>
                          </select>
                          <?php if($validation_errors->getError('pat_BloodType')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_BloodType') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col-md-4">
                          <label for="pat_ContactNum" class="form-label">Contact Number</label>
                          <input type="text" name="pat_ContactNum" class="form-control" maxlength="11" value="<?= old('pat_ContactNum'); ?>">
                          <?php if($validation_errors->getError('pat_ContactNum')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_ContactNum') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col-md-4">
                          <label for="pat_EmergencyNum" class="form-label">Emergency Number</label>
                          <input type="text" name="pat_EmergencyNum" class="form-control" maxlength="11" value="<?= old('pat_EmergencyNum'); ?>">
                          <?php if($validation_errors->getError('pat_EmergencyNum')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_EmergencyNum') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col-md-4">
                          <label for="pat_Email" class="form-label">Email</label>
                          <input type="email" name="pat_Email" class="form-control" value="<?= old('pat_Email'); ?>">
                          <?php if($validation_errors->getError('pat_Email')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Email') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="col">
                          <label for="pat_FamHistory" class="form-label">Family History</label>
                          <textarea rows="3" name="pat_FamHistory" class="form-control"><?= old('pat_FamHistory'); ?></textarea>
                          <?php if($validation_errors->getError('pat_FamHistory')):?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_FamHistory') ?></div>
                          <?php endif;?>
                        </div><br>
                      </div>                     
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Save</button>
                          <a type="button" class="btn btn-secondary"
                            href="<?php echo base_url('home/registration_form') ?>" >Close</a>
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

            
          
