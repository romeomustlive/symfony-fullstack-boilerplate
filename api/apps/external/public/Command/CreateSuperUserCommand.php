<?php


namespace App\Apps\External\Pub\Command;


use App\Auth\Application\Register\RegisterUserCommand;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\ValueObject\Uuid;
use App\Shared\Infrastructure\Security\Hasher;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class CreateSuperUserCommand extends Command
{
    private CommandBus $bus;
    protected static $defaultName = 'app:create-superuser';

    public function __construct(CommandBus $bus)
    {
        $this->bus = $bus;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $helper = $this->getHelper('question');

        $questionEmail = new Question('email:');
        $questionPassword = new Question('password:');
        $questionPassword->setHidden(true);

        $this->bus->dispatch(
            new RegisterUserCommand(
                Uuid::random(),
                $helper->ask($input, $output, $questionEmail),
                Hasher::hash($helper->ask($input, $output, $questionPassword))
            )
        );

        $output->writeln('User successfully created.');

        return 0;
    }
}