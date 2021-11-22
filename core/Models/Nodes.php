<?php

namespace Ocms\Core\Models;

use Phalcon\Mvc\Model;

/**
 * Nodes Model Class.
 *
 * @package core
 * @access public
 * @since 10.11.2021
 * @version 0.0.0 21.11.20219
 * @author Oleg Ivanchenko <oleg@ivanchenko.ch>
 * @copyright Copyright (C) 2021, OCMS
 */
class Nodes extends Model
{
	/**
	 * @var int|null
	 */
	public ?int $id = null;

	/**
	 * @var string
	 */
	public string $title;

	/**
	 * @var string
	 */
	public string $body;

	/**
	 * @var string
	 */
	public string $abstract;

	/**
	 * @var string
	 */
	public string $name;

	/**
	 * @var string
	 */
	public string $created_at;

	/**
	 * @var int|null
	 */
	public ?int $is_published = null;

}
