<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/25/19
 * Time: 2:36 AM
 */

?>
<!-- Load PayPal's checkout.js Library. -->
<script src="https://www.paypalobjects.com/api/checkout.js" data-version-4 log-level="warn"></script>

<!-- Load the client component. -->
<script src="https://js.braintreegateway.com/web/3.44.2/js/client.min.js"></script>

<!-- Load the PayPal Checkout component. -->
<script src="https://js.braintreegateway.com/web/3.44.2/js/paypal-checkout.min.js"></script>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y border-top">
    <div class="container">
        <h3>Carrito de compras</h3>
        <div class="row">
            <main class="col-sm-9">

                <div class="card">

                    <table class="table table-hover shopping-cart-wrap">
                        <thead class="text-muted">
                        <tr>
                            <th scope="col">Producto</th>
                            <th scope="col" width="120">Cantidad</th>
                            <th scope="col" width="120">Precio</th>
                            <th scope="col" class="text-right" width="200">Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $total = 0;
                        foreach ($this->cart->contents() AS $item){ ?>
                        <tr>
                            <td>
                                <figure class="media">
                                    <div class="img-wrap"><img src="<?= base_url('assets/images/product/'.$item['options']['path']) ?>" class="img-thumbnail img-sm"></div>
                                    <figcaption class="media-body">
                                        <h6 class="title text-truncate"><?= $item['name'] ?></h6>
                                        <dl class="dlist-inline small">
                                            <dt>Variante: </dt>
                                            <dd><?= $item['id'] ?></dd>

                                        </dl>
                                    </figcaption>
                                </figure>
                            </td>
                            <td>
                                <strong><?= $item['qty'] ?></strong>
                            </td>
                            <td>
                                <div class="price-wrap">
                                    <var class="price">MXN <?php $total += $item['qty'] * $item['price']; echo $total ?></var>
                                    <small class="text-muted">(MXN <?= $item['price'] ?>  C/U)</small>
                                </div> <!-- price-wrap .// -->
                            </td>
                            <td class="text-right">
                                <a href="<?php echo site_url('shop/removeFromCart?rowid='.$item['rowid']) ?>" class="btn btn-outline-danger"> × Quitar</a>
                            </td>
                        </tr>
                        <?php }  ?>


                        </tbody>
                    </table>
                </div> <!-- card.// -->

            </main> <!-- col.// -->
            <aside class="col-sm-3">
                <dl class="dlist-align">
                    <dt>Subtotal: </dt>
                    <dd class="text-right">MXN <?= $total ?></dd>
                </dl>

                <dl class="dlist-align h4">
                    <dt>Total:</dt>
                    <dd class="text-right"><strong>MXN <?= $total ?></strong></dd>
                </dl>
                <hr>
                <figure class="itemside mb-3">
                    <aside class="aside"><img src="images/icons/pay-visa.png"></aside>
                    <div class="text-wrap small text-muted">
                        Pay 84.78 AED ( Save 14.97 AED )
                        By using ADCB Cards
                    </div>
                </figure>
                <figure class="itemside mb-3">
                    <aside class="aside"> <img src="images/icons/pay-mastercard.png"> </aside>
                    <div class="text-wrap small text-muted">
                        Pay by MasterCard and Save 40%. <br>
                        Lorem ipsum dolor
                    </div>
                </figure>

            </aside> <!-- col.// -->
        </div>

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
