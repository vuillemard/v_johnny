<?php

class Connexion
{
    public function getPDO()
    {
        return new SQLite3('database.db');
    }
}

?>