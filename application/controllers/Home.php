<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('session');
    }

    public function index() {  // Landing page
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $this->load->view('pages/home.php', $data);
        }
        else {
            if ($_SESSION['role'] == 'User') {
                $this->load->view('pages/home_user.php', $data);
            }
            else if ($_SESSION['role'] == 'Manager') {
                $this->load->view('pages/home_management.php', $data);
            }
            else if ($_SESSION['role'] == 'Admin') {
                $this->load->view('pages/home_admin.php', $data);
            }
            else {
                $this->load->view('pages/error.php', $data);
            }
        }
    }

    public function login() {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/login.php', $data);
    }

    public function do_login() {
        $token = $_POST['token'];
        $action = $_POST['action'];
        
        $score_limit = 0.8;

        $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
        $recaptcha_secret = "6LePRGcdAAAAAMsbA1tKa-a86LahRsHMeeb-1M1t";

        $recaptcha = file_get_contents($recaptcha_url . "?secret=" . $recaptcha_secret . "&response=" . $token);
        $arrResponse = json_decode($recaptcha);

        if ($arrResponse->success && $arrResponse->action == $action && $arrResponse->score >= $score_limit) {  // Success
            $this->form_validation->set_rules("email", "email", "required");
            $this->form_validation->set_rules("password", "password", "required");

            if ($this->form_validation->run() == false) {
                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/login.php', $data);
            }
            else {
                $password = $this->input->post('password');
                $passhash = hash('sha512', $password);

                $values = array(
                    'email' => $this->input->post('email'),
                    'password' => $passhash
                );

                $result = $this->home_model->check_user($values);

                if (empty($result)) {
                    $newdata = array(
                        'alert'  => "Wrong email or password!"
                    );
        
                    $this->session->set_userdata($newdata);

                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $this->load->view('pages/login.php', $data);
                }
                else {
                    $newdata = array(
                        'name'  => $result[0]['name'],
                        'link_profile' => $result[0]['link_profile'],
                        'role' => $result[0]['role'],
                        'logged_in' => true
                    );
        
                    $this->session->set_userdata($newdata);

                    redirect("home");
                }
                
            }
        }
        else {  // Not success
            redirect("home");
        }
    }

    public function register() {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/register.php', $data);
    }

    public function do_register() {
        $token = $this->input->post('token');
        $action = $this->input->post('action');
        
        $score_limit = 0.9;

        $recaptcha_url = "https://www.google.com/recaptcha/api/siteverify";
        $recaptcha_secret = "6LePRGcdAAAAAMsbA1tKa-a86LahRsHMeeb-1M1t";

        $recaptcha = file_get_contents($recaptcha_url . "?secret=" . $recaptcha_secret . "&response=" . $token);
        $arrResponse = json_decode($recaptcha);

        if ($arrResponse->success && $arrResponse->action == $action && $arrResponse->score >= $score_limit) {  // Success
            $this->form_validation->set_rules("email", "email", "required");
            $this->form_validation->set_rules("password", "password", "required");
            $this->form_validation->set_rules("name", "name", "required");

            $config['upload_path'] = './assets/pp/';
            $config['allowed_types'] = 'png|jpg|gif';
            $config['max_size'] = 4096;
            $config['max_width'] = 2048;
            $config['max_height'] = 2048;
            $config['encrypt_name'] = true;
            $this->load->library('upload', $config);

            if ($this->form_validation->run() == false) {
                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/register.php', $data);
            }
            else {
                if (!$this->upload->do_upload('link_profile')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                    
                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $this->load->view('pages/register.php', $data);
                }
                else {
                    $data = array('upload_data' => $this->upload->data());

                    $password = $this->input->post('password');
                    $passhash = hash('sha512', $password);

                    $values = array(
                        'email' => $this->input->post('email'),
                        'password' => $passhash,
                        'name' => $this->input->post('name'),
                        'link_profile' => 'assets/pp/'.$data['upload_data']['file_name']
                    );

                    $this->home_model->add_user($values);

                    $newdata = array(
                        'alert'  => "User has been registered. Please log in to proceed."
                    );
        
                    $this->session->set_userdata($newdata);

                    redirect("home/login");
                }
            }
        }
        else {  // Not success
            redirect("home");
        }
    }



    public function error404() {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/error.php', $data);
    }

    public function logout() {
        $this->session->sess_destroy();

        redirect("home");
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
					'title' => $this->input->post('Title'),
					'year' => $this->input->post('Year'),
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
