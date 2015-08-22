<?php
/**
 * The default template for displaying a filter
 *
 * @package WordPress
 * @subpackage Nicowesse
 * @since Nicowesse
 */

$categories = get_categories();
?>

<div class="c-filter">
    <h5 class="c-filter__text">
    I want to see some of your
    <ul class="c-filter__dropdown">
    <span class="c-filter__selected">graphic</span>
        <div class="c-filter__list-items">
        <?php foreach ($categories as $cat) :
        if ($cat->parent != 0 && $cat->count > 0) : ?>

            <li class="c-filter__item filter" data-filter=".category-<?= $cat->slug; ?>"><?= $cat->name; ?></li>

        <?php endif; ?>
        <?php endforeach; ?>
        </div>
    </ul>
    work, Nico.
    <span class="c-filter__reset filter" data-filter="all">Reset</span>
    </h5>
</div>