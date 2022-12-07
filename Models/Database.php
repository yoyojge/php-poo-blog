<?php

namespace Models;

use PDO;

class Database {
    
    protected $bdd;

    public function __construct()
    {
        try {
            $this->bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}
