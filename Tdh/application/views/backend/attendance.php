<?php 
// Load the common header section
$this->load->view('backend/header'); 

// Load the sidebar navigation
$this->load->view('backend/sidebar'); 
?>

<div class="page-wrapper">
    <!-- Message section (can be used to display success/error notifications) -->
    <div class="message"></div>

    <!-- Page Title and Breadcrumb -->
    <div class="row page-titles">
        <!-- Page Title with icon -->
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">
                <i class="fa fa-calendar-check-o" style="color:#1976d2"></i>Attendance
            </h3>
        </div>

        <!-- Breadcrumb navigation -->
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Attendance</li>
            </ol>
        </div>
    </div>
    <!-- End Page Title -->

    <!-- Container fluid (Main page content wrapper) -->
    <div class="container-fluid">

        <!-- Action buttons row -->
        <div class="row m-b-10"> 
            <div class="col-12">
                <!-- Button to add single attendance -->
                <button type="button" class="btn btn-info">
                    <i class="fa fa-plus"></i>
                    <a href="<?php echo base_url(); ?>attendance/Save_Attendance" class="text-white">
                        <i class="" aria-hidden="true"></i> Add Attendance 
                    </a>
                </button>

                <!-- Hidden Bulk Attendance button (not visible because of d-none class) -->
                <button type="button" class="btn btn-primary d-none">
                    <i class="fa fa-bars"></i>
                    <a href="#" class="text-white" data-toggle="modal" data-target="#Bulkmodal">
                        <i class="" aria-hidden="true"></i> Add Bulk Attendance
                    </a>
                </button>

                <!-- Button to open attendance report -->
                <button type="button" class="btn btn-info">
                    <i class="fa fa-plus"></i>
                    <a href="<?php echo base_url(); ?>attendance/Attendance_Report" class="text-white">
                        <i class="" aria-hidden="true"></i> Attendance Report 
                    </a>
                </button>
            </div>
        </div>  
        <!-- End Action buttons row -->

        <!-- Attendance List Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <!-- Table Header -->
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Attendance List </h4>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Attendance DataTable -->
                            <table id="attendance123" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Employee Name</th>
                                        <th>PIN</th>
                                        <th>Date</th>
                                        <th>Sign In</th>
                                        <th>Sign Out</th>
                                        <th>Working Hour</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <!-- Table body populated dynamically with PHP -->
                                <tbody>
                                   <?php foreach($attendancelist as $value): ?>
                                    <tr>
                                        <!-- Employee name highlighted with <mark> -->
                                        <td><mark><?php echo $value->name; ?></mark></td>
                                        <td><?php echo $value->emp_id; ?></td>
                                        <td><?php echo $value->atten_date; ?></td>
                                        <td><?php echo $value->signin_time; ?></td>
                                        <td><?php echo $value->signout_time; ?></td>
                                        <td><?php echo $value->Hours; ?></td>
                                        <td class="jsgrid-align-center">
                                            <!-- If user has not signed out yet, show "Sign Out" button -->
                                            <?php if($value->signout_time == '00:00:00') { ?>
                                                <!-- <a href="Save_Attendance?A=<?php echo $value->id; ?>" 
     title="Edit" 
     class="btn btn-sm btn-danger waves-effect waves-light" 
     data-value="Approve">Sign Out</a><br> -->
                        
                                            <?php } ?>

                                            <!-- Edit attendance button -->
                                            <a href="Save_Attendance?A=<?php echo $value->id; ?>" 
                                               title="Edit" 
                                               class="btn btn-sm btn-primary waves-effect waves-light" 
                                               data-value="Approve">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                            <!-- End DataTable -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Attendance List Table -->

        <!-- Bulk Attendance Modal (hidden by default) -->
        <div id="Bulkmodal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog">
                <div class="modal-content">
                   <!-- Form to upload CSV attendance file -->
                   <form method="post" action="import" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel">Add Attendance</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>

                        <div class="modal-body">
                            <!-- File upload instruction -->
                            <h4>
                                Import Attendance
                                <span>
                                    <img src="<?php echo base_url(); ?>assets/images/finger.jpg" height="100px" width="100px">
                                </span>
                                Upload only CSV file
                            </h4>
                            <!-- File input for CSV -->
                            <input type="file" name="csv_file" id="csv_file" accept=".csv"><br><br>
                        </div>

                        <!-- Modal footer with Save and Close buttons -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success waves-effect">Save</button>
                            <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- End Bulk Attendance Modal -->

    </div>
    <!-- End Container fluid -->
</div>

<?php 
// Load the footer section
$this->load->view('backend/footer'); 
?>

<!-- DataTables script for sorting, exporting, and printing -->
<script>
    $('#attendance123').DataTable({
        // Sort by Date column (index 2) in descending order
        "aaSorting": [[2,'desc']],
        // Enable export/print buttons
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
</script>
