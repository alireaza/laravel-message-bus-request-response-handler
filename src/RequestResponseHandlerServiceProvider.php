<?php

namespace AliReaza\Laravel\MessageBus\RequestResponseHandler;

use Illuminate\Support\ServiceProvider;
use AliReaza\Laravel\MessageBus\RequestResponseHandler\Commands\HandleGatewayRequestMessageFromKafkaCommand;

class RequestResponseHandlerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . DIRECTORY_SEPARATOR . 'config.php', 'request-response-handler');

        $this->commands(HandleGatewayRequestMessageFromKafkaCommand::class);
    }
}
