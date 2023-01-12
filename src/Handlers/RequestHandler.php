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
        $content = $message->getContent();

        $array = json_decode($content, true);

        if (json_last_error() === JSON_ERROR_NONE) {
            $array = [
                'status' => 'Valid',
                'body' => $array['request'] ?? null,
                'files' => $array['files'] ?? null,
            ];
        } else {
            $array = [
                'status' => 'Invalid',
                'body' => $content,
            ];
        }

        $message = new Message(
            content: json_encode($array),
            causation_id: $message->getCausationId(),
            correlation_id: $message->getCorrelationId(),
            name: $this->response_message_name,
        );

        MessageCreated::dispatch($message);
    }
}
