<?php
namespace app\Models;

class Feedback {
    private $id;
    private $id_user;
    private $rating;
    private $description;
    private $date_feedback;

    function __construct($id, $id_user, $rating, $description, $date_feedback) {
        $this->id = $id;
        $this->id_user = $id_user;
        $this->rating = $rating;
        $this->description = $description;
        $this->date_feedback = $date_feedback;
    }

    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

    function getIdUser() {
        return $this->id_user;
    }
    function setIdUser($id_user) {
        $this->id_user = $id_user;
    }

    function getRating() {
        return $this->rating;
    }
    function setRating($rating) {
        $this->rating = $rating;
    }

    function getDescription() {
        return $this->description;
    }
    function setDescription($description) {
        $this->description = $description;
    }

    function getDateFeedback() {
        return $this->date_feedback;
    }
    function setDateFeedback($date_feedback) {
        $this->date_feedback = $date_feedback;
    } 
}