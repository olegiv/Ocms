<?php

namespace Ocms\Core\Models;

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;

/**
 * Users Model Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class Users extends Model
{
	/**
	 * @var int|null
	 */
	public ?int $id = null;

	/**
	 * @var string
	 */
	public string $username;

	/**
	 * @var string
	 */
	public string $password;

	/**
	 * @var string
	 */
	public string $email;

	/**
	 * @var string
	 */
	public string $name;

	/**
	 * @var string
	 */
//	public string $created_at;

	/**
	 * @var int|null
	 */
	public ?int $active = null;

	/**
	 * @return bool
	 */
	protected function validation(): bool
	{
		$validator = new Validation();

		$validator->add('username', new UniquenessValidator([
			'message' => 'This username has been used already by another user'
		]));

		$validator->add('email', new UniquenessValidator([
			'message' => 'This email has been used already by another user'
		]));

		$validator->add('email', new EmailValidator([
			'message' => 'Invalid email format'
		]));

		return $this->validate($validator);
	}
}
