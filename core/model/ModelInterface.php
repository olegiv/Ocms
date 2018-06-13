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
	 */
	public function getNode (int $nodeId);

	/**
	 *
	 * @return array
	 */
	public function getBlogs ();
	
	/**
	 * 
	 * @param int $blockId
	 * @return \stdClass
	 */
	public function getBlock (int $blockId);

	/**
	 *
	 * @return array
	 */
	public function getBlocksForBlogIndex ();
}
