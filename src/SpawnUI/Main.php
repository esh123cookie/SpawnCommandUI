<?php
/*
   _____  .__                .___  __          ____  ________
  /  _  \ |  |   ____ ___  __|   |/  |________/_   |/  _____/
 /  /_\  \|  | _/ __ \\  \/  /   \   __\___   /|   /   __  \ 
/    |    \  |_\  ___/ >    <|   ||  |  /    / |   \  |__\  \
\____|__  /____/\___  >__/\_ \___||__| /_____ \|___|\_____  /
        \/          \/      \/               \/           \/ 
*/
namespace SpawnUI;
use pocketmine\Server;
use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\TextFormat;
use pocketmine\level\Location;
use pocketmine\Player;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\CommandExecutor;
use pocketmine\command\ConsoleCommandSender;
class Main extends PluginBase implements Listener {
	
    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);    
        $this->getLogger()->info(TextFormat::GREEN . "spawn Enable");
    }
    public function onDisable() {
        $this->getLogger()->info(TextFormat::RED . "spawn Disable");
    }
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
        switch($cmd->getName()){                    
            case "spawn":
                if ($sender->hasPermission("spawn.command")){
                     $this->Menu($sender);
                }else{     
                     $sender->sendMessage(TextFormat::RED . "You dont have permission!");
                     return true;
                }     
            break;         
            
         }  
        return true;                         
    }
   
	public function Menu($sender){ 
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $sender, int $data = null) { 
            $result = $data;
            if($result === null){
                return true;
            }             
            switch($result){
                case 0:
        $sender->teleport(Location::fromObject($this->getServer()->getDefaultLevel()->getSpawnLocation(), $this->getServer()->getDefaultLevel()));
        $sender->addTitle(TextFormat::GREEN . "Teleporting...");
                break;			
            }
            
            
            });
            $form->setTitle("§bSpawn");
			$form->setContent("§3Teleport to Spawn");
            $form->addButton("§aSubmit");
	    $form->addButton("");
            $form->addButton("§cClose");
            $form->sendToPlayer($sender);
            return $form;                                            
    }
 
                                                                                                                                                                                                                                                                                          
}
