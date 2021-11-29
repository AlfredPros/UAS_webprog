<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('session');
    }

    public function index($listing = null) {  // Landing page
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $this->load->view('pages/home.php', $data);
        }
        else {
            switch ($_SESSION['role']) {
                case 'User':
                    $this->load->view('pages/home_user.php', $data);
                    break;
                
                case 'Manager':
                    $this->load->view('pages/home_management.php', $data);
                    break;
                
                case 'Admin':
                    $this->load->view('pages/home_admin.php', $data);
                    break;
                default:
                    $this->load->view('pages/error.php', $data);
                    break;
            }
        }
    }

    // User

    public function user_list()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['users'] = $this->home_model->get_list_user();
            $this->load->view('pages/user_list_admin.php', $data, NULL);
        } 
        else {
            $this->error404();
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
            $this->form_validation->set_rules("email", "email", "required|valid_email");
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
                    'email' => strip_tags($this->input->post('email')),
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
            $this->form_validation->set_rules("email", "email", "required|valid_email");
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
                        'email' => strip_tags($this->input->post('email')),
                        'password' => $passhash,
                        'name' => strip_tags($this->input->post('name')),
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

    public function edit_user() {
        $id_user = $this->input->get('id_user');
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['user'] = $this->home_model->get_user($id_user);
            $this->load->view('pages/edit_user.php', $data);
        }
        else {
            $this->error404();
        }
    }

    public function delete_user() {
        $id_user = $this->input->get('id_user');
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $this->home_model->delete_user($id_user);
            redirect("home");
        }
        else {
            $this->error404();
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

    public function do_edit_user() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false || $_SESSION['role'] != 'Admin') {
            $this->error404();
        }

        $this->form_validation->set_rules("id_user", "id_user", "required");
        $this->form_validation->set_rules("email", "email", "required|valid_email");
		$this->form_validation->set_rules("name", "name", "required");
		$this->form_validation->set_rules("role", "role", "required|in_list[Admin,Manager,User]");

		$config['upload_path'] = './assets/pp/';
		$config['allowed_types'] = 'png|jpg|gif';
		$config['max_size'] = 4096;
		$config['max_width'] = 2048;
		$config['max_height'] = 2048;
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);

		if ($this->form_validation->run() == false) {
            $id_user = $this->input->post('id_user');

            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['user'] = $this->home_model->get_user($id_user);
            $this->load->view('pages/edit_user.php', $data);
		}
		else {
			if (!$this->upload->do_upload('link_profile')) {
                $id_user = $this->input->post('id_user');

                $data['error'] = array('error' => $this->upload->display_errors());
				
                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $data['user'] = $this->home_model->get_user($id_user);
                $this->load->view('pages/edit_user.php', $data);
			}
			else {
				$data = array('upload_data' => $this->upload->data());

				$values = array(
                    'id_user' => $this->input->post('id_user'),
					'email' => $this->input->post('email'),
					'name' => $this->input->post('name'),
					'role' => $this->input->post('role'),
					'link_profile' => 'assets/pp/'.$data['upload_data']['file_name']
				);

				$this->home_model->update_user($values);

				redirect("home/user_list");
			}
		}
    }

    // Book

    public function book_list()
    {
        if (isset($_SESSION['logged_in'])) {
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['books'] = $this->home_model->get_list_book();
            if ($_SESSION['role'] == 'User') {
                $this->load->view('pages/book_list_user.php', $data, NULL);
            } else {
                $this->load->view('pages/book_list_crud.php', $data, NULL);   
            }
        } 
        else {
            $this->error404();
        }
    }

    public function delete_book() {
        $id_book = $this->input->get('id_book');
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $this->home_model->delete_book($id_book);
            redirect("home/book_list");
        }
        else {
            $this->error404();
        }
    }

    public function detail_book() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_book = $this->input->get('id_book');

        $data['book'] = $this->home_model->get_book($id_book);

        if (empty($data['book'])) {  // id not found
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

    public function add_book() {
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
        $this->load->view('pages/add_book.php', $data);
    }

    public function edit_book() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_book = $this->input->get('id_book');

        $data['book'] = $this->home_model->get_book($id_book);

        if (empty($data['book'])) {  // id not found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/error.php', $data);
        }
        else {  // id found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/edit_book.php', $data);
        }
    }

    public function do_edit_book() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $this->form_validation->set_rules("id_book", "id_book", "required");
        $this->form_validation->set_rules("title", "title", "required");
		$this->form_validation->set_rules("year", "year", "required|integer|min_length[4]|max_length[4]");
		$this->form_validation->set_rules("publisher", "publisher", "required");
		$this->form_validation->set_rules("author", "author", "required");
        $this->form_validation->set_rules("description", "description", "required");

		$config['upload_path'] = './assets/cover/';
		$config['allowed_types'] = 'png|jpg|gif';
		$config['max_size'] = 4096;
		$config['max_width'] = 2048;
		$config['max_height'] = 2048;
		$config['encrypt_name'] = true;
		$this->load->library('upload', $config);

		if ($this->form_validation->run() == false) {
            $id_book = $this->input->post('id_book');

            $data['book'] = $this->home_model->get_book($id_book);

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/edit_book.php', $data);
		}
		else {
			if (!$this->upload->do_upload('link_cover')) {
                $id_book = $this->input->post('id_book');

                $data['book'] = $this->home_model->get_book($id_book);

				$data['error'] = array('error' => $this->upload->display_errors());
				
				$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/edit_book.php', $data);
			}
			else {
				$data = array('upload_data' => $this->upload->data());

				$values = array(
                    'id_book' => $this->input->post('id_book'),
					'title' => $this->input->post('title'),
					'year' => $this->input->post('year'),
					'author' => $this->input->post('author'),
                    'publisher' => $this->input->post('publisher'),
                    'description' => $this->input->post('description'),
					'link_cover' => 'assets/cover/'.$data['upload_data']['file_name']
				);

				$this->home_model->update_book($values);

				redirect("home/book_list");
			}
		}
    }

    public function do_add_book() {
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $this->form_validation->set_rules("title", "title", "required");
            $this->form_validation->set_rules("year", "year", "required|integer|min_length[4]|max_length[4]");
            $this->form_validation->set_rules("publisher", "publisher", "required");
            $this->form_validation->set_rules("author", "author", "required");
            $this->form_validation->set_rules("description", "description", "required");

            $config['upload_path'] = './assets/cover/';
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
                $this->load->view('pages/add_book.php', $data);
            }
            else {
                if (!$this->upload->do_upload('link_cover')) {
                    $data['error'] = array('error' => $this->upload->display_errors());
                    
                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $this->load->view('pages/add_book.php', $data);
                }
                else {
                    $data = array('upload_data' => $this->upload->data());

                    $values = array(
                        'title' => $this->input->post('title'),
                        'year' => $this->input->post('year'),
                        'author' => $this->input->post('publisher'),
                        'publisher' => $this->input->post('author'),
                        'description' => $this->input->post('description'),
                        'link_cover' => 'assets/cover/'.$data['upload_data']['file_name']
                    );

                    $this->home_model->add_book($values);

                    redirect("home/book_list");
                }
            }
        } else {
            $this->error404();
        }
    }

    /*
    public function detail_book() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_book = $this->input->get('id_book');

        $data['book'] = $this->home_model->get_book($id_book);

        if (empty($data['book'])) {  // id not found
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

    public function add_book() {
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

    public function edit_book() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_book = $this->input->get('id_book');

        $data['book'] = $this->home_model->get_book($id_book);

        if (empty($data['book'])) {  // id not found
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
					'penulis_book' => $this->input->post('Publisher'),
                    'penerbit_book' => $this->input->post('Author'),
					'link_poster' => 'assets/poster/'.$data['upload_data']['file_name']
				);

				$this->home_model->add_book($values);

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

        $this->form_validation->set_rules("id_book", "id_book", "required");
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
            $id_book = $this->input->post('id_book');

            $data['book'] = $this->home_model->get_book($id_book);

			$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/edit.php', $data);
		}
		else {
			if (!$this->upload->do_upload('PosterLink')) {
                $id_book = $this->input->post('id_book');

                $data['book'] = $this->home_model->get_book($id_book);

				$data['error'] = array('error' => $this->upload->display_errors());
				
				$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/edit.php', $data);
			}
			else {
				$data = array('upload_data' => $this->upload->data());

				$values = array(
                    'id_book' => $this->input->post('id_book'),
					'judul_book' => $this->input->post('Title'),
					'tahun_terbit' => $this->input->post('Year'),
					'penulis_book' => $this->input->post('Publisher'),
                    'penerbit_book' => $this->input->post('Author'),
					'link_poster' => 'assets/poster/'.$data['upload_data']['file_name']
				);

				$this->home_model->update_book($values);

				redirect("home");
			}
		}
    }

    public function delete_book() {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_book = $this->input->get('id_book');

        $this->home_model->delete_book($id_book);

        redirect("home");
    }
    */
   
}
