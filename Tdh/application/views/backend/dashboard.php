<?php 
// Load the header view
$this->load->view('backend/header'); 
?>

<?php 
// Load the sidebar view
$this->load->view('backend/sidebar'); 
?>

<div class="page-wrapper" style="background-color: #FFF3E0; color: #000;">
    <div class="message"></div>

    <!-- Page title and breadcrumb -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">
                <i class="fa fa-braille" style="color:#FF8C00;"></i>&nbsp Dashboard
            </h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb" style="background-color:#FFE0B2; color:#000;">
                <li class="breadcrumb-item"><a href="javascript:void(0)" style="color:#000;">Home</a></li>
                <li class="breadcrumb-item active" style="color:#000;">Dashboard</li>
            </ol>
        </div>
    </div>

    <div class="container-fluid">
        <!-- First Row of Cards -->
        <div class="row">
            <!-- Active Employees Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card" style="background-color:#FFCC80; color:#000;">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-primary" style="background-color:#FFB84D;"><i class="ti-user"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0">
                                    <?php 
                                    $this->db->where('status','ACTIVE');
                                    $this->db->from("employee");
                                    echo $this->db->count_all_results();
                                    ?> Employees
                                </h3>
                                <a href="" class="text-muted m-b-0" style="color:#000;">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Approved Leaves Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card" style="background-color:#FFCC80; color:#000;">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-info" style="background-color:#FFB84D;"><i class="ti-file"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0">
                                    <?php 
                                    $this->db->where('leave_status','Approve');
                                    $this->db->from("emp_leave");
                                    echo $this->db->count_all_results();
                                    ?> Leaves
                                </h3>
                                <a href="<?php echo base_url(); ?>leave/Application" class="text-muted m-b-0" style="color:#000;">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Granted Loan Card -->
            <div class="col-lg-3 col-md-6">
                <div class="card" style="background-color:#FFCC80; color:#000;">
                    <div class="card-body">
                        <div class="d-flex flex-row">
                            <div class="round align-self-center round-success" style="background-color:#FFB84D;"><i class="ti-money"></i></div>
                            <div class="m-l-10 align-self-center">
                                <h3 class="m-b-0">
                                    <?php 
                                    $this->db->where('status','Granted');
                                    $this->db->from("loan");
                                    echo $this->db->count_all_results();
                                    ?> Loan 
                                </h3>
                                <a href="" class="text-muted m-b-0" style="color:#000;">View Details</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of first row -->

        <!-- Second Row of Cards -->
        <div class="row">
            <!-- Pending Leave Application -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card card-inverse" style="background-color:#FFB84D; color:#000;">
                    <div class="box text-center">
                        <h1 class="font-light text-black">
                            <?php 
                            $this->db->where('leave_status','Not Approve');
                            $this->db->from("emp_leave");
                            echo $this->db->count_all_results();
                            ?> 
                        </h1>
                        <h6 class="text-black">Pending Leave Application</h6>
                    </div>
                </div>
            </div>

            <!-- Loan Application -->
            <div class="col-md-6 col-lg-3 col-xlg-3">
                <div class="card card-inverse" style="background-color:#FFB84D; color:#000;">
                    <div class="box text-center">
                        <h1 class="font-light text-black">
                            <?php 
                            $this->db->where('status','Granted');
                            $this->db->from("loan");
                            echo $this->db->count_all_results();
                            ?> 
                        </h1>
                        <h6 class="text-black">Loan Application</h6>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of second row -->

        <?php 
        // Fetch data
        $notice = $this->notice_model->GetNoticelimit(); 
        $running = $this->dashboard_model->GetRunningProject(); 
        $userid = $this->session->userdata('user_login_id'); 
        $todolist = $this->dashboard_model->GettodoInfo($userid); 
        $holiday = $this->dashboard_model->GetHolidayInfo(); 
        ?>

        <!-- To-Do List Section -->
        <div class="row">
            <div class="col-lg-4">
                <div class="card" style="background-color:#FFCC80; color:#000;">
                    <div class="card-body">
                        <h4 class="card-title">To Do list</h4>
                        <h6 class="card-subtitle">Urgent Tasks for the Company</h6>
                        <div class="to-do-widget m-t-20" style="height:550px; overflow-y:scroll">
                            <ul class="list-task todo-list list-group m-b-0" data-role="tasklist">
                                <?php foreach($todolist as $value): ?>
                                <li class="list-group-item" data-role="task" style="background-color:#FFE0B2;">
                                    <?php if($value->value == '1'){ ?>
                                    <div class="checkbox checkbox-info">
                                        <input class="to-do" data-id="<?php echo $value->id?>" data-value="0" type="checkbox" id="<?php echo $value->id?>" >
                                        <label for="<?php echo $value->id?>"><span><?php echo $value->to_dodata; ?></span></label>
                                    </div>
                                    <?php } else { ?>
                                    <div class="checkbox checkbox-info">
                                        <input class="to-do" data-id="<?php echo $value->id?>" data-value="1" type="checkbox" id="<?php echo $value->id?>" checked>
                                        <label class="task-done" for="<?php echo $value->id?>"><span><?php echo $value->to_dodata; ?></span></label>
                                    </div> 
                                    <?php } ?>                                                   
                                </li>
                                <?php endforeach; ?>
                            </ul>                                    
                        </div>

                        <div class="new-todo">
                            <form method="post" action="add_todo" enctype="multipart/form-data" id="add_todo">
                                <div class="input-group">
                                    <input type="text" name="todo_data" class="form-control" style="border:1px solid #000 !important;" placeholder="Type here ...">
                                    <span class="input-group-btn">
                                        <input type="hidden" name="userid" value="<?php echo $userid; ?>">
                                        <button type="submit" class="btn btn-success todo-submit"><i class="fa fa-plus"></i></button>
                                    </span> 
                                </div>
                            </form>
                        </div>                                
                    </div>
                </div>
            </div>
        </div>
        <!-- End of To-Do List Section -->

        <script>
        $(".to-do").on("click", function(){
            $.ajax({
                url: "Update_Todo",
                type:"POST",
                data: {
                    'toid': $(this).attr('data-id'),
                    'tovalue': $(this).attr('data-value'),
                },
                success: function(response) {
                    location.reload();
                },
                error: function(response) {
                    console.error();
                }
            });
        });			
        </script>                                               

<?php 
// Load the footer
$this->load->view('backend/footer'); 
?>
