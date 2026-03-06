<!-- Stripe JavaScript library -->
<script src="https://js.stripe.com/v3/"></script>
<script>
    // Create an instance of the Stripe object
    // Set your publishable API key
    var stripe = Stripe('');

    // Create an instance of elements
    var elements = stripe.elements();
    var er_msg = document.getElementById('card_invalid_message');
    var style = {
        base: {
            fontWeight: 400,
            fontFamily: 'Roboto, Open Sans, Segoe UI, sans-serif',
            fontSize: '16px',
            lineHeight: '1.4',
            color: '#555',
            backgroundColor: '#fff',
            '::placeholder': {
                color: '#888',
            },
        },
        invalid: {
            color: '#eb1c26',
        }
    };

    var cardElement = elements.create('cardNumber', {
        style: style
    });
    cardElement.mount('#card_number');

    var exp = elements.create('cardExpiry', {
        'style': style
    });
    exp.mount('#card_expiry');

    var cvc = elements.create('cardCvc', {
        'style': style
    });
    cvc.mount('#card_cvc');

    // Validate input of the card elements
    var resultContainer = document.getElementById('card_invalid_message');
    var resultExp = document.getElementById('card_exp_message');
    cardElement.addEventListener('change', function(event) {
        if (event.error) {
            //alert("error");
            resultContainer.innerHTML = 'Card Number Is Invalid';
        } else {
            resultContainer.innerHTML = '';
        }
    });

    exp.addEventListener('change', function(event) {
        if (event.error) {
            //alert("error");
            resultExp.innerHTML = 'Expiry Date Is Not Valid';
        } else {
            resultExp.innerHTML = '';
        }
    });
</script>