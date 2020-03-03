<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sungai_m extends MY_Model {

    function get_by_class()
    {
        $this->db->order_by('class', 'DESC');
        $query = $this->db->get('2016_kualiti_sungai');

        return $query->result();
    }

    function get_total_by_class($class)
    {
        $query = $this->db->get_where('2016_kualiti_sungai', array('class' => $class));

        return $query->num_rows();

    }

    // function get_list_hazardous_waste()
    // { 
    //     $query = $this->db->get('hazardous_waste_location');

    //     return $query->result();
    // }

    // // function get_list_population()
    // // {
    // //     $query = $this->db->get('taburan_penduduk');

    // //     return $query->result();
    // // }

    // function get_total_population_bandar($tahun, $daerah)
    // {
    //     $this->db->where('tahun', $tahun);
    //     $this->db->where('daerah', $daerah);
    //     $query = $this->db->get_where('taburan_penduduk');

    //     return $query->row()->bandar;
    // }

    // function get_total_population_luar_bandar($tahun, $daerah)
    // {
    //     $this->db->where('tahun', $tahun);
    //     $this->db->where('daerah', $daerah);
    //     $query = $this->db->get_where('taburan_penduduk');

    //     return $query->row()->luar_bandar;
    // }

    // function get_total_population_kepadatan($tahun, $daerah)
    // {
    //     $this->db->where('tahun', $tahun);
    //     $this->db->where('daerah', $daerah);
    //     $query = $this->db->get_where('taburan_penduduk');

    //     return $query->row()->kepadatan_penduduk;
    // }












    function login_user($username, $password) {
        $this->db->where('user', $username);
        $result = $this->db->get('industry');
        $row = $result->row();

        if (!$row) {
            // tiada rekod ditemui
            return false;
        }

        $db_password = $result->row()->password;

        if (password_verify($password, $db_password)) {
            return $result->row(0)->id;
        } else {
            echo 'password fail verify';
            return false;
        }
    }

    function find_premiseInEKAS($namapremis, $nofailjas) {
        //$this->load->database('ekas', TRUE);
        $ekasdb = $this->load->database('ekas', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.

        $ekasdb->where('NOFAILJAS', $nofailjas);
        $ekasdb->where('STATUSPREMIS', 'Operasi');
        $ekasdb->like('NAMAPREMIS', $namapremis);

        $result = $ekasdb->get('premis');

        return $result->row();
    }

    function find_premiseInDB($namapremis, $nofailjas) {
        $this->db->where('doe_file_no', $nofailjas);
        $this->db->like('premise_name', $namapremis);

        $result = $this->db->get('industry');

        return $result->row();
    }

    function find_premiseByEmail($email, $nofailjas) {
        $this->db->where('doe_file_no', $nofailjas);
        $this->db->where('email', $email);

        $result = $this->db->get('industry');

        if ($result->num_rows() < 1) {
            return FALSE;
        }
        return $result->row();
    }

    function insert($insert_data) {
        $this->db->insert('industry', $insert_data);

        if ($this->db->affected_rows() < 1) {
            return FALSE;
        }
        return TRUE;
    }

    function sa($id) {
        $this->db->where('id', $id);
        $result = $this->db->get('industry');

        return $result->row();
    }

    function get_all() {
        
        $query = $this->db->get('industry');

        return $query->result();
    }

    function get_industries($per_page, $offset, $sortfield, $orderBy, $search_string, $id = 0) {
        if (empty($id)) {
            //echo $per_page.'fff'.$offset.'fff'.$sortfield.'fff'.$orderBy;
            if (!empty($search_string)) {
                $this->db->like('premise_name', $search_string);
                $this->db->or_like('p_alamat', $search_string);
                $this->db->or_like('p_bandar', $search_string);
                $this->db->or_like('p_negeri', $search_string);
            }
            $this->db->order_by("$sortfield", "$orderBy");
            $this->db->limit($per_page, $offset);
            $query = $this->db->get('industry');
            if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                    $data[] = $row;
                }
                return $data;
            }
            return false;
        } else {
            $query = $this->db->get_where('industry', array('id' => $id));
            return $query->row_array();
        }
    }

    public function record_count($search_string) {
        if (!empty($search_string)) {
            $this->db->like('premise_name', $search_string);
            $this->db->or_like('p_alamat', $search_string);
            $this->db->or_like('p_bandar', $search_string);
            $this->db->or_like('p_negeri', $search_string);
        }
        return $this->db->count_all_results("industry");
    }

    function delete($id) {
        parent::delete($id);
    }

    function accountIsActive($id) {
        $this->db->where('id', $id);
        $this->db->where('status', 1);
        $result = $this->db->get('industry');

        if ($result->num_rows() < 1) {
            return FALSE;
        }
        return TRUE;
    }

    public function find_cawangan($id) {
        $ekasdb = $this->load->database('ekas', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.

        $ekasdb->where('id', $id);

        $result = $ekasdb->get('cawangan_jas');

        return $result->row();
    }

    public function find_user_by_state($namapremis, $nofailjas, $state) {
        //$this->load->database('ekas', TRUE);
        $ekasdb = $this->load->database('ekas', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.

        $ekasdb->where('NOFAILJAS', $nofailjas);
        $ekasdb->where('STATUSPREMIS', 'Operasi');
        $ekasdb->where('PKODNEGERI', $state);
        $ekasdb->like('NAMAPREMIS', $namapremis);

        $result = $ekasdb->get('premis');

        return $result->row();
    }

    public function email_dont_exists($email) {
        $this->db->where('email', $email);

        $result = $this->db->get('premis_login');

        if ($result->num_rows() < 1) {
            return true; //if no row return-meaning that premise id has not been registered before
        }

        return false;
    }

    public function find_user_KPIGSR($namapremis, $nofailjas) { // Untuk Premis
        //$this->load->database('ekas', TRUE);
        $this->db->where('nofaildoe', $nofailjas);
        $this->db->like('namapremis', $namapremis);

        $result = $this->db->get('premis_login');

        return $result->row();
    }

    public function user_registered() {

        //$this->load->database('ekas', TRUE);

        $this->db->where('nofaildoe', $this->input->post('no_fail_jas'));
        $this->db->like('namapremis', $this->input->post('nama_premis'));

        $result = $this->db->get('premis_login');


        if ($result->num_rows() < 1) {

            //print_r($result->num_rows());

            return true; //if no row return-meaning that premise id has not been registered before
        }

        return false;
    }

    public function get_premise_info($premiseid) {

        $this->db->where('idpremis', $premiseid);

        $query = $this->db->get('premis_login');

        return $query->row();
    }

    //LAMA
    public function get_premise_infoEKAS($premiseid) {
        $ekasdb = $this->load->database('ekas', TRUE);
        $ekasdb->where('IDPREMIS', $premiseid);

        $query = $ekasdb->get('premis');

        return $query->row();
    }

    public function get_premise_infoEKAS_belumsiap_lagi_nakcombinetable($premiseid) {

        $this->db->select('*');
        $this->db->from('premis');
        $this->db->join('Category b', 'b.cat_id=a.cat_id', 'left');
        $this->db->join('Soundtrack c', 'c.album_id=a.album_id', 'left');
        $this->db->where('c.album_id', $id);
        $this->db->order_by('c.track_title', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }

        return $query->row();
    }

    public function add_premise($data) {
        if ($this->db->insert('premis_login', $data)) {
            return true;
        }

        return false;
    }

    public function update_premise($data, $idpremis) {
        $this->db->where('idpremis', $idpremis);

        if ($this->db->update('premis_login', $data)) {
            return true;
        }

        return false;
    }

    public function update_password($newpass, $idpremis) {
        $this->db->where('idpremis', $idpremis);
        $this->db->update('premis_login', $newpass);
    }

    public function update_pic($data, $idpremis) {
        $this->db->where('idpremis', $idpremis);
        $this->db->update('premis_login', $data);
    }

    /* 	public function findby_premiseid($premiseid){

      $this->db->where('idpremis', $premiseid);

      $query= $this->db->get('premislogin');

      if($query->num_rows() < 1) {

      return true; //if no row return-meaning that premise id has not been registered before
      }

      return false;

      } */

    public function create_user($premiseid) {

        //$this->load->database('kpigsr', TRUE);

        $option = ['cost' => 12];

        $encrypted_password = password_hash($this->input->post('password'), PASSWORD_BCRYPT, $option);


        $data = array(
//            'idpremis' => $this->input->post('idpremis'),
            'nofaildoe' => $this->input->post('no_fail_jas'),
            'namapremis' => $this->input->post('nama_premis'),
            'no_roc' => $this->input->post('no_roc'),
            'alamat' => $this->input->post('alamat'),
            'poskod' => $this->input->post('poskod'),
            'parlimen' => $this->input->post('parlimen'),
            'negeri' => $this->input->post('negeri'),
            'bandar' => $this->input->post('bandar'),
            'telefon' => $this->input->post('tel'),
            'faks' => $this->input->post('faks'),
            'kategori_premis' => $this->input->post('kategori'),
            'sic' => $this->input->post('sic'),
            'subsic' => $this->input->post('subsic'),
            'name' => $this->input->post('name'),
            'ic_no' => $this->input->post('ic_no'),
            'position' => $this->input->post('position'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => $encrypted_password
        );

        //$this->db->insert('premis_login', $data);
        $this->db->where('idpremis', $this->input->post('idpremis'));
        $this->db->update('premis_login', $data);
        return true;
    }

    public function expiry_date($premiseid) { //Date 1st login - 6 month utk siapkan EMT
        $this->db->select('register_date');
        $this->db->where('idpremis', $premiseid);

        $date_registered = $this->db->get('premis_login');

        //print_r($date_registered->row_array());
        return $date_registered->row_array();
    }

    public function premise_submitted() {
        $sql = "SELECT * FROM emt 
                LEFT JOIN premis_login ON premis_login.idpremis = emt.premis_id
                WHERE idpremis NOT IN (SELECT id_premis FROM ulasan)
                GROUP BY emt.premis_id";

        $query = $this->db->query($sql);

        return $query->result();
    }

    public function premise_completed() {
        $sql = "SELECT * FROM premis_kajian 
                LEFT JOIN premis_login ON premis_login.idpremis = premis_kajian.id_premis
               ";

        $query = $this->db->query($sql);

        return $query->result();
    }

    //dptkan emt type = Voluntarily/Compulsory
    public function get_premise_emt_type($idpremise) {
        $this->db->select('*');
        $this->db->where('idpremis', $idpremise);

        return $this->db->get('premis_login')->row()->submission_type;
    }

    public function created_date($premisid) { //get_earliest emt submitted
        $sql = "SELECT * FROM emt WHERE premis_id = ? ORDER BY created_on ASC LIMIT 1";

        $query = $this->db->query($sql, array($premisid));

        return $query->row('created_on');
    }

    public function ForgotPassword($email) {
        $this->db->select('email');
        $this->db->from('premis_login');
        $this->db->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function sendpassword($data) {
        $this->load->library('email');
        $email = $data['email'];
        $query1 = $this->db->query("SELECT *  from premis_login where email = '" . $email . "' ");
        $row = $query1->result_array();
        if ($query1->num_rows() > 0) {
            $passwordplain = "";
            $passwordplain = rand(999999999, 9999999999);

            $option = ['cost' => 12];
            $encrypted_password = password_hash($passwordplain, PASSWORD_BCRYPT, $option);

            $newpass['password'] = $encrypted_password;
            $this->db->where('email', $email);
            $this->db->update('premis_login', $newpass);
            $mail_message = 'Dear ' . $row[0]['name'] . ',' . "\r\n";
            $mail_message .= 'You have requested to reset password,<br> Your <b>Username</b> : <b>' . $row[0]['username'] . '</b>' . "\r\n";
            $mail_message .= '<br>Your <b>Temporary Password</b> is <b>' . $passwordplain . '</b>' . "\r\n";
            $mail_message .= '<br>Please update your password after this.';
            $mail_message .= '<br>Regards';
            $mail_message .= '<br>EMAINS System';

            $subject = 'EMAINS - You have requested password reset';
            //date_default_timezone_set('Etc/UTC');
            //require FCPATH . 'assets/PHPMailer/PHPMailerAutoload.php';
//            $mail = new PHPMailer;
//            $mail->isSMTP();
//            $mail->SMTPSecure = "tls";
//            $mail->Debugoutput = 'html';
//            $mail->Host = "yooursmtp";
//            $mail->Port = 587;
//            $mail->SMTPAuth = true;
//            $mail->Username = "your@email.com";
//            $mail->Password = "password";
//            $mail->setFrom('admin@site', 'admin');
//            $mail->IsHTML(true);
//            $mail->addAddress($email);

            $result = $this->email
                    ->from('emains-noreply@doe.gov.my', 'EMAINS Support')
                    //->reply_to('yoursecondemail@somedomain.com')    // Optional, an account where a human being reads.
                    ->to($email)
                    ->subject($subject)
                    ->message($mail_message)
                    ->send();

            var_dump($result);
            echo '<br />';
            echo $this->email->print_debugger();

            //exit;
//            if (!$mail->send()) {
//                $this->session->set_flashdata('msg', 'Failed to send password, please try again!');
//            } else {
//                $this->session->set_flashdata('msg', 'Password sent to your email!');
//            }
            //redirect(base_url() . 'user/Login', 'refresh');
        } else {
            $this->session->set_flashdata('err', 'Forgot Password : Email not found try again!');
            //redirect(base_url() . 'user/Login', 'refresh');
        }
    }

    public function getEmailByRoleState($state, $role) {

        $this->db->where('state', $state);
        $this->db->where('role', $role);

        $query = $this->db->get('admin');

        return $query->result_array();
    }

    function get_officer_by_email($username) { //change to username
        $query = $this->db->get_where('admin', array('username' => $username));

        if ($query->num_rows() != 0) {
            return true;
        }
    }

    function get_officer_id($username) {

        $this->db->select('*');
        $this->db->where('username', $username);

        return $this->db->get('admin')->row()->id;
    }

    function get_all_officer_by_state($state) {

        //$where = "(role='PN' OR role='PM') AND state='". $state . "'";
        $where = "(role='PN') AND state='" . $state . "'";
        $this->db->where($where);
        //$this->db->where('state', $state);
        $query = $this->db->get('admin');

        return $query->result();
    }

}

?>