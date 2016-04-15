<?php
/**
 * Demo Code
 * PHP Wrapper for Flipkart API (unofficial)
 * GitHub: https://github.com/xaneem/flipkart-api-php
 * Demo: http://www.clusterdev.com/flipkart-api-demo
 * License: MIT License
 *
 * @author Saneem (@xaneem, xaneem@gmail.com)
 */

//This is basic example code, and is not intended to be used in production.


//Don't forget to use a valid Affiliate Id and Access Token.

//Include the class.
include "clusterdev.flipkart-api.php";

//Replace <affiliate-id> and <access-token> with the correct values
$flipkart = new \clusterdev\Flipkart("makemycou", "3bcec088b8ae406490e5186acdeb486e", "json");


$dotd_url = 'https://affiliate-api.flipkart.net/affiliate/offers/v1/dotd/json';
$topoffers_url = 'https://affiliate-api.flipkart.net/affiliate/offers/v1/top/json';



//To view category pages, API URL is passed as query string.
$url = isset($_GET['url'])?$_GET['url']:false;



//Deal of the Day DOTD and Tops offers
$offer = isset($_GET['offer'])?$_GET['offer']:false;
if($offer){

    if($offer == 'dotd'){
        //Call the API using the URL.
        $details = $flipkart->call_url($dotd_url);

        if(!$details){
            echo 'Error: Could not retrieve DOTD.';
            
        }

        //The response is expected to be JSON. Decode it into associative arrays.
        $details = json_decode($details, TRUE);

        $list = $details['dotdList'];

        //The navigation buttons.
        echo '<h2><a href="?">HOME</a> | DOTD Offers | <a href="?offer=topoffers">Top Offers</a></h2>';

        //Show table
        echo "<table border=2 cellpadding=10 cellspacing=1 style='text-align:center'>";
        $count = 0;
        $end = 1;

        //Make sure there are products in the list.
        if(count($list) > 0){
            foreach ($list as $item) {
                //Keep count.
                $count++;

                //The API returns these values
                $title = $item['title'];
                $description = $item['description'];
                $url = $item['url'];
                $imageUrl = $item['imageUrls'][0]['url'];
                $availability = $item['availability'];

                //Setting up the table rows/columns for a 3x3 view.
                $end = 0;
                if($count%3==1)
                    echo '<tr><td>';
                else if($count%3==2)
                    echo '</td><td>';
                else{
                    echo '</td><td>';
                    $end =1;
                }

                echo '<a target="_blank" href="'.$url.'"><img src="'.$imageUrl.'" style="max-width:200px; max-height:200px;"/><br>'.$title."</a><br>".$description;

                if($end)
                    echo '</td></tr>';

            }
        }
        //A message if no products are printed. 
        if($count==0){
            echo '<tr><td>No DOTDs returned.</td><tr>';
        }

        //A hack to make sure the tags are closed.  
        if($end!=1)
            echo '</td></tr>';

        echo '</table>';

        
    }else if($offer == 'topoffers'){

        //Call the API using the URL.
        $details = $flipkart->call_url($topoffers_url);

        if(!$details){
            echo 'Error: Could not retrieve Top Offers.';
            
        }

        //The response is expected to be JSON. Decode it into associative arrays.
        $details = json_decode($details, TRUE);

        $list = $details['topOffersList'];

        //The navigation buttons.
        echo '<h2><a href="?">HOME</a> | <a href="?offer=dotd">DOTD Offers</a> | Top Offers</h2>';

        //Show table
        echo "<table border=2 cellpadding=10 cellspacing=1 style='text-align:center'>";
        $count = 0;
        $end = 1;

        //Make sure there are products in the list.
        if(count($list) > 0){
            foreach ($list as $item) {
                //Keep count.
                $count++;

                //The API returns these values
                $title = $item['title'];
                $description = $item['description'];
                $url = $item['url'];
                $imageUrl = $item['imageUrls'][0]['url'];
                $availability = $item['availability'];

                //Setting up the table rows/columns for a 3x3 view.
                $end = 0;
                if($count%3==1)
                    echo '<tr><td>';
                else if($count%3==2)
                    echo '</td><td>';
                else{
                    echo '</td><td>';
                    $end =1;
                }

                echo '<a target="_blank" href="'.$url.'"><img src="'.$imageUrl.'" style="max-width:200px; max-height:200px;"/><br>'.$title."</a><br>".$description;

                if($end)
                    echo '</td></tr>';

            }
        }
        //A message if no products are printed. 
        if($count==0){
            echo '<tr><td>No Top Offers returned.</td><tr>';
        }

        //A hack to make sure the tags are closed.  
        if($end!=1)
            echo '</td></tr>';

        echo '</table>';

        

    }else{
        echo 'Error: Invalid offer type.';
         
    }

}


//If the control reaches here, the API directory view is shown.

//Query the API
$home = $flipkart->api_home();

//Make sure there is a response.
if($home==false){
    echo 'Error: Could not retrieve API homepage';
    exit();
}

//Convert into associative arrays.
$home = json_decode($home, TRUE);

$list = $home['apiGroups']['affiliate']['apiListings'];

$count = 0;
$end = 1;

 ?>

<!DOCTYPE html>
<html lang="en" ng-app="app">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/freelancer.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">
    <title>make my coupon</title>
 <script src="libs/bootstrap-3.3.6-dist/js/bootstrap.js"></script>
    <link rel="stylesheet" href="libs/bootstrap-3.3.6-dist/css/bootstrap.css">

    <link rel="stylesheet" href="libs/bootstrap-3.3.6-dist/css/bootstrap.css">
<link rel="stylesheet" href="custome.css">
</head>

<body id="page-top" class="index">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" ui-sref="products" title="Make My Coupon">
                    <img style="max-height:45px; margin-top: -7px;" src="images/logo.png">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Categories<b class="caret"></b></a>

                <ul class="dropdown-menu multi-column columns-3">
                    <div class="row">
<?php

 echo '<div class="col-sm-4"> <ul class="multi-column-dropdown">';
foreach ($list as $key => $data) {

    if($count%11==0 )
        echo '</ul></div>';

    if($count%10==0 )
       echo '<div class="col-sm-4"> <ul class="multi-column-dropdown">';
    
        echo '<li><a href="?url='.base64_encode($data['availableVariants']['v0.1.0']['get']).'">'.$key.'</a></li> ';

  
$count++;
    
}



//echo '</ul> </div> </div>';

                                                  
                            
?> 
                    </div>
                </ul>
            </li>

                    <li class="page-scroll">
                        <a href="#products">products</a>
                    </li>
                    
                    <li class="page-scroll">
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid 
        <c-header></c-header>-->
        </div>
    </nav>
    <!-- products Grid Section -->
    <section id="products">
<?php 

if($url){
    //URL is base64 encoded to prevent errors in some server setups.
    $url = base64_decode($url);

    //This parameter lets users allow out-of-stock items to be displayed.
    $hidden = isset($_GET['hidden'])?false:true;

    //Call the API using the URL.
    $details = $flipkart->call_url($url);

    if(!$details){
        echo 'Error: Could not retrieve products list.';
        exit();
    }

    //The response is expected to be JSON. Decode it into associative arrays.
    $details = json_decode($details, TRUE);

    //The response is expected to contain these values.
    $nextUrl = $details['nextUrl'];
    $validTill = $details['validTill'];
    $products = $details['productInfoList'];

    //The navigation buttons.
    echo '<a href="?url='.base64_encode($nextUrl).'">NEXT >></a></h2>';

    //Message to be displayed if out-of-stock items are hidden.
    if($hidden)
        echo 'Products that are out of stock are hidden by default.<br><a href="?hidden=1&url='.base64_encode($url).'">SHOW OUT-OF-STOCK ITEMS</a><br><br>';

    //Products table
    echo '<div class="container-fluid">';
    echo '<div class="row">';




    $count = 0;
    $end = 1;

    //Make sure there are products in the list.
    if(count($products) > 0){
        foreach ($products as $product) {

            //Hide out-of-stock items unless requested.
            $inStock = $product['productBaseInfo']['productAttributes']['inStock'];
            if(!$inStock && $hidden)
                continue;
            
            //Keep count.
            $count++;

            //The API returns these values nested inside the array.
            //Only image, price, url and title are used in this demo
            $productId = $product['productBaseInfo']['productIdentifier']['productId'];
            $title = $product['productBaseInfo']['productAttributes']['title'];
            $productDescription = $product['productBaseInfo']['productAttributes']['productDescription'];

            //We take the 200x200 image, there are other sizes too.
            $productImage = array_key_exists('200x200', $product['productBaseInfo']['productAttributes']['imageUrls'])?$product['productBaseInfo']['productAttributes']['imageUrls']['200x200']:'';
            $sellingPrice = $product['productBaseInfo']['productAttributes']['sellingPrice']['amount'];
            $productUrl = $product['productBaseInfo']['productAttributes']['productUrl'];
            $productBrand = $product['productBaseInfo']['productAttributes']['productBrand'];
            $color = $product['productBaseInfo']['productAttributes']['color'];
            $productUrl = $product['productBaseInfo']['productAttributes']['productUrl'];

            echo '<div class="col-sm-3 bsdiv">';

            echo '<a target="_blank" href="'.$productUrl.'"><img  height="150 px" src="'.$productImage.'" data-toggle="tooltip" title="'.$productDescription.'"/><br>'.$title."</a><br>Rs. ".$sellingPrice;
           
            echo '<button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Simple collapsible</button>';
            echo '<div id="demo" class="collapse in">';
            echo ''.$productDescription;
            echo '</div>';
            

            echo '</div>';

        }
    }

   
   
    echo '  </div> </div>';

    //Next URL link at the bottom.
    echo '<h2><a href="?url='.base64_encode($nextUrl).'">NEXT >></a></h2>';

   
}


?>
    </section>
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Contact Me</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Name</label>
                                <input type="text" class="form-control" placeholder="Name" id="name" required data-validation-required-message="Please enter your name.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Email Address</label>
                                <input type="email" class="form-control" placeholder="Email Address" id="email" required data-validation-required-message="Please enter your email address.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Phone Number</label>
                                <input type="tel" class="form-control" placeholder="Phone Number" id="phone" required data-validation-required-message="Please enter your phone number.">
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <div class="row control-group">
                            <div class="form-group col-xs-12 floating-label-form-group controls">
                                <label>Message</label>
                                <textarea rows="5" class="form-control" placeholder="Message" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                        <br>
                        <div id="success"></div>
                        <div class="row">
                            <div class="form-group col-xs-12">
                                <button type="submit" class="btn btn-success btn-lg">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                  <a class="navbar-brand" ui-sref="products" title="Make My Coupon">
                    <img style="max-height:45px; margin-top: -7px;" src="images/logo.png">
                  </a>
                    <div class="footer-col col-md-4">
                        <h3>Location</h3>
                        <p>Hyderabad
                            <br>Telangana- 39
                            <br> India
                        </p>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-google-plus"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="#" class="btn-social btn-outline"><i class="fa fa-fw fa-dribbble"></i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-col col-md-4">
                        <h3>
                        <p>Best coupon deals by <a href="http://makemycoupon.in">makemycoupon.in</a></p>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; makemycoupon.in 2016
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll visible-xs visible-sm">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>
    <!-- products Modals -->
    <div class="products-modal modal fade" id="productsModal1" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
    <script src="js/freelancer.js"></script>
</body>

</html>
