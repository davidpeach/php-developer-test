<?php

namespace App\Contracts;

interface RawUser
{
	/**
	 * @param string $externalId
	 */
	public function setExternalId(string $externalId): void;

	/**
	 * @return string
	 */
	public function getExternalId(): string;

	/**
	 * @param string $email
	 */
	public function setEmail(string $email): void;

	/**
	 * @return string
	 */
	public function getEmail(): string;

	/**
	 * @param string $firstName
	 */
	public function setFirstName(string $firstName): void;

	/**
	 * @return string
	 */
	public function getFirstName(): string;

	/**
	 * @param string $lastName
	 */
	public function setLastName(string $lastName): void;

	/**
	 * @return string
	 */
	public function getLastName(): string;

	/**
	 * @param string $avatar
	 */
	public function setAvatar(string $avatar): void;

	/**
	 * @return string
	 */
	public function getAvatar(): string;
}