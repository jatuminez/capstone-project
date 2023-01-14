<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<style>
    td {
         text-align : center;
    }
</style>

<?php if(session()->getFlashdata('validation_errors') || session()->getFlashdata('already_exist_error')):?>
    <script type="text/javascript">
        $(function() {
            $('#Add_Staff').modal('show');
        });
    </script>
<?php endif;?>

<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <?= $this->include('layouts/sidebar') ?>
        <div class="col vh-100 d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
                <div class="col pt-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Staff Data
                                <a href="<?php echo base_url('staff/add_staff');?>"
                                    class="btn btn-info btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#Add_Staff">Add Staff</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="nowrap cell-border hover" id="staff-list" style="width: 100%;">
                                <?php
                                    if(session()->getFlashdata('status'))
                                    {
                                        ?>
                                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                <strong>
                                                    <?= session()->getFlashdata('status'); ?>
                                                </strong>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        <?php
                                    }
                                ?>
                                <thead>
                                    <tr>
                                        <th>Staff ID</th>
                                        <th>Type</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Middle Name</th>
                                        <th>Suffix</th>
                                        <th>Address</th>
                                        <th>Contact Number</th>
                                        <th>Email</th>
                                        <th>Licensed Number</th>
                                        <th>Specialization</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($staff): ?>
                                    <?php foreach($staff as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['staff_ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Type']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Fname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Lname']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_MI']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Suffix']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Address']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_ContactNum']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Email']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_LicenseNum']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['staff_Specialization']; ?>
                                        </td>
                                        <td>
                                            <!-- <a href="<?php echo base_url('admin/view/'. $row['staff_ID']);?>"
                                                class="bi bi-eye-fill" style="color: green;"></a> -->
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#Edit_Staff<?= $row['staff_ID']; ?>"
                                                class="bi bi-pencil-square"></a>
                                            <a data-bs-toggle="modal"
                                                data-bs-target="#Delete_Staff<?= $row['staff_ID']; ?>"
                                                class="bi bi-trash3-fill" style="color: red;"></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>

                        </div>
                    </div><br>
                    <!-- Add Staff -->
                    <form action="<?php echo base_url('staff/add_staff') ?>" method="post">
                        <div class="modal fade modal-lg" id="Add_Staff" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Add Staff</h5>

                                        <a class="btn-close" href="<?php echo base_url('staff') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                  
                                    <?php if(session()->getFlashdata('already_exist_error')):?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('already_exist_error'); ?></div>
                                    <?php endif;?>

                                        <div class="row g-3">
                                            <div class="col-md-4">
                                                <label for="staff_Type" class="form-label">Staff Type</label>
                                                <select class="form-select" name="staff_Type">
                                                    <option  value="">
                                                        Select Type
                                                    </option>
                                                    <option <?php if(old('staff_Type') == "Doctor"):?>selected="selected"<?php endif;?> value="Doctor">Doctor</option>
                                                    <option <?php if(old('staff_Type') == "Nurse"):?>selected="selected"<?php endif;?> value="Nurse">Nurse</option>
                                                </select>
                                                <?php if($validation_errors->getError('staff_Type')): ?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Type') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Specialization" class="form-label">Specialization</label>
                                                <input type="text" name="staff_Specialization" class="form-control" value="<?= old('staff_Specialization'); ?>">
                                                <?php if($validation_errors->getError('staff_Specialization')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Specialization') ?></div>
                                                <?php endif;?>
                                            </div><br>
                                            
                                            <div class="col-md-4">
                                                <label for="staff_LicenseNum" class="form-label">Licensed Number</label>
                                                <input type="text" name="staff_LicenseNum" class="form-control" value="<?= old('staff_LicenseNum'); ?>">
                                                <?php if($validation_errors->getError('staff_LicenseNum')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_LicenseNum') ?></div>
                                                <?php endif;?>
                                            </div><br>                                           

                                            <div class="col-md-4">
                                                <label for="staff_Fname" class="form-label">First Name</label>
                                                <input type="text" name="staff_Fname" class="form-control" value="<?= old('staff_Fname'); ?>">
                                                <?php if($validation_errors->getError('staff_Fname')): ?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Fname') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Lname" class="form-label">Last Name</label>
                                                <input type="text" name="staff_Lname" class="form-control" value="<?= old('staff_Lname'); ?>">
                                                <?php if($validation_errors->getError('staff_Lname')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Lname') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col">
                                                <label for="staff_MI" class="form-label">Middle Initial</label>
                                                <input type="text" name="staff_MI" class="form-control" value="<?= old('staff_MI'); ?>">
                                                <?php if($validation_errors->getError('staff_MI')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_MI') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col">
                                                <label for="staff_Suffix" class="form-label">Suffix</label>
                                                <input type="text" name="staff_Suffix" class="form-control" value="<?= old('staff_Suffix'); ?>">
                                                <?php if($validation_errors->getError('staff_Suffix')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Suffix') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Address" class="form-label">Address</label>
                                                <input type="text" name="staff_Address" class="form-control" value="<?= old('staff_Address'); ?>">
                                                <?php if($validation_errors->getError('staff_Address')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Address') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_ContactNum" class="form-label">Contact Number</label>
                                                <input type="text" name="staff_ContactNum" class="form-control" maxlength="11" value="<?= old('staff_ContactNum'); ?>">
                                                <?php if($validation_errors->getError('staff_ContactNum')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_ContactNum') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Email" class="form-label">Email</label>
                                                <input type="email" name="staff_Email" class="form-control" value="<?= old('staff_Email'); ?>">
                                                <?php if($validation_errors->getError('staff_Email')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Email') ?></div>
                                                <?php endif;?>
                                            </div><br>
                                        </div>
                                        
                                    </div>

                                    <div class="modal-footer d-flex justify-content-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('staff') ?>" >Close</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
                    <!-- Edit Staff -->
                    <?php foreach($staff as $row): ?>
                    <form action="<?php echo base_url('staff/update_staff/'.$row['staff_ID']); ?>" method="post">
                        <div class="modal fade modal-lg" id="Edit_Staff<?= $row['staff_ID']; ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Staff</h5>

                                        <a class="btn-close" href="<?php echo base_url('staff') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <?php if(session()->getFlashdata('update_already_exist_error')):?>
                                            <div class="alert alert-danger"><?= session()->getFlashdata('update_already_exist_error'); ?></div>
                                        <?php endif;?>

                                        <div class="row g-3"> 
                                            <div class="col-md-4">
                                                <label for="staff_Type" class="form-label">Staff Type</label>
                                                <select class="form-select" name="staff_Type">
                                                    <option value="">
                                                        Select Staff Type
                                                    </option>
                                                    <option <?php if(set_value('staff_Type') == "Doctor" || $row['staff_Type'] == "Doctor"):?>selected="selected"<?php endif;?> value="Doctor">Doctor</option>
                                                    <option <?php if(set_value('staff_Type') == "Nurse" || $row['staff_Type'] == "Nurse"):?>selected="selected"<?php endif;?> value="Nurse">Nurse</option>
                                                </select>
                                                <?php if($validation_errors->getError('staff_Type')): ?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Type') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Specialization" class="form-label">Specialization</label>
                                                <input type="text" name="staff_Specialization" class="form-control" 
                                                <?php if(empty(set_value('staff_Specialization'))):?>value="<?= $row['staff_Specialization'] ?>"<?php else:?>value="<?= set_value('staff_Specialization') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_Specialization')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Specialization') ?></div>
                                                <?php endif;?>
                                            </div><br>
                                            
                                            <div class="col-md-4">
                                                <label for="staff_LicenseNum" class="form-label">Licensed Number</label>
                                                <input type="text" name="staff_LicenseNum" class="form-control"
                                                <?php if(empty(set_value('staff_LicenseNum'))):?>value="<?= $row['staff_LicenseNum'] ?>"<?php else:?>value="<?= set_value('staff_LicenseNum') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_LicenseNum')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_LicenseNum') ?></div>
                                                <?php endif;?>
                                            </div><br>
                                           
                                            <div class="col-md-4">
                                                <label for="staff_Fname" class="form-label">First Name</label>
                                                <input type="text" name="staff_Fname" class="form-control" <?php if(empty(set_value('staff_Fname'))):?>value="<?= $row['staff_Fname'] ?>"<?php else:?>value="<?= set_value('staff_Fname') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_Fname')): ?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Fname') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Lname" class="form-label">Last Name</label>
                                                <input type="text" name="staff_Lname" class="form-control" <?php if(empty(set_value('staff_Lname'))):?>value="<?= $row['staff_Lname'] ?>"<?php else:?>value="<?= set_value('staff_Lname') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_Lname')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Lname') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col">
                                                <label for="staff_MI" class="form-label">Middle Initial</label>
                                                <input type="text" name="staff_MI" class="form-control" <?php if(empty(set_value('staff_MI'))):?>value="<?= $row['staff_MI'] ?>"<?php else:?>value="<?= set_value('staff_MI') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_MI')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_MI') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col">
                                                <label for="staff_Suffix" class="form-label">Suffix</label>
                                                <input type="text" name="staff_Suffix" class="form-control" <?php if(empty(set_value('staff_Suffix'))):?>value="<?= $row['staff_Suffix'] ?>"<?php else:?>value="<?= set_value('staff_Suffix') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_Suffix')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Suffix') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Address" class="form-label">Address</label>
                                                <input type="text" name="staff_Address" class="form-control" <?php if(empty(set_value('staff_Address'))):?>value="<?= $row['staff_Address'] ?>"<?php else:?>value="<?= set_value('staff_Address') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_Address')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Address') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_ContactNum" class="form-label">Contact Number</label>
                                                <input type="text" name="staff_ContactNum" class="form-control" maxlength="11" <?php if(empty(set_value('staff_ContactNum'))):?>value="<?= $row['staff_ContactNum'] ?>"<?php else:?>value="<?= set_value('staff_ContactNum') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_ContactNum')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_ContactNum') ?></div>
                                                <?php endif;?>
                                            </div><br>

                                            <div class="col-md-4">
                                                <label for="staff_Email" class="form-label">Email</label>
                                                <input type="email" name="staff_Email" class="form-control" <?php if(empty(set_value('staff_Email'))):?>value="<?= $row['staff_Email'] ?>"<?php else:?>value="<?= set_value('staff_Email') ?>"<?php endif;?>>
                                                <?php if($validation_errors->getError('staff_Email')):?>
                                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Email') ?></div>
                                                <?php endif;?>
                                            </div><br>                                           
                                        </div>   

                                    </div>

                                    <div class="modal-footer d-flex justify-content-center">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('staff') ?>" >Close</a>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </form>
                    <?php endforeach; ?>
                    <!-- Delete Staff -->
                    <?php foreach($staff as $row): ?>
                    <form action="<?php echo base_url('staff/delete_staff/'.$row['staff_ID']); ?>" method="post">
                        <div class="modal fade" id="Delete_Staff<?= $row['staff_ID']; ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                            aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Staff</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">

                                        <p>Are you sure do you want to delete this staff?</p>

                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-danger">Yes</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">No</button>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
                    <?php endforeach; ?>
                </div>
            </main>
            <?= $this->include('layouts/footer') ?>
        </div>
        
        

    </div>
</div>

<script>
   $(document).ready(function () {
      $('#staff-list').DataTable({
         info: false,
         scrollY: '50vh',
         scrollX: true,
         scrollCollapse: true,

         dom: 'Bfrtip',
         buttons: [
            {
               extend: 'collection',
               text: 'Generate Reports',
               buttons: [

                  {

                     extend: 'print',
                     exportOptions: {
                        columns: ':visible'
                     },
                     customize: function (win) {
                        $(win.document.body).find('h1')
                           .css('text-align', 'center')
                           .css('font-size', '1.5rem');
                     }

                  },
                  'colvis'

               ],
               columnDefs: [{
                  targets: -1,
                  visible: false
               }
               ]
            }
         ]
      });
      // $('#searchbox').keyup(function () {
      //    table.search(this.value).draw();
      // });
      

   });
</script>
<script>
    function staffPassword() {
        var x = document.getElementById("staff_Password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
<?php if(session()->getFlashdata('update_validation_errors') || session()->getFlashdata('update_already_exist_error')):?>
    <script type="text/javascript">
        $(function() {
            $('#Edit_Staff<?php echo $staff_update_error['staff_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>

<?= $this->endSection('content') ?>