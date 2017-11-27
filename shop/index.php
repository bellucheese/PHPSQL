<?php
    include_once 'assets/layout/nav.php';
    if(isset($_GET['registration']) == 'success'){
        echo "<div class='alert alert-success'>SUCCESS: <b>Registration</b> complete! Feel free to login!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
    if(isset($_GET['login']) == 'success'){
        echo "<div class='alert alert-success'>SUCCESS: <b>Login</b> complete! Feel free to look around and shop!<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button></div>";
    }
?>

<div class="card" style="width: 50%;">
    <img class="car-img-top" src="https://cdn.shopify.com/s/files/1/0934/3720/products/giraffe-whats-up-funny-vintage-t-shirts_1024x1024.jpg" style=" display: block; max-height: 400px; height: auto; width: auto;">
    <div class="card-body">
        <h4 class="card-title">Item Name</h4>
        <p class="card-text">A small description of the item for the customer to view</p>
        <a href="#" class="btn btn-primary">View item</a> <span style="float: right; font-weight: bold; font-size: 16px" class="text-right text-primary">$9.99</span>
    </div>
</div>

<?php include_once 'assets/layout/footer.php'?>