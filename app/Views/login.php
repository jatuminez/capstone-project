<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container-fluid overflow-hidden">
  <div class="row overflow-auto">
    <div class="col vh-100 h-sm-100 overflow-auto">
      <div class="d-flex justify-content-center align-items-center" style="width: 100%; height: 90%;">
        <div class="card bg-light" style="width: 32rem;">
          <div class="card-header">
            <div class="text-center">
              <img src="https://www.isatu.edu.ph/wp-content/uploads/2016/07/ISAT-U-logo-shadow1.png"  height="50px" alt="">
            </div>
            <div class="text-center">
              <h5>ISATU MEDICAL CLINIC MANAGEMENT SYSTEM</h5>
            </div>
          </div>
          <div class="card-body">
          <?php if(session()->getFlashdata('msg')):?>
            <div class="alert alert-danger">
              <?= session()->getFlashdata('msg') ?>
            </div>
          <?php endif;?>

            <form action="<?php echo base_url('/login/auth') ?>" method="post">
  
              <div class="form-group">
                <label for="email" class="form-label">Email</label>
                <input type="text" name="email" value="<?= old('email') ?>" class="form-control" id="username">
              </div><br>
  
              <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
              </div><br>
  
              <div class="form-group d-flex justify-content-center">
                <button type="submit" class="btn btn-success">Login</button>
              </div>
  
            </form>
          </div>
        </div>
      </div>

      <?= $this->include('layouts/footer') ?>
    </div>


   
  </div>


</div>


<?= $this->endSection('content') ?>