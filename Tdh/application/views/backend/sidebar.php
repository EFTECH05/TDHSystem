  <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- User profile -->
                        <?php 
                        $id = $this->session->userdata('user_login_id');
                        $basicinfo = $this->employee_model->GetBasic($id); 
                        ?>                
                <div class="user-profile">
                    <!-- User profile image -->
                    <div class="profile-img"> <img src="<?php echo base_url(); ?>assets/images/users/<?php echo $basicinfo->em_image ?>" alt="user" />
                        <!-- this is blinking heartbit-->
                        <!-- <div class="notify setpos"> <span class="heartbit"></span> <span class="point"></span> </div> -->
                    </div>

                    <!-- User profile text-->
                    <div class="profile-text">
                        <h5><?php echo $basicinfo->first_name.' '.$basicinfo->last_name; ?></h5>
                      <!-- <a href="<?php echo base_url(); ?>settings/Settings" class="dropdown-toggle u-dropdown" role="button" aria-haspopup="true" aria-expanded="true"><i class="mdi mdi-settings"></i></a>   -->

                        <a href="<?php echo base_url(); ?>login/logout" class="" data-toggle="tooltip" title="Logout"><i class="mdi mdi-power"></i></a>
                    </div>
                </div>
                <!-- End User profile text    check it late -->
                <!-- Sidebar navigation employee side start  -->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li> <a href="<?php echo base_url(); ?>" ><i class="mdi mdi-gauge"></i><span class="hide-menu">Dashboard </span></a></li>
                        <?php if($this->session->userdata('user_type')=='EMPLOYEE'){ ?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="<?php echo base_url(); ?>employee/view?I=<?php echo base64_encode($basicinfo->em_id); ?>" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-rocket"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmApplication"> Leave Application </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/EmLeavesheet"> Leave Sheet </a></li>
                            </ul>
                        </li> 
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Branches </span></a>
                            <ul aria-expanded="false" class="collapse">
                              <li>
    <a href="<?php echo base_url(); ?>Projects/All_Projects">
        <i class="fa fa-envelope"></i> Messages
    </a>
</li>
<li>
    <a href="https://stock.tdhmanagementportal.co.za/">
        <i class="fa fa-shopping-cart"></i> Place Order 
    </a>
</li>
<li>
    <a href="https://stockcheck.tdhmanagementportal.co.za/admin/login.php">
        <i class="fa fa-cubes"></i> Manage your stock
    </a>
</li>

<li>
   <a href="https://contacttdh.store/forms/contact.php">
        <i class="fa fa-exclamation-triangle"></i> Report to the management
    </a>
</li>
<li>
   <a href="https://employeetimecheck.tdhmanagementportal.co.za/">
        <i class="fa fa-clock-o"></i> Start and End Your Shift
    </a>
</li>

<li>
   <a href="https://employeetimecheck.tdhmanagementportal.co.za/admin/">
        <i class="fa fa-clock-o"></i> View my daily  attendance
    </a>
</li>
<li>
    <a href="<?php echo base_url(); ?>attendance/Attendance_Report">
        <i class="fa fa-clock-o"></i>
        Monthly Attendance Report
    </a>
</li>



   <!-- Sidebar navigation employee side end   //////////////////////////////////  -->

                               
                                <!--<li><a href="<?php #echo base_url(); ?>Projects/All_Tasks"> Field Visit</a></li>-->
                            </ul>
                        </li>                                                                       
                        <?php } else { ?>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="fa fa-building-o"></i><span class="hide-menu">Organization </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url();?>organization/Department">Department </a></li>
                                <li><a href="<?php echo base_url();?>organization/Designation">Designation</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">Employees </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>employee/Employees">Employees </a></li>
                                <li><a href="<?php echo base_url(); ?>employee/Disciplinary">Disciplinary </a></li>
                               <li>
  <a href="https://admintimecheck.tdhmanagementportal.co.za/admin/home.php">
    <i class="mdi mdi-account-clock"></i>
    <span class="hide-menu">Track Employee Attendance</span>
  </a>
</li>


                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-clipboard-text"></i><span class="hide-menu">Confirm Attendance</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>attendance/Attendance">Attendance List </a></li>
                                <li><a href="<?php echo base_url(); ?>attendance/Save_Attendance">Add Attendance </a></li>
                                <li><a href="<?php echo base_url(); ?>attendance/Attendance_Report">Attendance Report </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-account-off"></i><span class="hide-menu">Leave </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>leave/Holidays"> Holiday </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/leavetypes"> Leave Type</a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Application"> Leave Application </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Earnedleave"> Earned Leave </a></li>
                                <li><a href="<?php echo base_url(); ?>leave/Leave_report"> Report </a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-briefcase-check"></i><span class="hide-menu">Branches </span></a>
                            <ul aria-expanded="false" class="collapse">
                          <li>
  <a href="<?php echo base_url(); ?>Projects/All_Projects">
    <i class="fa fa-envelope" aria-hidden="true"></i> All Messages
  </a>
</li>



                           <!-- <li>
  <a href="<?php echo base_url(); ?>Projects/All_Tasks">
    <i class="fas fa-envelope"></i> Message icon
    <span class="hide-menu">Message</span>
  </a>
</li> -->


                               <li>
  <a href="<?php echo base_url(); ?>Projects/Field_visit">
    <i class="mdi mdi-bullhorn"></i> <!-- Promotion icon -->
    <span class="hide-menu">Running Promotion</span>
  </a>
</li>

                        </li>
                       <li>
  <a class="waves-effect waves-dark" href="https://contacttdh.store/forms/contact.php">
    <i class="fas fa-clipboard"></i>
    <span class="hide-menu">Report to the Main Management</span>
  </a>
</li>
  <li>
  <a class="waves-effect waves-dark" href="https://tdhmanagementportal.cashup.space/">
    <i class="fas fa-clipboard"></i>
    <span class="hide-menu">add cash up </span>
  </a>
</li>

<!-- Include Font Awesome in your <head> if not already -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-cash"></i><span class="hide-menu">Loan </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Loan/View"> Grant Loan </a></li>
                                <li><a href="<?php echo base_url(); ?>Loan/installment"> </a></li>
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-grid"></i><span class="hide-menu">Assets </span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>Logistice/Assets_Category"> Assets Category </a></li>
                                <li><a href="<?php echo base_url(); ?>Logistice/All_Assets"> Asset List </a></li>
                                <!--<li><a href="<?php #echo base_url(); ?>Logistice/View"> Logistic Support List </a></li>-->
                               
                            </ul>
                        </li>
                        
                      <li>
  <a href="<?php echo base_url()?>notice/All_notice">
    <i class="mdi mdi-clipboard"></i>
    <span class="hide-menu">Daily  Proof</span>
  </a>
</li>
  <li>
  <a href="https://stockcheck.tdhmanagementportal.co.za/admin/login.php" target="_blank">
    <i class="mdi mdi-package-variant"></i>
    <span class="hide-menu">Manage Stock</span>
  </a>
</li>
<li>
  <a href="https://stock.tdhmanagementportal.co.za/admin/login.php" target="_blank">
    <i class="mdi mdi-cart-outline"></i>
    <span class="hide-menu">Place  your order</span>
  </a>
</li>





                       <!--
<li> <a href="<?php echo base_url(); ?>settings/Settings" ><i class="mdi mdi-settings"></i><span class="hide-menu">Settings <span class="hide-menu"></a></li>
-->

                        <?php } ?>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>