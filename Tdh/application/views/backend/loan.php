<?php $this->load->view('backend/header'); ?> <!-- Load the header view -->
<?php $this->load->view('backend/sidebar'); ?> <!-- Load the sidebar view -->

<div class="page-wrapper">
    <div class="message"></div> <!-- Placeholder for messages/alerts --> 

    <!-- Page title and breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor"><i class="fa fa-money" aria-hidden="true"></i> Grant Loan</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Grant Loan</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Add Loan button -->
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info">
                    <i class="fa fa-plus"></i>
                    <a data-toggle="modal" data-target="#loanmodel" data-whatever="@getbootstrap" class="text-white">
                        Add Loan
                    </a>
                </button>
            </div>
        </div> 

        <!-- Loan List Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Loan List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- DataTable to display all granted loans -->
                            <table id="loan123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Employee Id</th>
                                        <th>Amount</th>
                                        <th>Installment</th>
                                        <th>Total Pay</th>
                                        <th>Total Due</th>
                                        <th>Approve Date</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php foreach($loanview as $value): ?>
                                    <tr>
                                        <td><?php echo $value->first_name.' '.$value->last_name ?></td>
                                        <td><?php echo $value->em_code ?></td>
                                        <td><?php echo $value->amount ?></td>
                                        <td><?php echo $value->installment ?></td> 
                                        <td><?php echo $value->total_pay ?></td>
                                        <td><?php echo $value->total_due ?></td>
                                        <td><?php echo date('jS \of F Y',strtotime($value->approve_date)) ?></td>
                                        <td><?php echo $value->status ?></td>
                                        <td class="jsgrid-align-center">
                                            <!-- Edit button triggers modal -->
                                            <a href="#" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light loanmodalclass" data-id="<?php echo $value->id; ?>" >
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <!-- Print button triggers printing of this employee's loan -->
                                            <button type="button" class="btn btn-sm btn-success print-loan-btn" data-id="<?php echo $value->id; ?>" title="Print Loan">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- End table-responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div>       

    <!-- Modal for Adding or Editing a Loan -->
    <div class="modal fade" id="loanmodel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Loan</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <!-- Form to add or edit loan -->
                <form role="form" method="post" action="Add_Loan" id="btnSubmit" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- Select employee to assign loan -->
                        <div class="form-group row">
                            <label class="control-label col-md-3">Assign To</label>
                            <select class="form-control custom-select col-md-8" data-placeholder="Choose a Category" tabindex="1" name="emid" required>
                                <option value="">Select Here</option>
                                <?php foreach($employee as $value): ?>
                                <option value="<?php echo $value->em_id; ?>"><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <!-- Loan amount input -->
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Amount</label>
                            <input type="text" name="amount" value="" class="form-control col-md-8 amount" id="recipient-name1" required>
                        </div> 
                        <!-- Approve date -->
                        <div class="form-group row">
                            <label class="control-label col-md-3">Approve Date</label>
                            <input type="text" name="appdate" class="form-control col-md-8 mydatetimepickerFull" id="recipient-name1" value="" required>
                        </div>
                        <!-- Installment period -->
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Install Period</label>
                            <input type="number" name="install" value="" class="form-control col-md-8 period" id="recipient-name1" required>
                        </div>
                        <!-- Calculated installment amount -->
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Install Amount</label>
                            <input type="number" name="installment" value="" class="form-control col-md-8 installment" id="recipient-name1" readonly>
                        </div>
                        <!-- Loan number -->
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Loan No</label>
                            <input type="text" name="loanno" value="<?php echo rand(100000,56000000)?>" class="form-control col-md-8" id="recipient-name1" readonly>
                        </div>
                        <!-- Loan status -->
                        <div class="form-group row">
                            <label class="control-label col-md-3">Status</label>
                            <select class="form-control custom-select col-md-8" data-placeholder="Choose a Category" tabindex="1" name="status" value="" required>
                                <option value="">Select here</option>
                                <option value="Granted">Granted</option>
                                <option value="Deny">Deny</option>
                                <option value="Done">Done</option>
                            </select>
                        </div>
                        <!-- Loan details -->
                        <div class="form-group row">
                            <label for="message-text" class="control-label col-md-3">Loan Details</label>
                            <textarea class="form-control col-md-8" name="details" value="" id="message-text1"></textarea>
                        </div>                                                                        
                    </div>
                    <div class="modal-footer">
                       <input type="hidden" name="id" value=""> <!-- Hidden input for edit -->
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.modal --> 

    <!-- Hidden Print Section for Turkish Doner House -->
    <div id="print-section" style="display:none; padding: 20px; font-family: Arial, sans-serif; color:#000;">
        <div style="text-align:center; margin-bottom: 20px;">
            <h2 style="margin:0; color:#e67e22;">Turkish Doner House</h2>
            <p style="margin:0;">Employee Loan Details</p>
            <hr style="border-color:#e67e22;">
        </div>
        <!-- Loan details table -->
        <table style="width:100%; border-collapse: collapse; margin-bottom:20px;">
            <tr><th style="text-align:left; padding:5px; width:150px;">Name:</th><td id="print-name"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Employee ID:</th><td id="print-empid"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Amount:</th><td id="print-amount"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Installment:</th><td id="print-installment"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Total Pay:</th><td id="print-totalpay"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Total Due:</th><td id="print-totaldue"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Approve Date:</th><td id="print-appdate"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Status:</th><td id="print-status"></td></tr>
            <tr><th style="text-align:left; padding:5px;">Loan Details:</th><td id="print-details"></td></tr>
        </table>
        <!-- Signature section -->
        <div style="margin-top:40px;">
            <div style="float:left; width:50%; text-align:center;">
                <p>________________________</p>
                <p>Employee Signature</p>
            </div>
            <div style="float:right; width:50%; text-align:center;">
                <p>________________________</p>
                <p>Manager Signature</p>
            </div>
            <div style="clear:both;"></div>
        </div>
        <hr style="border-color:#e67e22;">
        <p style="text-align:center; font-size:12px; color:gray;">Turkish Doner House Management </p>
    </div>

</div> <!-- End page-wrapper -->

<!-- JavaScript for modal, calculations, and printing -->
<script type="text/javascript">
    // Auto-calculate installment when amount or period changes
    $('.amount, .period').on('input',function() {
        var amount = parseInt($('.amount').val());
        var period = parseFloat($('.period').val());
        $('.installment').val((amount / period ? amount / period : 0).toFixed(2));
    });

    $(document).ready(function () {
        // Open modal and populate fields for editing loan
        $(".loanmodalclass").click(function (e) {
            e.preventDefault();
            var iid = $(this).attr('data-id');
            $('#btnSubmit').trigger("reset");
            $('#loanmodel').modal('show');
            $.ajax({
                url: 'LoanByID?id=' + iid,
                method: 'GET',
                dataType: 'json',
            }).done(function (response) {
                var loan = response.loanvalue;
                $('#btnSubmit').find('[name="emid"]').val(loan.emp_id).end();
                $('#btnSubmit').find('[name="id"]').val(loan.id).end();
                $('#btnSubmit').find('[name="details"]').val(loan.loan_details).end();
                $('#btnSubmit').find('[name="appdate"]').val(loan.approve_date).end();
                $('#btnSubmit').find('[name="amount"]').val(loan.amount).end();
                $('#btnSubmit').find('[name="install"]').val(loan.install_period).end();
                $('#btnSubmit').find('[name="installment"]').val(loan.installment).end();
                $('#btnSubmit').find('[name="loanno"]').val(loan.loan_number).end();
                $('#btnSubmit').find('[name="status"]').val(loan.status).end();
            });
        });

        // Print only the selected employee loan
        $('.print-loan-btn').click(function() {
            var loanId = $(this).data('id');
            $.ajax({
                url: 'LoanByID?id=' + loanId,
                method: 'GET',
                dataType: 'json'
            }).done(function(response) {
                var loan = response.loanvalue;
                // Populate print section
                $('#print-name').text(loan.first_name + ' ' + loan.last_name);
                $('#print-empid').text(loan.emp_id);
                $('#print-amount').text(loan.amount);
                $('#print-installment').text(loan.installment);
                $('#print-totalpay').text(loan.total_pay);
                $('#print-totaldue').text(loan.total_due);
                $('#print-appdate').text(loan.approve_date);
                $('#print-status').text(loan.status);
                $('#print-details').text(loan.loan_details);

                // Open print dialog
                var printContents = document.getElementById('print-section').innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload(); // Reload page to restore DataTable
            });
        });
    });
</script>

<?php $this->load->view('backend/footer'); ?>

<script>
    // Initialize DataTable for loan list with export buttons
    $('#loan123').DataTable({
        "aaSorting": [[6,'desc']], // Sort by approve date descending
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>

