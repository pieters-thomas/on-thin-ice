<?php


namespace App\Service;


class GenerateLobbyId
{
    public function generateLobbyId():string
    {
        return mb_substr(md5(mt_rand()), 0 , 5);
    }
}
