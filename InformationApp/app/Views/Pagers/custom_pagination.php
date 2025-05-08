<?php
$pager->setSurroundCount(2);
?>

<nav aria-label="Page navigation">
    <ul class="pagination">
        <?php if ($pager->hasPrevious()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getFirst() . (isset($search) ? "&search=$search" : '') . (isset($sortField) ? "&sort=$sortField" : '') . (isset($sortOrder) ? "&order=$sortOrder" : '') ?>" aria-label="First">
                    <span aria-hidden="true"><i class="fas fa-angle-double-left"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getPrevious() . (isset($search) ? "&search=$search" : '') . (isset($sortField) ? "&sort=$sortField" : '') . (isset($sortOrder) ? "&order=$sortOrder" : '') ?>" aria-label="Previous">
                    <span aria-hidden="true"><i class="fas fa-angle-left"></i></span>
                </a>
            </li>
        <?php endif ?>

        <?php foreach ($pager->links() as $link) : ?>
            <li class="page-item <?= $link['active'] ? 'active' : '' ?>">
                <a class="page-link" href="<?= $link['uri'] . (isset($search) ? "&search=$search" : '') . (isset($sortField) ? "&sort=$sortField" : '') . (isset($sortOrder) ? "&order=$sortOrder" : '') ?>">
                    <?= $link['title'] ?>
                </a>
            </li>
        <?php endforeach ?>

        <?php if ($pager->hasNext()) : ?>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getNext() . (isset($search) ? "&search=$search" : '') . (isset($sortField) ? "&sort=$sortField" : '') . (isset($sortOrder) ? "&order=$sortOrder" : '') ?>" aria-label="Next">
                    <span aria-hidden="true"><i class="fas fa-angle-right"></i></span>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="<?= $pager->getLast() . (isset($search) ? "&search=$search" : '') . (isset($sortField) ? "&sort=$sortField" : '') . (isset($sortOrder) ? "&order=$sortOrder" : '') ?>" aria-label="Last">
                    <span aria-hidden="true"><i class="fas fa-angle-double-right"></i></span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</nav> 