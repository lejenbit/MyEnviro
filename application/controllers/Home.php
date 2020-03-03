<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function index()
	{
        $this->template->load('template/template_gis', 'iframe_gis');
		//$this->load->view('layout');
	}

	public function dashboard()
	{
		$this->load->model('stats_m', 'stats');

		$data['hazardous'] = $this->stats->get_list_hazardous_waste();

		$data['no_of_industries_kimia'] = $this->stats->get_total_type_industries('Industri Kimia');
		$data['no_of_industries_plastik'] =  $this->stats->get_total_type_industries('Plastik');
		$data['no_of_industries_loji'] = $this->stats->get_total_type_industries('Loji');
		$data['no_of_industries_tapak'] =  $this->stats->get_total_type_industries('Tapak Pelupusan Sampah');

		$data['statscard'] = $this->load->view('template/template_statscard', $data, TRUE);

 		$this->template->load('template/template_body', 'stat', $data);
	}

	public function population()
	{
		$this->template->load('template/template_body', 'population');
	}

	public function return_industry_by_cat()
	{
		$this->load->model('stats_m', 'stats');

		$this->db->distinct();
		$this->db->select('daerah');
		$result_daerah = $this->db->get('industri')->result();

		$daerah_array = array();
		$series1['name'] = 'Industri Kimia';
		$series2['name'] = 'Plastik';
		$series3['name'] = 'Loji Kumbahan';
		$series4['name'] = 'Tapak Pelupusan Sampah';

		
        //$i = 0;
		foreach ($result_daerah as $d) {
			array_push($daerah_array, $d->daerah);
			//$series1[$i]['name'] = $d->daerah;
			$series1['data'][] = $this->stats->get_total_type_industries('Industri Kimia', $d->daerah);
			$series2['data'][] = $this->stats->get_total_type_industries('Plastik', $d->daerah);
			$series3['data'][] = $this->stats->get_total_type_industries('Loji', $d->daerah);
			$series4['data'][] = $this->stats->get_total_type_industries('Tapak Pelupusan Sampah', $d->daerah);
            //$i++;
		}

		$category = array();
		$category['name'] = 'category';
		$category['data'] = $daerah_array;

		$result = array();
		array_push($result, $category);
		array_push($result, $series1);
		array_push($result, $series2);
		array_push($result, $series3);
		array_push($result, $series4);

		print json_encode($result, JSON_NUMERIC_CHECK);		
		
		//$this->output->enable_profiler(TRUE);

	}

	public function return_population_by_cat()
	{
		$daerah = $this->input->get('id');
		$this->load->model('stats_m', 'stats');

		$this->db->distinct();
		$this->db->select('tahun');
		$this->db->order_by('tahun');
		$result_tahun = $this->db->get('taburan_penduduk')->result();
		$result_daerah = $this->db->get('taburan_penduduk')->result();

		
		$tahun_array = array();
		$series1['name'] = 'Bandar';
		$series2['name'] = 'Luar Bandar';
		$series3['name'] = 'Kepadatan';

		foreach ($result_tahun as $d) {
			array_push($tahun_array, $d->tahun);
			$series1['data'][] = $this->stats->get_total_population_bandar( $d->tahun, $daerah);
			$series2['data'][] = $this->stats->get_total_population_luar_bandar( $d->tahun, $daerah);
			//$series3['data'][] = $this->stats->get_total_population_kepadatan( $d->tahun, $daerah);
		}

		$category = array();
		$category['name'] = 'category';
        //$category['data'] = array('Industri Kimia', 'Plastik', 'Loji Kumbahan(IWK, Majari, PBT, JKR)', 'Loji Kumbahan Persendirian', 'Tapak Pelupusan Sampah');
		$category['data'] = $tahun_array;

		// echo '<pre>';
		// print_r($series1);
		// print_r($series2);
		// print_r($series3);
		// print_r($series4);
		// print_r($series5);
		// echo '</pre>';

		$result = array();
		array_push($result, $category);
		array_push($result, $series1);
		array_push($result, $series2);
		//array_push($result, $series3);
		// array_push($result, $series4);
		// array_push($result, $series5);
		// array_push($result, $series6);
		// array_push($result, $series7);
		// array_push($result, $series8);
		// array_push($result, $series9);

		print json_encode($result, JSON_NUMERIC_CHECK);		
		
		//$this->output->enable_profiler(TRUE);

	}

	public function return_kepadatan_by_year()
	{
		$daerah = $this->input->get('id');

		$this->load->model('stats_m', 'stats');

		$this->db->distinct();
		$this->db->select('tahun');
		$this->db->order_by('tahun');
		$result_tahun = $this->db->get('taburan_penduduk')->result();
		$result_daerah = $this->db->get('taburan_penduduk')->result();

		
		$tahun_array = array();
		$series1['name'] = 'Kepadatan';

		foreach ($result_tahun as $d) {
			array_push($tahun_array, $d->tahun);
			$series1['data'][] = $this->stats->get_total_population_kepadatan( $d->tahun, $daerah);
		}

		$category = array();
		$category['name'] = 'category';
		$category['data'] = $tahun_array;

		// echo '<pre>';
		// print_r($series1);
		// print_r($series2);
		// print_r($series3);
		// print_r($series4);
		// print_r($series5);
		// echo '</pre>';

		$result = array();
		array_push($result, $category);
		array_push($result, $series1);

		print json_encode($result, JSON_NUMERIC_CHECK);		
		
		//$this->output->enable_profiler(TRUE);
	}

	public function sungai()
	{
		$this->load->model('sungai_m', 'sg');

		$data['sungai'] = $this->sg->get_by_class();
		$data['class1'] = $this->sg->get_total_by_class(1);
		$data['class2'] = $this->sg->get_total_by_class(2);
		$data['class3'] = $this->sg->get_total_by_class(3);
		$data['class4'] = $this->sg->get_total_by_class(4);
		$data['class5'] = $this->sg->get_total_by_class(5);
		// echo '<pre>';
		// print_r($data['sungai']);
		// echo '</pre>';
		$data['statscard'] = $this->load->view('template/template_statscard_sungai', $data, TRUE);

		$this->template->load('template/template_body', 'river', $data);

	}

	public function pbt()
	{
		$this->template->load('template/template_body', 'pbt');
	}

	public function banjir()
	{
		$data['banjir'] = $this->db->get('2017_banjir')->result();
		$this->template->load('template/template_body', 'banjir', $data);
	}



}
