<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportController extends CI_Controller {

    public function index()
    {
        // Load database
        $this->load->database();

        // Fetch attendance records
        $query = $this->db->query("
            SELECT a.*, e.employee_id AS empid, e.firstname, e.lastname
            FROM attendance a
            LEFT JOIN employees e ON e.id = a.employee_id
            ORDER BY a.date DESC, a.time_in DESC
        ");
        $data['attendance'] = $query->result_array();

        // Load view
        $this->load->view('backend/report', $data);
    }
}
