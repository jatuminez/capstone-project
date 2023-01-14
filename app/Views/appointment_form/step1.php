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
                <div class="card" style="width: 40rem;">
                  <form action="<?php echo base_url('home/step1') ?>" method="post">
                    <h5 class="card-header text-center">Set An Appointment</h5>                      
                    <div class="card-body">
                      <div class="tab">
                        <div class="form-group">
                          <label for="app_doctor" class="form-label">Doctor</label>
                          <select id="app_doctor" name="app_doctor" class="selectpicker" data-width="100%" data-live-search="true" title="Select Patient">
                            <?php if($staff): ?>
                            <?php foreach($staff as $row): ?>
                              <option <?php if(old('app_doctor') == $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>">
                                <?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>
                              </option>
                            <?php endforeach; ?>
                            <?php endif; ?>
                          </select>    
                          <?php if($validation_errors->getError('app_doctor')): ?>
                              <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_doctor') ?></div>
                          <?php endif;?>
                        </div><br>

                        <div class="form-group">
                            <label for="app_Date" class="form-label">Date</label>
                            <input type="date" name="app_Date" class="form-control" value="<?= old('app_Date'); ?>">
                            <?php if($validation_errors->getError('app_Date')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Date') ?></div>
                            <?php endif;?>
                        </div><br>

                        <div class="form-group">
                            <label for="app_Time" class="form-label">Time</label>
                            <input type="time" name="app_Time" class="form-control" value="<?= old('app_Time'); ?>">
                            <?php if($validation_errors->getError('app_Time')): ?>
                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Time') ?></div>
                            <?php endif;?>
                        </div><br>

                        <div class="form-group">
                            <label for="app_Complain" class="form-label">Complain</label>
                            <textarea rows="3" name="app_Complain" class="form-control"><?= old('app_Complain'); ?></textarea>
                            <?php if($validation_errors->getError('app_Complain')):?>
                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Complain') ?></div>
                            <?php endif;?>
                        </div><br>
                      </div>    
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                      <div class="form-group">
                        <a type="button" class="btn btn-secondary"
                            href="<?php echo base_url('home') ?>" >Back</a>
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

            
          
