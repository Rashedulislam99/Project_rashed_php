<?php
 class DistrictController{
    
    
    
    public function index(){
      $data= District::getAll();
      view("Address",  $data);
    }
 }
?>