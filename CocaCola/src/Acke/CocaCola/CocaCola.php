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
								if(!($sender->hasPermission("cocacola") || $sender->hasPermission("cocacola.command") || $sender->hasPermission("cocacola.command.cocacola"))) {
										return false;
								}
						if(mt_rand(1, 20) == 1){
								$sender->setHealth(0);
								$sender->sendMessage(TextFormat::RED."Whops! Deliciousness overload...");
						}
						else{
								if($sender->getHealth() == 19){
								    $sender->setHealth(20);
								    $sender->sendMessage(TextFormat::GREEN."Pure refreshment! Full health!");
							  }
								if($sender->getHealth() <= 18){
										$sender->setHealth($sender->getHealth() + 2);
										$sender->sendMessage(TextFormat::GREEN."Pure refreshment! Health +2.");
								}
								if($sender->getFood() == 19){
  							    $sender->setFood(20);
									  $sender->sendMessage(TextFormat::GREEN."Ahhh! Thirst Stops Here.");
								}
								if($sender->getFood() <= 18){
									  $sender->setFood($sender->getFood() + 2);
									  $sender->sendMessage(TextFormat::GREEN."Ahhh! Food +2.");
								}
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
