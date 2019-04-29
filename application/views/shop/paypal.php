<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/28/19
 * Time: 9:07 PM
 */
?>

<script
    src="https://www.paypal.com/sdk/js?client-id=AbAkF67LN5G5bdxr_n6cD3hLrdESTd4IDIuPcnQzVrZyoYVcQcwpW1neEjkQfrfZo89Fy33uMJtcmy9V">
</script>
<div id="paypal-button-container"></div>
<script>
    paypal.Buttons().render('#paypal-button-container');
</script>
<script>
    paypal.Buttons({
        createOrder: function(data, actions) {
            // Set up the transaction
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '0.01'
                    }
                }]
            });
        }
        onApprove: function(data, actions) {
            // Capture the funds from the transaction
            return actions.order.capture().then(function(details) {
                // Show a success message to your buyer
                alert('Transaction completed by ' + details.payer.name.given_name);
                return fetch('/paypal-transaction-complete', {
                    method: 'post',
                    headers: {
                        'content-type': 'application/json'
                    },
                    body: JSON.stringify({
                        orderID: data.orderID
                    })
            });
        }
    }).render('#paypal-button-container');
</script>