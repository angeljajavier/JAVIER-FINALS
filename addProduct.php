<?php
ob_start();
session_start();

require('function.php');
$err = array('ProductName'=>'', 'ProductPrice'=>'', 'ProdDes'=>'', 'image1'=>'', 'image2'=>'');
$ProductName = $ProductPrice = $ProdDes = '';
$con = openConnection();


?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Ample lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Ample admin lite dashboard bootstrap 5 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>Ample Admin Lite Template by WrapPixel</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
    <link href="plugins/bower_components/chartist/dist/chartist.min.css" rel="stylesheet">
    <link rel="stylesheet" href="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css">
    <!-- Custom CSS -->
    <link href="css/dashstyle.min.css" rel="stylesheet">
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <a class="navbar-brand" href="dashboard.html">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                        </span>
                    </a>
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav ms-auto d-flex align-items-center">
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Kyokie</span></a>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item pt-2">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="dashboard.php"
                                aria-expanded="false">
                                <i class="far fa-clock" aria-hidden="true"></i>
                                <span class="hide-menu">Dashboard</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="#"
                                aria-expanded="false">
                                <i class="fa fa-font" aria-hidden="true"></i>
                                <span class="hide-menu">Add</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a class="sidebar-link waves-effect waves-dark sidebar-link" href="ChangeAdminPassword.php"
                                aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="hide-menu">Profile</span>
                            </a>
                        </li>
                        <li class="text-center p-20 upgrade-btn">
                            <a href="loginAdmin.php"
                                class="btn d-grid btn-danger text-white" target="_blank">
                                Logout</a>
                        </li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <div class="page-wrapper">
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">ADD PRODUCT</h4>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-body">
                    <?php

                        if (isset($_POST['addbtn'])) {
                            $con = openConnection();
                            $ProductName = sanitizeInput($con, $_POST['ProductName']);
                            $ProductPrice = sanitizeInput($con, $_POST['ProductPrice']);
                            $ProdDes = sanitizeInput($con, $_POST['ProdDes']);

                            $img1 = sanitizeInput($con, $_FILES['image1']['name']);
                            $img2 = sanitizeInput($con, $_FILES['image2']['name']);

                            if (empty($ProductName)) {
                                $err['ProductName'] = 'Product Name is required.';
                            }

                            if (empty($ProductPrice)) {
                                $err['ProductPrice'] = 'Product Price is required.';
                            }

                            if (empty($ProdDes)) {
                                $err['ProdDes'] = 'Product Description is required.';
                            }

                            if (empty($_FILES['image1']['name'])) {
                                $err['image1'] = "Photo 1 is requred";
                            }else{
                                $image1 = fileUpload($_FILES['image1']);
                                $arrImage1[] = $image1;
                                if (!empty($arrImage1[0])) {
                                $err['image1'] = '' . $arrImage1[0][0];
                                }
                            }


                            if (empty($_FILES['image2']['name'])) {
                                $err['image2'] = "Photo 2 is requred";
                            }else{
                                $image2 = fileUpload($_FILES['image2']);
                                $arrImage2[] = $image2;
                                if (!empty($arrImage2[0])) {
                                $err['image2'] = '' . $arrImage2[0][0];   
                                }
                            }

                            if(!array_filter($err)){
                            $strSql = "INSERT INTO tbl_products(name, description, price, photo1, photo2) 
                            VALUES ('$ProductName', '$ProdDes', '$ProductPrice', '$img1', '$img2') 
                            ";
                            if (mysqli_query($con, $strSql)) {
                                header('location: addProduct.php');
                            }
                            else
                            echo "errorL: ";

                        }
                        }
                        ob_end_flush();
                        ?> 
                        <form method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-5">
                                <input type="text" name="ProductName" class="form-control" placeholder="Name of the Product" value="<?php echo $ProductName;?>">
                                    <?php echo '<label class="text-danger">'.$err['ProductName'].'</label>'; ?>
                                </div>
                                <div class="col-md-5">
                                <input type="number" name="ProductPrice" class="form-control"  placeholder="Price of the Product" value="<?php echo $ProductPrice;?>">
                                <?php echo '<label class="text-danger">'.$err['ProductPrice'].'</label>'; ?>
                                </div>
                            </div><br>   
                            <div class="row">
                                <div class="col-md-10">
                                <label for="inputAddress">Product Description</label>
                                <textarea name="ProdDes" class="form-control " id="inputAddress" placeholder="Description" value="<?php echo $ProdDes;?>"></textarea>
                                <?php echo '<label class="text-danger">'.$err['ProdDes'].'</label>'; ?>
                                </div>
                            </div><br>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="photo1">Photo 1</label>
                                    <input type="file" name="image1" id="photo1"> 
                                    <?php echo '<label class="text-danger">'.$err['image1'].'</label>'; ?>   
                                </div>
                                <div class="col-md-5">
                                    <label for="photo2">Photo 2</label>
                                    <input type="file" name="image2" id="photo2">
                                    <?php echo '<label class="text-danger">'.$err['image2'].'</label>'; ?> 
                                </div>
                            </div>
                            <br>
                                <div class="row">
                                    <div class="col-md-5">
                                    <button type="submit" name="addbtn" class="btn btn-success text-white">ADD PRODUCT</button>
                                    <a href="dashboard.php" class="btn btn-primary text-white">GO BACK</a>
                                    </div>
                                </div>
                        </form>

                        <div id="success_tic" class="modal fade" role="dialog">
                            <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                <a class="close" href="#" data-dismiss="modal">&times;</a>
                                <div class="page-body">
                                <div class="head">  
                                <h3 style="margin-top:5px;">Lorem ipsum dolor sit amet</h3>
                                <h4>Lorem ipsum dolor sit amet</h4>
                                </div>

                            <h1 style="text-align:center;"><div class="checkmark-circle">
                            <div class="background"></div>
                            <div class="checkmark draw"></div>
                            </div><h1>

                            </div>
                            </div>
                                </div>

                            </div>
                    </div>
                </div>
                </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">

            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <footer class="footer text-center"> 2022 © Angel brought to you by <a
                    href="https://youtu.be/dQw4w9WgXcQ">Click Here</a>
            </footer>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <script src="plugins/bower_components/jquery-sparkline/jquery.sparkline.min.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>
    <!--This page JavaScript -->
    <!--chartis chart-->
    <script src="plugins/bower_components/chartist/dist/chartist.min.js"></script>
    <script src="plugins/bower_components/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="js/pages/dashboards/dashboard1.js"></script>
</body>

</html>