<?php
namespace app\Models;

class ImageMachine {
    private $id;
    private $image1;
    private $image2;
    private $image3;

    function __construct($id, $image1, $image2, $image3)
    {
        $this->id = $id;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->image3 = $image3;
    }

    function getId(){
        return $this->id;
    }
    function setId($id){
        $this->id = $id;
    }
    
    function getImage1(){
        return $this->image1;
    }
    function setImage1($image1){
        $this->image1 = $image1;
    }

    function getImage2(){
        return $this->image2;
    }
    function setImage2($image2){
        $this->image2 = $image2;
    }

    function getImage3(){
        return $this->image3;
    }
    function setImage3($image3){
        $this->image3 = $image3;
    }

}