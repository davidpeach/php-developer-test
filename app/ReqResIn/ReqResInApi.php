<?php

namespace App\ReqResIn;

use App\ReqResIn\ReqResInUser;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class ReqResInApi
{
	private $baseUrl;

	public function __construct(string $baseUrl)
	{
		$this->baseUrl = $baseUrl;
	}

	/**
	 * Get the users from ReqResIn
	 * @return Collection
	 */
	public function getUsers(): Collection
	{
		$response = Http::get(
			vsprintf(
				'%s/users?page=1',
				[
					$this->baseUrl,
				]
			)
		);

		$data = collect($response->json()['data']);

		return $data->map(function ($rawData) {
			$rawUser = new ReqResInUser;
			$rawUser->setExternalId('7');
	        $rawUser->setEmail('michael.lawson@reqres.in');
	        $rawUser->setFirstName('Michael');
	        $rawUser->setLastName('Lawson');
	        $rawUser->setAvatar('https://reqres.in/img/faces/7-image.jpg');
	        return $rawUser;
		});
	}
}