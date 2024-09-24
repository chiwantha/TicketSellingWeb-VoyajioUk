<?php
    include '../config/config.php';
?>

<!DOCTYPE html>

<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K-Admin</title>

    <meta name="theme-color" content="#3F50FF">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="#3F50FF">

    <link href="../Upload/assets/logo.png" rel="icon">
    <link href="../Upload/assets/logo.png" rel="apple-touch-icon">

    <link rel="stylesheet" href="../style/css/style.css"/>
    <link rel="stylesheet" href="../style/css/fontawesome.min.css"/>
    <link rel="stylesheet" href="../style/css/all.min.css"/>
    <link rel="stylesheet" href="../style/css/sidebar.css"/>
    <link rel="stylesheet" href="../style/css/datatable.css"/>
    <link rel="stylesheet" href="../style/css/header.css"/>
    <link rel="stylesheet" href="../style/css/action-bar.css"/>
    <link rel="stylesheet" href="../style/css/modal-form.css"/>
    <link rel="stylesheet" href="../style/css/dash-cards.css"/>
    <?php 
        include_once '../style/css/online_css.php';
    ?>   
    
</head>

<body style="background: #ebebeb;">
    
    <?php 
        include_once 'components/sidebar.php';
    ?>

    <!-----------------------------main content---------------------------->

    <div class="main--content">

        <!-----------------------------header content---------------------------->

        <div class="header--wrapper">
            <div class="d-flex gap-2 align-items-center" style="align-content: center;">
                <div>
                    <button id="sidebarToggleTop" class="btn d-xl-none mr-3 sidebarToggleTop">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>
                <div class="header--title align-items-center">
                    <span>Dashboard</span>
                </div>
            </div>
            <div class="user--info">
                <a href="index.php" class="brand-name" style="text-decoration: none;"><h1>K-CHORD</h1></a>
            </div>     
        </div>

        <!-----------------------------card content---------------------------->

        <div class="card--container">
            <div class="card--wrapper row">

                <div class="col-lg-6">

                <div class="row ">
                        <div class="col-xl-6 col-md-6">
                            <div class="card2 l-bg-cherry">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">New Orders</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                3,243
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card2 l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Customers</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                15.07k
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card2 l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Ticket Resolved</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                578
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>10% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6">
                            <div class="card2 l-bg-orange-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Revenue Today</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                $11.61k
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>  

                </div>

                <div class="col-lg-6">

                    <div class="row ">
                        <div class="col-xl-6 col-lg-6">
                            <div class="card2 l-bg-cherry">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-shopping-cart"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">New Orders</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                3,243
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>12.5% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card2 l-bg-blue-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-users"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Customers</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                15.07k
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>9.23% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-green" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card2 l-bg-green-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-ticket-alt"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Ticket Resolved</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                578
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>10% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-orange" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <div class="card2 l-bg-orange-dark">
                                <div class="card-statistic-3 p-4">
                                    <div class="card-icon card-icon-large"><i class="fas fa-dollar-sign"></i></div>
                                    <div class="mb-4">
                                        <h5 class="card-title mb-0">Revenue Today</h5>
                                    </div>
                                    <div class="row align-items-center mb-2 d-flex">
                                        <div class="col-8">
                                            <h2 class="d-flex align-items-center mb-0">
                                                $11.61k
                                            </h2>
                                        </div>
                                        <div class="col-4 text-right">
                                            <span>2.5% <i class="fa fa-arrow-up"></i></span>
                                        </div>
                                    </div>
                                    <div class="progress mt-1 " data-height="8" style="height: 8px;">
                                        <div class="progress-bar l-bg-cyan" role="progressbar" data-width="25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

        <!-----------------------------table content---------------------------->

        <div class="table--wrapper mt-0">
            <div class="table--container">
                <table id="student_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Contact</th>
                            <th>Image</th>
                            <th>Account</th>
                            <th>Options</th>
                        </tr>                       
                    </thead>
                    <tbody id="student_table_body">
                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>

    </div>
    
</body>

<script src="../style/js/my-script.js"></script>
<script src="../style/js/func.js"></script>

<script>
    
    function load_students() {

        $.ajax({
            type: 'post',
            url: 'ajax/process_student.php',
            data: {
                'load_students' : true
            },
            success: function (response) {                                        
                $('#student_table_body').html(response);
                table_pagination('#student_table', '#student_table tbody');    
            }
        })
    }

    $(document).ready(function(){  	
        load_students();  
    });

    $('#sidebarToggleTop').on('click', function() {
        $('#sidebar').addClass('open');
        $('#overlay').toggle();
    });

    $('#closeBtn, #overlay').on('click', function() {
        $('#sidebar').removeClass('open');
        $('#overlay').hide();
    });

</script>

</html>