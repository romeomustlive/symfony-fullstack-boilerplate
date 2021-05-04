<?php


namespace App\Shared\Infrastructure\Bus\Command;


use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Infrastructure\Bus\CallableFirstParameterExtractor;
use App\Shared\Infrastructure\Bus\ValidationMiddleware;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\Exception\NoHandlerForMessageException;
use Symfony\Component\Messenger\Handler\HandlersLocator;
use Symfony\Component\Messenger\MessageBus;
use Symfony\Component\Messenger\Middleware\HandleMessageMiddleware;
use Symfony\Component\Validator\Validator\ValidatorInterface;


final class InMemorySymfonyCommandBus implements CommandBus
{
    private MessageBus $bus;
    private ValidatorInterface $validator;

    public function __construct(iterable $commandHandlers, ValidatorInterface $validator)
    {
        $this->validator = $validator;
        $this->bus = new MessageBus(
            [
                new HandleMessageMiddleware(
                    new HandlersLocator(CallableFirstParameterExtractor::forCallables($commandHandlers))
                ),
                new ValidationMiddleware($this->validator)
            ]
        );
    }

    public function dispatch(Command $command): void
    {
        try {
            $this->bus->dispatch($command);
        } catch (NoHandlerForMessageException $e) {
            throw new CommandNotRegisteredError($command);
        } catch (HandlerFailedException $e) {
            throw $e->getPrevious() ?? $e;
        }

    }
}