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
            $('#Add_Patient').modal('show');
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
                        Patient Data
                        <a href="<?php echo base_url('/patient/add_patient');?>" class="btn btn-info btn-sm float-end"
                           data-bs-toggle="modal" data-bs-target="#Add_Patient">Add Patient</a>
                     </h5>
                  </div>
                  <div class="card-body">
                     <table class="nowrap cell-border hover" id="patient-list" style="width: 100%;">
                        <?php
                              if(session()->getFlashdata('status'))
                              {
                                 ?>
                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                       <strong>
                                          <?= session()->getFlashdata('status'); ?>
                                       </strong>
                                       <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                 <?php
                              }
                        ?>
                        <thead>
                           <tr>
                              <th>Date Created</th>
                              <th>Patient ID</th>
                              <th>Patient Type</th>
                              <th>First Name</th>
                              <th>Last Name</th>
                              <th>Middle Name</th>
                              <th>Suffix</th>
                              <th>Address</th>
                              <th>Gender</th>
                              <th>Birth Date</th>
                              <th>Blood Type</th>
                              <th>Family History</th>
                              <th>Contact Number</th>
                              <th>Emergency Number</th>
                              <th>Email</th>
                              <th>Action</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php if($patient): ?>
                           <?php foreach($patient as $row): ?>
                           <tr>
                              <td>
                                 <?php echo $row['pat_Date']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_ID']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Type']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Fname']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Lname']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_MI']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Suffix']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Address']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Gender']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Bdate']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_BloodType']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_FamHistory']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_ContactNum']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_EmergencyNum']; ?>
                              </td>
                              <td>
                                 <?php echo $row['pat_Email']; ?>
                              </td>

                              <td>
                                 <a href="<?php echo base_url('patient/patient_view/'. $row['pat_ID']);?>"
                                    class="bi bi-eye-fill" style="color: green;"></a>
                                 <a data-bs-toggle="modal" data-bs-target="#Edit_Patient<?= $row['pat_ID']; ?>"
                                    class="bi bi-pencil-square"></a>
                                 <a data-bs-toggle="modal" data-bs-target="#Delete_Patient<?= $row['pat_ID']; ?>"
                                    class="bi bi-trash3-fill" style="color: red;"></a>
                              </td>
                           </tr>
                           <?php endforeach; ?>
                           <?php endif; ?>
                        </tbody>
                     </table>

                  </div>
               </div>
               <!-- Add Patient -->
               <form action="<?php echo base_url('patient/add_patient') ?>" method="post">
                  <div class="modal fade" id="Add_Patient" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                        <div class="modal-content">

                           <div class="modal-header">

                              <h5 class="modal-title" id="staticBackdropLabel">Add Patient</h5>

                              <a class="btn-close" href="<?php echo base_url('patient') ?>"></a>

                           </div>

                           <div class="modal-body">
                              <?php if(session()->getFlashdata('already_exist_error')):?>
                                    <div class="alert alert-danger"><?= session()->getFlashdata('already_exist_error'); ?></div>
                              <?php endif;?>
                              <div class="form-group">
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
                              </div><br>
                              <div class="form-group">
                                 <label for="pat_Fname" class="form-label">First Name</label>
                                 <input type="text" name="pat_Fname" class="form-control" value="<?= old('pat_Fname'); ?>">
                                 <?php if($validation_errors->getError('pat_Fname')): ?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Fname') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Lname" class="form-label">Last Name</label>
                                 <input type="text" name="pat_Lname" class="form-control" value="<?= old('pat_Lname'); ?>">
                                 <?php if($validation_errors->getError('pat_Lname')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Lname') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_MI" class="form-label">Middle Initial</label>
                                 <input type="text" name="pat_MI" class="form-control" value="<?= old('pat_MI'); ?>">
                                 <?php if($validation_errors->getError('pat_MI')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_MI') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Suffix" class="form-label">Suffix</label>
                                 <input type="text" name="pat_Suffix" class="form-control" value="<?= old('pat_Suffix'); ?>">
                                 <?php if($validation_errors->getError('pat_Suffix')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Suffix') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Address" class="form-label">Address</label>
                                 <input type="text" name="pat_Address" class="form-control" value="<?= old('pat_Address'); ?>">
                                 <?php if($validation_errors->getError('pat_Address')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Address') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
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

                              <div class="form-group">
                                 <label for="pat_Bdate" class="form-label">Birth Date</label>
                                 <input type="date" name="pat_Bdate" class="form-control" value="<?= old('pat_Bdate'); ?>">
                                 <?php if($validation_errors->getError('pat_Bdate')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Bdate') ?></div>
                                 <?php endif;?>
                              </div>

                              <div class="form-group">
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

                              <div class="form-group">
                                 <label for="pat_FamHistory" class="form-label">Family History</label>
                                 <input type="text" name="pat_FamHistory" class="form-control" value="<?= old('pat_FamHistory'); ?>">
                                 <?php if($validation_errors->getError('pat_FamHistory')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_FamHistory') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_ContactNum" class="form-label">Contact Number</label>
                                 <input type="text" name="pat_ContactNum" class="form-control" maxlength="11" value="<?= old('pat_ContactNum'); ?>">
                                 <?php if($validation_errors->getError('pat_ContactNum')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_ContactNum') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_EmergencyNum" class="form-label">Emergency Number</label>
                                 <input type="text" name="pat_EmergencyNum" class="form-control" maxlength="11" value="<?= old('pat_EmergencyNum'); ?>">
                                 <?php if($validation_errors->getError('pat_EmergencyNum')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_EmergencyNum') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Email" class="form-label">Email</label>
                                 <input type="email" name="pat_Email" class="form-control" value="<?= old('pat_Email'); ?>">
                                 <?php if($validation_errors->getError('pat_Email')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Email') ?></div>
                                 <?php endif;?>
                              </div><br>

                           </div>
                           <div class="modal-footer">
                              <div class="form-group">
                                 <button type="submit" class="btn btn-success">Save</button>
                                 <a type="button" class="btn btn-secondary"
                                    href="<?php echo base_url('patient') ?>" >Close</a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>
               </form>
               <!-- Edit Patient -->
               <?php foreach($patient as $row): ?>
               <form action="<?php echo base_url('patient/update_patient/'.$row['pat_ID']); ?>" method="post">
                  <div class="modal fade" id="Edit_Patient<?= $row['pat_ID']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                     tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                        <div class="modal-content">

                           <div class="modal-header">

                              <h5 class="modal-title" id="staticBackdropLabel">Edit patient</h5>

                              <a class="btn-close" href="<?php echo base_url('patient') ?>"></a>

                           </div>

                           <div class="modal-body">
                              <?php if(session()->getFlashdata('update_already_exist_error')):?>
                                 <div class="alert alert-danger"><?= session()->getFlashdata('update_already_exist_error'); ?></div>
                              <?php endif;?>

                              <div class="form-group">
                                 <label for="pat_Type" class="form-label">Patient Type</label>
                                 <select class="form-select" name="pat_Type">
                                    <option value="">Select Patient Type</option>
                                    <option <?php if(set_value('pat_Type') == "Applicants" || $row['pat_Type'] == "Applicants"):?>selected="selected"<?php endif;?> value="Applicants">Applicants</option>
                                    <option <?php if(set_value('pat_Type') == "Student" ||$row['pat_Type'] == "Student"):?>selected="selected"<?php endif;?> value="Student">Student</option>
                                    <option <?php if(set_value('pat_Type') == "Employee/Faculty" ||$row['pat_Type'] == "Employee/Faculty"):?>selected="selected"<?php endif;?> value="Employee/Faculty">Employee/Faculty</option>
                                 </select>
                                 <?php if($validation_errors->getError('pat_Type')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Type') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Fname" class="form-label">First Name</label>
                                 <input type="text" name="pat_Fname" class="form-control" <?php if(empty(set_value('pat_Fname'))):?>value="<?= $row['pat_Fname'] ?>"<?php else:?>value="<?= set_value('pat_Fname') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_Fname')): ?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Fname') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Lname" class="form-label">Last Name</label>
                                 <input type="text" name="pat_Lname" class="form-control" <?php if(empty(set_value('pat_Lname'))):?>value="<?= $row['pat_Lname'] ?>"<?php else:?>value="<?= set_value('pat_Lname') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_Lname')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Lname') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_MI" class="form-label">Middle Initial</label>
                                 <input type="text" name="pat_MI" class="form-control" <?php if(empty(set_value('pat_MI'))):?>value="<?= $row['pat_MI'] ?>"<?php else:?>value="<?= set_value('pat_MI') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_MI')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_MI') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Suffix" class="form-label">Suffix</label>
                                 <input type="text" name="pat_Suffix" class="form-control" <?php if(empty(set_value('pat_Suffix'))):?>value="<?= $row['pat_Suffix'] ?>"<?php else:?>value="<?= set_value('pat_Suffix') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_Suffix')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Suffix') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Address" class="form-label">Address</label>
                                 <input type="text" name="pat_Address" class="form-control" <?php if(empty(set_value('pat_Address'))):?>value="<?= $row['pat_Address'] ?>"<?php else:?>value="<?= set_value('pat_Address') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_Address')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Address') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Gender" class="form-label">Gender</label>
                                 <select class="form-select" name="pat_Gender">
                                    <option value="">Select Gender</option>
                                    <option <?php if(set_value('pat_Gender') == "Male" || $row['pat_Gender'] == "Male"):?>selected="selected"<?php endif;?> value="Male">Male</option>
                                    <option <?php if(set_value('pat_Gender') == "Female" ||$row['pat_Gender'] == "Female"):?>selected="selected"<?php endif;?> value="Female">Female</option>
                                 </select>
                                 <?php if($validation_errors->getError('pat_Gender')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Gender') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Bdate" class="form-label">Birth Date</label>
                                 <input type="date" name="pat_Bdate" class="form-control" <?php if(empty(set_value('pat_Bdate'))):?>value="<?= $row['pat_Bdate'] ?>"<?php else:?>value="<?= set_value('pat_Bdate') ?>"<?php endif;?>">
                                 <?php if($validation_errors->getError('pat_Bdate')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Bdate') ?></div>
                                 <?php endif;?>
                              </div>

                              <div class="form-group">
                                 <label for="pat_BloodType" class="form-label">Blood Type</label>
                                 <select class="form-select" name="pat_BloodType" class="form-control">
                                    <option value="">Select Blood Type</option>
                                    <option <?php if(set_value('pat_BloodType') == "O" || $row['pat_BloodType'] == "O"):?>selected="selected"<?php endif;?> value="O">O</option>
                                    <option <?php if(set_value('pat_BloodType') == "AB" || $row['pat_BloodType'] == "AB"):?>selected="selected"<?php endif;?> value="AB">AB</option>
                                    <option <?php if(set_value('pat_BloodType') == "A" || $row['pat_BloodType'] == "A"):?>selected="selected"<?php endif;?> value="A">A</option>
                                    <option <?php if(set_value('pat_BloodType') == "B" || $row['pat_BloodType'] == "B"):?>selected="selected"<?php endif;?> value="B">B</option>
                                 </select>
                                 <?php if($validation_errors->getError('pat_BloodType')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_BloodType') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_FamHistory" class="form-label">Family History</label>
                                 <input type="text" name="pat_FamHistory" class="form-control" <?php if(empty(set_value('pat_FamHistory'))):?>value="<?= $row['pat_FamHistory'] ?>"<?php else:?>value="<?= set_value('pat_FamHistory') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_FamHistory')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_FamHistory') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_ContactNum" class="form-label">Contact Number</label>
                                 <input type="text" name="pat_ContactNum" class="form-control" maxlength="11" <?php if(empty(set_value('pat_ContactNum'))):?>value="<?= $row['pat_ContactNum'] ?>"<?php else:?>value="<?= set_value('pat_ContactNum') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_ContactNum')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_ContactNum') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_EmergencyNum" class="form-label">Emergency Number</label>
                                 <input type="text" name="pat_EmergencyNum" class="form-control" maxlength="11" <?php if(empty(set_value('pat_EmergencyNum'))):?>value="<?= $row['pat_EmergencyNum'] ?>"<?php else:?>value="<?= set_value('pat_EmergencyNum') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_EmergencyNum')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_EmergencyNum') ?></div>
                                 <?php endif;?>
                              </div><br>

                              <div class="form-group">
                                 <label for="pat_Email" class="form-label">Email</label>
                                 <input type="email" name="pat_Email" class="form-control" <?php if(empty(set_value('pat_Email'))):?>value="<?= $row['pat_Email'] ?>"<?php else:?>value="<?= set_value('pat_Email') ?>"<?php endif;?>>
                                 <?php if($validation_errors->getError('pat_Email')):?>
                                    <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Email') ?></div>
                                 <?php endif;?>
                              </div><br>

                           </div>
                           <div class="modal-footer">
                              <div class="form-group">
                                 <button type="submit" class="btn btn-success">Save</button>
                                 <a type="button"  class="btn btn-secondary"
                                    href="<?php echo base_url('patient') ?>" >Close</a>
                              </div>
                           </div>

                        </div>

                     </div>

                  </div>
               </form>
               <?php endforeach; ?>
               <!-- Delete Patient -->
               <?php foreach($patient as $row): ?>
               <form action="<?php echo base_url('patient/delete_patient/'.$row['pat_ID']); ?>" method="post">
                  <div class="modal fade" id="Delete_Patient<?= $row['pat_ID']; ?>" data-bs-backdrop="static"
                     data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                     <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                        <div class="modal-content">

                           <div class="modal-header">

                              <h5 class="modal-title" id="staticBackdropLabel">Delete Patient</h5>

                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                           </div>

                           <div class="modal-body">

                              <p>Are you sure do you want to delete this patient?</p>

                           </div>
                           <div class="modal-footer">
                              <div class="form-group">
                                 <button type="submit" class="btn btn-danger">Yes</button>
                                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
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
      $('#patient-list').DataTable({
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
 document.getElementById("comboA").onchange = function(){
    var value = document.getElementById("comboA").value;
 };
</script>

<?php if(session()->getFlashdata('update_validation_errors') || session()->getFlashdata('update_already_exist_error')):?>
    <script type="text/javascript">
        $(function() {
            $('#Edit_Patient<?php echo $patient_update_error['pat_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>

<?= $this->endSection('content') ?>