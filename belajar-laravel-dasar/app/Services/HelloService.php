<?php 
    namespace App\Services;

    interface HelloService {
        public function Hello(string $name) : string;
    }
?>