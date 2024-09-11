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
                <h2 class="wow fadeInUp mb-15" data-wow-duration="1.1s" data-wow-delay=".1s">Cart Page</h2>
                <div class="breadcrumb-list wow fadeInUp" data-wow-duration="1.3s" data-wow-delay=".3s">
                    <a href="index.html" class="primary-hover"><i class="fa-solid fa-house me-1"></i> Home <i
                            class="fa-regular text-white fa-angle-right"></i></a>
                    <span>Cart</span>
                </div>
            </div>
        </section>
        <!-- Page banner area end here -->

        <!-- cart page area start here -->
        <section class="cart-page pt-130 pb-130">
            <div class="container">

                <div class="shopping-cart radius-10 bor sub-bg">

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
    <title>Your Cart</title>
    <!-- Add your existing CSS file link or inline styles here -->
    <link rel="stylesheet" href="path/to/your/styles.css">
</head>
<body>
    <section>
        <div class="container">
            <div class="column-labels py-3 px-4 d-flex justify-content-between align-items-center fw-bold text-white text-uppercase">
                <label class="product-details">Product</label>
                <label class="product-price">Price</label>
                <label class="product-quantity">Quantity</label>
                <label class="product-line-price">Total</label>
                <label class="product-removal">Edit</label>
            </div>

            <?php if (!empty($cartDetails)): ?>
                <?php foreach ($cartDetails as $item): ?>
                    <div class="product p-4 bor-top bor-bottom d-flex justify-content-between align-items-center">
                        <div class="product-details d-flex align-items-center">
                            <img src="admin/<?php echo $item['image_url']; ?>" alt="<?php echo $item['product_name']; ?>">
                            <h4 class="ps-4 text-capitalize"><?php echo $item['product_name']; ?></h4>
                        </div>
                        <div class="product-price">$<?php echo number_format($item['price'], 2); ?></div>
                        <div class="product-quantity">
                            <input type="number" value="<?php echo $item['quantity']; ?>" min="1">
                        </div>
                        <div class="product-line-price">$<?php echo number_format($item['total'], 2); ?></div>
                        <div class="product-removal">
                            <button class="remove-product">
                                <i class="fa-solid fa-x heading-color"></i>
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="product p-4 bor-bottom d-flex justify-content-between align-items-center">
                    <p>Your cart is empty.</p>
                </div>
            <?php endif; ?>

            <div class="totals">
                <div class="totals-item theme-color float-end mt-20">
                    <span class="fw-bold text-uppercase py-2">cart total =</span>
                    <div class="totals-value d-inline py-2 pe-2" id="cart-subtotal">$<?php echo number_format($totalPrice, 2); ?></div>
                </div>
            </div>

            <!-- mobile view if necessary -->
            <div class="shopping-cart mobile-view bor sub-bg">
                <?php if (!empty($cartDetails)): ?>
                    <?php foreach ($cartDetails as $item): ?>
                        <div class="product p-4 bor-bottom">
                            <div class="product-details d-flex align-items-center">
                                <img src="admin/<?php echo $item['image_url']; ?>" alt="<?php echo $item['product_name']; ?>">
                                <h4 class="ps-4 text-capitalize"><?php echo $item['product_name']; ?></h4>
                            </div>
                            <div class="product-price">$<?php echo number_format($item['price'], 2); ?></div>
                            <div class="product-quantity">
                                <input type="number" value="<?php echo $item['quantity']; ?>" min="1">
                            </div>
                            <div class="product-line-price">$<?php echo number_format($item['total'], 2); ?></div>
                            <div class="product-removal">
                                <button class="remove-product">
                                    <i class="fa-solid fa-x heading-color"></i>
                                </button>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="product p-4 bor-bottom">
                        <p>Your cart is empty.</p>
                    </div>
                <?php endif; ?>

                <div class="totals">
                    <div class="totals-item theme-color float-end">
                        <span class="fw-bold text-uppercase py-2">cart total =</span>
                        <div class="totals-value d-inline py-2 pe-2">$<?php echo number_format($totalPrice, 2); ?></div>
                    </div>
                </div>
            </div>

        </div>

    

    </section>
</body>
</html>
 <!-- Proceed to Checkout Button -->
 <div class="d-flex justify-content-start my-4">
    <a href="checkout.php" class="btn-one"><span>Proceed to Checkout</span></a>
</div>

        <!-- cart page area end here -->
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