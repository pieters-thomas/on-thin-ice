<?php


namespace App\Server;


use Ratchet\Http\HttpServer;
use Ratchet\Server\IoServer;
use Ratchet\WebSocket\WsServer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunServerCommand extends Command
{
    protected static $defaultName = 'server:run';

    protected function configure():void
    {
        $this->setDescription('Start Catan Server');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $server = IoServer::factory(
            new HttpServer(
                new WsServer(
                    new GameServer()
                )
            ),
            8080
        );

        $server->run();
    }
}
