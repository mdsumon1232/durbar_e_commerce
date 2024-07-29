<?php
session_start();
require('../database_config/config.php');

$full_name = $email = $phone = "";
if(isset($_SESSION['user'])){
    $user_id = $_SESSION['user']['user_id'];
    $user_data = "SELECT * FROM user WHERE user_id = '$user_id'";
    $user_data_query = $conn->query($user_data);
    $fetch_user = mysqli_fetch_array($user_data_query);
    $full_name = $fetch_user['full_name'];
    $email = $fetch_user['email'];
    $phone = $fetch_user['phone'];
}

$products_id = '';
if(isset($_GET['id'])){
    $products_id = $_GET['id'];
}

if(isset($_POST['order'])){
    $user_id = $_SESSION['user']['user_id'];
    $full_name = $_POST['full_name'];
    $city = $_POST['city'];
    $street = $_POST['street'];
    $house_no = $_POST['house'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $product_ids = explode(',', $products_id);

    foreach ($product_ids as $product_id) {
        $insert_data = "INSERT INTO product_orderd (product_id, user_id, city, street, house_no, full_name, phone, email) 
                        VALUES ('$product_id', '$user_id', '$city', '$street', '$house_no', '$full_name', '$number', '$email')";
        $insert_data_query = $conn->query($insert_data);
        if($insert_data_query){
            header('location: order_done.php');
        } else {
            echo "Something went wrong while placing the order for product ID: $product_id<br>";
        }
    }
}

//  cart data load
$user_id = $_SESSION['user']['user_id'];
$select_cart = "SELECT cart.* , product.* FROM product INNER JOIN cart ON cart.product_id = product.product_id WHERE user_id = '$user_id'";
 $cart_query =$conn-> query($select_cart);
 $subTotal = 0;
 while($cartData = mysqli_fetch_array($cart_query)){
    $product_price = $cartData['product_price'] * $cartData['quantity'];
    $subTotal += $product_price;
}
$shipping = ($subTotal /100)*5;
$total = $subTotal + $shipping;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="cart.css">
    <link rel="stylesheet" href="checkout.css">
</head>
<body>
    <section class="cart_container">
        <div class="cart_items">
            <div class="payment_method">
                <div class="payment_system">
                    <p>Cash on delivery only</p>
                </div>
                <div class="receiver_information">
                    <form action="checkout.php?id=<?php echo $products_id ?>" method="POST" class="form">
                        <h2>Receiver Information</h2>
                        <div class="form_item">
                            <label for="">Full Name:</label>
                            <input type="text" name="full_name" value="<?php echo $full_name ?>">
                        </div>
                        <div class="form_item">
                            <label for="">City:</label>
                            <input type="text" name="city">
                        </div>
                        <div class="form_item">
                            <label for="">Street:</label>
                            <input type="text" name="street">
                        </div>
                        <div class="form_item">
                            <label for="">Apt./house no.:</label>
                            <input type="text" name="house" placeholder="Apt no. Or house no.">
                        </div>
                        <div class="form_item">
                            <label for="">Email:</label>
                            <input type="email" name="email" value="<?php echo $email ?>">
                        </div>
                        <div class="form_item">
                            <label for="">Phone:</label>
                            <input type="number" name="number" value="<?php echo $phone ?>">
                        </div>
                        <input type="submit" name="order" value="Order" class="order_btn">
                    </form>
                </div>
            </div>
            <div class="checkout_detail">
                <div class="cart">
                    <p>sub total: <?php echo round($subTotal, 2)?> </p>
                    <p>shipping: <?php echo round($shipping, 2) ?></p>
                    <hr class='line'>
                    <p class="total">total: <?php echo round($total, 2) ?></p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
