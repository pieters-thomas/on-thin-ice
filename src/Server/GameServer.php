<?php


namespace App\Server;


use JetBrains\PhpStorm\Pure;
use Ratchet\ConnectionInterface;
use Ratchet\MessageComponentInterface;

class GameServer implements MessageComponentInterface
{

    protected \SplObjectStorage $clients;

    #[Pure] public function __construct() {
        $this->clients = new \SplObjectStorage;
    }

    /**
     * @inheritDoc
     */
    public function onOpen(ConnectionInterface $conn):void
    {
        $this->clients->attach($conn);
    }

    /**
     * @inheritDoc
     */
    public function onClose(ConnectionInterface $conn):void
    {
        $this->clients->detach($conn);
    }

    /**
     * @inheritDoc
     */
    public function onError(ConnectionInterface $conn, \Exception $e):void
    {
        // TODO: Implement onError() method.
    }

    /**
     * @inheritDoc
     */
    public function onMessage(ConnectionInterface $from, $msg):void
    {
        // TODO: Implement onMessage() method.

    }
}
