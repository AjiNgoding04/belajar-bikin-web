<?php 
    namespace App\Services;

    class HelloServiceIndonesia implements HelloService
    {
        public function Hello(string $name) : string
        {
            return "Hello ".$name;
        }
    }
    
?>