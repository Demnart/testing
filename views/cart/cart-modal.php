<?php

use yii\helpers\Html;

if (!empty($session['cart'])): ?>
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Количество</th>
                    <th>Цена</th>
                    <th><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($session['cart'] as $id => $item):?>
                    <tr>
                        <td><?= Html::img("@web/images/products/{$item['img']}",['height'=>'100','width' => '100']) ?></td>
                        <td><?= $item['name']?></td>
                        <td><?= $item['qty']?></td>
                        <td><?= $item['price']?></td>
                        <td><span class="glyphicon glyphicon-remove text-danger del-item" data-id="<?= $id;?>" aria-hidden="true"></span></td>
                    </tr>
                <?php endforeach;?>
                    <tr>
                        <td colspan="4">Итого: </td>
                        <td ><?= $session['cart.qty']?></td>

                    <tr>
                        <td colspan="4">На сумму: </td>
                        <td ><?= $session['cart.sum']?></td>
                    </tr>
            </tbody>
        </table>
    </div>
    <?php else:?>
    <h3>Корзина пуста</h3>
<?php endif;?>

