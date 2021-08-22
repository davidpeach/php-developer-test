<?php

namespace App\ReqResIn;

use App\Contracts\RawUser;

class ReqResInUser implements RawUser
{
	private $externalId;

	private $firstName;

	private $lastName;

	private $email;

	private $avatar;

	/**
	 * @param string $externalId
	 */
	public function setExternalId(string $externalId): void
	{
		$this->externalId = $externalId;
	}

	/**
	 * @return string
	 */
	public function getExternalId(): string
	{
		return $this->externalId;
	}

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void
	{
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getEmail(): string
	{
		return $this->email;
	}

	/**
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName): void
	{
		$this->firstName = $firstName;
	}

	/**
	 * @return string
	 */
	public function getFirstName(): string
	{
		return $this->firstName;
	}

	/**
	 * @param string $lastName
	 */
	public function setLastName(string $lastName): void
	{
		$this->lastName = $lastName;
	}

	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->lastName;
	}

	/**
	 * @param string $avatar
	 */
	public function setAvatar(string $avatar): void
	{
		$this->avatar = $avatar;
	}

	/**
	 * @return string
	 */
	public function getAvatar(): string
	{
		return $this->avatar;
	}
}