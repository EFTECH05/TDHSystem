<?php
// ---------------- DATABASE CONNECTION ----------------
$servername = "localhost"; 
$username = "u152458561_Ngangu1";
$password = "Sephor@5";
$dbname = "u152458561_apsystem";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ---------------- HTML + BOOTSTRAP ----------------
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance Report</title>
    <!-- Bootstrap CDN -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <style>
        body { background-color: #f5f5f5; padding: 20px; }
        .table th, .table td { text-align: center; vertical-align: middle; }
        .table td a { color: #337ab7; text-decoration: none; }
        .table td a:hover { text-decoration: underline; }
    </style>
</head>
<body>
<div class="container">
    <h2 class="text-center">Employee Attendance Report</h2>
    <table class="table table-bordered table-striped table-hover">
        <thead>
            <tr style="background-color:#ddd;">
                <th>Date</th>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Time In</th>
                <th>Break In</th>
                <th>Break Out</th>
                <th>Time Out</th>
                <th>Hours Worked</th>
                <th>Location</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $sql = "SELECT a.*, e.employee_id AS empid, e.firstname, e.lastname 
                FROM attendance a
                LEFT JOIN employees e ON e.id = a.employee_id
                ORDER BY a.date DESC, a.time_in DESC";
        $query = $conn->query($sql);

        while($row = $query->fetch_assoc()){
            $time_in = $row['time_in'] ? date('h:i A', strtotime($row['time_in'])) : '-';
            $break_in = $row['break_in'] ? date('h:i A', strtotime($row['break_in'])) : '-';
            $break_out = $row['break_out'] ? date('h:i A', strtotime($row['break_out'])) : '-';
            $time_out = $row['time_out'] ? date('h:i A', strtotime($row['time_out'])) : '-';

            // Calculate hours worked
            $hours_worked = '-';
            if(!empty($row['time_in']) && !empty($row['time_out'])){
                $timeIn = new DateTime($row['time_in']);
                $timeOut = new DateTime($row['time_out']);
                $interval = $timeIn->diff($timeOut);
                $totalMinutes = ($interval->h * 60) + $interval->i;

                if(!empty($row['break_in']) && !empty($row['break_out'])){
                    $breakIn = new DateTime($row['break_in']);
                    $breakOut = new DateTime($row['break_out']);
                    $breakInterval = $breakIn->diff($breakOut);
                    $breakMinutes = ($breakInterval->h * 60) + $breakInterval->i;
                    $totalMinutes -= $breakMinutes;
                }
                $hours_worked = number_format($totalMinutes / 60, 2);
            }

            // Location links
            $loc_in = !empty($row['address_in']) ? "<a href='https://www.openstreetmap.org/?mlat={$row['latitude_in']}&mlon={$row['longitude_in']}' target='_blank'>{$row['address_in']}</a>" : '-';
            $loc_break_in = !empty($row['address_break_in']) ? "<a href='https://www.openstreetmap.org/?mlat={$row['latitude_break_in']}&mlon={$row['longitude_break_in']}' target='_blank'>{$row['address_break_in']}</a>" : '-';
            $loc_break_out = !empty($row['address_break_out']) ? "<a href='https://www.openstreetmap.org/?mlat={$row['latitude_break_out']}&mlon={$row['longitude_break_out']}' target='_blank'>{$row['address_break_out']}</a>" : '-';
            $loc_out = !empty($row['address_out']) ? "<a href='https://www.openstreetmap.org/?mlat={$row['latitude_out']}&mlon={$row['longitude_out']}' target='_blank'>{$row['address_out']}</a>" : '-';

            $location = "In: $loc_in<br>Break In: $loc_break_in<br>Break Out: $loc_break_out<br>Out: $loc_out";

            echo "<tr>
                <td>".date('M d, Y', strtotime($row['date']))."</td>
                <td>{$row['empid']}</td>
                <td>{$row['firstname']} {$row['lastname']}</td>
                <td>$time_in</td>
                <td>$break_in</td>
                <td>$break_out</td>
                <td>$time_out</td>
                <td>$hours_worked</td>
                <td>$location</td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
