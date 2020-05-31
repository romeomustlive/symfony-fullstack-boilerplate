<?php

namespace App\Infrastructure\Console\Commands;

use App\Core\Auth\Actions\CreateSuperUserAction;
use App\Core\Auth\DTO\CreateSuperUserDTO;
use Illuminate\Console\Command;

class RegisterSuperUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-super-user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private CreateSuperUserAction $createSuperUser;

    /**
     * Create a new command instance.
     *
     * @param CreateSuperUserAction $createSuperUser
     */
    public function __construct(CreateSuperUserAction $createSuperUser)
    {
        parent::__construct();
        $this->createSuperUser = $createSuperUser;
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $dto = new CreateSuperUserDTO();
        $dto->name = $this->argument('name');
        $dto->email = $this->argument('email');
        $dto->password = $this->argument('password');

        $this->createSuperUser->execute($dto);
    }
}
