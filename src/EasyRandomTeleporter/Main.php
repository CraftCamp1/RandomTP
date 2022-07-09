<?php

namespace EasyRandomTeleporter;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;

use pocketmine\event\Listener;
use pocketmine\utils\TextFormat as Fart;

use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {

    public function onEnable() : void {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

	public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool {
        switch(strtolower($command->getName())) {
            case "randomtp":
            case "rtp":
                if (!$player instanceof Player) {
					$player->sendMessage("Use in-game");
				}else{
				    $to = $this->getServer()->getOnlinePlayers()[array_rand($this->getServer()->getOnlinePlayers())];
				    $player->teleport($to->getPosition());
				    if($to === $player) {
				        $player->sendMessage(Fart::RED."There is no one online to teleport to!");
				        }else{
					    $player->sendMessage(Fart::YELLOW."You have teleported to ".Fart::GREEN.$to->getName());
				}
			}
        }
        return true;
    }
}
