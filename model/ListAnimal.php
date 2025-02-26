<?php
class ListAnimal {
    private $id;
    private $animalimage;
    private $animals_id;

    // Getters and setters for each property
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAnimalimage() {
        return $this->animalimage;
    }

    public function setAnimalimage($animalimage) {
        $this->animalimage = $animalimage;
    }

    public function getAnimalsId() {
        return $this->animals_id;
    }

    public function setAnimalsId($animals_id) {
        $this->animals_id = $animals_id;
    }
}
?>