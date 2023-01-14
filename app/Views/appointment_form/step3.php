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
                <div class="card bg-light" style="width: 28rem;">
                  <form action="<?php echo base_url('home/step3') ?>" method="post">
                    <h5 class="card-header text-center">Enter Verification Code</h5>                      
                    <div class="card-body">
                        <div class="tab">    
                            <div class="form-group">
                                <label for="app_otp" class="form-label">Your code has been sent to your mobile number. Please enter the code below</label>
                                <input type="text" name="app_otp" class="form-control" value="<?= old('app_otp'); ?>">
                                <?php if($validation_errors->getError('app_otp')): ?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_otp') ?></div>
                                <?php endif;?>
                                <?php
                                    if(session()->getFlashdata('status'))
                                    {
                                        ?>
                                          <div class="alert alert-danger mt-2">
                                                <?= session()->getFlashdata('status'); ?>             
                                          </div>
                                        <?php
                                    }
                                ?>
                            </div><br>
                        </div>    
                    </div>
                    <div class="card-footer d-flex justify-content-center">
                      <div class="form-group">
                          <button type="submit" class="btn btn-success">Submit</button>
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

            
          
