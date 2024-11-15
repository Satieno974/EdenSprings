<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout</title>
    <script src="https://www.paypal.com/sdk/js?client-id=YOUR_PAYPAL_CLIENT_ID"></script>
</head>
<body>
    <h2>Checkout</h2>

    <!-- Render PayPal button -->
    <div id="paypal-button-container"></div>

    <script>
        paypal.Buttons({
            createOrder: function(data, actions) {
                // Set up the transaction
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '<?php echo array_sum(array_column($_SESSION['cart'], 'price')); ?>'
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                // Capture the transaction
                return actions.order.capture().then(function(details) {
                    alert('Transaction completed by ' + details.payer.name.given_name);
                    // Clear the cart on successful payment
                    <?php unset($_SESSION['cart']); ?>
                });
            }
        }).render('#paypal-button-container');
    </script>
</body>
</html>
