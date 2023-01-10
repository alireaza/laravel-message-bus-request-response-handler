<?php

namespace AliReaza\Laravel\MessageBus\RequestResponseHandler\Handlers;

use AliReaza\Laravel\MessageBus\Kafka\Events\MessageCreated;
use AliReaza\MessageBus\HandlerInterface;
use AliReaza\MessageBus\Message;
use AliReaza\MessageBus\MessageInterface;

class RequestHandler implements HandlerInterface
{
    private string $response_message_name;

    public function __construct()
    {
        $config = config('request-response-handler');

        $this->response_message_name = $config['request']['response']['message']['name'];
    }

    public function __invoke(MessageInterface $message): void
    {
        $message = new Message(
            content: 'Request received.',
            causation_id: $message->getCausationId(),
            correlation_id: $message->getCorrelationId(),
            name: $this->response_message_name,
        );

        MessageCreated::dispatch($message);
    }
}
