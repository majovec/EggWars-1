

<?php

namespace Enes5519\EggWars;

use pocketmine\lang\BaseLang;
use pocketmine\plugin\PluginBase;

class EggWars extends PluginBase {

    /** @var  EggWars */
    private static $api;
    /** @var BaseLang $baseLang */
	private $baseLang = null;
    public $prefix = "";

    /**
	 * @api
	 * @return BaseLang
	 */
	public function getLanguage() : BaseLang {
		return $this->baseLang;
	}
    
    
    public function onLoad(){
        self::$api = $this;
        @mkdir($this->getDataFolder());
        $this->saveDefaultConfig();
        

    public function onEnable(){
        
        $lang = $this->getConfig()->get("lang", BaseLang::FALLBACK_LANGUAGE);

		$this->baseLang = new BaseLang($lang, $this->getFile() . "resources/langs/");
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
