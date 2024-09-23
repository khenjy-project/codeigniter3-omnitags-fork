<?php
defined('BASEPATH') or exit('No direct script access allowed');

include 'Omnitags.php';

class C_tabel_e3 extends Omnitags
{
	// Pages
	// Public Pages


	// Account Only Pages


	// Admin Pages
	public function admin()
	{
		$this->declarew();
		$allowed_values = [
			$this->aliases['tabel_c2_field6_value3'],
			$this->aliases['tabel_c2_field6_value4']
		];
		$this->page_session_check($allowed_values);

		$param1 = $this->v_get['tabel_e3_field4'];

		$filter = $this->tl_e3->get_e3_by_field('tabel_e3_field4', $param1);

		if (empty($param1)) {
			$result = $this->tl_e3->get_all_e3();
		} else {
			$result = $filter;
		}

		$data1 = array(
			'title' => lang('tabel_e3_alias_v3_title'),
			'konten' => $this->v3['tabel_e3'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e3']),
			'tbl_e1' => $this->tl_e1->get_all_e1(),
			'tbl_e2' => $this->tl_e2->get_all_e2(),
			'tbl_e3' => $result,
			'tbl_e4' => $this->tl_e4->get_all_e4(),
			// 'tbl_c1' => $this->tl_c1->get_all_c1(),
			'tabel_e3_field4_value' => $param1
		);

		$this->load_page('tabel_e3', '_layouts/template', $data1);
	}

	// Print all data
	public function laporan()
	{
		$this->declarew();
		$allowed_values = [
			$this->aliases['tabel_c2_field6_value3'],
			$this->aliases['tabel_c2_field6_value4']
		];
		$this->page_session_check($allowed_values);

		$data1 = array(
			'title' => lang('tabel_e3_alias_v4_title'),
			'konten' => $this->v4['tabel_e3'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e3']),
			'tbl_e3' => $this->tl_e3->get_all_e3(),
		);

		$this->load_page('tabel_e3', '_layouts/printpage', $data1);
	}

	// Print one data

	// Functions
	// Add data
	public function tambah()
	{
		$this->declarew();
		$this->session_3();

		validate_all(
			array(
				$this->v_post['tabel_e3_field2'],
				$this->v_post['tabel_e3_field3'],
				$this->v_post['tabel_e3_field4'],
			),
			$this->views['flash2'],
			'tambah'
		);

		// $id = get_next_code($this->aliases['tabel_e1'], $this->aliases['tabel_e1_field1'], 'FK');
		// $this->aliases['tabel_e1_field1'] => $id,

		$code = $this->add_code('tabel_e3', $this->aliases['tabel_e3_field1'], 5, '03');

		$data = array(
			$this->aliases['tabel_e3_field1'] => $code,
			$this->aliases['tabel_e3_field2'] => $this->v_post['tabel_e3_field2'],
			$this->aliases['tabel_e3_field3'] => $this->v_post['tabel_e3_field3'],
			$this->aliases['tabel_e3_field4'] => $this->v_post['tabel_e3_field4'],
			$this->aliases['tabel_e3_field5'] => $this->v_post['tabel_e3_field5'],

			'created_at' => date("Y-m-d\TH:i:s"),
			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_e3->insert_e3($data);
		$this->insert_history('tabel_e3', $data);

		$notif = $this->handle_4b($aksi, 'tabel_e3');

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Update data
	public function update()
	{
		$this->declarew();
		$this->session_3();

		$tabel_e3_field1 = $this->v_post['tabel_e3_field1'];

		$tabel = $this->tl_e3->get_e3_by_field('tabel_e3_field1', $tabel_e3_field1)->result();
		$this->check_data($tabel);

		validate_all(
			array(
				$this->v_post['tabel_e3_field1'],
				$this->v_post['tabel_e3_field2'],
				$this->v_post['tabel_e3_field3'],
				$this->v_post['tabel_e3_field4'],
				$this->v_post['tabel_e3_field5'],
			),
			$this->views['flash3'],
			'ubah' . $tabel_e3_field1
		);

		$data = array(
			$this->aliases['tabel_e3_field2'] => $this->v_post['tabel_e3_field2'],
			$this->aliases['tabel_e3_field3'] => $this->v_post['tabel_e3_field3'],
			$this->aliases['tabel_e3_field4'] => $this->v_post['tabel_e3_field4'],
			$this->aliases['tabel_e3_field5'] => $this->v_post['tabel_e3_field5'],

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_e3->update_e3($data, $tabel_e3_field1);
		$this->insert_history('tabel_e3', $data);

		$notif = $this->handle_4c($aksi, 'tabel_e3', $tabel_e3_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}
	
	//Soft Delete Data
	public function soft_delete($tabel_e3_field1 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_e3->get_e3_by_field('tabel_e3_field1', $tabel_e3_field1)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_e3->update_e3($data, $tabel_e3_field1);
		$this->insert_history('tabel_e3', $data);

		$notif = $this->handle_4e($aksi, 'tabel_e3', $tabel_e3_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Soft Delete data
	public function restore($tabel_e3_field1 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_e3->get_e3_by_field_archive('tabel_e3_field1', $tabel_e3_field1)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			'deleted_at' => NULL,
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_e3->update_e3($data, $tabel_e3_field1);
		$this->insert_history('tabel_e3', $data);

		$notif = $this->handle_4e($aksi, 'tabel_e3', $tabel_e3_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Delete data
	public function delete($tabel_e3_field1 = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_e3->get_e3_by_field_archive('tabel_e3_field1', $tabel_e3_field1)->result();
		$this->check_data($tabel);

		$aksi = $this->tl_e3->delete_e3_by_field('tabel_e3_field1', $tabel_e3_field1);

		$notif = $this->handle_4e($aksi, 'tabel_e3', $tabel_e3_field1);

		redirect($_SERVER['HTTP_REFERER']);
	}

	// Archive Page
	public function archive()
	{
		$this->declarew();
		$this->page_session_3();

		$data1 = array(
			'title' => lang('tabel_e3_alias_v9_title'),
			'konten' => $this->v9['tabel_e3'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e3']),
			'tbl_e3' => $this->tl_e3->get_all_e3_archive(),
		);

		$this->load_page('tabel_e3', '_layouts/template', $data1);
	}

	// Public Pages
	public function detail_archive($param1 = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_e3->get_e3_by_field('tabel_e3_field1', $param1)->result();
		$this->check_data($tabel);

		$data1 = array(
			'title' => lang('tabel_e3_alias_v10_title'),
			'konten' => $this->v10['tabel_e3'],
			'dekor' => $this->tl_e3->dekor($this->theme_id, $this->aliases['tabel_e3']),
			'tbl_e3' => $this->tl_e3->get_e3_by_field_archive('tabel_e3_field1', $param1),
		);

		$this->load_page('tabel_e3', '_layouts/template', $data1);
	}
	
	public function history($param1 = null)
	{
		$this->declarew();
		$this->page_session_all();

		$tabel = $this->tl_e3->get_e3_by_field('tabel_e3_field1', $param1)->result();
		$this->check_data($tabel);

		$data1 = array(
			'table_id' => $param1,
			'title' => lang('tabel_e3_alias_v11_title'),
			'konten' => $this->v11['tabel_e3'],
			'dekor' => $this->tl_b1->dekor($this->theme_id, $this->aliases['tabel_e3']),
			'current' => $this->tl_ot->get_by_field('tabel_e3', 'tabel_e3_field1', $param1),
			'tbl_e3' => $this->tl_ot->get_by_field_history('tabel_e3', 'tabel_e3_field1', $param1),
		);

		$this->load_page('tabel_e3', '_layouts/template', $data1);
	}

	//Push History Data into current data
	public function push($code = null)
	{
		$this->declarew();
		$this->session_3();

		$tabel = $this->tl_ot->get_by_id_history('tabel_e3', $code)->result();
		$this->check_data($tabel);

		// menggunakan nama khusus sama dengan konfigurasi
		$data = array(
			$this->aliases['tabel_e3_field1'] => $tabel[0]->{$this->aliases['tabel_e3_field1']},
			$this->aliases['tabel_e3_field2'] => $tabel[0]->{$this->aliases['tabel_e3_field2']},

			'updated_at' => date("Y-m-d\TH:i:s"),
			'updated_by' => userdata($this->aliases['tabel_c2_field1']),
		);

		$aksi = $this->tl_e3->update_e3($data, $tabel[0]->{$this->aliases['tabel_e3_field1']});

		redirect($_SERVER['HTTP_REFERER']);
	}
}
