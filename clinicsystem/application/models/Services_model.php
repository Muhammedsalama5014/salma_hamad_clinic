<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Services_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // MODERATOR EMPLOYEE ALL INFORMATION
    public function save_services($data)
    {
        $inser_data1 = array(
            'name' => $data["name"], 
            'from_date' => $data["from_date"], 
            'to_date' => $data["to_date"], 
            'amount' => $data["amount"], 
            
        );
        if (!isset($data['id'])) {
            $this->db->insert('services', $inser_data1);
            $id = $this->db->insert_id();

            return $id;
        } else {
            // UPDATE ALL INFORMATION IN THE DATABASE
            $this->db->where('id', $data['id']);
            $this->db->update('services', $inser_data1);

        }
    }

    // GET STAFF ALL DETAILS
    public function get_services_list($active = 1)
    {
        $this->db->select('*');
        $this->db->from('services');
       
        $this->db->order_by('services.id', 'ASC');
        return $this->db->get()->result();
    }

    public function get_single_services($id)
    {
        $this->db->select('*');
        $this->db->from('services');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    public function get_bill_list($id)
    {
        $this->db->select('labtest_bill.*,SUM(total-discount+tax_amount) as net_amount,patient.name as patient_name,patient.patient_id,staff.name as referral_name,labtest_report.delivery_date,labtest_report.delivery_time,labtest_report.status as delivery_status');
        $this->db->from('labtest_bill');
        $this->db->join('labtest_report', 'labtest_report.labtest_bill_id = labtest_bill.id', 'inner');
        $this->db->join('patient', 'patient.id = labtest_bill.patient_id', 'left');
        $this->db->join('staff', 'staff.id = labtest_bill.referral_id', 'left');
        $this->db->where('labtest_bill.patient_id', $id);
        $this->db->group_by('labtest_bill.bill_no');
        $this->db->order_by('labtest_bill.id', 'ASC');
        return $this->db->get()->result_array();
    }

    public function get_search_list($text)
    {
        $this->db->select('patient.*,patient_category.name as category_name,login_credential.active as active');
        $this->db->from('patient');
        $this->db->join('login_credential', 'login_credential.user_id = patient.id and login_credential.role = "7"', 'inner');
        $this->db->join('patient_category', 'patient_category.id = patient.category_id', 'left');
        $this->db->where('login_credential.active', 1);
        $this->db->like('patient.patient_id', $text);
        $this->db->or_like('patient.address', $text);
        $this->db->or_like('patient.email', $text);
        $this->db->or_like('patient.mobileno', $text);
        $this->db->or_like('patient.sex', $text);
        $this->db->or_like('login_credential.username', $text);
        $this->db->or_like('patient_category.name', $text);
        $this->db->order_by('patient.id', 'ASC');
        return $this->db->get()->result();
    }
}
