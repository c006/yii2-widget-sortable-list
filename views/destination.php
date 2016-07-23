<?php
/** @var $array array */
/** @var $container_class string */
/** @var $class_name string */
/** @var $unique_id string */
/** @var $ul_id string */
/** @var $ul_class string */
/** @var $li_class string */
?>

<div id="<?= $unique_id ?>" class="<?= $container_class ?>">
    <ul id="<?= $ul_id ?>" class="<?= $ul_class ?>">
        <?php foreach ($array as $i => $item) : ?>
            <?php
            $required      = '';
            $required_item = 'false';
            if ($item['is_required']) {
                $required      = 'required';
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
<script type="text/javascript">

    jQuery(function () {
        var _wh = jQuery(window).height();
        var $<?= $unique_id ?> = jQuery('#<?= $unique_id ?>');
        $<?= $unique_id ?>
            .css({
                minHeight: (_wh * 0.5) + 'px',
//                overflowY: 'scroll',
//                overflowX: 'hidden'
            })
            .sortable({forcePlaceholderSize: true, placeholder: 'WidgetSortableList-placeholder'})
            .disableSelection();
        jQuery('.<?= $class_name . '-ul' ?>')
            .sortable({
                connectWith: ".<?= $class_name . '-ul' ?>",
                placeholder: 'WidgetSortableList-placeholder',
                forcePlaceholderSize: true,
                dropOnEmpty: true
            }).disableSelection();
    });

</script>