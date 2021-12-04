<?php
require_once "BaseSpaceTwigController.php";

class MangaTitleCreateController extends BaseSpaceTwigController {
    public $template = "manga_title_create.twig";

    public function get(array $context) // добавили параметр
    {      
        parent::get($context); // пробросили параметр
    }

    public function post(array $context) { // добавили параметр
        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        // создаем текст запрос
        $sql = <<<EOL
INSERT INTO titles(title, description, type, info, image)
VALUES(:title, :description, :type, :info, :image_url)
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        
        $query->execute();
        
        $context['message'] = 'Congratulations! New cool title is there now!';
        $context['id'] = $this->pdo->lastInsertId(); // получаем id нового добавленного объекта
        $this->get($context); // пробросили параметр
    }
}