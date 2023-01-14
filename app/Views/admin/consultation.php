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

  @media print {
    #print {
      display: flex;
      flex-direction: column;
      flex-wrap: wrap;
      align-items: center;
    }
  }

  textarea {
    resize: none;
  }
</style>

<div class="container-fluid overflow-hidden">
  <div class="row vh-100 overflow-auto">
    <?= $this->include('layouts/sidebar') ?>
    <div class="col d-flex flex-column h-sm-100">
      <main class="row overflow-auto">
        <div class="col pt-4">   
          <div class="info" id="print">
            <div class="card bg-light">

              <div class="card-header">
                <h5>
                  Prescription
                  <button class="print btn btn-info btn-sm float-end" onclick="printDiv('print','Title')">Print</button>
                </h5>
              </div>
              <div class="card-body">
                <form action="">
                  <div class="row g-3">
                    <div class="row gy-2 gx-3">
                      <div class="col">
                        <label for="staff_Name" class="form-label">Staff Name</label>
                        <input type="text" name="staff_Name" class="form-control" readonly value="<?= $consultation['staff_Fname']." ".$consultation['staff_MI']." ".$consultation['staff_Lname']; ?>">
                      </div><br>

                      <div class="col">
                        <label for="app_ID" class="form-label">App No</label>
                        <input type="text" name="app_ID" readonly value="<?= $consultation['app_ID']; ?>" class="form-control bg-white" id="name"
                          readonly >
                      </div><br>

                      <div class="col">
                        <label for="con_Date" class="form-label">Date</label>
                        <input type="text" name="con_Date" readonly value="<?= $consultation['con_Date']; ?>" class="form-control bg-white" id="name"
                          readonly>
                      </div><br>

                    </div>
                    
                    <div class="row gy-2 gx-3">
                      <div class="col-md-4">
                        <label for="pat_Fname" class="form-label">First Name</label>
                        <input type="text" name="pat_Fname" class="form-control" readonly value="<?= $consultation['pat_Fname']; ?>">
                      </div><br>

                      <div class="col-md-4">
                        <label for="pat_Lname" class="form-label">Last Name</label>
                        <input type="text" name="pat_Lname" class="form-control" readonly value="<?= $consultation['pat_Lname']; ?>">
                      </div><br>

                      <div class="col">
                        <label for="pat_MI" class="form-label">Middle Initial</label>
                        <input type="text" name="pat_MI" class="form-control" readonly value="<?= $consultation['pat_MI']; ?>">
                      </div><br>

                      <div class="col">
                        <label for="pat_Suffix" class="form-label">Suffix</label>
                        <input type="text" name="pat_Suffix" class="form-control" readonly value="<?= $consultation['pat_Suffix']; ?>">
                      </div><br>
                    </div>

                    <div class="col">
                      <label for="con_VitalSigns" class="form-label">Vital Signs</label>
                      <textarea rows="3" name="con_VitalSigns" class="form-control" readonly><?= $consultation['con_VitalSigns']; ?></textarea>
                    </div><br>

                    <div class="col">
                      <label for="con_Assessment" class="form-label">Assessment</label>
                      <textarea rows="3" name="con_Assessment" class="form-control" readonly><?= $consultation['con_Assessment']; ?></textarea>
                    </div><br>

                    <div class="col-md-4">
                      <label for="med_ID" class="form-label">Medicine</label>
                      <textarea rows="3" name="med_ID" class="form-control" readonly>Name: <?= $consultation['med_Name']; ?>&#13;&#10;Quantity: <?= $consultation['dis_Num']; ?></textarea>
                    </div><br>

                    <div class="col">
                      <label for="con_MedDose" class="form-label">Dosage</label>
                      <textarea rows="3" name="con_MedDose" class="form-control" readonly><?= $consultation['con_MedDose']; ?></textarea>
                    </div><br>
                    
                  </div>
                </form>
              </div>
            </div>
          </div><br>
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