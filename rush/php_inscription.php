<?php

abstract class Inscription
{

   protected $ca_id;
   protected $ca_username;
   protected $ca_password;
   protected $ca_admin;

   function __construct($username, $password, $admin)
   {
      $this->ca_username = $username;
      $this->ca_password = $password;
      $this->ca_admin = $admin;
  }

   public function getUsername()
   {
      return $this->ca_username;
   }

   public function getPassword()
   {
      return $this->ca_password;
   }

   public function getAdmin()
   {
      return $this->ca_admin;
   }

   public function setUsername($username)
   {
      $this->ca_username = $username;
   }

   public function setPassword($password)
   {
      $this->ca_password = $password;
   }

   public function setAdmin($admin)
   {
      $this->ca_admin = $admin;
   }

   private function form($array, $submit, $action = NULL)
   {
      echo '<form action=$action method="post">';
      foreach ($array as $key => $value)
      {
         echo '<p><label for='.$key.'>'.$value.'</label><input type="text" name='.$key.' id='.$key.' required/></p>';
      }
      echo '<p><button type="submit">'.$submit.'</button></form></p>';
   }
}
?>
