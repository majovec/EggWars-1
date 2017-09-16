<?php

namespace Enes5519\EggWars\Lang;

use Enes5519\EggWars\EggWars;
use pocketmine\utils\Config;

class LangManager {

    private $cfg;

    public function __construct($dil){
        $api = EggWars::getAPI();
        $this->cfg = new Config($api->langDir().'lang_'.$dil.'.yml', Config::YAML);
    }

    public function translate($text, ...$args){
        $text = $this->cfg->get($text);
        foreach ($args as $key => $deger) {
            $text = str_ireplace("{%$key}", $deger, $text);
        }
        return $text;
    }
}