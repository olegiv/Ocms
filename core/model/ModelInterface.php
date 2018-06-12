<?php

namespace Ocms\core\model;

/**
 * Description of Model
 *
 * @author olegiv
 */
interface ModelInterface {

	/**
	 * 
	 * @param int $nodeId
	 * @return \stdClass
	 * @throws Ocms\core\exception\Exception
	 */
	public function getNode (int $nodeId): \stdClass;
	
	/**
	 * 
	 * @param int $blockId
	 * @return \stdClass
	 * @throws Ocms\core\exception\Exception
	 */
	public function getBlock (int $blockId): \stdClass;
}
