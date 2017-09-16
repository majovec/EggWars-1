<?php

namespace Enes5519\EggWars;

use Enes5519\EggWars\Lang\LangManager;
use pocketmine\plugin\PluginBase;

class EggWars extends PluginBase {

    /** @var  EggWars */
    private static $api;
    /** @var  LangManager */
    public $lang = null;
    public $prefix = "";

    public function onLoad(){
        self::$api = $this;
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        $lang = $this->getConfig()->get("lang");
        if(!file_exists($this->langDir()."lang_".$lang.".yml")){
            throw new \Exception("Lang file not found: ".$lang);
        }
        $this->prefix = $this->getConfig()->get("prefix");
        $this->lang = new LangManager($lang);
    }

    public function onEnable(){
        $this->konsol("plugin-enabled", "§a", true, "deneme");
    }

    public function konsol($text, $first = "", $translate = true, ...$translatearg){
        if($translate){
            $text = $this->lang->translate($text, ...$translatearg);
        }
        $this->getServer()->getLogger()->info($this->prefix.$first.$text);
    }

    public static function getAPI(){
        return self::$api;
    }

    public function langDir(){
        return $this->getFile()."/resources/langs/";
    }
}