<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<style>
    td {
        text-align : center;
    }
    .des {
         text-align: left;
         width: 15rem;
    }
</style>
<?php if(session()->getFlashdata('validation_errors')):?>
    <script type="text/javascript">
        $(function() {
            $('#Add_Medicine').modal('show');
        });
    </script>
<?php endif;?>


<div class="container-fluid overflow-hidden">
    <div class="row overflow-auto">
        <?= $this->include('layouts/sidebar') ?>
        <div class="col vh-100  d-flex flex-column h-sm-100">
            <main class="row overflow-auto">
                <div class="col pt-4">         
                    <div class="card">
                        <div class="card-header">
                            <h5>
                                Medicine List
                                <a type="button" class="btn btn-info btn-sm float-end" data-bs-toggle="modal" data-bs-target="#Add_Medicine">Add Medicine</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="cell-border hover" id="medicine-list" style="width: 100%;">
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
                                        <th>Medicine ID</th>
                                        <th>Medicine Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>Expiration Date</th>
                                        <th>Unit</th>
                                        <th>Total Quantity</th>                                  
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($medicine): ?>
                                    <?php foreach($medicine as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['med_ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['med_Name']; ?>
                                        </td>
                                        <td class="text-nowrap">
                                            <?php echo $row['med_Category']; ?>
                                        </td>
                                        <td class="des">
                                            <?php echo $row['med_Description']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['med_ExpDate']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['med_Unit']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['med_Quantity']; ?>
                                        </td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#Edit_Medicine<?= $row['med_ID']; ?>"
                                                class="bi bi-pencil-square"></a>
                                            <a data-bs-toggle="modal" data-bs-target="#Delete_Medicine<?= $row['med_ID']; ?>"
                                                class="bi bi-trash3-fill" style="color: red;"></a>  
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="inv col mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5>
                                        Add Stock
                                    </h5>
                                </div>
                                <div class="card-body">
                                    
                                    <form action="<?php echo base_url('medicine/add_med_inv') ?>" method="post">

                                        <div class="form-group">
                                            <label for="med_Name" class="form-label">Medicine Name</label>
                                            <select id="med_Name" name="med_Name" class="selectpicker" data-width="100%" data-live-search="true" title="Select Medicine">
                                                <?php if($medicine): ?>
                                                <?php foreach($medicine as $row1): ?>
                                                    <option <?php if(old('med_Name') == $row1['med_Name']):?>selected="selected"<?php endif;?> value="<?php echo $row1['med_Name']; ?>">
                                                        <?php echo $row1['med_Name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>                                                
                                            <?php if($validation_errors->getError('med_Name')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Name') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_invQuantity" class="form-label">Quantity</label>
                                            <input type="number" name="med_invQuantity" class="form-control" value="<?= old('med_invQuantity'); ?>">
                                            <?php if($validation_errors->getError('med_invQuantity')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_invQuantity') ?></div>
                                            <?php endif;?>
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="med_invUnit" class="form-label">Unit</label>
                                            <input type="text" class="form-control" name="med_invUnit" value="<?= old('med_invUnit'); ?>">
                                            <?php if($validation_errors->getError('med_invUnit')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_invUnit') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_invCost" class="form-label">Cost</label>
                                            <input type="number" name="med_invCost" class="form-control" value="<?= old('med_invCost'); ?>">
                                            <?php if($validation_errors->getError('med_invCost')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_invCost') ?></div>
                                            <?php endif;?>
                                        </div><br>

                            
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button" class="btn btn-secondary" 
                                                href="<?php echo base_url('medicine') ?>" >Cancel</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="inv col mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="med-inv">
                                        Medicine Inventory History
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="cell hover" id="medicine-inventory" style="width: 100%;">
                                        <?php
                                            if(session()->getFlashdata('inv_status'))
                                            {
                                                ?>
                                                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>
                                                            <?= session()->getFlashdata('inv_status'); ?>
                                                        </strong>
                                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                            aria-label="Close"></button>
                                                    </div>
                                                <?php
                                            }
                                        ?>
                                        <thead>
                                            <tr class="text-nowrap">
                                                <th>History ID</th>
                                                <th>Date</th>
                                                <th>Medicine Name</th>
                                                <th>Quantity</th>
                                                <th>Unit</th>
                                                <th>Cost</th>     
                                                <th>Total Cost</th>                             
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($med_inv): ?>
                                            <?php foreach($med_inv as $row): ?>
                                            <tr class="text-nowrap">
                                                <td>
                                                    <?php echo $row['med_inv_ID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_invDate']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_Name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_invQuantity']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_invUnit']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_invCost']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['med_invTotal']; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#Delete_Med_Inv<?= $row['med_inv_ID']; ?>"
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

                    <!-- Add Medicine -->
                    <form action="<?php echo base_url('medicine/add_medicine') ?>" method="post">
                        <div class="modal fade" id="Add_Medicine" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Add Medicine</h5>

                                        <a class="btn-close" href="<?php echo base_url('medicine') ?>"></a>

                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="med_Name" class="form-label">Medicine Name</label>
                                            <input type="text" name="med_Name" class="form-control" value="<?= old('med_Name'); ?>">
                                            <?php if($validation_errors->getError('med_Name')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Name') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_Category" class="form-label">Category</label>
                                            <input type="text" name="med_Category" class="form-control" value="<?= old('med_Category'); ?>">
                                            <?php if($validation_errors->getError('med_Category')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Category') ?></div>
                                            <?php endif;?> 
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="med_Description" class="form-label">Description</label>
                                            <textarea class="form-control" name="med_Description" rows="3"><?= old('med_Description'); ?></textarea>
                                            <?php if($validation_errors->getError('med_Description')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Description') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_ExpDate" class="form-label">Expiration Date</label>
                                            <input type="date" name="med_ExpDate" class="form-control" value="<?= old('med_ExpDate'); ?>">
                                            <?php if($validation_errors->getError('med_ExpDate')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_ExpDate') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_Unit" class="form-label">Unit</label>
                                            <input type="text" name="med_Unit" class="form-control" value="<?= old('med_Unit'); ?>">
                                            <?php if($validation_errors->getError('med_Unit')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Unit') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button" class="btn btn-secondary" 
                                                href="<?php echo base_url('medicine') ?>" >Close</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>

                    <!-- Edit Medicine -->
                    <?php foreach($medicine as $row): ?>
                    <form action="<?php echo base_url('medicine/update_medicine/'.$row['med_ID']); ?>" method="post">
                        <div class="modal fade" id="Edit_Medicine<?= $row['med_ID']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Medicine</h5>

                                        <a class="btn-close" href="<?php echo base_url('medicine') ?>"></a>

                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="med_Name" class="form-label">Medicine Name</label>
                                            <input type="text" name="med_Name" class="form-control" <?php if(empty(set_value('med_Name'))):?>value="<?= $row['med_Name'] ?>"<?php else:?>value="<?= set_value('med_Name') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('med_Name')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Name') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_Category" class="form-label">Category</label>
                                            <input type="text" name="med_Category" class="form-control" <?php if(empty(set_value('med_Category'))):?>value="<?= $row['med_Category'] ?>"<?php else:?>value="<?= set_value('med_Category') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('med_Category')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Category') ?></div>
                                            <?php endif;?> 
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="med_Description" class="form-label">Description</label>
                                            <textarea class="form-control" name="med_Description" rows="3"><?php if(empty(set_value('med_Description'))):?><?= $row['med_Description'] ?><?php else:?><?= set_value('med_Description') ?><?php endif;?></textarea>
                                            <?php if($validation_errors->getError('med_Description')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Description') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_ExpDate" class="form-label">Expiration Date</label>
                                            <input type="date" name="med_ExpDate" class="form-control" <?php if(empty(set_value('med_ExpDate'))):?>value="<?= $row['med_ExpDate'] ?>"<?php else:?>value="<?= set_value('med_ExpDate') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('med_ExpDate')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_ExpDate') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_Unit" class="form-label">Unit</label>
                                            <input type="text" name="med_Unit" class="form-control" <?php if(empty(set_value('med_Unit'))):?>value="<?= $row['med_Unit'] ?>"<?php else:?>value="<?= set_value('med_Unit') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('med_Unit')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Unit') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="med_Quantity" class="form-label">Quantity</label>
                                            <input type="number" name="med_Quantity" class="form-control" <?php if(empty(set_value('med_Quantity'))):?>value="<?= $row['med_Quantity'] ?>"<?php else:?>value="<?= set_value('med_Quantity') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('med_Quantity')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('med_Quantity') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('medicine') ?>" >Close</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>  
                    </form>
                    <?php endforeach; ?>

                    <!-- Delete Medicine -->
                    <?php foreach($medicine as $row): ?>
                    <form action="<?php echo base_url('medicine/delete_medicine/'.$row['med_ID']); ?>" method="post">
                        <div class="modal fade" id="Delete_Medicine<?= $row['med_ID']; ?>" data-bs-backdrop="static"
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


                    <!-- Delete Medicine Inventory -->
                    <?php foreach($med_inv as $row): ?>
                    <form action="<?php echo base_url('medicine/delete_med_inv/'.$row['med_inv_ID']); ?>" method="post">
                        <div class="modal fade" id="Delete_Med_Inv<?= $row['med_inv_ID']; ?>" data-bs-backdrop="static"
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
        $('#medicine-list').DataTable({
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

        $('#medicine-inventory').DataTable({
            info: false,
            searching: false,
            scrollY: '50vh',
            scrollX: true,
            scrollCollapse: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    title: $('.med-inv').text(),
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
            $('#Edit_Medicine<?php echo $med_update_error['med_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>
<script>
     $('#med_Name').selectpicker();
</script>

<?= $this->endSection('content') ?>