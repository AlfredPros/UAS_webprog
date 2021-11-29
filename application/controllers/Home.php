<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('session');
    }

    public function index() {
        $data['list_buku'] = $this->home_model->get_list_buku();

        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/home.php', $data);
    }


    /*
    public function detail_buku() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_buku = $this->input->get('id_buku');

        $data['buku'] = $this->home_model->get_buku($id_buku);

        if (empty($data['buku'])) {  // id not found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/error.php', $data);
        }
        else {  // id found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/detail.php', $data);
        }
    }

    public function add_buku() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/add.php', $data);
    }

    public function edit_buku() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_buku = $this->input->get('id_buku');

        $data['buku'] = $this->home_model->get_buku($id_buku);

        if (empty($data['buku'])) {  // id not found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/error.php', $data);
        }
        else {  // id found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/edit.php', $data);
        }
    }

    public function error404() {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/error.php', $data);
    }


    // Non-GUI pages
    public function dologin() {
        // kuis2pemweb2017garam
        // localhost

        $password = $this->input->post('password');
        $passhash = hash('sha512', $password);
        
        $values = array(
            'password' => $passhash
        );

        $userFound = $this->home_model->check_user($values);

        if (empty($userFound)) {  // "Not Found!"
            $newdata = array(
                'alertNotif'  => 'Email or password is invalid.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);
        }
        else {  // Found!
            $newdata = array(
                'logged_in' => true
            );

            $this->session->set_userdata($newdata);
        }
        
        redirect("home");
    }

    public function logout() {
        $this->session->sess_destroy();

        redirect("home");
    }

    public function do_add() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $this->form_validation->set_rules("Title", "Title", "required");
		$this->form_validation->set_rules("Year", "Year", "required|integer|min_length[4]|max_length[4]");
		$this->form_validation->set_rules("Publisher", "Publisher", "required");
		$this->form_validation->set_rules("Author", "Author", "required");

		$config['upload_path'] = './assets/poster/';
		$config['allowed_types'] = 'png|jpg';
		$config['max_size'] = 4096;
		$config['max_width'] = 2048;
		$config['max_height'] = 2048;
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);

		if ($this->form_validation->run() == false) {
			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/add.php', $data);
		}
		else {
			if (!$this->upload->do_upload('PosterLink')) {
				$data['error'] = array('error' => $this->upload->display_errors());
				
				$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/add.php', $data);
			}
			else {
				$data = array('upload_data' => $this->upload->data());

				$values = array(
					'judul_buku' => $this->input->post('Title'),
					'tahun_terbit' => $this->input->post('Year'),
					'penulis_buku' => $this->input->post('Publisher'),
                    'penerbit_buku' => $this->input->post('Author'),
					'link_poster' => 'assets/poster/'.$data['upload_data']['file_name']
				);

				$this->home_model->add_buku($values);

				redirect("home");
			}
		}
    }

    public function do_edit() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $this->form_validation->set_rules("id_buku", "id_buku", "required");
        $this->form_validation->set_rules("Title", "Title", "required");
		$this->form_validation->set_rules("Year", "Year", "required|integer|min_length[4]|max_length[4]");
		$this->form_validation->set_rules("Publisher", "Publisher", "required");
		$this->form_validation->set_rules("Author", "Author", "required");

		$config['upload_path'] = './assets/poster/';
		$config['allowed_types'] = 'png|jpg';
		$config['max_size'] = 4096;
		$config['max_width'] = 2048;
		$config['max_height'] = 2048;
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);

		if ($this->form_validation->run() == false) {
            $id_buku = $this->input->post('id_buku');

            $data['buku'] = $this->home_model->get_buku($id_buku);

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/edit.php', $data);
		}
		else {
			if (!$this->upload->do_upload('PosterLink')) {
                $id_buku = $this->input->post('id_buku');

                $data['buku'] = $this->home_model->get_buku($id_buku);

				$data['error'] = array('error' => $this->upload->display_errors());
				
				$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/edit.php', $data);
			}
			else {
				$data = array('upload_data' => $this->upload->data());

				$values = array(
                    'id_buku' => $this->input->post('id_buku'),
					'judul_buku' => $this->input->post('Title'),
					'tahun_terbit' => $this->input->post('Year'),
					'penulis_buku' => $this->input->post('Publisher'),
                    'penerbit_buku' => $this->input->post('Author'),
					'link_poster' => 'assets/poster/'.$data['upload_data']['file_name']
				);

				$this->home_model->update_buku($values);

				redirect("home");
			}
		}
    }

    public function delete_buku() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_buku = $this->input->get('id_buku');

        $this->home_model->delete_buku($id_buku);

        redirect("home");
    }
    */
   
}
