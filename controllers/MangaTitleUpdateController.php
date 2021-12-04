<?php
require_once "BaseSpaceTwigController.php";

class MangaTitleUpdateController extends BaseSpaceTwigController {
    public $template = "manga_title_create.twig";

    public function get(array $context) // добавили параметр
    {      
        $id = $this->params['id'];

        $sql = <<<EOL
SELECT * FROM titles WHERE id = :id
EOL;
        $query = $this->pdo->prepare($sql);
        $query->bindValue("id", $id);
        $query->execute();

        $data = $query->fetch();

        $context['object'] = $data;
        parent::get($context);
    }

    public function post(array $context) { // добавили параметр
        // получаем значения полей с формы
        $title = $_POST['title'];
        $description = $_POST['description'];
        $type = $_POST['type'];
        $info = $_POST['info'];
        $id = $this->params['id'];

        $tmp_name = $_FILES['image']['tmp_name'];
        $name =  $_FILES['image']['name'];

        move_uploaded_file($tmp_name, "../public/media/$name");
        $image_url = "/media/$name";

        // создаем текст запрос
        $sql = <<<EOL
UPDATE titles
SET title = :title, description= :description, type = :type, info = :info, image = :image_url
WHERE id = :id
EOL;

        // подготавливаем запрос к БД
        $query = $this->pdo->prepare($sql);
        // привязываем параметры
        $query->bindValue("title", $title);
        $query->bindValue("description", $description);
        $query->bindValue("type", $type);
        $query->bindValue("info", $info);
        $query->bindValue("image_url", $image_url);
        $query->bindValue("id", $id);
        $query->execute();
        
        $context['message'] = 'Congratulations! This cool title is updated now!';
        $context['id'] = $this->params['id']; // получаем id изменённого объекта
        $this->get($context); // пробросили параметр
    }
}