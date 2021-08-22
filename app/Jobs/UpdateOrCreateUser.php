<?php

namespace App\Jobs;

use App\Models\User;
use App\ReqResIn\ReqResInUser;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateOrCreateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $rawUser;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(ReqResInUser $rawUser)
    {
        $this->rawUser = $rawUser;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        User::updateOrCreate([
            'external_id' => $this->rawUser->getExternalId(),
        ], [
            'first_name' => $this->rawUser->getFirstName(),
            'last_name' => $this->rawUser->getLastName(),
            'email' => $this->rawUser->getEmail(),
            'avatar' => $this->rawUser->getAvatar(),
        ]);
    }
}
