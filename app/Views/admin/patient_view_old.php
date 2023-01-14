<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>
<style>

  .info{
    display: flex;
    justify-content: center;
    margin: 30px;
  }

  .info .card{
    width: 32rem;
  }

  .print {
    border: 1px solid rgba(0, 0, 0, 0.3);
    border-radius: 2px;
    font-size: .88em;
    color: black;
    background-color: rgba(0, 0, 0, 0.1);
    background: linear-gradient(to bottom, rgba(230, 230, 230, 0.1) 0%, rgba(0, 0, 0, 0.1) 100%);
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

<div class="container-fluid overflow-hidden">
  <div class="row vh-100 overflow-auto">
    <?= $this->include('layouts/sidebar') ?>
    <div class="col d-flex flex-column h-sm-100">
      <main class="row overflow-auto">
        <div class="col pt-4">
          <div class="row" id="print">
            
            <div class="info col">
              <div class="card bg-light">

                <div class="card-header">
                  <h5>
                    Patient Details
                    <button class="print btn btn-info btn-sm float-end" onclick="printDiv('print','Title')">Print</button>
                  </h5>
                </div>
                <div class="card-body">
                  <form>

                    <div class="form-group">
                      <label for="pat_ID" class="form-label">Patient ID</label>
                      <input type="text" name="pat_ID" class="form-control" readonly value="<?= $patient['pat_ID']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Type" class="form-label">Patient Type</label>
                      <input type="text" name="pat_Type" class="form-control" readonly value="<?= $patient['pat_Type']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Fname" class="form-label">First Name</label>
                      <input type="text" name="fname" readonly value="<?= $patient['pat_Fname']; ?>" class="form-control bg-white" id="name"
                        readonly >
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Lname" class="form-label">Last Name</label>
                      <input type="text" name="lname" readonly value="<?= $patient['pat_Lname']; ?>" class="form-control bg-white" id="name"
                        readonly>
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Suffix" class="form-label">Suffix</label>
                      <input type="text" name="pat_Suffix" class="form-control" readonly value="<?= $patient['pat_Suffix']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Address" class="form-label">Address</label>
                      <input type="text" name="pat_Address" class="form-control" readonly value="<?= $patient['pat_Address']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Gender" class="form-label">Gender</label>
                      <input type="text" name="pat_Gender" class="form-control" readonly value="<?= $patient['pat_Gender']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Bdate" class="form-label">Birth Date</label>
                      <input type="date" name="pat_Bdate" class="form-control" readonly value="<?= $patient['pat_Bdate']; ?>">
                    </div>

                    <div class="form-group">
                      <label for="pat_BloodType" class="form-label">Blood Type</label>
                      <input type="text" name="pat_BloodType" class="form-control" readonly value="<?= $patient['pat_BloodType']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_FamHistory" class="form-label">Family History</label>
                      <input type="text" name="pat_FamHistory" class="form-control" readonly value="<?= $patient['pat_FamHistory']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_ContactNum" class="form-label">Contact Number</label>
                      <input type="text" name="pat_ContactNum" class="form-control" maxlength="11" readonly value="<?= $patient['pat_ContactNum']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_EmergencyNum" class="form-label">Emergency Number</label>
                      <input type="text" name="pat_EmergencyNum" class="form-control" maxlength="11" readonly value="<?= $patient['pat_EmergencyNum']; ?>">
                    </div><br>

                    <div class="form-group">
                      <label for="pat_Email" class="form-label">Email</label>
                      <input type="email" name="pat_Email" class="form-control" readonly value="<?= $patient['pat_Email']; ?>">
                    </div><br>

                  </form>
                </div>
              </div>
            </div>
            <!-- <div class="info col">
              <div class="card bg-light">

                <div class="card-header">
                  <h5 class="text-center">Edit Patient</h5>
                </div>
                <div class="card-body">
                  <form action="<?= base_url('/update') ?>" method="post">

                    <input type="hidden" name="id" readonly value="<?php echo $patient['pat_ID']; ?>">

                    <div class="form-group">
                      <label for="name" class="form-label">First Name</label>
                      <input type="text" name="fname" readonly value="<?= $patient['pat_Fname']; ?>" class="form-control bg-white" id="name"
                        required readonly>
                    </div><br>

                    <div class="form-group">
                      <label for="course" class="form-label">Last Name</label>
                      <input type="text" name="lname" readonly value="<?= $patient['pat_Lname']; ?>" class="form-control bg-white" id="name"
                        required readonly>
                    </div><br>

                    <div class="form-group">
                      <button type="submit" class="btn btn-success">Save</button>
                    </div>

                  </form>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </main>
    </div>
    
    <?= $this->include('layouts/footer') ?>

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
<?= $this->endSection('content') ?>