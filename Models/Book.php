<?php

class Book
{

    const PAGE_LIMIT = 2;
    const IMG_PATH = '/resources/loaded/';
    const IMG_TYPES = 'image/jpeg, image/png';
    const IMG_SIZE = 2; // max, MB
    const PAGIONATION_LIMIT = 2; // page number before/after current
    private $db;
    private $table = 'books';
    private static $updatable = array('author', 'title', 'description_b', 'image_b');
    private $id;
    private $author;
    private $author_name;
    private $title;
    private $description_b;
    private $image_b;

    public function __construct($db, $book_data = [])
    {
        $this->db = $db;
        if (isset($book_data['id'])) {
            $this->id = $book_data['id'];
            $this->author = @$book_data['author'];
            $this->title = @$book_data['title'];
            $this->description_b = @$book_data['description_b'];
            $this->image_b = @$book_data['image_b'];
        } else {
            $this->id = '';
            $this->author = @$book_data['author'];
            $this->title = @$book_data['title'];
            $this->description_b = @$book_data['description_b'];
            $this->image_b = @$book_data['image_b'];
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getDescription()
    {
        return $this->description_b;
    }

    public function setDescription($description)
    {
        $this->description_b = $description;
    }

    public function getAuthorId()
    {
        return $this->author;
    }

    public function setAuthorId($author)
    {
        $this->author = $author;
    }

    public function getImage()
    {
        return $this->image_b;
    }

    public function setImage($image)
    {
        $this->image_b = $image;
    }

    public function toArray() {
        return [
            "id" => $this->getId(),
            "author" => $this->getAuthorId(),
            "title" => $this->getTitle(),
            "description_b" => $this->getDescription(),
            "image_b" => $this->getImage()
        ];
    }

    public function getById($id) {
        return $this->db->getById($this->table, $id);
    }

    public function readLimit($page_num) {
        if(!$page_num || $page_num < 2) {
            $page_num = 1;
        }
        $offset = ($page_num - 1) * self::PAGE_LIMIT;
        return $this->db->readLimit($this->table, self::PAGE_LIMIT, $offset);
    }
    public function pagination($current_page) {
        if(!$current_page) {
            $current_page = 1;
        }
        $pages['show_prev'] = false;
        $pages['show_next'] = false;
        $rows_total = $this->db->getCount($this->table);
        $pages_total = ceil($rows_total['items_count'] / self::PAGE_LIMIT);
        echo $pages_total.'<br>';
        $pages_arr = array($current_page);
        for ($i = 1; $i <= self::PAGIONATION_LIMIT; $i++) {
            if(($current_page - $i) > 0) {
                array_unshift($pages_arr, $current_page - $i);
            }
            if(($current_page + $i) <= $pages_total) {
                $pages_arr[] = $current_page + $i;
            }
        }
        if($current_page > 1) {
            $pages['show_prev'] = true;
        }
        if(end($pages_arr) > $current_page) {
            $pages['show_next'] = true;
        }
        $pages['page_list'] = $pages_arr;
        $pages['page_active'] = $current_page;
        return $pages;
    }

    public function create() {
        $data = $this->toArray();
        foreach ($data as $d => $val) {
            if(!in_array($d, self::$updatable)) {
                unset($data[$d]);
            }
        }
        return $this->db->create($this->table, $data);
    }

    public function update() {
        $data = $this->toArray();
        foreach ($data as $d => $val) {
            if(!in_array($d, self::$updatable)) {
                unset($data[$d]);
            }
        }
        return $this->db->update($this->table, $this->id, $data);
    }
    public function delete($id) {
        return $this->db->delete($this->table, $id);
    }

    public static function validateImage($file) {
        if($file['image_l']['name']) {
            $upload = Upload::factory(self::IMG_PATH);
            $upload->file($_FILES['image_l']);
            $upload->set_max_file_size(self::IMG_SIZE);
            $upload->set_allowed_mime_types(explode(',',self::IMG_TYPES));
            $results = $upload->upload($_FILES['image_l']['name']);
            if(count($results['errors'])) {
                return $results['errors'];
            }
            return $_FILES['image_l']['name'];
        }
        $results['errors'][0] = 'No image';
        return $results['errors'];
    }

    public static function validateBook($data) {
        $val = new Validation();
        $val->name('title')->value($data['title'])->pattern('text')
            ->required()->min('2')->max('255');
        $val->name('image_b')->value($data['image_b'])->pattern('text')->required();
        $val->name('author')->value($data['author'])->pattern('int')->required();
        $val->name('description_b')->value($data['description_b'])->pattern('text')
            ->required()->min('20')->max('1000');
        if($val->isSuccess()){
            return true;
        }else{
            return $val->getErrors();
        }
    }
}
