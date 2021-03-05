<?php
/**
 *
 */
namespace SimoneBaldini\WordPressStarterTheme;

use Composer\Script\Event;
use Symfony\Component\Console\Application;
use SimoneBaldini\WordPressStarterTheme\Commands\SetupCommand;
use Symfony\Component\Console\Input\ArrayInput;

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
    public static function run(Event $event)
    {
        $path = dirname($event->getComposer()->getConfig()->get('vendor-dir'));
        $application = new Application();
        $command = new SetupCommand('app:setup');
        $application->add($command);
        $application->setDefaultCommand($command->getName());
        $input = new ArrayInput([
            'command' => 'app:setup',
            'path' => $path,
        ]);
        $application->run($input);
    }
}