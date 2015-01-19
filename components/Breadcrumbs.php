<?php
/**
 * Breadcrumbs
 *
 * @author Semenov Alexander <semenov@skeeks.com>
 * @link http://skeeks.com/
 * @copyright 2010-2014 SkeekS (Sx)
 * @date 15.01.2015
 * @since 1.0.0
 */
namespace skeeks\cms\components;

use skeeks\cms\base\components\Descriptor;
use skeeks\cms\base\db\ActiveRecord;
use skeeks\cms\models\Site;
use skeeks\cms\models\StorageFile;
use skeeks\cms\models\Tree;
use skeeks\cms\models\TreeType;
use skeeks\cms\models\User;
use skeeks\cms\widgets\Infoblock;
use skeeks\cms\widgets\StaticBlock;
use skeeks\sx\models\IdentityMap;
use Yii;
use yii\base\Component;
use yii\base\Event;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;
use yii\web\View;

/**
 * Class Cms
 * @package skeeks\cms\components
 */
class Breadcrumbs extends \skeeks\cms\base\Component
{
    /**
     * @var array
     */
    public $parts = [];

    public function init()
    {
        parent::init();
    }

    /**
     * @param array $data
     * @return $this
     */
    public function append($data = [])
    {
        $this->parts[] = $data;
        return $this;
    }

    /**
     * @param Tree $tree
     * @return $this
     */
    public function setPartsByTree(Tree $tree)
    {
        $parents = $tree->fetchParents();
        $parents[] = $tree;

        foreach ($parents as $tree)
        {
            $this->append([
                'name'          => $tree->name,
                'url'           => $tree->getPageUrl(),
                'data'          => [
                    'model' => $tree
                ],
            ]);
        }

        return $this;
    }

}