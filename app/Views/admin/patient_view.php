<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<style>

  .print {
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 2px;
    font-size: .88em;
    color: black;
    background-color: rgba(0, 0, 0, 0.1);
    background: linear-gradient(to bottom, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
  }

  td {
    text-align : center;
  }

  textarea {
    resize: none;
  }

  @media print {
    #print {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      align-items: center;
    }
  }
</style>
<?php if(session()->getFlashdata('validation_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Add_Consultation').modal('show');
        });
    </script>
<?php endif;?>

<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <?= $this->include('layouts/sidebar') ?>
        <div class="col vh-100  d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
              <div class="col pt-4">   
                <div class="info" id="print">
                  <div class="card bg-light">

                    <div class="card-header">
                      <h5>
                        Patient Details
                        <button class="print btn btn-info btn-sm float-end" onclick="printDiv('print','Title')">Print</button>
                      </h5>
                    </div>
                    <div class="card-body">
                      <form action="">
                        <div class="row g-3">
                          <div class="row gy-2 gx-3">
                            <div class="col-md-3">
                              <label for="pat_ID" class="form-label">Patient ID</label>
                              <input type="text" name="pat_ID" class="form-control" readonly value="<?= $patient['pat_ID']; ?>">
                            </div><br>

                            <div class="col-md-3">
                              <label for="pat_Type" class="form-label">Patient Type</label>
                              <input type="text" name="pat_Type" class="form-control" readonly value="<?= $patient['pat_Type']; ?>">
                            </div><br>
                          </div>

                          <div class="col-md-4">
                            <label for="pat_Fname" class="form-label">First Name</label>
                            <input type="text" name="fname" readonly value="<?= $patient['pat_Fname']; ?>" class="form-control bg-white" id="name"
                              readonly >
                          </div><br>

                          <div class="col-md-4">
                            <label for="pat_Lname" class="form-label">Last Name</label>
                            <input type="text" name="lname" readonly value="<?= $patient['pat_Lname']; ?>" class="form-control bg-white" id="name"
                              readonly>
                          </div><br>

                          <div class="col">
                            <label for="pat_MI" class="form-label">Middle Initial</label>
                            <input type="text" name="pat_MI" readonly value="<?= $patient['pat_MI']; ?>" class="form-control bg-white" id="name"
                              readonly>
                          </div><br>

                          <div class="col">
                            <label for="pat_Suffix" class="form-label">Suffix</label>
                            <input type="text" name="pat_Suffix" class="form-control" readonly value="<?= $patient['pat_Suffix']; ?>">
                          </div><br>

                          <div class="col-md-4">
                            <label for="pat_Address" class="form-label">Address</label>
                            <input type="text" name="pat_Address" class="form-control" readonly value="<?= $patient['pat_Address']; ?>">
                          </div><br>

                          <div class="col">
                            <label for="pat_Bdate" class="form-label">Birth Date</label>
                            <input type="date" name="pat_Bdate" class="form-control" readonly value="<?= $patient['pat_Bdate']; ?>">
                          </div><br>

                          <div class="col">
                            <label for="pat_Gender" class="form-label">Gender</label>
                            <input type="text" name="pat_Gender" class="form-control" readonly value="<?= $patient['pat_Gender']; ?>">
                          </div><br>

                          <div class="col">
                            <label for="pat_BloodType" class="form-label">Blood Type</label>
                            <input type="text" name="pat_BloodType" class="form-control" readonly value="<?= $patient['pat_BloodType']; ?>">
                          </div><br>
                          
                          <div class="row gy-2 gx-3">
                            <div class="col-md-4">
                              <label for="pat_ContactNum" class="form-label">Contact Number</label>
                              <input type="text" name="pat_ContactNum" class="form-control" maxlength="11" readonly value="<?= $patient['pat_ContactNum']; ?>">
                            </div><br>

                            <div class="col-md-4">
                              <label for="pat_EmergencyNum" class="form-label">Emergency Number</label>
                              <input type="text" name="pat_EmergencyNum" class="form-control" maxlength="11" readonly value="<?= $patient['pat_EmergencyNum']; ?>">
                            </div><br>

                            <div class="col-md-4">
                              <label for="pat_Email" class="form-label">Email</label>
                              <input type="email" name="pat_Email" class="form-control" readonly value="<?= $patient['pat_Email']; ?>">
                            </div><br>
                          </div>

                          <div class="col-md">
                            <label for="pat_FamHistory" class="form-label">Family History</label>
                            <textarea rows="3" name="pat_FamHistory" class="form-control" readonly><?= $patient['pat_FamHistory']; ?></textarea>
                          </div><br>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="info mt-4" id="print2">
                  <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="cons">
                          Consultation
                        </h5>
                        <a href="<?php echo base_url('/patient/add_patient');?>" class="btn btn-info btn-sm"
                              data-bs-toggle="modal" data-bs-target="#Add_Consultation">Add Consultation</a>
                    </div>
                    <div class="card-body">
                        <table class="nowrap cell-border hover" id="consultation-list" style="width: 100%;">
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
                                <th>Staff Name</th>
                                <th>App No</th>
                                <th>Date</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Middle Initial</th>
                                <th>Suffix</th>
                                <th>Vital Signs</th>
                                <th>Assessment</th>
                                <th>Medicine</th>
                                <th>Dosage</th>
                                <th>Action</th>
                              </tr>
                          </thead>
                          <tbody>
                              <?php if($consultation): ?>
                              <?php foreach($consultation as $row): ?>
                              <tr>
                                <td>
                                    <?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>
                                </td>
                                <td>
                                    <?php echo $row['app_ID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['con_Date']; ?>
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
                                    <?php echo $row['con_VitalSigns']; ?>
                                </td>
                                <td>
                                    <?php echo $row['con_Assessment']; ?>
                                </td>
                                <td>
                                    <?php echo $row['dis_ID']; ?>
                                </td>
                                <td>
                                    <?php echo $row['con_MedDose']; ?>
                                </td>
                                
                                <td>
                                    <a href="<?php echo base_url('patient/consultation/'. $row['pat_ID']);?>"
                                      class="bi bi-eye-fill" style="color: green;"></a>
                                    <a data-bs-toggle="modal" data-bs-target="#Edit_Consultation<?= $row['con_ID']; ?>"
                                      class="bi bi-pencil-square"></a>
                                    <a data-bs-toggle="modal" data-bs-target="#Delete_Consultation<?= $row['con_ID']; ?>"
                                      class="bi bi-trash3-fill" style="color: red;"></a>
                                </td>
                              </tr>
                              <?php endforeach; ?>
                              <?php endif; ?>
                          </tbody>
                        </table>

                    </div>
                  </div>

                  <!-- Add consultation -->
                  <form action="<?php echo base_url('patient/add_consultation') ?>" method="post">
                    <div class="modal fade modal-lg" id="Add_Consultation" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                          <div class="modal-content">

                              <div class="modal-header">

                                <h5 class="modal-title" id="staticBackdropLabel">Add Prescription</h5>

                                <a class="btn-close" href="<?php echo base_url('patient/patient_view/'.$patient['pat_ID']) ?>"></a>

                              </div>

                              <div class="modal-body">
                                <?php if(session()->getFlashdata('already_exist_error')):?>
                                      <div class="alert alert-danger"><?= session()->getFlashdata('already_exist_error'); ?></div>
                                <?php endif;?>
                                <div class="row g-3">
                                  <div class="row gy-2 gx-3">
                                    <input type="text" name="pat_ID" value="<?=$patient['pat_ID'];?>" class="form-control bg-white" hidden>
                                    <?php if(!empty($dispense['dis_ID'])): ?><input type="text" name="dis_ID" value="<?=$dispense['dis_ID'];?>" class="form-control bg-white" hidden><?php endif;?>
                                    <div class="col">
                                      <label for="staff_Name" class="form-label">Staff Name</label>
                                          <select id="staff_Name" name="staff_Name" class="selectpicker" data-width="100%" data-live-search="true" title="Select Staff">
                                              <?php if($staff): ?>
                                              <?php foreach($staff as $row): ?>
                                                  <option <?php if(old('staff_Name') == $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>">
                                                      <?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>
                                                  </option>
                                              <?php endforeach; ?>
                                              <?php endif; ?>
                                          </select>     
                                      <?php if($validation_errors->getError('staff_Name')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Name') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="app_ID" class="form-label">App No</label>
                                      <input type="text" name="app_ID" value="<?= old('app_ID'); ?>" class="form-control bg-white" id="name">
                                      <?php if($validation_errors->getError('app_ID')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_ID') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="con_Date" class="form-label">Date</label>
                                      <input type="date" name="con_Date" value="<?= old('con_Date'); ?>" class="form-control bg-white" id="name">
                                      <?php if($validation_errors->getError('con_Date')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_Date') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                  </div>
                                  
                                  <div class="row gy-2 gx-3">
                                    <div class="col-md-4">
                                      <label for="pat_Fname" class="form-label">First Name</label>
                                      <input type="text" name="pat_Fname" class="form-control" value="<?= $patient['pat_Fname']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_Fname')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Fname') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col-md-4">
                                      <label for="pat_Lname" class="form-label">Last Name</label>
                                      <input type="text" name="pat_Lname" class="form-control" value="<?= $patient['pat_Lname']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_Lname')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Lname') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="pat_MI" class="form-label">Middle Initial</label>
                                      <input type="text" name="pat_MI" class="form-control" value="<?= $patient['pat_MI']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_MI')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_MI') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="pat_Suffix" class="form-label">Suffix</label>
                                      <input type="text" name="pat_Suffix" class="form-control" value="<?= $patient['pat_Suffix']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_Suffix')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Suffix') ?></div>
                                      <?php endif;?>
                                    </div><br>
                                  </div>

                                  <div class="col">
                                    <label for="con_VitalSigns" class="form-label">Vital Signs</label>
                                    <textarea rows="3" name="con_VitalSigns" class="form-control"><?= old('con_VitalSigns'); ?></textarea>
                                    <?php if($validation_errors->getError('con_VitalSigns')):?>
                                      <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_VitalSigns') ?></div>
                                    <?php endif;?>
                                  </div><br>

                                  <div class="col">
                                    <label for="con_Assessment" class="form-label">Assessment</label>
                                    <textarea rows="3" name="con_Assessment" class="form-control"><?= old('con_Assessment'); ?></textarea>
                                    <?php if($validation_errors->getError('con_Assessment')):?>
                                      <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_Assessment') ?></div>
                                    <?php endif;?>
                                  </div><br>

                                  <div class="col-md-4">
                                    <label for="con_Med" class="form-label">Medicine</label>
                                    <textarea rows="3" name="med_ID" class="form-control" <?php if(!empty($dispense['dis_ID'])): ?>readonly>Name: <?= $cons_data['med_Name']; ?>&#13;&#10;Quantity: <?= $cons_data['dis_Num']; ?><?php else:?>>Name: &#13;&#10;Quantity: <?php endif;?></textarea>
                                  </div><br>

                                  <div class="col">
                                    <label for="con_MedDose" class="form-label">Dosage</label>
                                    <textarea rows="3" name="con_MedDose" class="form-control"><?= old('con_MedDose'); ?></textarea>
                                    <?php if($validation_errors->getError('con_MedDose')):?>
                                      <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_MedDose') ?></div>
                                    <?php endif;?>
                                  </div><br>
                          
                                </div>   

                              </div>

                              <div class="modal-footer d-flex justify-content-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a type="button" class="btn btn-secondary"
                                      href="<?php echo base_url('patient/patient_view/'.$patient['pat_ID']) ?>" >Close</a>
                                </div>
                              </div>
                                      
                          </div>

                        </div>

                    </div>
                  </form>

                  <!-- Edit consultation -->
                  <?php foreach($consultation as $row): ?>
                  <form action="<?php echo base_url('patient/edit_consultation/'.$row['con_ID']); ?>" method="post">
                    <div class="modal fade modal-lg" id="Edit_Consultation<?= $row['con_ID']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                          <div class="modal-content">

                              <div class="modal-header">

                                <h5 class="modal-title" id="staticBackdropLabel">Add Prescription</h5>

                                <a class="btn-close" href="<?php echo base_url('patient/patient_view/'.$patient['pat_ID']) ?>"></a>

                              </div>

                              <div class="modal-body">
                                <?php if(session()->getFlashdata('already_exist_error')):?>
                                      <div class="alert alert-danger"><?= session()->getFlashdata('already_exist_error'); ?></div>
                                <?php endif;?>
                                <div class="row g-3">
                                  <div class="row gy-2 gx-3">
                                    <input type="text" name="pat_ID" value="<?=$patient['pat_ID'];?>" class="form-control bg-white" hidden>
                                    <?php if(!empty($dispense['dis_ID'])): ?><input type="text" name="dis_ID" value="<?=$dispense['dis_ID'];?>" class="form-control bg-white" hidden><?php endif;?>
                                    <div class="col">
                                      <label for="staff_Name" class="form-label">Staff Name</label>
                                          <select id="staff_Name" name="staff_Name" class="selectpicker" data-width="100%" data-live-search="true" title="Select Staff">
                                              <?php if($staff): ?>
                                              <?php foreach($staff as $row1): ?>
                                                  <option <?php if(set_value('staff_Name') == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname'] || $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname'] == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>">
                                                      <?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>
                                                  </option>
                                              <?php endforeach; ?>
                                              <?php endif; ?>
                                          </select>     
                                      <?php if($validation_errors->getError('staff_Name')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('staff_Name') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="app_ID" class="form-label">App No</label>
                                      <input type="text" name="app_ID" <?php if(empty(set_value('app_ID'))):?>value="<?= $row['app_ID'] ?>"<?php else:?>value="<?= set_value('app_ID') ?>"<?php endif;?> class="form-control">
                                      <?php if($validation_errors->getError('app_ID')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_ID') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="con_Date" class="form-label">Date</label>
                                      <input type="date" name="con_Date" <?php if(empty(set_value('con_Date'))):?>value="<?= $row['con_Date'] ?>"<?php else:?>value="<?= set_value('con_Date') ?>"<?php endif;?> class="form-control">
                                      <?php if($validation_errors->getError('con_Date')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_Date') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                  </div>
                                  
                                  <div class="row gy-2 gx-3">
                                    <div class="col-md-4">
                                      <label for="pat_Fname" class="form-label">First Name</label>
                                      <input type="text" name="pat_Fname" class="form-control" value="<?= $patient['pat_Fname']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_Fname')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Fname') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col-md-4">
                                      <label for="pat_Lname" class="form-label">Last Name</label>
                                      <input type="text" name="pat_Lname" class="form-control" value="<?= $patient['pat_Lname']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_Lname')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Lname') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="pat_MI" class="form-label">Middle Initial</label>
                                      <input type="text" name="pat_MI" class="form-control" value="<?= $patient['pat_MI']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_MI')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_MI') ?></div>
                                      <?php endif;?>
                                    </div><br>

                                    <div class="col">
                                      <label for="pat_Suffix" class="form-label">Suffix</label>
                                      <input type="text" name="pat_Suffix" class="form-control" value="<?= $patient['pat_Suffix']; ?>" readonly>
                                      <?php if($validation_errors->getError('pat_Suffix')):?>
                                        <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Suffix') ?></div>
                                      <?php endif;?>
                                    </div><br>
                                  </div>

                                  <div class="col">
                                    <label for="con_VitalSigns" class="form-label">Vital Signs</label>
                                    <textarea rows="3" name="con_VitalSigns" class="form-control"><?php if(empty(set_value('con_VitalSigns'))):?><?= $row['con_VitalSigns'] ?><?php else:?><?= set_value('con_VitalSigns') ?><?php endif;?></textarea>
                                    <?php if($validation_errors->getError('con_VitalSigns')):?>
                                      <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_VitalSigns') ?></div>
                                    <?php endif;?>
                                  </div><br>

                                  <div class="col">
                                    <label for="con_Assessment" class="form-label">Assessment</label>
                                    <textarea rows="3" name="con_Assessment" class="form-control"><?php if(empty(set_value('con_Assessment'))):?><?= $row['con_Assessment'] ?><?php else:?><?= set_value('con_Assessment') ?><?php endif;?></textarea>
                                    <?php if($validation_errors->getError('con_Assessment')):?>
                                      <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_Assessment') ?></div>
                                    <?php endif;?>
                                  </div><br>

                                  <div class="col-md-4">
                                    <label for="con_Med" class="form-label">Medicine</label>
                                    <textarea rows="3" name="med_ID" class="form-control" <?php if(!empty($dispense['dis_ID'])): ?>readonly>Name: <?= $cons_data['med_Name']; ?>&#13;&#10;Quantity: <?= $cons_data['dis_Num']; ?><?php else:?>>Name: &#13;&#10;Quantity: <?php endif;?></textarea>
                                  </div><br>

                                  <div class="col">
                                    <label for="con_MedDose" class="form-label">Dosage</label>
                                    <textarea rows="3" name="con_MedDose" class="form-control"><?php if(empty(set_value('con_MedDose'))):?><?= $row['con_MedDose'] ?><?php else:?><?= set_value('con_MedDose') ?><?php endif;?></textarea>
                                    <?php if($validation_errors->getError('con_MedDose')):?>
                                      <div class="alert alert-danger mt-2"><?= $validation_errors->getError('con_MedDose') ?></div>
                                    <?php endif;?>
                                  </div><br>
                          
                                </div>   

                              </div>

                              <div class="modal-footer d-flex justify-content-center">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Save</button>
                                    <a type="button" class="btn btn-secondary"
                                      href="<?php echo base_url('patient/patient_view/'.$patient['pat_ID']) ?>" >Close</a>
                                </div>
                              </div>
                                      
                          </div>

                        </div>

                    </div>
                  </form>
                  <?php endforeach; ?>

                  <!-- Delete Consultation -->
                    <?php foreach($consultation as $row): ?>
                    <form action="<?php echo base_url('patient/delete_consultation/'.$row['con_ID']); ?>" method="post">
                      <div class="modal fade" id="Delete_Consultation<?= $row['con_ID']; ?>" data-bs-backdrop="static"
                          data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                          <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                            <div class="modal-content">

                                <div class="modal-header">

                                  <h5 class="modal-title" id="staticBackdropLabel">Delete Consultation</h5>

                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                                </div>

                                <div class="modal-body">

                                  <p>Are you sure do you want to delete this consultation?</p>

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

                </div><br>
              </div>
            </main>
            <?= $this->include('layouts/footer') ?>
        </div>
    </div>
</div>
<script>
  var doc = new jsPDF();

  function saveDiv(divId, title) {
    doc.fromHTML(`<html><head><title>${title}</title></head><body>` + document.getElementById(divId).innerHTML + `</body></html>`);
    doc.save('div.pdf');
  }

  function printDiv(divId,
    title) {

    let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');

    mywindow.document.write('<html><head><title>' + document.title + '</title>');
    mywindow.document.write('</head><body>');
    mywindow.document.write('<h1 style="text-align: center; font-size: 1.5rem;">' + document.title + '</h1><div class="container-fluid mt-4" style="display: flex; flex-direction: column; flex-wrap: wrap; align-items: center;">');
    mywindow.document.write(document.getElementById(divId).innerHTML);
    mywindow.document.write('</div></body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();
    s
    return true;
  }
</script>
<script>
   $(document).ready(function () {
      $('#consultation-list').DataTable({
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
                     title: $('.cons').text(),
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
<?= $this->endSection('content') ?>



