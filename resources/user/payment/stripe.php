<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Aduca</title>

    <!-- Google fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="<?php ABSPATH ?>/public/frontend/images/favicon.png">

    <!-- inject:css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/line-awesome.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/fancybox.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/tooltipster.bundle.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/animated-headline.css">
    <link rel="stylesheet" href="<?php ABSPATH ?>/public/frontend/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://js.stripe.com/v3/"></script>
    <!-- end inject -->
</head>

<?php
global $router;
?>

<body>

    <!-- start cssload-loader -->
    <div class="preloader">
        <div class="loader">
            <svg class="spinner" viewBox="0 0 50 50">
                <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
            </svg>
        </div>
    </div>

    <header class="header-menu-area bg-white">

        <?php require ABSPATH . 'resources/user/home/layout/headerTop.php' ?>

        <?php require ABSPATH . 'resources/user/home/layout/headerMenuContent.php' ?>

        <?php require ABSPATH . 'resources/user/home/layout/headerCanvasMenu.php' ?>

    </header>

    <style>
        /* General form styling */
        #payment-form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #e6ebf1;
            border-radius: 8px;
            background-color: #f9fafb;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        #payment-form label {
            font-size: 18px;
            font-weight: 500;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        /* Styling for the Stripe card element */
        .StripeElement {
            box-sizing: border-box;
            height: 50px;
            padding: 12px 14px;
            border: 1px solid #ccd0d5;
            border-radius: 6px;
            background-color: white;
            font-size: 16px;
            color: #495057;
            transition: box-shadow 150ms ease, border-color 150ms ease;
        }

        .StripeElement:focus {
            border-color: #5b9bd5;
            box-shadow: 0 0 0 2px rgba(91, 155, 213, 0.3);
        }

        .StripeElement--invalid {
            border-color: #fa755a;
            box-shadow: 0 0 0 2px rgba(250, 117, 90, 0.3);
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        /* Button styling */
        #payment-form button {
            margin-top: 20px;
            padding: 12px 20px;
            background-color: #5b9bd5;
            border: none;
            border-radius: 6px;
            color: white;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 150ms ease;
        }

        #payment-form button:hover {
            background-color: #4a90d5;
        }

        /* Error message styling */
        #card-errors {
            color: #fa755a;
            margin-top: 10px;
            font-size: 14px;
            font-weight: 500;
        }
    </style>

    <section class="breadcrumb-area section-padding img-bg-2">
        <div class="overlay"></div>
        <div class="container">
            <div class="breadcrumb-content d-flex flex-wrap align-items-center justify-content-between">
                <div class="section-heading">
                    <h2 class="section__title text-white">Stripe</h2>
                </div>
                <ul class="generic-list-item generic-list-item-white generic-list-item-arrow d-flex flex-wrap align-items-center">
                    <li><a href="/">Home</a></li>
                    <li>Pages</li>
                    <li>Stripe</li>
                </ul>
            </div><!-- end breadcrumb-content -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->

    <section class="cart-area section--padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-item">
                        <div class="card-body">
                            <h3 class="card-title fs-22 pb-3">Select Payment Method</h3>
                            <div class="divider"><span></span></div>
                            <div class="col-lg-12">
                                <div class="border cart-totals p-40">
                                    <div class="divider-2 mb-30">
                                        <div class="table-responsive order_table checkout">
                                            <form action="<?php echo $router->generate('stripe.order'); ?>" method="POST" id="payment-form">
                                                <div class="form-row">
                                                    <label for="card-element"> Credit or Debit Cart</label>

                                                    <input type="hidden" name="name" value="<?php echo $user->getName(); ?>">
                                                    <input type="hidden" name="email" value="<?php echo $user->getEmail(); ?>">

                                                    <div id="card-element">

                                                    </div>
                                                    <div id="card-errors" role="alert"></div>
                                                </div>
                                                <button class="btn btn-primary">Submit Payment</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card-body -->
                    </div><!-- end card -->
                </div><!-- end col-lg-7 -->
            </div><!-- end row -->
        </div><!-- end container -->
        </form>
    </section>

    <script type="text/javascript">
        // Create a Stripe client.
        var stripe = Stripe('pk_test_51OyGFbRxiVsCifP3KweKD87wCP84AXXR13sVUqLbUDsGUX3Y4gaIxnjbyX2lOzc72gYTAYeX5Pj7R4r14DhuKmHu00kJP3z0an');
        // Create an instance of Elements.
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
            base: {
                color: '#32325d',
                fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                fontSmoothing: 'antialiased',
                fontSize: '16px',
                '::placeholder': {
                    color: '#aab7c4'
                }
            },
            invalid: {
                color: '#fa755a',
                iconColor: '#fa755a'
            }
        };
        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });
        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');
        // Handle real-time validation errors from the card Element.
        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });
        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the user if there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });
        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
            // Insert the token ID into the form so it gets submitted to the server
            var form = document.getElementById('payment-form');
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', token.id);
            form.appendChild(hiddenInput);
            // Submit the form
            form.submit();
        }
    </script>

    <?php require ABSPATH . 'resources/user/layout/footerScript.php'; ?>

</body>

</html>