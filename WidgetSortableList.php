<?php
namespace c006\widget\sortableList;

use c006\widget\sortableList\assets\AppAssets;

class WidgetSortableList extends \yii\bootstrap\Widget
{

    public $class_name = 'WidgetSortableList';
    /**
     * @var bool
     */
    public $is_destination = FALSE;
    /**
     * @var string
     */
    public $container_class = '';
    /**
     * @var bool
     */
    public $has_groups = FALSE;
    /**
     * @var string
     */
    public $ul_class = '';
    /**
     * @var string
     */
    public $ul_id = '';
    /**
     * @var string
     */
    public $li_class = '';
    /**
     * @var string
     */
    public $group_class = '';
    /**
     * @var array
     */
    public $array = array();
    /**
     * @var string
     */
    public $unique_id = '';

    /**
     * Add css
     */
    function init()
    {
        parent::init();
        /* ToDo - C006 - CSS Dev - uncomment when finished */
        // AppAssets::register($this->getView());
    }


    /**
     * Executes the widget.
     * This method is called by {@link CBaseController::endWidget}.
     */
    public function run()
    {
        $this->unique_id = 'id_' . rand(100, 900) . '_' . rand(100, 900) . '_' . rand(100, 900);
        $array = [];
        $array['unique_id'] = $this->unique_id;
        $array['class_name'] = $this->class_name;
        $array['is_destination'] = $this->is_destination;
        $array['has_groups'] = $this->has_groups;
        $array['group_class'] = $this->class_name . '-group';
        $array['ul_class'] = $this->class_name . '-ul';
        $array['li_class'] = $this->class_name . '-li ui-state-default';
        $array['ul_id'] = 'ul-' . $array['unique_id'];

        if ($array['is_destination']) {
            $array['container_class'] = $this->class_name . '-destination';
        } else {
            $array['container_class'] = $this->class_name . '-available';
        }
        if ($this->group_class) {
            $array['group_class'] .= $this->group_class;
        }
        if ($this->ul_class) {
            $array['ul_class'] .= $this->ul_class;
        }
        if ($this->li_class) {
            $array['li_class'] .= $this->li_class;
        }

        $array['array'] = $this->array;

        if ($this->is_destination) {
            if ($this->has_groups) {
                return $this->render('destination-groups', $array);
            }

            return $this->render('destination', $array);
        }

        return $this->render('available', $array);
    }
}
