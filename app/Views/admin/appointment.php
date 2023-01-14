<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<style>
    td {
         text-align : center;
    }
</style>
<?php if(session()->getFlashdata('validation_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Add_Appointment').modal('show');
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
                                Appointment Data
                                <a href="<?php echo base_url('/appointment/add_appointment');?>"
                                    class="btn btn-info btn-sm float-end" data-bs-toggle="modal"
                                    data-bs-target="#Add_Appointment">Add Appointment</a>
                            </h5>
                        </div>
                        <div class="card-body">
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
                            <!-- Pending Appointment Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                         Pending
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="nowrap cell-border hover" id="pending-list" style="width: 100%;">
                                        <?php
                                            if(session()->getFlashdata('pending_status'))
                                            {
                                                ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>
                                                            <?= session()->getFlashdata('pending_status'); ?>
                                                        </strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Appointment ID</th>
                                                <th>Type</th>
                                                <th>Patient Name</th>
                                                <th>Doctor</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Complain</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($appointment_pending): ?>
                                            <?php foreach($appointment_pending as $row): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['app_ID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['app_Type']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['pat_Fname']." ".$row['pat_MI']." ".$row['pat_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['app_Date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['app_Time']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['app_Complain']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['app_Status']; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Send_Notification<?= $row['app_ID']; ?>"
                                                        class="bi bi-envelope-fill" style="color: gold;"></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Edit_Appointment<?= $row['app_ID']; ?>"
                                                        class="bi bi-pencil-square"></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Delete_Appointment<?= $row['app_ID']; ?>"
                                                        class="bi bi-trash3-fill" style="color: red;"></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div><br>
                            <!-- Completed Appointment Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        Completed
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="nowrap cell-border hover" id="completed-list" style="width: 100%;">
                                        <?php
                                            if(session()->getFlashdata('completed_status'))
                                            {
                                                ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>
                                                            <?= session()->getFlashdata('completed_status'); ?>
                                                        </strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Appointment ID</th>
                                                <th>Type</th>
                                                <th>Patient Name</th>
                                                <th>Doctor</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Complain</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($appointment_completed): ?>
                                            <?php foreach($appointment_completed as $row2): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row2['app_ID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['app_Type']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['pat_Fname']." ".$row2['pat_MI']." ".$row2['pat_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['staff_Fname']." ".$row2['staff_MI']." ".$row2['staff_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['app_Date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['app_Time']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['app_Complain']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['app_Status']; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Send_Notification<?= $row2['app_ID']; ?>"
                                                        class="bi bi-envelope-fill" style="color: gold;"></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Edit_Appointment<?= $row2['app_ID']; ?>"
                                                        class="bi bi-pencil-square"></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Delete_Appointment<?= $row2['app_ID']; ?>"
                                                        class="bi bi-trash3-fill" style="color: red;"></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div><br>
                            <!-- Cancelled Appointment Table -->
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        Cancelled
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="nowrap cell-border hover" id="cancelled-list" style="width: 100%;">
                                        <?php
                                            if(session()->getFlashdata('cancelled_status'))
                                            {
                                                ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>
                                                            <?= session()->getFlashdata('cancelled_status'); ?>
                                                        </strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                        <thead>
                                            <tr>
                                                <th>Appointment ID</th>
                                                <th>Type</th>
                                                <th>Patient Name</th>
                                                <th>Doctor</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                                <th>Complain</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($appointment_cancelled): ?>
                                            <?php foreach($appointment_cancelled as $row3): ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row3['app_ID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['app_Type']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['pat_Fname']." ".$row3['pat_MI']." ".$row3['pat_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['staff_Fname']." ".$row3['staff_MI']." ".$row3['staff_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['app_Date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['app_Time']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['app_Complain']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row3['app_Status']; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Send_Notification<?= $row3['app_ID']; ?>"
                                                        class="bi bi-envelope-fill" style="color: gold;"></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Edit_Appointment<?= $row3['app_ID']; ?>"
                                                        class="bi bi-pencil-square"></a>
                                                    <a data-bs-toggle="modal"
                                                        data-bs-target="#Delete_Appointment<?= $row3['app_ID']; ?>"
                                                        class="bi bi-trash3-fill" style="color: red;"></a>
                                                </td>
                                            </tr>
                                            <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                        </div>
                    </div><br>
                    <!-- Add Appointment -->
                    <form action="<?php echo base_url('appointment/add_appointment') ?>" method="post">
                        <div class="modal fade" id="Add_Appointment" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Add Appointment</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="app_Type" class="form-label">Type</label>
                                            <select class="form-select" name="app_Type">
                                                <option value="">Select Type</option>
                                                <option <?php if(old('app_Type') == "Urgent"):?>selected="selected"<?php endif;?>>Urgent</option>                                                 
                                                <option <?php if(old('app_Type') == "Not Urgent"):?>selected="selected"<?php endif;?>>Not Urgent</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Type')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Type') ?></div>
                                            <?php endif;?>
                                        </div><br>
            
                                        <div class="form-group">
                                            <label for="app_patient" class="form-label">Patient</label>
                                            <select id="app_patient" name="app_patient" class="selectpicker" data-width="100%" data-live-search="true" title="Select Patient">
                                                 <?php if($patient): ?>
                                                <?php foreach($patient as $row): ?>
                                                    <option <?php if(old('app_patient') == $row['pat_Fname']." ".$row['pat_MI']." ".$row['pat_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row['pat_Fname']." ".$row['pat_MI']." ".$row['pat_Lname']; ?>">
                                                        <?php echo $row['pat_Fname']." ".$row['pat_MI']." ".$row['pat_Lname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>                                                
                                            <?php if($validation_errors->getError('app_patient')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_patient') ?></div>
                                            <?php endif;?>
                                        </div><br>

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

                                        <div class="form-group">
                                            <label for="app_Status" class="form-label">Status</label>
                                            <select class="form-select" name="app_Status">
                                                <option value="">Select Status</option>
                                                <option <?php if(old('app_Status') == "Pending"):?>selected="selected"<?php endif;?>>Pending</option>                                                 
                                                <option <?php if(old('app_Status') == "Completed"):?>selected="selected"<?php endif;?>>Completed</option>
                                                <option <?php if(old('app_Status') == "Cancelled"):?>selected="selected"<?php endif;?>>Cancelled</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Status')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Status') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button" class="btn btn-secondary" 
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>
                    <!-- Edit Pending Appointment -->
                    <?php foreach($appointment_pending as $row): ?>
                        <form action="<?php echo base_url('appointment/update_appointment_pending/'.$row['app_ID']); ?>" method="post">
                            <div class="modal fade" id="Edit_Appointment<?= $row['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Appointment</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="app_Type" class="form-label">Type</label>
                                            <select class="form-select" name="app_Type">
                                                <option value="">Select Type</option>
                                                <option <?php if(set_value('app_Type') == "Urgent" || $row['app_Type'] == "Urgent"):?>selected="selected"<?php endif;?>>Urgent</option>                                                 
                                                <option <?php if(set_value('app_Type') == "Not Urgent" || $row['app_Type'] == "Urgent"):?>selected="selected"<?php endif;?>>Not Urgent</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Type')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Type') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_patient" class="form-label">Patient</label>
                                            <select id="app_patient" name="app_patient" class="selectpicker" data-width="100%" data-live-search="true" title="Select Patient">
                                                <?php if($patient): ?>
                                               <?php foreach($patient as $row1): ?>
                                                    <option <?php if(set_value('app_patient') == $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname'] || $row['pat_Fname']." ".$row['pat_MI']." ".$row['pat_Lname'] == $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']; ?>">
                                                        <?php echo $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']; ?>
                                                    </option>
                                                <?php endforeach; ?>>
                                                <?php endif; ?>
                                            </select>                                                
                                            <?php if($validation_errors->getError('app_patient')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_patient') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_doctor" class="form-label">Doctor</label>
                                            <select id="app_doctor" name="app_doctor" class="selectpicker" data-width="100%" data-live-search="true" title="Select Patient">
                                                <?php if($staff): ?>
                                                <?php foreach($staff as $row1): ?>
                                                    <option <?php if(set_value('app_doctor') == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname'] || $row['staff_Fname']." ".$row['staff_MI']." ".$row['staff_Lname'] == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>">
                                                        <?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>
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
                                            <input type="date" name="app_Date" class="form-control" <?php if(empty(set_value('app_Date'))):?>value="<?= $row['app_Date'] ?>"<?php else:?>value="<?= set_value('app_Date') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('app_Date')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Date') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_Time" class="form-label">Time</label>
                                            <input type="time" name="app_Time" class="form-control" <?php if(empty(set_value('app_Time'))):?>value="<?= $row['app_Time'] ?>"<?php else:?>value="<?= set_value('app_Time') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('app_Time')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Time') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_Complain" class="form-label">Complain</label>
                                            <textarea rows="3" name="app_Complain" class="form-control"><?php if(empty(set_value('app_Complain'))):?><?= $row['app_Complain'] ?><?php else:?><?= set_value('app_Complain') ?><?php endif;?></textarea>
                                            <?php if($validation_errors->getError('app_Complain')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Complain') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="app_Status" class="form-label">Status</label>
                                            <select class="form-select" name="app_Status">
                                                <option value="<?php echo $row['app_Status']; ?>">
                                                    <?php echo $row['app_Status']; ?>
                                                </option>
                                                <option value="Pending">Pending</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Status')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Status') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    <?php endforeach; ?>
                    <!-- Edit Completed Appointment -->
                    <?php foreach($appointment_completed as $row2): ?>
                        <form action="<?php echo base_url('appointment/update_appointment_completed/'.$row2['app_ID']); ?>" method="post">
                            <div class="modal fade" id="Edit_Appointment<?= $row2['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Appointment</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="app_Type" class="form-label">Type</label>
                                            <select class="form-select" name="app_Type">
                                                <option value="">Select Type</option>
                                                <option <?php if(set_value('app_Type') == "Urgent" || $row2['app_Type'] == "Urgent"):?>selected="selected"<?php endif;?>>Urgent</option>                                                 
                                                <option <?php if(set_value('app_Type') == "Not Urgent" || $row2['app_Type'] == "Urgent"):?>selected="selected"<?php endif;?>>Not Urgent</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Type')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Type') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_patient" class="form-label">Patient</label>
                                            <select class="form-select" name="app_patient">                                                                              
                                                <?php if($patient): ?>
                                                <?php foreach($patient as $row1): ?>
                                                    <option <?php if(set_value('app_patient') == $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname'] || $row2['pat_Fname']." ".$row2['pat_MI']." ".$row2['pat_Lname'] == $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']; ?>">
                                                        <?php echo $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if($validation_errors->getError('app_patient')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_patient') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_doctor" class="form-label">Doctor</label>
                                            <select class="form-select" name="app_doctor">                                                                                              
                                                <?php if($staff): ?>
                                                <?php foreach($staff as $row1): ?>
                                                    <option <?php if(set_value('app_doctor') == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname'] || $row2['staff_Fname']." ".$row2['staff_MI']." ".$row2['staff_Lname'] == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>">
                                                        <?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>
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
                                            <input type="date" name="app_Date" class="form-control" <?php if(empty(set_value('app_Date'))):?>value="<?= $row2['app_Date'] ?>"<?php else:?>value="<?= set_value('app_Date') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('app_Date')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Date') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="app_Time" class="form-label">Time</label>
                                            <input type="time" name="app_Time" class="form-control" <?php if(empty(set_value('app_Time'))):?>value="<?= $row2['app_Time'] ?>"<?php else:?>value="<?= set_value('app_Time') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('app_Time')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Time') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_Complain" class="form-label">Complain</label>
                                            <textarea rows="3" name="app_Complain" class="form-control"><?php if(empty(set_value('app_Complain'))):?><?= $row2['app_Complain'] ?><?php else:?><?= set_value('app_Complain') ?><?php endif;?></textarea>
                                            <?php if($validation_errors->getError('app_Complain')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Complain') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_Status" class="form-label">Status</label>
                                            <select class="form-select" name="app_Status">
                                                <option value="<?php echo $row2['app_Status']; ?>">
                                                    <?php echo $row2['app_Status']; ?>
                                                </option>
                                                <option value="Pending">Pending</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Status')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Status') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    <?php endforeach; ?>
                    <!-- Edit Cancelled Appointment -->
                    <?php foreach($appointment_cancelled as $row3): ?>
                        <form action="<?php echo base_url('appointment/update_appointment_cancelled/'.$row3['app_ID']); ?>" method="post">
                            <div class="modal fade" id="Edit_Appointment<?= $row3['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Appointment</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="app_Type" class="form-label">Type</label>
                                            <select class="form-select" name="app_Type">
                                                <option value="">Select Type</option>
                                                <option <?php if(set_value('app_Type') == "Urgent" || $row3['app_Type'] == "Urgent"):?>selected="selected"<?php endif;?>>Urgent</option>                                                 
                                                <option <?php if(set_value('app_Type') == "Not Urgent" || $row3['app_Type'] == "Urgent"):?>selected="selected"<?php endif;?>>Not Urgent</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Type')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Type') ?></div>
                                            <?php endif;?>
                                        </div><br>                                                                        

                                        <div class="form-group">
                                            <label for="app_patient" class="form-label">Patient</label>
                                            <select class="form-select" name="app_patient">                                                                              
                                                <?php if($patient): ?>
                                                <?php foreach($patient as $row1): ?>
                                                    <option <?php if(set_value('app_patient') == $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname'] || $row3['pat_Fname']." ".$row3['pat_MI']." ".$row3['pat_Lname'] == $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']; ?>">
                                                        <?php echo $row1['pat_Fname']." ".$row1['pat_MI']." ".$row1['pat_Lname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>
                                            <?php if($validation_errors->getError('app_patient')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_patient') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_doctor" class="form-label">Doctor</label>
                                            <select class="form-select" name="app_doctor">                                                                                              
                                                 <?php if($staff): ?>
                                                <?php foreach($staff as $row1): ?>
                                                    <option <?php if(set_value('app_doctor') == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname'] || $row3['staff_Fname']." ".$row3['staff_MI']." ".$row3['staff_Lname'] == $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>">
                                                        <?php echo $row1['staff_Fname']." ".$row1['staff_MI']." ".$row1['staff_Lname']; ?>
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
                                            <input type="date" name="app_Date" class="form-control" <?php if(empty(set_value('app_Date'))):?>value="<?= $row3['app_Date'] ?>"<?php else:?>value="<?= set_value('app_Date') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('app_Date')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Date') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                        
                                         <div class="form-group">
                                            <label for="app_Time" class="form-label">Time</label>
                                            <input type="time" name="app_Time" class="form-control" <?php if(empty(set_value('app_Time'))):?>value="<?= $row3['app_Time'] ?>"<?php else:?>value="<?= set_value('app_Time') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('app_Time')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Time') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_Complain" class="form-label">Complain</label>
                                            <textarea rows="3" name="app_Complain" class="form-control"><?php if(empty(set_value('app_Complain'))):?><?= $row3['app_Complain'] ?><?php else:?><?= set_value('app_Complain') ?><?php endif;?></textarea>
                                            <?php if($validation_errors->getError('app_Complain')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Complain') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="app_Status" class="form-label">Status</label>
                                            <select class="form-select" name="app_Status">
                                                <option value="<?php echo $row3['app_Status']; ?>">
                                                    <?php echo $row3['app_Status']; ?>
                                                </option>
                                                <option value="Pending">Pending</option>
                                                <option value="Completed">Completed</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>
                                            <?php if($validation_errors->getError('app_Status')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('app_Status') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    <?php endforeach; ?>
                    
                    <!-- Delete Pending Appointment -->
                    <?php foreach($appointment_pending as $row): ?>
                        <form action="<?php echo base_url('appointment/delete_appointment_pending/'.$row['app_ID']); ?>" method="post">
                            <div class="modal fade" id="Delete_Appointment<?= $row['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Appointment</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">

                                        <p>Are you sure do you want to delete this appointment?</p>

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
                    <!-- Delete Completed Appointment -->
                    <?php foreach($appointment_completed as $row2): ?>
                        <form action="<?php echo base_url('appointment/delete_appointment_completed/'.$row2['app_ID']); ?>" method="post">
                            <div class="modal fade" id="Delete_Appointment<?= $row2['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Appointment</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">

                                        <p>Are you sure do you want to delete this appointment?</p>

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
                    <!-- Delete Cancelled Appointment -->
                    <?php foreach($appointment_cancelled as $row3): ?>
                        <form action="<?php echo base_url('appointment/delete_appointment_cancelled/'.$row3['app_ID']); ?>" method="post">
                            <div class="modal fade" id="Delete_Appointment<?= $row3['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Delete Appointment</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>

                                    </div>

                                    <div class="modal-body">

                                        <p>Are you sure do you want to delete this appointment?</p>

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
                  
                    <!-- Send Notification Pending -->
                    <?php foreach($appointment_pending as $row): ?>
                        <form action="<?php echo base_url('appointment/send_notification'); ?>" method="post">
                        <?= csrf_field() ?>
                            <div class="modal fade" id="Send_Notification<?= $row['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Send Notification</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <?php if(session()->getFlashdata('update_appointment_pending_errors')):?>
                                            <div class="alert alert-danger"><?= session()->getFlashdata('update_appointment_pending_errors')->listErrors() ?></div>
                                        <?php endif;?>
                                        
                                        <div class="form-group">
                                            <label for="pat_ContactNum" class="form-label">Contact Number</label>
                                            <input type="number" name="pat_ContactNum" class="form-control" value="<?php echo $row['pat_ContactNum']; ?>">
                                        </div><br>

                                        <!-- <div class="form-group">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" name="subject" class="form-control" value="Appointment Confirmation">
                                        </div><br> -->

                                        <div class="form-group">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea rows="6" type="text" name="message" class="form-control"></textarea>
                                        </div><br>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    <?php endforeach; ?>

                    <!-- Send Notification Completed-->
                    <?php foreach($appointment_completed as $row2): ?>
                        <form action="<?php echo base_url('appointment/send_notification'); ?>" method="post">
                        <?= csrf_field() ?>
                            <div class="modal fade" id="Send_Notification<?= $row2['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Send Notification</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <?php if(session()->getFlashdata('update_appointment_pending_errors')):?>
                                            <div class="alert alert-danger"><?= session()->getFlashdata('update_appointment_pending_errors')->listErrors() ?></div>
                                        <?php endif;?>
                                        
                                        <div class="form-group">
                                            <label for="pat_ContactNum" class="form-label">Contact Number</label>
                                            <input type="number" name="pat_ContactNum" class="form-control" value="<?php echo $row['pat_ContactNum']; ?>">
                                        </div><br>

                                        <!-- <div class="form-group">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" name="subject" class="form-control" value="Appointment Confirmation">
                                        </div><br> -->

                                        <div class="form-group">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea rows="6" type="text" name="message" class="form-control"></textarea>
                                        </div><br>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
                                        </div>
                                    </div>

                                    </div>

                                </div>

                            </div>
                        </form>
                    <?php endforeach; ?>

                    <!-- Send Notification Cancelled-->
                    <?php foreach($appointment_cancelled as $row3): ?>
                        <form action="<?php echo base_url('appointment/send_notification'); ?>" method="post">
                        <?= csrf_field() ?>
                            <div class="modal fade" id="Send_Notification<?= $row3['app_ID']; ?>" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                    <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Send Notification</h5>

                                        <a class="btn-close" href="<?php echo base_url('appointment') ?>"></a>

                                    </div>

                                    <div class="modal-body">
                                        <?php if(session()->getFlashdata('update_appointment_pending_errors')):?>
                                            <div class="alert alert-danger"><?= session()->getFlashdata('update_appointment_pending_errors')->listErrors() ?></div>
                                        <?php endif;?>
                                        
                                        <div class="form-group">
                                            <label for="pat_ContactNum" class="form-label">Contact Number</label>
                                            <input type="number" name="pat_ContactNum" class="form-control" value="<?php echo $row['pat_ContactNum']; ?>">
                                        </div><br>

                                        <!-- <div class="form-group">
                                            <label for="subject" class="form-label">Subject</label>
                                            <input type="text" name="subject" class="form-control" value="Appointment Confirmation">
                                        </div><br> -->

                                        <div class="form-group">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea rows="6" type="text" name="message" class="form-control"></textarea>
                                        </div><br>
                                      
                                    </div>
                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('appointment') ?>" >Close</a>
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
</div>
<script>
   $(document).ready(function () {
      $('#pending-list').DataTable({
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
   $(document).ready(function () {
      $('#completed-list').DataTable({
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
   $(document).ready(function () {
      $('#cancelled-list').DataTable({
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
<?php if(session()->getFlashdata('update_appointment_pending_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Edit_Appointment<?= $app_pending_update_error['app_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>
<?php if(session()->getFlashdata('update_appointment_completed_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Edit_Appointment<?= $app_completed_update_error['app_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>
<?php if(session()->getFlashdata('update_appointment_cancelled_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Edit_Appointment<?= $app_cancelled_update_error['app_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>
<?= $this->endSection('content') ?>