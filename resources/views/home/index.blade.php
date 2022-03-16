<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Page</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <style>
        .cta-100 {
            margin-top: 100px;
            padding-left: 8%;
            padding-top: 7%;
        }

        .col-md-4 {
            padding-bottom: 20px;
        }

        .white {
            color: #fff !important;
        }

        .mt {
            float: left;
            margin-top: -20px;
            padding-top: 20px;
        }

        .bg-blue-ui {
            background-color: #708198 !important;
        }

        figure img {
            width: 300px;
        }

        #blogCarousel {
            padding-bottom: 100px;
        }

        .blog .carousel-indicators {
            left: 0;
            top: -50px;
            height: 50%;
        }


        /* The colour of the indicators */

        .blog .carousel-indicators li {
            background: #708198;
            border-radius: 50%;
            width: 8px;
            height: 8px;
        }

        .blog .carousel-indicators .active {
            background: #0fc9af;
        }




        .item-carousel-blog-block {
            outline: medium none;
            padding: 15px;
        }

        .item-box-blog {
            border: 1px solid #dadada;
            text-align: center;
            z-index: 4;
            padding: 20px;
        }

        .item-box-blog-image {
            position: relative;
        }

        .item-box-blog-image figure img {
            width: 100%;
            height: auto;
        }

        .item-box-blog-date {
            position: absolute;
            z-index: 5;
            padding: 4px 20px;
            top: -20px;
            right: 8px;
            background-color: #41cb52;
        }

        .item-box-blog-date span {
            color: #fff;
            display: block;
            text-align: center;
            line-height: 1.2;
        }

        .item-box-blog-date span.mon {
            font-size: 18px;
        }

        .item-box-blog-date span.day {
            font-size: 16px;
        }

        .item-box-blog-body {
            padding: 10px;
        }

        .item-heading-blog a h5 {
            margin: 0;
            line-height: 1;
            text-decoration: none;
            transition: color 0.3s;
        }

        .item-box-blog-heading a {
            text-decoration: none;
        }

        .item-box-blog-data p {
            font-size: 13px;
        }

        .item-box-blog-data p i {
            font-size: 12px;
        }

        .item-box-blog-text {
            max-height: 100px;
            overflow: hidden;
        }

        .mt-10 {
            float: left;
            margin-top: -10px;
            padding-top: 10px;
        }

        .btn.bg-blue-ui.white.read {
            cursor: pointer;
            padding: 4px 20px;
            float: left;
            margin-top: 10px;
        }

        .btn.bg-blue-ui.white.read:hover {
            box-shadow: 0px 5px 15px inset #4d5f77;
        }

    </style>
</head>
<body>

    <!------ Include the above in your HEAD tag ---------->

    <div class="title m-b-md">
        eSewa Checkout
    </div>

    <div class="links">

        @if($message = session('message'))
        <p>
            {{ $message }}
        </p>
        @endif

        <p>
            <strong>QuietComfort® 25 Acoustic Noise Cancelling® headphones — Apple devices</strong>
        </p>

        <br>

        <form method="POST" action="{{ route('checkout.payment.esewa.process', $order->id) }}">
            @csrf
            <button class="btn btn-primary" type="submit">
                ${{ $order->amount }} Pay with eSewa
            </button>
        </form>
    </div>


    <div class="container cta-100 ">
        <div class="container">
            <div class="row blog">
                <div class="col-md-12">
                    <div id="blogCarousel" class="carousel slide container-blog" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#blogCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#blogCarousel" data-slide-to="1"></li>
                        </ol>
                        <!-- Carousel items -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="item-box-blog">
                                            <div class="item-box-blog-image">
                                                <!--Date-->
                                                <div class="item-box-blog-date bg-blue-ui white"> <span class="mon">Augu 01</span> </div>
                                                <!--Image-->
                                                <figure> <img alt="" src="https://cdn.pixabay.com/photo/2017/02/08/14/25/computer-2048983_960_720.jpg"> </figure>
                                            </div>
                                            <div class="item-box-blog-body">
                                                <!--Heading-->
                                                <div class="item-box-blog-heading">
                                                    <a href="#" tabindex="0">
                                                        <h5>News Title</h5>
                                                    </a>
                                                </div>
                                                <!--Data-->
                                                <div class="item-box-blog-data" style="padding: px 15px;">
                                                    <p><i class="fa fa-user-o"></i> Admin, <i class="fa fa-comments-o"></i> Comments(3)</p>
                                                </div>
                                                <!--Text-->
                                                <div class="item-box-blog-text">
                                                    <p>Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, adipiscing. Lorem ipsum dolor sit amet, consectetuer adipiscing. Lorem ipsum dolor.</p>
                                                </div>
                                                <!-- Place this where you need payment button -->
                                                <button class="btn btn-outline-danger" id="payment-button">Pay with Khalti</button>
                                                <!-- Place this where you need payment button -->

                                                {{-- <div class="mt"> <a href="#" tabindex="0" class="btn bg-blue-ui white read">read more</a> </div>  --}}
                                                <!--Read More Button-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--.row-->
                            </div>
                        </div>
                        <!--.carousel-inner-->
                    </div>
                    <!--.Carousel-->
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Place this where you need payment button -->
    <button id="payment-button">Pay with Khalti</button>
    <!-- Place this where you need payment button -->  --}}

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>


    <!-- Paste this code anywhere in you body tag -->
    <script>
        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_dc74e0fd57cb46cd93832aee0a390234"
            , "productIdentity": "1234567890"
            , "productName": "Dragon"
            , "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons"
            , "paymentPreference": [
                "KHALTI"
                , "EBANKING"
                , "MOBILE_BANKING"
                , "CONNECT_IPS"
                , "SCT"
            , ]
            , "eventHandler": {
                onSuccess(payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                }
                , onError(error) {
                    console.log(error);
                }
                , onClose() {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function() {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({
                amount: 1000
            });
        }

    </script>
    <!-- Paste this code anywhere in you body tag -->

</body>
</html>
