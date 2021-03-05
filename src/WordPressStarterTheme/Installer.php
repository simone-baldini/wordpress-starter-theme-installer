<?php
/**
 * 
 */
namespace SimoneBaldini\WordPressStarterTheme;

use Composer\Script\Event;
use Symfony\Component\Console\Application;
use SimoneBaldini\WordPressStarterTheme\Commands\SetupCommand;

/**
 * Undocumented class
 */
class Installer
{
    /**
     * Undocumented function
     *
     * @return void
     */
    public static function run(Event $event=null)
    {
        $application = new Application();
        $command = new SetupCommand();
        $application->add($command);
        $application->setDefaultCommand($command->getName());
        $application->run();
    }
}