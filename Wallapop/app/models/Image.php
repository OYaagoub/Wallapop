<?php
class Image {
    private $id;
    private $image;
    private $id_ano;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    public function getIdAno() {
        return $this->id_ano;
    }

    public function setIdAno($id_ano) {
        $this->id_ano = $id_ano;
    }
}



?>