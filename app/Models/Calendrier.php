<?php

namespace app\Models;

class Calendrier {
    private $id;
    private $title;
    private $description;
    private $start_datetime;
    private $end_datetime;

    function __construct($id, $title, $description, $start_datetime, $end_datetime) {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->start_datetime = $start_datetime;
        $this->end_datetime = $end_datetime;
    }

    function getId() {
        return $this->id;
    }
    function setId($id) {
        $this->id = $id;
    }

    function getTitle() {
        return $this->title;
    }
    function setTitle($title) {
        $this->title = $title;
    }

    function getDescription() {
        return $this->description;
    }
    function setDescription($description) {
        $this->description = $description;
    }

    function getStartDatetime() {
        return $this->start_datetime;
    }
    function setStartDatetime($start_datetime) {
        $this->start_datetime = $start_datetime;
    }
    
    function getEndDatetime() {
        return $this->end_datetime;
    }
    function setEndDatetime($end_datetime) {
        $this->end_datetime = $end_datetime;
    }
}