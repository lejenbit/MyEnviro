<?php
class Statistik_Model extends CI_Model {

public function getLadang(){
        return $this->db->get("ladang");
}
public function getDaerah()
{
                $this->db->distinct();
                $this->db->select('daerah');
                return $this->db->get("ladang")->result();
}

public function getRingkasanOperasi()
{
                $this->db->distinct();
                $this->db->select('ringkasan_operasi');
                return $this->db->get("ladang")->result();
 }

public function getLadangByDaerah($daerah)
{        
        $this->db->where("daerah","$daerah");
        return $this->db->get("ladang")->num_rows();
        
}

public function getLadangByOperasi($operasi)
{        
        $this->db->where("ringkasan_operasi","$operasi");
        return $this->db->get("ladang")->num_rows();
        
}

public function getLadangByDaerahDanOperasi($daerah,$operasi)
{        
        $this->db->where("daerah","$daerah");
        $this->db->where("ringkasan_operasi","$operasi");
        return $this->db->get("ladang")->num_rows();
        
}


public function getHazardous()
{
        return $this->db->get("hazardous_waste_location");
}

public function getDistinctDaerahHazardous()
{
        $this->db->distinct();
        $this->db->select('daerah');
        return $this->db->get("hazardous_waste_location")->result();
}

public function getDistinctLicenseHazardous()
{
        $this->db->distinct();
        $this->db->select('type_license');
        return $this->db->get("hazardous_waste_location")->result();
}

public function getHazardousByDaerah($daerah)
{        
        $this->db->where("daerah","$daerah");
        return $this->db->get("hazardous_waste_location")->num_rows();
        
}

public function getHazardousByDaerahDanLicense($daerah,$license)
{        
        $this->db->where("daerah","$daerah");
        $this->db->where("type_license","$license");
        return $this->db->get("hazardous_waste_location")->num_rows();
        
}

public function getHousehold(){
        return $this->db->get("household_ewaste");
}

public function getDistinctDaerahHousehold()
{
        $this->db->distinct();
        $this->db->select('daerah');
        return $this->db->get("household_ewaste")->result();
}

public function getHouseholdByDaerah($daerah)
{        
        $this->db->where("daerah","$daerah");
        return $this->db->get("household_ewaste")->num_rows();
        
}

public function getHouseholdByDaerahDanColumn($daerah,$column)
{        
        $this->db->where("daerah","$daerah");
        $this->db->where("$column IS NOT NULL",NULL, false);
        return $this->db->get("household_ewaste")->num_rows();
        
}

public function getHouseholdByColumn($column)
{        
        $this->db->where("$column !="," ");
        return $this->db->get("household_ewaste")->num_rows();
        
}


}