<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?> 

<div class="message"></div>
<div class="page-wrapper">

    <div class="container-fluid">

        <!-- Page Title & Breadcrumbs -->
        <div class="row page-titles">
            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor"><i class="fa fa-compass" style="color:#1976d2"></i> Disciplinary</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                    <li class="breadcrumb-item active">Disciplinary</li>
                </ol>
            </div>
        </div>

        <!-- Add Disciplinary Button -->
        <div class="row m-b-10"> 
            <div class="col-12">
                <button type="button" class="btn btn-info">
                    <i class="fa fa-plus"></i>
                    <a data-toggle="modal" data-target="#exampleModal" class="text-white">Add Disciplinary</a>
                </button>
            </div>
        </div>         

        <!-- Disciplinary List Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white">Disciplinary Action List</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered printable" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>Employee ID</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($desciplinary as $value): ?>
                                    <tr>
                                        <td><?php echo $value->first_name.' '.$value->last_name; ?></td>
                                        <td><?php echo $value->em_code; ?></td>
                                        <td><?php echo $value->title; ?></td>
                                        <td style="white-space: normal; word-wrap: break-word;"><?php echo $value->description; ?></td>
                                        <td><button class="btn btn-sm btn-success"><?php echo $value->action; ?></button></td>
                                        <td class="jsgrid-align-center">
                                            <a href="#" class="btn btn-sm btn-primary disiplinary" data-id="<?php echo $value->id; ?>" title="Edit">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-info print-btn" data-id="<?php echo $value->id; ?>" title="Print">
                                                <i class="fa fa-print"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLabel1">Disciplinary Notice</h4>
                                            <button type="button" class="close" data-dismiss="modal"><span>&times;</span></button>
                                        </div>
                                        <form method="post" action="add_Desciplinary" id="btnSubmit">
                                            <div class="modal-body">

                                                <div class="form-group">
                                                    <label>Employee Name</label>
                                                    <input type="text" name="emp_name" class="form-control" placeholder="Enter employee name" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Employee ID</label>
                                                    <input type="text" name="emp_id" class="form-control" placeholder="Enter employee ID" required>
                                                </div>

                                                <div class="form-group">
                                                    <label>Disciplinary Action</label>
                                                    <select class="form-control" name="warning" required>
                                                        <option value="Verbel Warning">Verbel Warning</option>
                                                        <option value="Writing Warning">Writing Warning</option>
                                                        <option value="Demotion">Demotion</option>
                                                        <option value="Suspension">Suspension</option>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" name="title" class="form-control">
                                                </div>

                                                <div class="form-group">
                                                    <label>Details</label>
                                                    <textarea class="form-control" name="details" rows="6"></textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" name="id" value="">
                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- /.modal -->

                        </div>
                    </div>
                </div>
            </div>
        </div>

</div>

<script>
$(document).ready(function () {

    // Edit disciplinary
    $(".disiplinary").click(function (e) {
        e.preventDefault();
        var iid = $(this).data('id');
        $('#btnSubmit').trigger("reset");
        $('#exampleModal').modal('show');

        $.ajax({
            url: 'DisiplinaryByID?id=' + iid,
            method: 'GET',
            dataType: 'json',
            success: function(response){
                $('#btnSubmit').find('[name="id"]').val(response.desipplinary.id);
                $('#btnSubmit').find('[name="title"]').val(response.desipplinary.title);
                $('#btnSubmit').find('[name="details"]').val(response.desipplinary.description);
                $('#btnSubmit').find('[name="warning"]').val(response.desipplinary.action);
                // Employee Name/ID left blank for manual entry
            }
        });
    });

    // Print disciplinary notice
    $(".print-btn").click(function(){
        var id = $(this).data('id');

        $.ajax({
            url: 'DisiplinaryByID?id=' + id,
            method: 'GET',
            dataType: 'json',
            success: function(response){
                var printContent = `
                    <div style="font-family: Arial, sans-serif; padding:30px; border:2px solid #000; max-width:800px; margin:auto;">
                        <div style="text-align:center; margin-bottom:10px;">
                            <img src="<?php echo base_url('assets/images/TDH (3).png'); ?>" alt="Company Logo" style="max-height:80px;">
                        </div>
                        <h1 style="text-align:center; color:#ff9800; margin-bottom:5px;">Turkish Doner House</h1>
                        <h3 style="text-align:center; text-decoration: underline; margin-bottom:30px;">Disciplinary Notice</h3>

                        <p><strong>Employee Name:</strong> ____________________________</p>
                        <p><strong>Employee ID:</strong> ____________________________</p>
                        <p><strong>Title:</strong> ${response.desipplinary.title}</p>
                        <p><strong>Action:</strong> ${response.desipplinary.action}</p>
                        <p><strong>Description:</strong></p>
                        <p style="margin-left:20px; white-space: pre-wrap;">${response.desipplinary.description}</p>

                        <p><strong>Reference Policy:</strong> Company HR & Disciplinary Guidelines</p>
                        <p><strong>Issued by:</strong> TDH Management</p>
                        <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>

                        <br><br>
                        <div style="display:flex; justify-content:space-between; margin-top:50px;">
                            <div><strong>TDH Management Signature: ____________________</strong></div>
                            <div><strong>Employee Signature: ____________________</strong></div>
                        </div>
                    </div>
                `;

                var w = window.open('', '', 'height=700,width=900');
                w.document.write('<html><head><title>Print Disciplinary Notice</title></head><body>');
                w.document.write(printContent);
                w.document.write('</body></html>');
                w.document.close();
                w.print();
            }
        });
    });

});
</script>

<style>
.page-wrapper {
    background-color: #f0f0f0;
    padding: 20px;
}
</style>

<?php $this->load->view('backend/footer'); ?>

