<?php

namespace App\Console\Commands;

use App\Jobs\UpdateOrCreateUser;
use App\ReqResIn\ReqResInApi;
use App\ReqResIn\ReqResInUser;
use Illuminate\Console\Command;

class ImportUsersCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jump:users:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import users';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ReqResInApi $api)
    {
        $rawUsers = $api->getUsers();

        $rawUsers->each(function (ReqResInUser $rawUser) {
            UpdateOrCreateUser::dispatch($rawUser);
        });

        return 0;
    }
}
