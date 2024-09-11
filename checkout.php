<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Odor - Vape Store WooCommerce HTML Template</title>
    <!-- Favicon img -->
    <link rel="shortcut icon" href="assets/images/favicon.png">
    <!-- Bootstarp min css -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <!-- All min css -->
    <link rel="stylesheet" href="assets/css/all.min.css">
    <!-- Swiper bundle min css -->
    <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">
    <!-- Magnigic popup css -->
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <!-- Animate css -->
    <link rel="stylesheet" href="assets/css/animate.css">
    <!-- Nice select css -->
    <link rel="stylesheet" href="assets/css/nice-select.css">
    <!-- Style css -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

    <!-- Header area start here -->
    <?php 
    session_start();
    include("header.php"); ?>
   
    <!-- Header area end here -->

    <!-- Sidebar area start here -->
    <div id="targetElement" class="side_bar slideInRight side_bar_hidden">
        <div class="side_bar_overlay"></div>
        <div class="logo mb-30">
            <img src="assets/images/logo/logo.svg" alt="logo">
        </div>
        <p class="text-justify">The foundation of any road is the subgrade, which provides a stable base for the road
            layers above. Proper compaction of
            the subgrade is crucial to prevent settling and ensure long-term road stability.</p>
        <ul class="info py-4 mt-65 bor-top bor-bottom">
            <li><i class="fa-solid primary-color fa-location-dot"></i> <a href="#0">example@example.com</a>
            </li>
            <li class="py-4"><i class="fa-solid primary-color fa-phone-volume"></i> <a href="tel:+912659302003">+91 2659
                    302 003</a>
            </li>
            <li><i class="fa-solid primary-color fa-paper-plane"></i> <a href="#0">info.company@gmail.com</a></li>
        </ul>
        <div class="social-icon mt-65">
            <a href="#0"><i class="fa-brands fa-facebook-f"></i></a>
            <a href="#0"><i class="fa-brands fa-twitter"></i></a>
            <a href="#0"><i class="fa-brands fa-linkedin-in"></i></a>
            <a href="#0"><i class="fa-brands fa-instagram"></i></a>
        </div>
        <button id="closeButton" class="text-white"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <!-- Sidebar area end here -->

    <!-- Preloader area start -->
    <div class="loading">
        <span class="text-capitalize">L</span>
        <span>o</span>
        <span>a</span>
        <span>d</span>
        <span>i</span>
        <span>n</span>
        <span>g</span>
    </div>

    <div id="preloader">
    </div>
    <!-- Preloader area end -->

    <!-- Mouse cursor area start here -->
    <div class="mouse-cursor cursor-outer"></div>
    <div class="mouse-cursor cursor-inner"></div>
    <!-- Mouse cursor area end here -->


    <main>
        <!-- Page banner area start here -->
        <section class="page-banner bg-image pt-130 pb-130" data-background="assets/images/banner/inner-banner.jpg">
            <div class="container">
                <h2 class="wow fadeInUp mb-15" data-wow-duration="1.1s" data-wow-delay=".1s">Checkout Page</h2>
                <div class="breadcrumb-list wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".3s">
                    <a href="index.html" class="primary-hover"><i class="fa-solid fa-house me-1"></i> Home <i
                            class="fa-regular text-white fa-angle-right"></i></a>
                    <span>Checkout</span>
                </div>
            </div>
        </section>
        <!-- Page banner area end here -->

        <!-- Checkout area start here -->
        <section class="checkout-area pt-130 pb-130">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-8">
                        <div class="checkout__item-left sub-bg">
                            <h3 class="mb-40">Billing Details</h3>
                            <label class="mb-10" for="name">Your Name *</label>
                            <input class="mb-20" id="name" type="text">
                            <label class="mb-10" for="email">Email Address *</label>
                            <input class="mb-20" id="email" type="email">
                            <label class="mb-10" for="companyName">Company Name (Optional)</label>
                            <input class="mb-20" id="companyName" type="text">
                            <h5 class="mb-10">Country / Region *</h5>
                            <select class="mb-20" name="subject">
                                <option value="0">United state america</option>
                                <option value="1">United Kingdom</option>
                                <option value="2">Australia</option>
                                <option value="3">Germany</option>
                                <option value="4">France</option>
                            </select>
                            <label class="mb-10" for="streetAddress">Street Address *</label>
                            <input placeholder="1837 E Homer M Adams Pkwy" class="mb-10" id="streetAddress" type="text">
                            <input class="mb-20" id="streetAddress2" type="text">
                            <label class="mb-10" for="townName">Town / City *</label>
                            <input class="mb-20" id="townName" type="text">
                            <h5 class="mb-10">State *</h5>
                            <select class="mb-20" name="subject">
                                <option value="0">Georgia / ohio / new york</option>
                                <option value="1">Georgia</option>
                                <option value="2">Ohio</option>
                                <option value="3">New York</option>
                                <option value="4">Texas</option>
                            </select>
                            <label class="mb-10" for="zipCode">ZIP Code *</label>
                            <input class="mb-20" id="zipCode" type="number">
                            <label class="mb-10" for="phone">Phone *</label>
                            <input class="mb-20" id="phone" type="text">
                            <div class="radio-btn">
                                <span></span>
                                <a class="ml-10 fw-bold" href="register.html">Create An Account?</a>
                            </div>
                            <div class="radio-btn mt-2 mb-30">
                                <span class="opacity-75"></span>
                                <p>Ship To A Different Address?</p>
                            </div>
                            <label class="mb-10" for="phone">Order Notes (Optional)</label>
                            <textarea placeholder="Note About Your Order . . ." name="notes" id="notes"></textarea>
                        </div>
                    </div>
                    <?php
include("connection.php");

// Initialize cart details
$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
$totalPrice = 0;

$cartDetails = [];

if (!empty($cartItems)) {
    // Collect product IDs from the cart
    $productIds = array_keys($cartItems);

    // Prepare SQL to fetch details of multiple products
    $placeholders = implode(',', array_fill(0, count($productIds), '?'));
    $sql = "SELECT id, product_name, price, image_url FROM products_table WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically
    $stmt->bind_param(str_repeat('i', count($productIds)), ...$productIds);
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch product details
    $products = [];
    while ($product = $result->fetch_assoc()) {
        $products[$product['id']] = $product;
    }

    foreach ($cartItems as $productId => $quantity) {
        if (isset($products[$productId])) {
            $product = $products[$productId];
            $productName = htmlspecialchars($product['product_name']);
            $price = $product['price'];
            $imageUrl = htmlspecialchars($product['image_url']);
            $totalPrice += $price * $quantity;

            $cartDetails[] = [
                'product_id' => $productId,
                'product_name' => $productName,
                'price' => $price,
                'quantity' => $quantity,
                'image_url' => $imageUrl,
                'total' => $price * $quantity
            ];
        }
    }
} else {
    $cartDetails = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order</title>
    <style>
        /* Your existing CSS styles */
    </style>
</head>
<body>
    <div class="col-lg-4">
        <div class="checkout__item-right sub-bg">
            <h3 class="mb-40">Your Order</h3>
            <ul>
                <li class="bor-bottom pb-4">
                    <h4>Products</h4>
                    <h4>Subtotal</h4>
                </li>

                <?php if (!empty($cartDetails)): ?>
                    <?php foreach ($cartDetails as $item): ?>
                        <li class="bor-bottom py-4">
                            <a href="#"><?php echo htmlspecialchars($item['product_name']); ?></a>
                            <span>$<?php echo number_format($item['total'], 2); ?></span>
                        </li>
                    <?php endforeach; ?>
                    <li class="bor-bottom py-4">
                        <h4>Subtotal</h4>
                        <h4>$<?php echo number_format($totalPrice, 2); ?></h4>
                    </li>
                <?php else: ?>
                    <li class="bor-bottom py-4">
                        <p>Your cart is empty.</p>
                    </li>
                <?php endif; ?>
            </ul>
            <div class="py-4 bor-bottom">
                <h5 class="mb-10">Shipping Address</h5>
                <span>2801 Lafayette Blvd, Norfolk, Vermont <br>
                    23509, United States</span>
            </div>
            <div class="radio-btn mt-30">
                <span class="opacity-75"></span>
                <p>Direct Bank Transfer</p>
            </div>
            <div class="radio-btn mt-2">
                <span></span>
                <a class="ml-10 fw-bold" href="#0">Check Payments</a>
            </div>
            <div class="radio-btn mt-2 pb-30 bor-bottom">
                <span class="opacity-75"></span>
                <p>Cash On Delivery</p>
            </div>
            <p class="pt-30 bor-top">Your personal data will be used to process
                your order, support your experience
                throughout this website.</p>
            <a href="#0" class="btn-one mt-35"><span>Place Order</span></a>
        </div>
    </div>
</body>
</html>
        <!-- Checkout area end here -->
    </main>

    <!-- Footer area start here -->
    <?php include("footer.php");?>
   
    <!-- Footer area end here -->

    <!-- Back to top area start here -->
    <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- Back to top area end here -->

    <!-- Jquery 3. 7. 1 Min Js -->
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <!-- Bootstrap min Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Swiper bundle min Js -->
    <script src="assets/js/swiper-bundle.min.js"></script>
    <!-- Counterup min Js -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Wow min Js -->
    <script src="assets/js/wow.min.js"></script>
    <!-- Magnific popup min Js -->
    <script src="assets/js/magnific-popup.min.js"></script>
    <!-- Nice select min Js -->
    <script src="assets/js/nice-select.min.js"></script>
    <!-- Pace min Js -->
    <script src="assets/js/pace.min.js"></script>
    <!-- Isotope pkgd min Js -->
    <script src="assets/js/isotope.pkgd.min.js"></script>
    <!-- Waypoints Js -->
    <script src="assets/js/jquery.waypoints.js"></script>
    <!-- Script Js -->
    <script src="assets/js/script.js"></script>
</body>

</html>