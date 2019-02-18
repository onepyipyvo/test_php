<?php

Class Controller {
    public $db;

    public function __construct(Database $db, $config) {
        $this->db = $db;
        $this->config = $config;
        $this->view = new View();
    }

    public function index() {
        $routes = explode('/', $_SERVER['REQUEST_URI']);
        if ( !empty($routes[1]) )
        {
            $action_name = 'action_'.$routes[1];
        } else {
            $action_name = 'action_list';
        }

        if ( !empty($routes[2]) )
        {
            $param = $routes[2];
        } else {
            $param = NULL;
        }

        if(method_exists('Controller', $action_name))
        {
            $this->$action_name($param);
        }
        else
        {
            $this->action_error();
        }
    }

    public function action_list($page_num = 1) {
        $book = new Book($this->db);
        $author = new Author($this->db);
        $data['books'] = $book->readLimit($page_num);
        $data['pages'] = $book->pagination($page_num);
        $data['author'] = $author;
        $this->view->generate('list.php','basic.php', $data);
    }

    public function action_edit($book_id) {
        if(!$book_id) {
            $this->action_error();
        }
        $book = new Book($this->db);
        $data['book'] = $book->getById($book_id);
        $author = new Author($this->db);
        $data['authors'] = $author->readAll();
        $this->view->generate('edit.php','basic.php', $data);
    }

    public function action_do_update() {
        $errors = array();
        if (isset($_POST['update_book'])) {
            $image_to_use = false;
            if($_FILES['image_l']['size']) {
                $image_to_use = Book::validateImage($_FILES);

            } elseif (isset($_POST['img_prev'])) {
                $image_to_use = $_POST['img_prev'];
            } else {
                $errors[] = 'File uploading error';
            }

            if(!is_array($image_to_use)) {
                $_POST['image_b'] = $image_to_use;
                $check_book = Book::validateBook($_POST);
                if($check_book) {
                    $book = new Book($this->db, $_POST);
                    if(!$book->update()) {
                        $errors[] = 'Book update error';
                    }
                } else {
                    $errors[] = 'Book validation error';
                }
            } else {
                $errors[] = $image_to_use;
            }
        }
        $this->action_response($errors);
    }

    public function action_delete($book_id) {
        $book = new Book($this->db);
        $this->action_response($book->delete($book_id));
    }

    public function action_add($param = NULL) {
        if (isset($_POST['insert_book'])) {
            $image_to_use = false;
            $errors = array();
            if($_FILES['image_l']['size']) {
                $image_to_use = Book::validateImage($_FILES);
            } elseif (isset($_POST['img_prev'])) {
                $image_to_use = $_POST['img_prev'];
            } else {
                $errors[] = 'File uploading error';
            }
            $errors[] = 'Book adding error';
            $errors[] = 'Book validation error';
            if(!is_array($image_to_use)) {
                $_POST['image_b'] = $image_to_use;
                $check_book = Book::validateBook($_POST);
                if($check_book) {
                    $book = new Book($this->db, $_POST);
                    if(!$book->create()) {
                        $errors[] = 'Book adding error';
                    }
                } else {
                    $errors[] = 'Book validation error';
                }
            } else {
                $errors[] = $image_to_use;
            }
            $this->action_response($errors);
        } else {
            $author = new Author($this->db);
            $data['authors'] = $author->readAll();
            $this->view->generate('add.php', 'basic.php', $data);
        }
    }

    private function action_error() {
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
    }
    private function action_response($err_data = []) {
        if(!is_array($err_data) || !count($err_data)) {
            $data['success'] = true;
        } else {
            $data['errors'] = $err_data;
        }
        echo json_encode($data);
        exit();
    }
}
