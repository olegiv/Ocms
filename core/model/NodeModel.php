<?php

namespace Ocms\core\model;

use Ocms\core\Kernel;

/**
 * Description of NodeModel
 *
 * @author olegiv
 */
class NodeModel {

	/**
	 * 
	 * @param int $nodeId
	 * @return \stdClass
	 */
	public static function getNode (int $nodeId) {
		
		return Kernel::$modelObj->single('SELECT * FROM #prefix#node WHERE id=?', $nodeId);
	}	
}
