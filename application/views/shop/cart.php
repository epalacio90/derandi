<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/25/19
 * Time: 2:36 AM
 */

?>

<script
        src="https://www.paypal.com/sdk/js?client-id=AVERRdwzs1J3At-KMK3yLSQKDDe4aldq8aBZXscS-XKdrpA4d7-CbBGzyb5zDwXHHR2wspTaJ08UGb4A&currency=MXN">
</script>

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
                                    <var class="price">MXN <?php $total += $item['qty'] * $item['price']; echo $item['qty'] * $item['price']; ?></var>
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


            </aside> <!-- col.// -->
        </div>
        <h3>Entrega</h3>
        <?php echo form_open('shop/confirmation', "id=buyForm") ?>
        <div class="row">
            <div class="col-md-5"><input type="text" class="form-control" name="address1" placeholder="Dirección"></div>
            <div class="col-md-5 offset-md-1"><input type="text" class="form-control" name="address2" placeholder="Colonia"></div>
        </div>
        <div class="row">
            <div class="col-md-5"><input type="text" class="form-control" name="city" placeholder="Ciudad"></div>
            <div class="col-md-5 offset-md-1"><input type="text" class="form-control" name="zip" placeholder="Código postal"></div>
        </div>
        <input type="hidden" name="paypal_email" id="paypal_mail">
        <input type="hidden" name="name" id="name">
        <input type="hidden" name="auth" id="auth">
        <input type="hidden" name="total_amount" id="total_amount">
        <?php echo form_close() ?>
        <div class="row">
            <div class="col-md-3 offset-md-8"><h3>Pagar:</h3><div id="paypal-button-container"></div></div>

        </div>

    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->
<script>

    paypal.Buttons({
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '<?= $total ?>',
                        currency_code: 'MXN'
                    }
                }]
            });
        },
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(details) {
                //alert('Transaction completed by ' + details.payer.name.given_name);
                //console.log('detalles:');
                //console.log(details);
                document.getElementById('auth').value=details.id;
                document.getElementById('paypal_mail').value=details.payer.email_address;
                document.getElementById('name').value=details.payer.name.given_name + ' ' + details.payer.name.surname ;
                document.getElementById('total_amount').value=details.purchase_units[0].amount.value;
                document.getElementById('buyForm').submit();
            }).then(function(details){
                if(details.error === 'INSTRUMENT_DECLINED'){
                    return actions.restart();
                }
            });
        }
    }).render('#paypal-button-container');


</script>