<?php

namespace Ocms\core\block;

/**
 * BlockInterface Interface.
 *
 * @package core
 * @access public
 * @since 10.06.2018
 * @version 0.0.4 03.04.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2018 - 2019, OCMS
 */
interface BlockInterface {

	/**
	 * @param int $blockId
	 * @return string
	 */
	public function renderBlockById(int $blockId): string;

	/**
	 *
	 * @param int $nodeId
	 * @return array
	 */
	public function getBlocksForNode (int $nodeId): array;
}
