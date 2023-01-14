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
<script type="text/javascript">
    $(function() {
        $('#Add_Appointment').modal('show');
    });
</script>
<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <div class="col vh-100  d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
              <div class="col pt-4" id="center">
                <!-- Add Appointment -->
                    <form action="<?php echo base_url('home/set_appointment') ?>" method="post">
                        <div class="modal fade" id="Add_Appointment" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Set An Appointment</h5>

                                        <a class="btn-close" href="<?php echo base_url('home/appointment_form') ?>"></a>

                                    </div>

                                    <div class="modal-body">                                                                  
                                      <div class="tab">    
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
                                      <div class="tab">

                                      </div>
                                    </div>

                                    <div class="modal-footer">
                                      <div class="form-group">
                                          <button type="submit" class="btn btn-success">Save</button>
                                          <a type="button" class="btn btn-secondary" 
                                              href="<?php echo base_url('home/appointment_form') ?>" >Close</a>
                                      </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
              </div>
            </main>
            <?= $this->include('layouts/footer') ?>
        </div>
    </div>
</div>


<?= $this->endSection('content') ?>

            
          
