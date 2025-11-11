<?php 
// Load the header view of the backend (includes top navigation, CSS, JS)
$this->load->view('backend/header'); 
?>

<?php 
// Load the sidebar view of the backend (includes side menu)
$this->load->view('backend/sidebar'); 
?>

<div class="page-wrapper">
    <!-- Message container to display success/error notifications -->
    <div class="message"></div>

    <!-- Page title and breadcrumb navigation -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <!-- Page heading with an icon -->
            <h3 class="text-themecolor"><i class="fa fa-archive" aria-hidden="true"></i> Branches</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <!-- Breadcrumb navigation -->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Branche</li>
            </ol>
        </div>
    </div>

    <?php
    /* 
    Example commented out PHP code for generating dates. 
    This section is not active but may be used for reference in date-related operations.
    $startDate = strtotime('2015-06-21');
    $endDate = strtotime('2015-08-01');
    for($i = $startDate; $i <= $endDate; $i = strtotime('+1 day', $i))
        echo date('Y-m-d',$i);
    
    if($result == "Friday"){  
        echo date("Y-m-d", strtotime($i)). " ".$result."<br>";
    }
    */
    ?>

    <div class="container-fluid">
        <!-- Buttons row for adding branches or viewing messages -->
        <div class="row m-b-10"> 
            <div class="col-12">
                <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                    <!-- Employees do not see Add/View buttons -->
                <?php } else { ?>
                    <!-- Add Branch button opens modal -->
                    <button type="button" class="btn" style="background-color:orange; border-color:orange; color:white;">
                        <i class="fa fa-plus"></i>
                        <a data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap" class="text-white">
                            <i class="" aria-hidden="true"></i> Send message 
                        </a>
                    </button>

                    <!-- View Messages button redirects to All_Tasks page -->
                    

                    <!-- Commented out Field Visit button (not currently used) -->
                    <!--
                    <button type="button" class="btn" style="background-color:orange; border-color:orange; color:white;">
                        <i class="fa fa-bars"></i>
                        <a href="<?php echo base_url(); ?>Projects/All_Tasks" class="text-white">
                            <i class="" aria-hidden="true"></i> Field Visit
                        </a>
                    </button>
                    -->
                <?php } ?>
            </div>
        </div>

        <!-- Branch List Table -->
        <div class="row">
            <div class="col-12">
                <div class="card card-outline-info">
                    <div class="card-header">
                        <h4 class="m-b-0 text-white"> Branche List </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- Table displaying all branches -->
                            <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Branche Name</th>
                                        <th>Status</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($projects as $value): ?>
                                    <tr>
                                        <!-- Display only first 50 characters of branch name -->
                                        <td><?php echo substr($value->pro_name,0,50).'....' ?></td>

                                        <!-- Display branch status (upcoming, running, complete) -->
                                        <td><?php echo $value->pro_status ?></td>

                                        <!-- Display formatted start date -->
                                        <td><?php echo date('jS \of F Y',strtotime($value->pro_start_date)); ?></td>

                                        <!-- Display formatted end date -->
                                        <td><?php echo date('jS \of F Y',strtotime($value->pro_end_date)) ?></td>

                                        <!-- Action buttons: Edit and Delete -->
                                        <td class="jsgrid-align-center">
                                            <!-- Edit button links to view page -->
                                            <a href="view?P=<?php echo base64_encode($value->id); ?>" title="Edit" class="btn btn-sm btn-primary waves-effect waves-light">
                                                <i class="fa fa-pencil-square-o"></i>
                                            </a>

                                            <!-- Delete button (currently hidden via display:none) -->
                                            <a href="pDelet?D=<?php echo base64_encode($value->id); ?>" title="Delete" onclick="alert('Are You Sure12 To Delete This Project?')" class="btn btn-sm btn-danger waves-effect waves-light projectdelet" style="display:none;">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div> <!-- end table-responsive -->
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-12 -->
        </div> <!-- end row -->

        <!-- Modal: Add New Branch -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <!-- Modal title -->
                        <h4 class="modal-title" id="exampleModalLabel1"><i class="fa fa-braille"></i> Add Branches</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>

                    <!-- Form to submit new branch -->
                    <form method="post" action="Add_Projects" id="btnSubmit" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="row">
                                <!-- Left column of form -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Branche Name </label>
                                        <input type="text" name="protitle" class="form-control" id="recipient-name1" minlength="8" maxlength="250" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> Start Date</label>
                                        <input type="text" name="startdate" class="form-control datepicker" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label"> End Date</label>
                                        <input type="text" name="enddate" class="form-control datepicker" required placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Summary</label>
                                        <textarea class="form-control" name="summery" placeholder=""></textarea>
                                    </div>
                                </div>
 
                                <!-- Right column of form -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="message-text" class="control-label">Details</label>
                                        <textarea class="form-control" name="details" minlength="10" maxlength="1300" rows="8" placeholder=""></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                      <select class="form-control custom-select" data-placeholder="Choose a Category" tabindex="1" name="prostatus" required>
    <option value="upcoming">upcoming</option>
<option value="complete">complete</option>
<option value="running">running</option>


</select>

                                    </div>
                                </div>
                            </div> <!-- end row -->
                        </div> <!-- end modal-body -->

                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div> <!-- end modal-content -->
            </div> <!-- end modal-dialog -->
        </div> <!-- end modal -->

<?php 
// Load the backend footer (includes scripts and closing HTML tags)
$this->load->view('backend/footer'); 
?>
