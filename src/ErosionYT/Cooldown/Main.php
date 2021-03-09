<?php

namespace ErosionYT\Cooldown;

use ErosionYT\Cooldown\Events\EnchantedGoldenAppleEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase{
    
	const MAIN_PREFIX = "§dCypher§0PE";

	public function onEnable()
    {
		$this->getServer()->getPluginManager()->registerEvents(new EnchantedGoldenAppleEvent($this), $this);
    }
}