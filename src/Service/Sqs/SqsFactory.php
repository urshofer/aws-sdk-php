<?php
namespace Aws\Service\Sqs;

use Aws\Service\ClientFactory;

/**
 * Modifies the host used when connecting to queues and validates the MD5 body
 * of received messages.
 */
class SqsFactory extends ClientFactory
{
    protected function createClient(array $args)
    {
        $client = parent::createClient($args);
        $emitter = $client->getEmitter();
        $emitter->attach(new QueueUrlListener());
        $emitter->attach(new Md5ValidatorListener());

        return $client;
    }
}
