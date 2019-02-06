<?php

namespace App\Service;

class ConfigService
{
    private $data;
    private $file_path=__DIR__ . "/../../config/config.json";
    function __construct()
    {
        $this->data = json_decode(file_get_contents($this->file_path));
    }

    public function getConfig($prop): ?string
    {
        return isset($this->data->$prop)?$this->data->$prop:null;
    }

    public function setConfig($prop,$value): void
    {
        $this->data->$prop=$value;
        file_put_contents($this->file_path,json_encode($this->data));
    }


}