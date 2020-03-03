<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistik extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->model("Statistik_Model");
        $daerah = $this->Statistik_Model->getDaerah();
		$operasi = $this->Statistik_Model->getRingkasanOperasi();
		$ladang = $this->Statistik_Model->getLadang()->num_rows();
		
		$chart = array();
		$barChart = array();
		$percent = array();
		$count = 0;
		
        foreach($daerah as $d){
				array_push($chart,array("$d->daerah" , $this->Statistik_Model->getLadangByDaerah($d->daerah)));
		}

		foreach($operasi as $bt){
			$ringkasanOperasi = array();
			foreach($daerah as $d){
				array_push($ringkasanOperasi,array($this->Statistik_Model->getLadangByDaerahDanOperasi($d->daerah,$bt->ringkasan_operasi)));
			}
			array_push($percent, array($bt->ringkasan_operasi,($this->Statistik_Model->getLadangByOperasi($bt->ringkasan_operasi)/$ladang)*100));
			array_push($barChart, array("$bt->ringkasan_operasi",$ringkasanOperasi));			
		}

		$container["jumlahLadang"] = $ladang;
		$container["percent"] = $percent;
		$container["jenisOperasi"] = $operasi;
		$container["chart"] = $chart;
		$container["barChart"] = $barChart;
        
		$this->template->load('template/template_body','statistik/ladang',$container);
		
	}

	public function hazardousWaste()
	{
        $this->load->model("Statistik_Model");
		//$this->template->load('template/template_body', 'welcome_message');
		//$this->output->enable_profiler(TRUE);
        $daerah = $this->Statistik_Model->getDistinctDaerahHazardous();
		$license = $this->Statistik_Model->getDistinctLicenseHazardous();
		
		$hazardous = $this->Statistik_Model->getHazardous()->num_rows();
		
		$chart = array();

		$barChart = array();
		

        foreach($daerah as $d){
				array_push($chart,array("$d->daerah" , $this->Statistik_Model->getHazardousByDaerah($d->daerah)));
		}

		foreach($license as $bt){
			$ringkasanLicense = array();
			foreach($daerah as $d){
				array_push($ringkasanLicense,array($this->Statistik_Model->getHazardousByDaerahDanLicense($d->daerah,$bt->type_license)));
			}
			array_push($barChart, array("$bt->type_license",$ringkasanLicense));			
		}

		$container["jumlahHazardous"] = $hazardous;
		$container["chart"] = $chart;
		$container["barChart"] = $barChart;
        
		$this->template->load('template/template_body','statistik/hazardous',$container);
		
	}

	public function householdWaste()
	{
        $this->load->model("Statistik_Model");
		$daerah = $this->Statistik_Model->getDistinctDaerahHousehold();
		#$this->output->enable_profiler(TRUE);
		$household = $this->Statistik_Model->getHousehold()->num_rows();

		$chart = array();
        foreach($daerah as $d){
				array_push($chart,array("$d->daerah" , $this->Statistik_Model->getHouseholdByDaerah($d->daerah)));
		}

		$container["chart"] = $chart;

		$barChart = array();

		
		$type_name = array("TV", "Refigerator","Washing Machine","Air Conditioner","Computer", "Mobile Phone" , "Lain-lain");
		$column = array("tv","refrigerator","washing_machine","air_conditioner","computer","mobile_phone","others");
		
		$i = 0;
		
		$ringkasanJenisColumn = array();
		foreach($column as $bt){

			array_push($barChart, array("$type_name[$i]",$this->Statistik_Model->getHouseholdByColumn($column[$i])));
			$i++;		
		}

		
		
		$container["daerah"] = $daerah;
		$container["jumlahHousehold"] = $household;
		$container["barChart"] = $barChart;
		
		$this->template->load('template/template_body','statistik/household',$container);
		
	}
        
}
