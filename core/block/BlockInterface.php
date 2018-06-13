<?php

namespace Ocms\core\block;

/**
 * Description of BlockInterface
 *
 * @author olegiv
 */
interface BlockInterface {
	
	/**
	 * 
	 * @param int $nodeId
	 * @return array
	 */
	public function getBlocksForNode (int $nodeId): array;

	/**
	 *
	 * @return array
	 */
	public function getBlocksForBlogIndex (): array;
}
