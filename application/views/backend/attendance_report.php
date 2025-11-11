<?php $this->load->view('backend/header'); ?>
<?php $this->load->view('backend/sidebar'); ?>
<div class="page-wrapper">
    <div class="message"></div>
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Attendance</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Attendance</li>
            </ol>
        </div>
    </div>
    <div class="container-fluid">

        <div class="row m-b-10"> 
            <div class="col-12">
                
                <button type="button" class="btn btn-info">
                    <a href="<?php echo base_url(); ?>attendance/Attendance_Report" class="text-white"> Attendance Report </a>
                </button>
            </div>
        </div>  

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Attendance Report</h4>
                        <form method="post" action="Get_attendance_data_for_report" class="form-material row">
                            <div class="form-group col-md-3">
                                <input type="text" name="date_from" id="date_from" class="form-control mydatetimepickerFull" placeholder="from">
                            </div>
                            <div class="form-group col-md-3">
                                <input type="text" name="date_to" id="date_to" class="form-control mydatetimepickerFull" placeholder="to">
                            </div>
                            <div class="form-group col-md-3">
                                <select class="form-control custom-select" tabindex="1" name="emid" id="employee_id" required>
                                    <option value="">Select Employee</option>
                                    <?php foreach($employee as $value): ?>
                                    <option value="<?php echo $value->em_id; ?>">
                                        <?php echo $value->first_name ?> <?php echo $value->last_name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-3 form-group">
                                <input type="submit" class="btn btn-success" value="Submit" name="submit" id="getAtdReport">
                                <button type="button" class="btn btn-primary" id="printAttendance">Print</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body EmployeeInfo">
                        <h3 class="employee_name">Employee</h3>
                        Worked <span class="hours"></span> Hours
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Full attendance</h4>
                        <div class="table-responsive">
                            <table id="example234" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                    <tr>
                                        <th>Employee ID</th>
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>In</th>
                                        <th>Out</th>
                                        <th>Hour</th>
                                        <th>Place</th>
                                    </tr>
                                </thead>
                                <tbody class="leave"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?php $this->load->view('backend/footer'); ?>

<script type="text/javascript">
var attendanceData = {}; // global to store report data

$(document).ready(function() {
    // Fetch attendance data
    $("#getAtdReport").click(function(e) {
        e.preventDefault();
        var date_from = $('#date_from').val();
        var date_to = $('#date_to').val();
        var employee_id = $('#employee_id').val();

        if(!employee_id) { alert("Please select an employee."); return; }

        $.ajax({
            url: 'Get_attendance_data_for_report',
            method: 'POST',
            data: {
                date_from: date_from,
                date_to: date_to,
                employee_id: employee_id
            }
        }).done(function(response) {
            var data = JSON.parse(response);
            attendanceData = data; // store globally for print

            var name = $('.EmployeeInfo .employee_name');
            var hours = $('.EmployeeInfo .hours');

            name.text(data.name);
            hours.text(Math.abs(data.hours[0].Hours));

            $('#example234').dataTable({
                "bDestroy": true,
                "aaData": data.attendance.filter(r => r.name === data.name), // show only selected employee
                "columns": [
                    { "data": "em_code" },
                    { "data": "name" },
                    { "data": "atten_date" },
                    { "data": "signin_time" },
                    { "data": "signout_time" },
                    { "data": "Hours" },
                    { "data": "place" }
                ]
            });
        });
    });

    // Print button
    $("#printAttendance").click(function() {
        if(!attendanceData.attendance) { alert("No data to print."); return; }

        var employeeName = attendanceData.name;
        var totalHours = attendanceData.hours[0].Hours;
        var tableDataFiltered = attendanceData.attendance.filter(r => r.name === employeeName);

        var printTable = "<table class='table table-bordered table-striped table-hover'>" +
                         "<thead class='thead-dark'><tr>" +
                         "<th>Employee ID</th><th>Name</th><th>Date</th><th>In</th><th>Out</th><th>Hour</th><th>Place</th>" +
                         "</tr></thead><tbody>";

        tableDataFiltered.forEach(function(row) {
            printTable += "<tr>" +
                          "<td>" + row.em_code + "</td>" +
                          "<td>" + row.name + "</td>" +
                          "<td>" + row.atten_date + "</td>" +
                          "<td>" + row.signin_time + "</td>" +
                          "<td>" + row.signout_time + "</td>" +
                          "<td>" + row.Hours + "</td>" +
                          "<td>" + row.place + "</td>" +
                          "</tr>";
        });
        printTable += "</tbody></table>";

        var newWin = window.open("");
        newWin.document.write("<html><head><title>Print Attendance</title>");
        newWin.document.write("<link rel='stylesheet' href='<?php echo base_url(); ?>assets/css/bootstrap.min.css'>");
        newWin.document.write("<style>");
        newWin.document.write("body { font-family: Arial, sans-serif; margin: 30px; }");
        newWin.document.write("h1 { text-align: center; margin-bottom: 5px; font-size: 28px; color: #343a40; }");
        newWin.document.write("h3 { text-align: center; margin-bottom: 20px; font-size: 22px; color: #495057; }");
        newWin.document.write("p { font-size: 16px; text-align: center; margin-bottom: 20px; }");
        newWin.document.write("table { width: 100%; margin-top: 10px; border-collapse: collapse; }");
        newWin.document.write("th, td { padding: 12px; text-align: center; border: 1px solid #dee2e6; }");
        newWin.document.write(".thead-dark th { background-color: #343a40; color: white; }");
        newWin.document.write("tr:nth-child(even) { background-color: #f8f9fa; }");
        newWin.document.write("tr:hover { background-color: #e9ecef; }");
        newWin.document.write("</style>");
        newWin.document.write("</head><body>");
        newWin.document.write("<h1>Turkish Doner House</h1>");
        newWin.document.write("<h3>Attendance Report</h3>");
        newWin.document.write("<p><strong>Employee:</strong> " + employeeName + "<br><strong>Total Hours Worked:</strong> " + totalHours + "</p>");
        newWin.document.write(printTable);
        newWin.document.write("</body></html>");
        newWin.document.close();
        newWin.print();
    });
});
</script>

