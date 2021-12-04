<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->library('session');
    }

    public function index()
    {  // Landing page
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);

        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $this->load->view('pages/home.php', $data);
        } else {
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
        } else {
            $this->error404();
        }
    }

    public function login()
    {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/login.php', $data);
    }

    public function do_login()
    {
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
            } else {
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
                } else {
                    $newdata = array(
                        'id' => $result[0]['id_user'],
                        'name'  => $result[0]['name'],
                        'link_profile' => $result[0]['link_profile'],
                        'role' => $result[0]['role'],
                        'logged_in' => true
                    );

                    $this->session->set_userdata($newdata);

                    redirect("home");
                }
            }
        } else {  // Not success
            $newdata = array(
                'alert' => "Recaptcha failed. Please login again."
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }
    }

    public function register()
    {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/register.php', $data);
    }

    public function do_register()
    {
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
            } else {
                if (!$this->upload->do_upload('link_profile')) {
                    $data['error'] = array('error' => $this->upload->display_errors());

                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $this->load->view('pages/register.php', $data);
                } else {
                    $data = array('upload_data' => $this->upload->data());

                    $password = $this->input->post('password');
                    $passhash = hash('sha512', $password);

                    $values = array(
                        'email' => strip_tags($this->input->post('email')),
                        'password' => $passhash,
                        'name' => strip_tags($this->input->post('name')),
                        'link_profile' => 'assets/pp/' . $data['upload_data']['file_name']
                    );

                    $this->home_model->add_user($values);

                    $newdata = array(
                        'alert'  => "User has been registered. Please log in to proceed."
                    );

                    $this->session->set_userdata($newdata);

                    redirect("home/login");
                }
            }
        } else {  // Not success
            $newdata = array(
                'alert' => "Recaptcha failed. Please register again."
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }
    }

    public function edit_user()
    {
        $id_user = strip_tags($this->input->get('id_user'));
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['user'] = $this->home_model->get_user($id_user);
            $this->load->view('pages/edit_user.php', $data);
        } else {
            $this->error404();
        }
    }

    public function delete_user()
    {
        $id_user = strip_tags($this->input->get('id_user'));
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $image = $this->home_model->get_pp_from_user($id_user);

            unlink($image['link_profile']);  

            $this->home_model->delete_user($id_user);
            
            redirect("home/user_list");
        } else {
            $this->error404();
        }
    }

    public function error404()
    {
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
        $this->load->view('pages/error.php', $data);
    }

    public function logout()
    {
        $this->session->sess_destroy();

        redirect("home");
    }

    public function do_edit_user()
    {
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
            $id_user = strip_tags($this->input->post('id_user'));

            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['user'] = $this->home_model->get_user($id_user);
            $this->load->view('pages/edit_user.php', $data);
        } else {
            if (!$this->upload->do_upload('link_profile')) {
                $id_user = strip_tags($this->input->post('id_user'));

                $data['error'] = array('error' => $this->upload->display_errors());

                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $data['user'] = $this->home_model->get_user($id_user);
                $this->load->view('pages/edit_user.php', $data);
            } else {
                $data = array('upload_data' => $this->upload->data());

                $values = array(
                    'id_user' => strip_tags($this->input->post('id_user')),
                    'email' => strip_tags($this->input->post('email')),
                    'name' => strip_tags($this->input->post('name')),
                    'role' => strip_tags($this->input->post('role')),
                    'link_profile' => 'assets/pp/' . $data['upload_data']['file_name']
                );
                $image = $this->home_model->get_pp_from_user($values['id_user']);
                unlink($image['link_profile']);   

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
            } else if ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager') {
                $this->load->view('pages/book_list_crud.php', $data, NULL);
            }
        } else {
            $this->error404();
        }
    }

    public function book_detail()
    {
        if (isset($_SESSION['logged_in'])) {
            $book = strip_tags($this->input->get('id_book'));
            $data['month'] = (int)strip_tags($this->input->get('month'));
            $data['year'] = (int)strip_tags($this->input->get('year'));
            if (empty($data['month']) || $data['month'] > 12 || $data['month'] < 1) {
                $data['month'] = date('m');
            }
            if (empty($data['year']) || $data['year'] > date('Y')+1 || $data['year'] < date('Y')) {
                $data['year'] = date('Y');
            }

            $data['requests'] = $this->home_model->get_book_request($book);
            $values = array(
                'id_book' => $book,
                'id_user' => $_SESSION['id']
            );

            $data['requests'] = $this->home_model->get_book_request($book);
            $data['requested'] = $this->home_model->get_unapprove_book_request($values);

            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['book'] = $this->home_model->get_book($book);
            if (empty($data['book'])) {
                $this->error404();
            } else {
                $this->load->view('pages/book_detail.php', $data, NULL);
            }
        } else {
            $this->error404();
        }
    }

    public function booking_manga()
    {
        if (isset($_SESSION['logged_in'])) {
            $book = strip_tags($this->input->get('id_book'));

            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $data['book'] = $this->home_model->get_book($book);
            if (empty($data['book'])) {
                $this->error404();
            } else {
                $this->load->view('pages/booking_manga.php', $data, NULL);
            }
        } else {
            $this->error404();
        }
    }

    public function do_booking_manga()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'User') {
            $this->form_validation->set_rules("id_book", "id_book", "required");
            $this->form_validation->set_rules("id_user", "id_user", "required");
            $this->form_validation->set_rules("start_time", "start_time", "required");
            $this->form_validation->set_rules("end_time", "end_time", "required");

            if ($this->form_validation->run() == false) {
                $book = strip_tags($this->input->post('id_book'));

                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $data['book'] = $this->home_model->get_book($book);
                $this->load->view('pages/booking_manga.php', $data);
            } else {
                $datebook1 = strip_tags($this->input->post('start_time'));
                $datebook2 = strip_tags($this->input->post('end_time'));
                $date1 = strtotime($datebook1);
                $date2 = strtotime($datebook2);

                $hourDiff = round(($date2 - $date1) / (60 * 60 * 24), 0);

                if ($hourDiff < 1 || $hourDiff > 7) {
                    if ($hourDiff < 1) {
                        $temp = "Date is too short.";
                    } else {
                        $temp = "Date is larger than the allowed 7 days.";
                    }

                    $newdata = array(
                        'alert'  => $temp
                    );

                    $this->session->set_userdata($newdata);

                    $book = strip_tags($this->input->post('id_book'));

                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $data['book'] = $this->home_model->get_book($book);
                    $this->load->view('pages/booking_manga.php', $data);
                } else {
                    $flag = true;
                    $values = array(
                        'id_book' => strip_tags($this->input->post('id_book')),
                        'id_user' => strip_tags($this->input->post('id_user')),
                        'start_time' => $datebook1,
                        'end_time' => $datebook2
                    );
                    $time_taken = $this->home_model->get_book_request($values['id_book']);
                    $blacklist = [];
                    foreach ($time_taken as $time) {
                        array_push($blacklist, $this->createDateRangeArray($time['start_time'], $time['end_time']));
                    }

                    $request_days = $this->createDateRangeArray($datebook1, $datebook2);
                    foreach ($request_days as $day) {
                        foreach ($blacklist as $bl) {
                            if (in_array($day, $bl)) {
                                $flag = false;
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $this->home_model->insert_request($values);
                        redirect("home/book_list");
                    } else {

                        $newdata = array(
                            'alert'  => "Date has been taken<br>Please select another date"
                        );

                        $this->session->set_userdata($newdata);

                        $book = strip_tags($this->input->post('id_book'));

                        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                        $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                        $data['book'] = $this->home_model->get_book($book);
                        $this->load->view('pages/booking_manga.php', $data);
                    }
                }
            }
        } else {
            $this->error404();
        }
    }

    public function delete_book()
    {
        if (isset($_SESSION['logged_in']) && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager')) {
            $id_book = strip_tags($this->input->get('id_book'));
            $image = $this->home_model->get_cover_from_book($id_book);
            unlink($image['link_cover']);
            $this->home_model->delete_book($id_book);
            redirect("home/book_list");
        } else {
            $this->error404();
        }
    }

    public function detail_book()
    {
        if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] == false) {
            $newdata = array(
                'alertNotif'  => 'Login is required to see the page.',
                'logged_in' => false
            );

            $this->session->set_userdata($newdata);

            redirect("home");
        }

        $id_book = strip_tags($this->input->get('id_book'));

        $data['book'] = $this->home_model->get_book($id_book);

        if (empty($data['book'])) {  // id not found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/error.php', $data);
        } else {  // id found
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/detail.php', $data);
        }
    }

    public function add_book()
    {
        if (isset($_SESSION['logged_in']) && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager')) {
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            $this->load->view('pages/add_book.php', $data);
        } else {
            $this->error404();
        }
    }

    public function edit_book()
    {
        if (isset($_SESSION['logged_in']) && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager')) {
            $id_book = strip_tags($this->input->get('id_book'));

            $data['book'] = $this->home_model->get_book($id_book);

            if (empty($data['book'])) {  // id not found
                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/error.php', $data);
            } else {  // id found
                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/edit_book.php', $data);
            }
        } else {
            $this->error404();
        }
    }

    public function do_edit_book()
    {
        if (isset($_SESSION['logged_in']) && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager')) {
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
                $id_book = strip_tags($this->input->post('id_book'));

                $data['book'] = $this->home_model->get_book($id_book);

                $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                $this->load->view('pages/edit_book.php', $data);
            } else {
                if (!$this->upload->do_upload('link_cover')) {
                    $id_book = strip_tags($this->input->post('id_book'));

                    $data['book'] = $this->home_model->get_book($id_book);

                    $data['error'] = array('error' => $this->upload->display_errors());

                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $this->load->view('pages/edit_book.php', $data);
                } else {
                    $data = array('upload_data' => $this->upload->data());

                    $values = array(
                        'id_book' => strip_tags($this->input->post('id_book')),
                        'title' => strip_tags($this->input->post('title')),
                        'year' => strip_tags($this->input->post('year')),
                        'author' => strip_tags($this->input->post('author')),
                        'publisher' => strip_tags($this->input->post('publisher')),
                        'description' => strip_tags($this->input->post('description')),
                        'link_cover' => 'assets/cover/' . $data['upload_data']['file_name']
                    );

                    $image = $this->home_model->get_cover_from_book($values['id_book']);
                    unlink($image['link_cover']);

                    $this->home_model->update_book($values);

                    redirect("home/book_list");
                }
            }
        } else {
            $this->error404();
        }
    }

    public function do_add_book()
    {
        if (isset($_SESSION['logged_in']) && ($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'Manager')) {
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
            } else {
                if (!$this->upload->do_upload('link_cover')) {
                    $data['error'] = array('error' => $this->upload->display_errors());

                    $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
                    $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
                    $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
                    $this->load->view('pages/add_book.php', $data);
                } else {
                    $data = array('upload_data' => $this->upload->data());

                    $values = array(
                        'title' => strip_tags($this->input->post('title')),
                        'year' => strip_tags($this->input->post('year')),
                        'author' => strip_tags($this->input->post('author')),
                        'publisher' => strip_tags($this->input->post('publisher')),
                        'description' => strip_tags($this->input->post('description')),
                        'link_cover' => 'assets/cover/' . $data['upload_data']['file_name']
                    );

                    $this->home_model->add_book($values);

                    redirect("home/book_list");
                }
            }
        } else {
            $this->error404();
        }
    }

    // Request
    public function request_list()
    {
        if (isset($_SESSION['logged_in'])) {
            $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
            $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
            $data['header'] = $this->load->view('pages/header.php', NULL, TRUE);
            switch ($_SESSION['role']) {
                case 'User':
                    $data['requests'] = $this->home_model->get_user_request($_SESSION['id']);
                    $this->load->view('pages/request_list_user.php', $data, NULL);
                    break;
                case 'Manager':
                    $data['requests'] = $this->home_model->get_unapproved_request();
                    $this->load->view('pages/request_list_manager.php', $data, NULL);
                    break;
                case 'Admin':
                    $data['requests'] = $this->home_model->get_list_request();
                    $this->load->view('pages/request_list_admin.php', $data, NULL);
                    break;
                default:
                    $this->error404();
                    break;
            }
        } else {
            $this->error404();
        }
    }

    public function approve_request()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Manager') {
            $id_request = strip_tags($this->input->get('id_request'));
            $this->home_model->approve_request($id_request);
            redirect("home/request_list");
        } else {
            $this->error404();
        }
    }

    public function reject_request()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Manager') {
            $id_request = strip_tags($this->input->get('id_request'));
            $this->home_model->reject_request($id_request);
            redirect("home/request_list");
        } else {
            $this->error404();
        }
    }

    public function delete_request()
    {
        if (isset($_SESSION['logged_in']) && $_SESSION['role'] == 'Admin') {
            $id_request = strip_tags($this->input->get('id_request'));
            $this->home_model->delete_request($id_request);
            redirect("home/request_list");
        } else {
            $this->error404();
        }
    }

    function createDateRangeArray($strDateFrom, $strDateTo)
    {
        // takes two dates formatted as YYYY-MM-DD and creates an
        // inclusive array of the dates between the from and to dates.

        $aryRange = [];

        $iDateFrom = mktime(1, 0, 0, substr($strDateFrom, 5, 2), substr($strDateFrom, 8, 2), substr($strDateFrom, 0, 4));
        $iDateTo = mktime(1, 0, 0, substr($strDateTo, 5, 2), substr($strDateTo, 8, 2), substr($strDateTo, 0, 4));

        if ($iDateTo >= $iDateFrom) {
            array_push($aryRange, date('Y-m-d', $iDateFrom)); // first entry
            while ($iDateFrom < $iDateTo) {
                $iDateFrom += 86400; // add 24 hours
                array_push($aryRange, date('Y-m-d', $iDateFrom));
            }
        }
        return $aryRange;
    }
}
