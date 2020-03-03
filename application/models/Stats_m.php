<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Stats_m extends MY_Model {

    function get_total_type_industries($jenis, $daerah=NULL)
    {
        $this->db->like('jenis_industri', $jenis);
        if($daerah != NULL){
            $this->db->where('daerah', $daerah);
        }
        
        $query = $this->db->get_where('industri');

        return $query->num_rows();
    }

    function get_list_hazardous_waste()
    { 
        $query = $this->db->get('hazardous_waste_location');

        return $query->result();
    }

    // function get_list_population()
    // {
    //     $query = $this->db->get('taburan_penduduk');

    //     return $query->result();
    // }

    function get_total_population_bandar($tahun, $daerah)
    {
        $this->db->where('tahun', $tahun);
        $this->db->where('daerah', $daerah);
        $query = $this->db->get_where('taburan_penduduk');

        return $query->row()->bandar;
    }

    function get_total_population_luar_bandar($tahun, $daerah)
    {
        $this->db->where('tahun', $tahun);
        $this->db->where('daerah', $daerah);
        $query = $this->db->get_where('taburan_penduduk');

        return $query->row()->luar_bandar;
    }

    function get_total_population_kepadatan($tahun, $daerah)
    {
        $this->db->where('tahun', $tahun);
        $this->db->where('daerah', $daerah);
        $query = $this->db->get_where('taburan_penduduk');

        return $query->row()->kepadatan_penduduk;
    }
}

?>