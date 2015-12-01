<?php

namespace Acke\CocaCola;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\ConsoleCommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\utils\TextFormat;
use pocketmine\Player;

class CocaCola extends PluginBase{

    public function onEnable(){
        $this->saveDefaultConfig();
    }

    public function onCommand(CommandSender $sender, Command $command, $label, array $args){
        if(strtolower($command->getName()) == "cocacola"){
            if($sender instanceof Player){
            	if(!($sender->hasPermission("cocacola") || $sender->hasPermission("cocacola.command") || $sender->hasPermission("cocacola.command.me"))) {
                    return false;
    	    	}
            	if(mt_rand(1, 20) == 1){
            	    $sender->setHealth(0);
        	    $sender->sendMessage(TextFormat::RED."Whops! Deliciousness overload...");
      	    	}
      	    	else{
			        	    $sender->setHealth($sender->getHealth() +2);
                    $sender->sendMessage(TextFormat::GREEN."Pure refreshment! Health restored +2.");
                    foreach($this->getConfig()->get("commands") as $command){
                    	$this->getServer()->dispatchCommand(new ConsoleCommandSender(), str_replace("{player}", $sender->getName(), $command));
                    }
            	}
            }
            else{
            	$sender->sendMessage(TextFormat::RED."N00b! Run this command in-game!");
            }
            return true;
        }
    }
}
