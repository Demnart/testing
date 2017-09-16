<?php
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
                        <td><?= $item['img']?></td>
                        <td><?= $item['name']?></td>
                        <td><?= $item['qty']?></td>
                        <td><?= $item['price']?></td>
                        <td<span class="glyphicon glyphicon-remove text-danger del-item"  aria-hidden="true"></span></td>
                    </tr>
                    <tr>
                        <td>Итого: </td>
                        <td colspan="4"><?= $session['cart.qty']?></td>

                    <tr>
                        <td>На сумму: </td>
                        <td colspan="4"><?= $session['cart.sum']?></td>
                    </tr>
                 <?php endforeach;?>
            </tbody>
        </table>
    </div>
    <?php else:?>
    <h3>Корзина пуста</h3>
<?php endif;?>

