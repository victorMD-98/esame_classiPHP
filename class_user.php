<?php

namespace Utenti{
    class Utente{
        public $name;
        public $surname;
        public $tel;
        public $city;
        private $email;
        private $password;
        public $img;

        function __construct($name,
        $surname,
        $tel,
        $city,
        $email,
        $password,
        $img){
            $this->name=$name;
            $this->surname=$surname;
            $this->tel=$tel;
            $this->city=$city;
            $this->email=$email;
            $this->password=$password;
            $this->img=$img;
        }
        function getPass(){
            return $this->password;
        }
        function getEmail(){
            return $this->email;
        }
    }
}