<?php
/** @var $array array */
use yii\bootstrap\Html;

/** @var $unique_id string */
/** @var $container_class string */
/** @var $ul_id string */
/** @var $ul_class string */
/** @var $li_class string */
/** @var $group_class string */
/** @var $class_name string */
?>

<div id="<?= $unique_id ?>" class="<?= $container_class ?>">
    <p>
    <div class="table">
        <div class="table-cell vertical-align-top">
            <input id="<?= $unique_id ?>-input" type="text" class="form-control" style="margin-left: 5px" placeholder="group container name"/>
        </div>
        <div class="table-cell vertical-align-top">
            <?= Html::button('Add Group Container', ['class' => 'btn btn-success', 'id' => $unique_id . '-button']) ?>
        </div>
    </div>
    </p>
    <div class="<?= $group_class ?>-container">
        <?php foreach ($array as $section_id => $section) : ?>
            <div class="<?= $group_class ?>"
                 id="<?= $unique_id ?>-<?= strtolower(preg_replace('/[^a-z|A-Z\0-9]/', '', $section['name'])) ?>"
                 item_name="<?= $section['name'] ?>"
                 item_id="<?= $section['id'] ?>"
                >
                <div>
                    <?= $section['name'] ?>
                    <span title="Move Group" class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-arrowthick-2-n-s"></span></span>
                    <span class="<?= $class_name ?>-close" item_id="groups-<?= $section['id'] ?>">x</span>
                </div>
                <ul id="<?= $ul_id ?>" class="<?= $ul_class ?>">
                    <?php foreach ($section['array'] as $i => $item) : ?>
                        <?php
                        $required = '';
                        $required_item = 'false';
                        if ($item['is_required']) {
                            $required = 'required';
                            $required_item = 'true';
                        }
                        ?>
                        <li class="<?= $li_class ?>"
                            item_id="<?= $item['id'] ?>"
                            item_link_id="<?= (isset($item['link_id'])) ? $item['link_id'] : 0 ?>"
                            item_name="<?= (isset($item['name'])) ? $item['name'] : $item['data'] ?>"
                            item_required="<?= $required_item ?>">
                            <?php if (isset($item['label'])) : ?>
                                <div class="label <?= $required ?>"><?= $item['label'] ?></div>
                            <?php endif ?>
                            <?php if (isset($item['data'])) : ?>
                                <div class="label <?= $required ?>"><?= $item['data'] ?></div>
                            <?php endif ?>
                            <?php if (isset($item['name'])) : ?>
                                <div class="name"><?= $item['name'] ?></div>
                            <?php endif ?>
                        </li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endforeach ?>
    </div>
</div>
<script type="text/javascript">

    jQuery(function () {
        <?= $unique_id ?>();

        jQuery('#<?= $unique_id ?>-button')
            .bind('click', function () {
                var $container = jQuery('#<?= $unique_id ?>');
                var $input = jQuery('#<?= $unique_id ?>-input');
                var group_id = '<?= $unique_id ?>-' + $input.val().toLocaleLowerCase().replace(/[^0-9|a-z]/gi, '');

                $container
                    .find('.<?= $group_class ?>-container')
                    .prepend('' +
                    '<div id="' + group_id + '" class="<?= $group_class ?>"  item_name="' + $input.val() + '" item_id="0" >' +
                    '<div class="label" >' + $input.val() +
                    '<span class="<?= $class_name ?>-close" item_id="' + group_id + '">x</span>' +
                    '</div >' +
                    '<ul class="<?= $ul_class  ?>"></ul >' +
                    '</div >');
                $input.val("");
                <?= $unique_id ?>();
            });
    });


    function <?= $unique_id ?>() {
        var _wh = jQuery(window).height();
        var $<?= $unique_id ?> = jQuery('#<?= $unique_id ?>');
        $<?= $unique_id ?>
            .find('.<?= $group_class ?>-container')
            .css({
                minHeight: (_wh * 0.5) + 'px',
//                overflowY: 'scroll',
//                overflowX: 'hidden'
            })
            .sortable({forcePlaceholderSize: true})
            .disableSelection();
        $<?= $unique_id ?>
            .find('#<?= $ul_id ?>')
            .sortable()
            .disableSelection();
        jQuery('.<?= $class_name .'-ul' ?>')
            .sortable({
                connectWith: ".<?= $class_name .'-ul' ?>",
                placeholder: 'WidgetSortableList-placeholder',
                forcePlaceholderSize: true,
                dropOnEmpty: true
            }).disableSelection();
    }


</script>
