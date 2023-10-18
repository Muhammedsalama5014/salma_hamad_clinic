<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Patient_model extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    // MODERATOR EMPLOYEE ALL INFORMATION
    public function save_patient($data)
    {
        $inser_data1 = array(
            'name' => $data["name"], 
            //'patient_id' => $data["patient_id"], 
            'debitbalance' => $data["debitbalance"], 
            'creditbalance' => $data["creditbalance"], 
            'tel' => $data["tel"], 
            'nationality' => $data["nationality"],   
            'job' => $data["job"],   
            'patientcase' => $data["patientcase"],   
            'knownusfrom' => $data["knownusfrom"],   
            'nationalid' => $data["nationalid"], 
            'category_id' => $data["category_id"],
            'birthday' => date("Y-m-d", strtotime($data["birthday"])),
            'sex' => $data["gender"],
            'blood_group' => $data["blood_group"],
            'blood_pressure' => $data["blood_pressure"],
            'height' => $data["height"],
            'weight' => $data["weight"],
            'marital_status' => $data["marital_status"],
            'age' => $data["age"],
            'mobileno' => $data["mobile_no"],
            'email' => $data["email"],
            'photo' => $this->app_lib->upload_image('patient'),
            'guardian' => $data["guardian"],
            'address' => $data["address"],
            'relationship' => $data["relationship"],
            'gua_mobileno' => $data["gua_mobileno"],
        );

        $inser_data2 = array('username' => $data["username"]);

        if (isset($data['form_type']) && $data['form_type'] == "add") {
        //if (!isset($data['patient_id'])) {
            //$inser_data1['patient_id'] =  $this->getPaitentId();
            ////$inser_data1['patient_id'] = substr(app_generate_hash(), 3, 7);

            // SAVE EMPLOYEE INFORMATION IN THE DATABASE
            $this->db->insert('patient', $inser_data1);
            $patient_id = $this->db->insert_id();

            // SAVE EMPLOYEE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $inser_data2['role'] = 7;
            $inser_data2['active'] = 1;
            $inser_data2['user_id'] = $patient_id;
            $inser_data2['username'] = substr(app_generate_hash(), 3, 7);
            $inser_data2['password'] = $this->app_lib->pass_hashed($data["password"]);
            $this->db->insert('login_credential', $inser_data2);
            
            return $patient_id;
        } else {
            // UPDATE ALL INFORMATION IN THE DATABASE

            $this->db->where('id', $data['patient_id']);
            $this->db->update('patient', $inser_data1);

            // UPDATE LOGIN CREDENTIAL INFORMATION IN THE DATABASE
            $this->db->where('user_id', $data['patient_id']);
            $this->db->where('role', 7);
            $this->db->update('login_credential', $inser_data2);
        }
    }

    public function addGeneralPatientId($patient_id)
    {
        if (isset($patient_id)) {
            // UPDATE ALL INFORMATION IN THE DATABASE
            $inser_data1['patient_id'] =  $this->getPaitentIdNew2();
            $this->db->where('id', $patient_id);
            $this->db->where('patient_id', null);
            $this->db->update('patient', $inser_data1);
        }
    }

    public function addGeneralPatientIdNew($patient_id)
    {
        if (isset($patient_id)) {
            // UPDATE ALL INFORMATION IN THE DATABASE
            $inser_data1['patient_id'] =  $this->getPaitentIdNew2($patient_id);
            $this->db->where('id', $patient_id);
            $this->db->where('patient_id', null);
            $this->db->update('patient', $inser_data1);
        }
    }

    public function getPaitentIdNew2 ($patient_id) {
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->where('id', $patient_id);
        $patient_data = $this->db->get()->result();

        if(isset($patient_data[0]->id)) {
            if($patient_data[0]->patient_id == ""){
                return $patient_data[0]->id;
            }else{
                return $patient_data[0]->patient_id;
            }
        }

        $this->db->select('patient_start_id');
        $this->db->from('global_settings');
        $this->db->order_by('global_settings.id', 'DESC');
        $this->db->limit(1, 0);
        $patient_start_id = $this->db->get()->result();
       
        if (isset($patient_start_id[0]->patient_start_id)) {
            return $patient_start_id[0]->patient_start_id+1;
        }
        
    }

    public function getPaitentIdNew () {
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(1, 0);

        $patient_data = $this->db->get()->result();
        if(isset($patient_data[0]->id)) {
            return $patient_data[0]->id+1;
        }

        $this->db->select('patient_start_id');
        $this->db->from('global_settings');
        $this->db->order_by('global_settings.id', 'DESC');
        $this->db->limit(1, 0);
        $patient_start_id = $this->db->get()->result();
       
        if (isset($patient_start_id[0]->patient_start_id)) {
            return $patient_start_id[0]->patient_start_id+1;
        }
        
    }

    public function getPaitentId () {
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->order_by('patient.id', 'DESC');
        $this->db->limit(1, 0);

        $patient_data = $this->db->get()->result();
        if(isset($patient_data[0]->patient_id)) {
            return $patient_data[0]->patient_id+1;
        }

        $this->db->select('patient_start_id');
        $this->db->from('global_settings');
        $this->db->order_by('global_settings.id', 'DESC');
        $this->db->limit(1, 0);
        $patient_start_id = $this->db->get()->result();
       
        if (isset($patient_start_id[0]->patient_start_id)) {
            return $patient_start_id[0]->patient_start_id+1;
        }
        
    }

    // GET STAFF ALL DETAILS
    public function get_patient_list($active = 1)
    {
        $this->db->select('patient.*,patient_category.name as category_name');
        $this->db->from('patient');
        //$this->db->join('login_credential', 'login_credential.user_id = patient.id and login_credential.role = "7"', 'inner');
        $this->db->join('patient_category', 'patient_category.id = patient.category_id', 'left');
        //$this->db->where('login_credential.active', $active);
        $this->db->order_by('patient.id', 'ASC');
        return $this->db->get()->result();
    }

    // GET STAFF ALL DETAILS
    public function get_patient_list_by_number($mobileno)
    {
        $this->db->select('*');
        $this->db->from('patient');
        $this->db->where('mobileno', $mobileno);
        return $this->db->get()->result();
    }
    
    

    public function get_single_patient2($id)
    {
        $this->db->select('patient.*,patient_category.name as category_name,login_credential.role as role_id,login_credential.active,login_credential.username,login_credential.id as login_id, roles.name as role');
        $this->db->from('patient');
        $this->db->join('login_credential', 'login_credential.user_id = patient.id and login_credential.role = "7"', 'left');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('patient_category', 'patient_category.id = patient.category_id', 'left');
        $this->db->where('patient.id', $id);
        return $this->db->get()->row_array();
    }

    public function get_single_patient($id)
    {
        $this->db->select('patient.*,patient_category.name as category_name,login_credential.role as role_id,login_credential.active,login_credential.username,login_credential.id as login_id, roles.name as role');
        $this->db->from('patient');
        $this->db->join('login_credential', 'login_credential.user_id = patient.id and login_credential.role = "7"', 'inner');
        $this->db->join('roles', 'roles.id = login_credential.role', 'left');
        $this->db->join('patient_category', 'patient_category.id = patient.category_id', 'left');
        $this->db->where('patient.id', $id);
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
