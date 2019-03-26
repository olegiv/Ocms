<?php

namespace Ocms\core\app\blog\controller;

use Ocms\core\app\blog\service\BlogEntity;
use Ocms\core\app\tag\service\TagEntity;
use Ocms\core\controller\ControllerBase;
use Ocms\core\controller\ControllerBaseInterface;
use Ocms\core\Kernel;

/**
 * MigrationController Class.
 *
 * @package core
 * @access public
 * @since 21.02.2019
 * @version 0.0.0 21.02.2019
 * @author Oleg Ivanchenko <oiv@ry.ru>
 * @copyright Copyright (C) 2019, OCMS
 */
class MigrationController extends ControllerBase implements ControllerBaseInterface {

	/**
	 * @throws \Ocms\core\exception\ExceptionRuntime
	 */
	public static function migrate() {

		if (($sourceItems = Kernel::$modelObj->fetch ('SELECT * FROM e_blog_post'))) {

			$tagEntity = new TagEntity();
			$blogEntity = new BlogEntity();

			foreach ($sourceItems as $sourceItem) {

				$destItem = (object)[
					'id' => $sourceItem->id,
					'id2_author' => 1,
					'id2_category' => 1,
					'title' => $sourceItem->title,
					'body' => str_replace (
						[' src="/files/', ' href="/files/'], [' src="/img/', ' href="/img/'], $sourceItem->body),
					'created' => $sourceItem->ts,
					'content_date' => $sourceItem->ts,
					'thumbnail' => str_replace ('/files/', '/img/', $sourceItem->thumbnail),
					'tags' => '',
					'abstract' => '',
					'description' => ''
				];

				// Tags {
				if (isset ($sourceItem->tags)) {
					if (($tags = explode (',', $sourceItem->tags))) {
						$tagsDest = [];
						foreach ($tags as $tag) {
							$tag = trim ($tag);
							if (($tagId = $tagEntity->add ($tag))) {
								$tagsDest[] = $tagId;
							} else {
								if (($tagItem = $tagEntity->getByLabel ($tag))) {
									$tagsDest[] = $tagItem->id;
								}
							}
						}
						if ($tagsDest) {
							$destItem->tags = join (',', array_unique ($tagsDest));
						}
					}
				}
				// Tags }

				$blogEntity->add($destItem);
			}
		}
	}
}
