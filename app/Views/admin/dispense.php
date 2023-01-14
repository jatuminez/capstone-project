<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<style>
    td {
        text-align : center;
    }
    .des {
         display: flex;
         justify-content: center;
         text-align : justify;
    }
</style>

<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <?= $this->include('layouts/sidebar') ?>
        <div class="col vh-100  d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
                <div class="col">         
                    <div class="row mt-2">
                        <div class="dis col mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        Dispense Medicine
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <?php if(session()->getFlashdata('dispense_greaterthan_quantity_error')):?>
                                        <div class="alert alert-danger"><?= session()->getFlashdata('dispense_greaterthan_quantity_error'); ?></div>
                                    <?php endif;?>
                                    <form action="<?php echo base_url('dispense/add_dispense') ?>" method="post">

                                        <div class="form-group">
                                            <label for="pat_Name" class="form-label">Patient Name</label>
                                            <select id="pat_Name" name="pat_Name" class="selectpicker" data-width="100%" data-live-search="true" title="Select Patient">
                                                 <?php if($patient): ?>
                                                <?php foreach($patient as $row): ?>
                                                    <option <?php if(old('pat_Name') == $row['pat_Fname']." ".$row['pat_Lname']):?>selected="selected"<?php endif;?> value="<?php echo $row['pat_Fname']." ".$row['pat_Lname']; ?>">
                                                        <?php echo $row['pat_Fname']." ".$row['pat_Lname']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>                                                
                                            <?php if($validation_errors->getError('pat_Name')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('pat_Name') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_Name" class="form-label">Medicine Name</label>
                                            <select id="med_Name" name="med_Name" class="selectpicker" data-width="100%" data-live-search="true" title="Select Medicine">
                                                <?php if($medicine): ?>
                                                <?php foreach($medicine as $row1): ?>
                                                    <option <?php if(old('med_Name') == $row1['med_Name']):?>selected="selected"<?php endif;?> value="<?php echo $row1['med_Name']; ?>">
                                                        <?php echo $row1['med_Name']; ?> - <?php echo $row1['med_Quantity']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>                                                
                                            <?php if($validation_errors->getError('med_Name')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Name') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="dis_Num" class="form-label">Quantity</label>
                                            <input type="number" name="dis_Num" class="form-control" value="<?= old('dis_Num'); ?>">
                                            <?php if($validation_errors->getError('dis_Num')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('dis_Num') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                        
                            
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button" class="btn btn-secondary" 
                                                href="<?php echo base_url('dispense') ?>" >Cancel</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="dis col mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="med_dis">
                                        Medicine Dispense History
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="cell-border hover" id="medicine-dispense" style="width: 100%;">
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
                                            <tr class="text-nowrap">
                                                <th>Dispense ID</th>
                                                <th>Date</th>
                                                <th>Patient Name</th> 
                                                <th>Medicine Name</th>                                  
                                                <th>Quantity</th>                                  
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($dispense): ?>
                                            <?php foreach($dispense as $row): ?>
                                            <tr class="text-nowrap">
                                                <td>
                                                    <?php echo $row['dis_ID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['dis_Date']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['pat_Fname']." ".$row['pat_Lname']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_Name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['dis_Num']; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#Delete_Dispense<?= $row['dis_ID']; ?>"
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
                    
                    <!-- Delete Medicine Dispense -->
                    <?php foreach($dispense as $row): ?>
                    <form action="<?php echo base_url('dispense/delete_dispense/'.$row['dis_ID']); ?>" method="post">
                        <div class="modal fade" id="Delete_Dispense<?= $row['dis_ID']; ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Medicine</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>

                                <div class="modal-body">

                                    <p>Are you sure do you want to delete this medicine?</p>

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
        $('#medicine-dispense').DataTable({
            info: false,
            searching: false,
            scrollY: '50vh',
            scrollX: true,
            scrollCollapse: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    title: $('.med_dis').text(),
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
                    visible: true
            } 
            ]
        });
      
      // $('#searchbox').keyup(function () {
      //    table.search(this.value).draw();
      // });
      

   });
</script>

<?php if(session()->getFlashdata('update_validation_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Edit_Dispense<?php echo $med_update_error['med_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>
<script>
     $('#med_Name').selectpicker();
</script>

<?= $this->endSection('content') ?>