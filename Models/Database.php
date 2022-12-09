<?php

namespace Models;

use PDO;




class Database {
    
    protected $bdd;

    public function __construct()
    {
        try {
            // $this->bdd = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', '');
            include('gitIgnore/connectDatabase.php');
            $this->bdd = new PDO('mysql:host='.$host.';dbname='.$dbname.';charset=utf8', $log, $psw);
        }
        catch(\Exception $e){
            echo $e->getMessage();
        }
    }
}
