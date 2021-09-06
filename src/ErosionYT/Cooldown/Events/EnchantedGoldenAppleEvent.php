<?php

namespace ErosionYT\Cooldown\Events;

use ErosionYT\Cooldown\Main;

use pocketmine\event\player\PlayerItemConsumeEvent;
use pocketmine\item\GoldenAppleEnchanted;
use pocketmine\utils\Config;
use pocketmine\event\Listener;
use pocketmine\command\Command;
use pocketmine\utils\TextFormat;
use pocketmine\command\CommandSender;

class EnchantedGoldenAppleEvent implements Listener {

    public $plugin;
	public $config;
	public $eapplecd;

    public function __construct(Main $plugin) 
    {
        $this->plugin = $plugin;
        $this->config = $plugin->getConfig();
	}
    public function onConsume(PlayerItemConsumeEvent $event)
    {
        $item = $event->getItem();
        if($item instanceof GoldenAppleEnchanted) {
            $cooldown = $this->config->get("cooldown");
            $player = $event->getPlayer();
            if (isset($this->eapplecd[$player->getName()]) and time() - $this->eapplecd[$player->getName()] < $cooldown) {
                $event->setCancelled(true);
                $time = time() - $this->eapplecd[$player->getName()];
                $message = $this->config->get("message");
                $message = str_replace("{cooldown}", ($cooldown - $time), $message);
                $player->sendMessage($message);
            } else {
                $this->eapplecd[$player->getName()] = time();
            }
        }
    }

}
