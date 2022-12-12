<?php
    session_start();
   require("function.php");
   
   $con = openConnection();
   $id = mysqli_real_escape_string($con, $_GET['k']);

   $sql = 'SELECT * FROM tbl_products';
   $result = mysqli_query($con, $sql);
   $arrProd = mysqli_fetch_all($result, MYSQLI_ASSOC);


        if(isset($_SESSION['customerID'])){
            if(isset($_POST['process'])) {
                if(isset($_SESSION['cart'][$_POST['id']][$_POST['size']]))
                    $_SESSION['cart'][$_POST['id']][$_POST['size']] += $_POST['quantity'];
                else
                    $_SESSION['cart'][$_POST['id']][$_POST['size']] = $_POST['quantity'];
                    
                $_SESSION['cart_count'] += $_POST['quantity'];
                header("location: confirm.php");
            }
        }else{
            header("location: login.php");
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/styles.css">
    <title>Learn IT Easy Online Shop | Shopping Cart</title>
</head>
<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-8">
                <h1>
                    <i class="fa fa-store"></i>
                    Learn IT Easy Online Shop
                </h1>
            </div>
            <div class = "mr-1">
                    <a href="validateCart.php" class="btn btn-primary">
                        <i class="fa fa-shopping-cart"></i> Cart
                        <span class="badge badge-light">                        
                        <?php echo $_SESSION['cart_count']; ?>
                        </span>
                    </a>
                </div>
            <div>
                <?php if (isset($_SESSION['customerName'])){ ?>
            <div class="dropdown">
                  <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user"></i>
                    <?php echo $_SESSION['customerName'];  ?>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item text-danger" href="signout.php">log out</a>
                  </div>
            </div>
                <?php }else{ ?> 
                    <a href="login.php" class="btn btn-primary text-white" >
                        Sign In
                    </a>
                <?php } ?>
            </div>   
        </div>
        <div class="row">
            <?php if(isset($arrProd[$id]['id'])): ?>                
                    <div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">                        
                        <div class="product-image2">                            
                            <img class="pic-1 w-100" src="uploads/<?php echo $arrProd[$id]['photo1']; ?>">                                              
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-8 col-lg-8 mb-4">
                        <form method="post">
                            <div class="product-content">
                                <h3 class="title">
                                    <?php echo $arrProd[$id]['name']; ?> <span class="badge badge-dark">₱ <?php echo $arrProd[$id]['price']; ?></span>
                                </h3>                        
                                <p><?php echo $arrProd[$id]['description']; ?></p>
                                <hr>

                                <input type="hidden" name="id" value="<?php echo $_GET['k']; ?>">
                                <h3 class="title">Select Size:</h3>
                                <input type="radio" name="size" id="XS" value="XS" checked="">
                                <label for="XS" class="pr-3">XS</label>
                                <input type="radio" name="size" id="SM" value="SM">
                                <label for="SM" class="pr-3">SM</label>
                                <input type="radio" name="size" id="MD" value="MD">
                                <label for="MD" class="pr-3">MD</label>
                                <input type="radio" name="size" id="LG" value="LG">
                                <label for="LG" class="pr-3">LG</label>
                                <input type="radio" name="size" id="XL" value="XL">
                                <label for="XL" class="pr-3">XL</label>                            
                                <hr>
                                
                                <h3 class="title">Enter Quantity:</h3>
                                <input type="number" name="quantity" id="quantity" placeholder="0" class="form-control" min="1" max="100" required>
                                <br>
                                <button type="submit" name="process" class="btn btn-dark btn-lg"><i class="fa fa-check-circle"></i> Confirm Product Purchase</button>
                                <a href="index.php" class="btn btn-danger btn-lg"><i class="fa fa-arrow-left"></i> Cancel / Go Back</a>
                            </div>
                        </form>                        
                    </div>                                               
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js" integrity="sha512-wV7Yj1alIZDqZFCUQJy85VN+qvEIly93fIQAN7iqDFCPEucLCeNFz4r35FCo9s6WrpdDQPi80xbljXB8Bjtvcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>    
</body>
</html>