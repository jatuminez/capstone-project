<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    <?php echo $title ?>
  </title>
  <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/bootstrap-select/css/bootstrap-select.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css"> 

  <!-- Custom styles for this template -->
  <link rel="stylesheet" href="/sidebars.css">
  <link rel="stylesheet" href="/column.css">
</head>

<body>

<!-- Update Account -->
    <?php $validation = \Config\Services::validation();?>
     <form action="<?php echo base_url('login/update_account') ?>" method="post">
       <div class="modal fade" id="Update_Account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="false">
   
         <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
   
           <div class="modal-content">
   
             <div class="modal-header">
   
               <h5 class="modal-title" id="staticBackdropLabel">Change Password</h5>
   
               <a type="button" class="btn-close" href="" aria-label="Close"></a>
   
             </div>
   
             <div class="modal-body">
               
               <?php if(session()->getFlashdata('wpass')):?>
                  <div class="alert alert-danger mt-2">       
                    <?= session()->getFlashdata('wpass'); ?>
                  </div>
                <?php endif;?>
   
                <div class="form-group">
                  <label for="oldpassword" class="form-label">Old Password</label>
                  <input type="password" name="oldpassword" class="form-control">
                  <?php if($validation->getError('oldpassword')):?>
                    <div class="alert alert-danger mt-2">
                      <?= session()->getFlashdata('update_account_validation_errors')->getError('oldpassword') ?>
                    </div>
                  <?php endif;?>
               </div><br>

               <div class="form-group">
                  <label for="newpassword" class="form-label">New Password</label>
                  <input type="text" name="newpassword" class="form-control" value="<?= old('newpassword'); ?>">
                  <?php if($validation->getError('newpassword')):?>
                    <div class="alert alert-danger mt-2">
                      <?= session()->getFlashdata('update_account_validation_errors')->getError('newpassword') ?>
                    </div>
                  <?php endif;?>
               </div><br>
   
               <div class="form-group">
                  <label for="confpassword" class="form-label">Confirm Password</label>
                  <input type="password" name="confpassword" class="form-control">
                  <?php if($validation->getError('confpassword')):?>
                    <div class="alert alert-danger mt-2">
                      <?= session()->getFlashdata('update_account_validation_errors')->getError('confpassword') ?>
                    </div>
                  <?php endif;?>
               </div><br>
   
             </div>
   
             <div class="modal-footer">
               <div class="form-group">
                 <button type="submit" class="btn btn-success">Save</button>
                 <a type="button" class="btn btn-secondary" href="">Close</a>
               </div>
             </div>
   
           </div>
   
         </div>
   
       </div>
     </form>

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/dselect.js"></script>
  <script src="/bootstrap-select/js/bootstrap-select.min.js"></script>
  <?= $this->renderSection('content') ?>
</body>

</html>