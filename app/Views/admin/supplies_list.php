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
                                Supplies List
                                <a type="button" class="btn btn-info btn-sm float-end" data-bs-toggle="modal" data-bs-target="#Add_Supplies">Add Supplies</a>
                            </h5>
                        </div>
                        <div class="card-body">
                            <table class="cell-border hover" id="supplies-list" style="width: 100%;">
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
                                        <th>Supplies ID</th>
                                        <th>Supplies Name</th>
                                        <th>Description</th>
                                        <th>Expiration Date</th>
                                        <th>Total Quantity</th>                                  
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($supplies): ?>
                                    <?php foreach($supplies as $row): ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['sup_ID']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sup_Name']; ?>
                                        </td>
                                        <td class="des">
                                            <?php echo $row['sup_Description']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sup_ExpDate']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['sup_Quantity']; ?>
                                        </td>
                                        <td>
                                            <a data-bs-toggle="modal" data-bs-target="#Edit_Supplies<?= $row['sup_ID']; ?>"
                                                class="bi bi-pencil-square"></a>
                                            <a data-bs-toggle="modal" data-bs-target="#Delete_Supplies<?= $row['sup_ID']; ?>"
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
                                    
                                    <form action="<?php echo base_url('supplies/add_sup_inv') ?>" method="post">

                                        <div class="form-group">
                                            <label for="sup_Name" class="form-label">Supplies Name</label>
                                            <select id="sup_Name" name="sup_Name" class="selectpicker" data-width="100%" data-live-search="true" title="Select Supplies">
                                                <?php if($supplies): ?>
                                                <?php foreach($supplies as $row1): ?>
                                                    <option <?php if(old('sup_Name') == $row1['sup_Name']):?>selected="selected"<?php endif;?> value="<?php echo $row1['sup_Name']; ?>">
                                                        <?php echo $row1['sup_Name']; ?>
                                                    </option>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                            </select>                                                
                                            <?php if($validation_errors->getError('sup_Name')): ?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_Name') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="sup_invQuantity" class="form-label">Quantity</label>
                                            <input type="number" name="sup_invQuantity" class="form-control" value="<?= old('sup_invQuantity'); ?>">
                                            <?php if($validation_errors->getError('sup_invQuantity')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_invQuantity') ?></div>
                                            <?php endif;?>
                                        </div><br>

                                        <div class="form-group">
                                            <label for="sup_invCost" class="form-label">Cost</label>
                                            <input type="number" name="sup_invCost" class="form-control" value="<?= old('sup_invCost'); ?>">
                                            <?php if($validation_errors->getError('sup_invCost')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_invCost') ?></div>
                                            <?php endif;?>
                                        </div><br>
                            
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button" class="btn btn-secondary" 
                                                href="<?php echo base_url('supplies') ?>" >Cancel</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="inv col mt-4">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="med-sup">
                                        Medical Supplies Inventory History
                                    </h5>
                                </div>
                                <div class="card-body">
                                    <table class="cell hover" id="supplies-inventory" style="width: 100%;">
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
                                                <th>Supplies Name</th>
                                                <th>Quantity</th>
                                                <th>Cost</th>     
                                                <th>Total Cost</th>                             
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($sup_inv): ?>
                                            <?php foreach($sup_inv as $row): ?>
                                            <tr class="text-nowrap">
                                                <td>
                                                    <?php echo $row['sup_inv_ID']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sup_invDate']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sup_Name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sup_invQuantity']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sup_invCost']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['sup_invTotal']; ?>
                                                </td>
                                                <td>
                                                    <a data-bs-toggle="modal" data-bs-target="#Delete_Med_Inv<?= $row['sup_inv_ID']; ?>"
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

                    <!-- Add Supplies -->
                    <form action="<?php echo base_url('supplies/add_supplies') ?>" method="post">
                        <div class="modal fade" id="Add_Supplies" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Add Supplies</h5>

                                        <a class="btn-close" href="<?php echo base_url('supplies') ?>"></a>

                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="sup_Name" class="form-label">Supplies Name</label>
                                            <input type="text" name="sup_Name" class="form-control" value="<?= old('sup_Name'); ?>">
                                            <?php if($validation_errors->getError('sup_Name')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_Name') ?></div>
                                            <?php endif;?> 
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="sup_Description" class="form-label">Description</label>
                                            <textarea class="form-control" name="sup_Description" rows="3"><?= old('sup_Description'); ?></textarea>
                                            <?php if($validation_errors->getError('sup_Description')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_Description') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="sup_ExpDate" class="form-label">Expiration Date</label>
                                            <input type="date" name="sup_ExpDate" class="form-control" value="<?= old('sup_ExpDate'); ?>">
                                            <?php if($validation_errors->getError('sup_ExpDate')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_ExpDate') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Submit</button>
                                            <a type="button" class="btn btn-secondary" 
                                                href="<?php echo base_url('supplies') ?>" >Close</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </form>

                    <!-- Edit Supplies -->
                    <?php foreach($supplies as $row): ?>
                    <form action="<?php echo base_url('supplies/update_supplies/'.$row['sup_ID']); ?>" method="post">
                        <div class="modal fade" id="Edit_Supplies<?= $row['sup_ID']; ?>" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                    <div class="modal-header">

                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Supplies</h5>

                                        <a class="btn-close" href="<?php echo base_url('supplies') ?>"></a>

                                    </div>

                                    <div class="modal-body">

                                        <div class="form-group">
                                            <label for="sup_Name" class="form-label">Supplies Name</label>
                                            <input type="text" name="sup_Name" class="form-control" <?php if(empty(set_value('sup_Name'))):?>value="<?= $row['sup_Name'] ?>"<?php else:?>value="<?= set_value('sup_Name') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('sup_Name')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_Name') ?></div>
                                            <?php endif;?> 
                                        </div><br>
                                        
                                        <div class="form-group">
                                            <label for="sup_Description" class="form-label">Description</label>
                                            <textarea class="form-control" name="sup_Description" rows="3"><?php if(empty(set_value('sup_Description'))):?><?= $row['sup_Description'] ?><?php else:?><?= set_value('sup_Description') ?><?php endif;?></textarea>
                                            <?php if($validation_errors->getError('sup_Description')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_Description') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="sup_ExpDate" class="form-label">Expiration Date</label>
                                            <input type="date" name="sup_ExpDate" class="form-control" <?php if(empty(set_value('sup_ExpDate'))):?>value="<?= $row['sup_ExpDate'] ?>"<?php else:?>value="<?= set_value('sup_ExpDate') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('sup_ExpDate')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_ExpDate') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                        <div class="form-group">
                                            <label for="sup_Quantity" class="form-label">Quantity</label>
                                            <input type="number" name="sup_Quantity" class="form-control" <?php if(empty(set_value('sup_Quantity'))):?>value="<?= $row['sup_Quantity'] ?>"<?php else:?>value="<?= set_value('sup_Quantity') ?>"<?php endif;?>>
                                            <?php if($validation_errors->getError('sup_Quantity')):?>
                                                <div class="alert alert-danger mt-2"><?= $validation_errors->getError('sup_Quantity') ?></div>
                                            <?php endif;?> 
                                        </div><br>

                                    </div>

                                    <div class="modal-footer">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <a type="button"  class="btn btn-secondary"
                                                href="<?php echo base_url('supplies') ?>" >Close</a>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>  
                    </form>
                    <?php endforeach; ?>

                    <!-- Delete Supplies -->
                    <?php foreach($supplies as $row): ?>
                    <form action="<?php echo base_url('supplies/delete_supplies/'.$row['sup_ID']); ?>" method="post">
                        <div class="modal fade" id="Delete_Supplies<?= $row['sup_ID']; ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Supplies</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>

                                <div class="modal-body">

                                    <p>Are you sure do you want to delete this supplies?</p>

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


                    <!-- Delete Supplies Inventory -->
                    <?php foreach($sup_inv as $row): ?>
                    <form action="<?php echo base_url('supplies/delete_sup_inv/'.$row['sup_inv_ID']); ?>" method="post">
                        <div class="modal fade" id="Delete_Med_Inv<?= $row['sup_inv_ID']; ?>" data-bs-backdrop="static"
                            data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">

                                <div class="modal-content">

                                <div class="modal-header">

                                    <h5 class="modal-title" id="staticBackdropLabel">Delete Supplies</h5>

                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>

                                <div class="modal-body">

                                    <p>Are you sure do you want to delete this supplies?</p>

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
        $('#supplies-list').DataTable({
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

        $('#supplies-inventory').DataTable({
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
            $('#Edit_Supplies<?php echo $sup_update_error['sup_ID']; ?>').modal('show');
        });
    </script>
<?php endif;?>
<script>
     $('#sup_Name').selectpicker();
</script>

<?= $this->endSection('content') ?>