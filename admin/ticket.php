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
    <link rel="stylesheet" href="../style/css/profile.css"/>
    <link rel="stylesheet" href="../style/css/tab.css"/>
    
    <?php 
        include_once '../style/css/online_css.php';
    ?>  
    
</head>

<body style="background: #ebebeb;">

    <?php 
        include_once 'components/sidebar.php';
    ?>

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
                    <span>Ticket Manage</span>
                </div>
            </div>
            <div class="user--info">
                <a href="index.php" class="brand-name" style="text-decoration: none;"><h1>K-CHORD</h1></a>
            </div>     
        </div>

        <!-----------------------------edit form content---------------------------->

        <div class="modal fade" id="ticketteditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Ticket</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="ticketEditForm" class="row" method="post" role="form" enctype="multipart/form-data">

                            <div class="controls mt-2" id="ticketEditFormBody">

                                <div class="separator">
                                    <span>Details</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="name">ticket id *</label>
                                            <input type="text" name="id" id="ticket_id" class="form-control" placeholder="ticket id" readonly
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 mb-3">
                                        <div class="form-group">
                                        <label for="type">ticket type *</label>
                                            <select class="form-select" id="ticket_type" name="type" aria-label="Default select example" aria-placeholder="type"
                                            style="background: #F5F5F5;">
                                                <option value="" selected>- select -</option>
                                                <option value="0">Eco</option>
                                                <option value="1">Regular</option>
                                                <option value="2">Vip</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-8 mb-3">
                                        <div class="form-group">
                                        <label for="event">event *</label>
                                            <select class="form-select" id="edit_event" name="event" aria-label="Default select example" aria-placeholder="event"
                                            style="background: #F5F5F5;">
                                                <option value="" selected>- select -</option>
                                                <!-- load events dinamiclly -->
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="name">ticket title *</label>
                                            <input type="text" name="name" id="ticket_name" class="form-control" placeholder="ticket title" required="required"
                                            style="background: #F5F5F5;" maxlength="250">
                                        </div>
                                    </div>
                                </div>

                                <div class="separator"> 
                                    <span>Pricing and Units</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="price">price *</label>
                                            <input type="text" name="price" id="ticket_price" class="form-control" placeholder="1500" required="required"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <div class="form-group">
                                            <label for="stock">stock *</label>
                                            <input type="number" name="stock" id="ticket_stock" class="form-control" placeholder="100" required="required"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>
                                </div>

                                <div class="separator">
                                    <span>Images or Intaface</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image" id="imgInpedit" placeholder="Image"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>  
                                    <div class="col-lg-2 mb-3">
                                        <img id="blahedit" src="../upload/ticket/default.png" alt="Student Image" style="width: 100%; height: auto; border-radius: 10px;aspect-ratio: 16 / 9;">
                                    </div>                           
                                </div>

                            </div>

                            <div class="d-flex mb-3 d-none" style="justify-content: center;" id="Editprocessing">
                                <img src="../upload/assets/waiting.gif" alt="waiting.gif" class="loading_image mt-4">
                            </div>

                    </div>

                    <div class="modal-footer">
                        <button type="reset" class="reset-form btn btn-danger mt-1" value="Save">Reset</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-success mt-1" value="Save">Update Ticket</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
        <!-----------------------------toast container---------------------------->

        <div class="toast-container position-fixed bottom-0 end-0 p-3">

            <!-----------------------------toast success---------------------------->
            <div class="toast align-items-center text-bg-success border-0 p-1" role="alert" aria-live="assertive" aria-atomic="true" id="successToast">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>Success!</strong>
                        <span id="successMessage"></span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>

            <!-----------------------------toast success---------------------------->
            <div class="toast align-items-center text-bg-danger border-0 p-1" role="alert" aria-live="assertive" aria-atomic="true" id="errorToast">
                <div class="d-flex">
                    <div class="toast-body">
                        <strong>Error !</strong>
                        <span id="errorMessage"></span>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>

        </div>

        <!-----------------------------tab content---------------------------->

        <div class="table--wrapper">

            <ul class=" nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Ticket List</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="simple-tab-1" data-bs-toggle="tab" href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1" aria-selected="false">New</a>
                </li>
                <!-- <li class="nav-item hidden" role="presentation">
                    <a class="nav-link" id="simple-tab-2" data-bs-toggle="tab" href="#simple-tabpanel-2" role="tab" aria-controls="simple-tabpanel-2" aria-selected="false">Trash</a>
                </li> -->
            </ul>

            <div class="tab-content" id="tab-content">

                <div class="tab-pane active" id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">

                    <div class="mb-3 mt-3">
                        <input type="text" id="ticketSearch" class="form-control" placeholder="search" style="background: #ebebeb;">
                    </div>

                    <div class="">
                        <div class="table--container">
                            <table id="ticket_table">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Ticket</th>
                                        <th>Type</th>
                                        <th>Event</th>
                                        <th>Price</th>
                                        <th>Stock</th>
                                        <th>Image</th>
                                        <th>State</th>
                                        <th>Event</th>
                                        <th>Options</th>
                                    </tr>                       
                                </thead>
                                <tbody id="ticket_table_body">
                                    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <!-- <td></td> -->
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tfoot>
                            </table>
                            
                            <div id="nav"></div> <!-- Pagination controls container -->

                            <div class="d-flex mb-3 d-none" style="justify-content: center;" id="loadprocessing">
                                <img src="../upload/assets/waiting.gif" alt="waiting.gif" class="loading_image mt-4">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="tab-pane" id="simple-tabpanel-1" role="tabpanel" aria-labelledby="simple-tab-21">

                    <form id="ticketForm" class="m-1" method="post" role="form" enctype="multipart/form-data">

                        <div class="controls mt-2">

                            <div class="separator">
                                <span>Details</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                    <label for="type">ticket type *</label>
                                        <select class="form-select" id="type" name="type" aria-label="Default select example" aria-placeholder="type"
                                        style="background: #F5F5F5;">
                                            <option value="" selected>- select -</option>
                                            <option value="0">Eco</option>
                                            <option value="1">Regular</option>
                                            <option value="2">Vip</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <div class="form-group">
                                    <label for="event">event *</label>
                                        <select class="form-select" id="event" name="event" aria-label="Default select example" aria-placeholder="event"
                                        style="background: #F5F5F5;">
                                            <option value="" selected>- select -</option>
                                            <!-- load events dinamiclly -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="name">ticket title *</label>
                                        <input type="text" name="name" class="form-control" placeholder="ticket title" required="required"
                                        style="background: #F5F5F5;" maxlength="250">
                                    </div>
                                </div>
                            </div>

                            <div class="separator"> 
                                <span>Pricing and Units</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="price">price *</label>
                                        <input type="text" name="price" class="form-control" placeholder="1500" required="required"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>

                                <div class="col-sm-6 mb-3">
                                    <div class="form-group">
                                        <label for="stock">stock *</label>
                                        <input type="number" name="stock" class="form-control" placeholder="100" required="required"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>
                            </div>

                            <div class="separator">
                                <span>Images or Intaface</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="image" id="imgInp" placeholder="Image"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>  
                                <div class="col-lg-2 mb-3">
                                    <img id="blah" src="../upload/ticket/default.png" alt="Student Image" style="width: 100%; height: auto; border-radius: 10px;aspect-ratio: 16 / 9;">
                                </div>                           
                            </div>

                        </div>

                        <div>
                            <button type="reset" class="reset-form btn btn-danger mt-1" value="Save">Reset</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-success mt-1" value="Save">Make an Entrance</button>
                        </div>

                    </form>

                    <div class="d-flex mb-3 d-none" style="justify-content: center;" id="processing">
                        <img src="../upload/assets/waiting.gif" alt="waiting.gif" class="loading_image mt-4">
                    </div>

                </div>

                <!-- <div class="tab-pane" id="simple-tabpanel-2" role="tabpanel" aria-labelledby="simple-tab-2">

                </div> -->

            </div>

        </div>

    </div>

</body>

<script src="../style/js/my-script.js"></script>
<script src="../style/js/func.js"></script>
<?php
    include_once '../config/links.php';
?>

<script>

    let condition = "state = 1 AND date >= '" + formattedDate + "'";
    loadOptions('event', 'event', 'id', 'name', condition);
    loadOptions('edit_event', 'event', 'id', 'name', 'state = 1');

    function load_tickets() {
        
        $('#loadprocessing').removeClass('d-none');

        const now = new Date();

        const year = now.getFullYear();
        const month = String(now.getMonth() + 1).padStart(2, '0'); // Months are 0-indexed
        const day = String(now.getDate()).padStart(2, '0');
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');

        const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;

        $.ajax({
            type: 'post',
            url: 'ajax/process_ticket.php',
            data: {
                'load_tickets' : true,
                'datetime' : formattedDateTime
            },
            success: function (response) {                                        
                $('#ticket_table_body').html(response);
                paginateTable('ticket_table', 10);
                $('#loadprocessing').addClass('d-none');
            }
        })
    }

    $(document).ready(function(){

        load_tickets();

        //---------------------------------------------------------------------------------Search-Intergration

        setup_Table_Search('ticketSearch', 'ticket_table');

        //---------------------------------------------------------------------------------Image-Imputs

        imgInp.onchange = evt => {
            const [file] = imgInp.files
            if (file) {
                blah.src = URL.createObjectURL(file)
            }
        }

        imgInpedit.onchange = evt => {
            const [file] = imgInpedit.files
            if (file) {
                blahedit.src = URL.createObjectURL(file)
            }
        }

        //---------------------------------------------------------------------------------Image-Imputs-resize

        function resizeImage(file, targetSizeKB, callback) {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function (event) {
                const img = new Image();
                img.src = event.target.result;
                img.onload = function () {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    canvas.width = img.width;
                    canvas.height = img.height;
                    ctx.drawImage(img, 0, 0);

                    let quality = 0.7;
                    let resizedImageDataUrl;

                    do {
                        resizedImageDataUrl = canvas.toDataURL('image/jpeg', quality);
                        quality -= 0.05;
                    } while (resizedImageDataUrl.length / 1024 > targetSizeKB && quality > 0.1);

                    const resizedImageBlob = dataURLToBlob(resizedImageDataUrl);
                    callback(resizedImageBlob);
                };
            };
        }

        function dataURLToBlob(dataURL) {
            const byteString = atob(dataURL.split(',')[1]);
            const mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
            const ab = new ArrayBuffer(byteString.length);
            const ia = new Uint8Array(ab);
            for (let i = 0; i < byteString.length; i++) {
                ia[i] = byteString.charCodeAt(i);
            }
            return new Blob([ab], { type: mimeString });
        }

        //---------------------------------------------------------------------------------Forms-admission

        $(document).on('submit', '#ticketForm', function(e) {
            e.preventDefault();

            const form = this;
            const fileInput = document.getElementById('imgInp');
            const file = fileInput.files[0];

            if (file && file.size > 3 * 1024 * 1024) { // Check if the file is larger than 1MB
                alert('The image is larger than 3MB. It will be resized.');
                resizeImage(file, 100, function(resizedImageBlob) {
                    const formData = new FormData(form);
                    formData.append("image", resizedImageBlob, 'resized-image.jpg');
                    submitForm(formData);
                });
            } else {
                const formData = new FormData(form);
                if (file) {
                    formData.append("image", file);
                }
                submitForm(formData);
            }
        });

        function submitForm(formData) {
            // alert('ok');
            $('#ticketForm').addClass('d-none');
            $('#processing').removeClass('d-none');

            formData.append("save_ticket", true);
            $.ajax({
                type: 'post',
                url: 'ajax/process_ticket.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = $.parseJSON(response);
                    if (res.status == 422) {
                        $('#ticketForm').removeClass('d-none');
                        $('#processing').addClass('d-none');
                        $('#errorToast').toast("show");
                        $('#errorMessage').html(res.message);
                    } else if (res.status == 200) {
                        $('#ticketForm').removeClass('d-none');
                        $('#processing').addClass('d-none');

                        $('#successToast').toast("show");
                        $('#successMessage').html(res.message);

                        $('#ticketForm')[0].reset();
                        $('#blah').attr('src', '../upload/ticket/default.png');
                        
                        load_tickets();
                    }
                }
            });
        }

        //---------------------------------------------------------------------------------update-update

        $(document).on('submit', '#ticketEditForm', function(e) {
            e.preventDefault();   

            const form = this;
            const fileInput = document.getElementById('imgInpedit');
            const file = fileInput.files[0];

            if (file && file.size > 1024 * 1024) { // Check if the file is larger than 1MB
                alert('The image is larger than 1MB. It will be resized.');
                resizeImage(file, 100, function(resizedImageBlob) {
                    const formData = new FormData(form);
                    formData.append("image", resizedImageBlob, 'resized-image.jpg');
                    submitEditForm(formData);
                });
            } else {
                const formData = new FormData(form);
                if (file) {
                    formData.append("image", file);
                }
                submitEditForm(formData);
            }
            
        });

        function submitEditForm(formData) {
            $('#ticketEditFormBody').addClass('d-none');
            $('#Editprocessing').removeClass('d-none');
            var modal_id = '#ticketteditmodal';

            formData.append("update_ticket", true)
            $.ajax({
                type:'post',
                url:'ajax/process_ticket.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = $.parseJSON(response);
                    if (res.status == 422) {
                        $('#ticketEditFormBody').removeClass('d-none');
                        $('#Editprocessing').addClass('d-none');

                        $('#errorToast').toast("show");
                        $('#errorMessage').html(res.message);
                    } else if(res.status == 200) {
                        $('#ticketEditFormBody').removeClass('d-none');
                        $('#Editprocessing').addClass('d-none');

                        $('#successToast').toast("show");
                        $('#successMessage').html(res.message);

                        $('#ticketEditForm')[0].reset();
                        load_tickets();
                        $(modal_id).modal('hide');   
                    }
                }
            });
        }

        //---------------------------------------------------------------------------------Page Buttons

        $(document).on('click', '.reset-form', function(e) {
            document.getElementById('ticketForm').reset();
            $('#blah').attr('src', '../upload/ticket/default.png');
        });

        $(document).on('click', '.edit', function(e) {
            var modal_id = '#ticketteditmodal';
            
            var ticket_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'ajax/process_ticket.php?ticket_id=' + ticket_id,
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        alert(res.message);
                    } else if(res.status == 200) {
                        //alert(res.data.name);

                        $('#ticket_id').val(res.data.id);
                        $('#ticket_type').val(res.data.type);
                        console.log(res.data.event_id);
                        $('#edit_event').val(res.data.event_id);
                        $('#ticket_name').val(res.data.name);
                        $('#ticket_price').val(res.data.price);
                        $('#ticket_stock').val(res.data.stock);
                        $('#blahedit').attr('src', '../upload/ticket/' + res.data.image);

                        $(modal_id).modal('show');         
                    }
                }
            });
        });

        $(document).on('click', '.remove', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to Permanate delete this Ticket ?')) {

                var ticket_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: 'ajax/process_ticket.php',
                    data: {
                        'remove_ticket' : true,
                        'ticket_id' : ticket_id
                    },
                    success: function (response) {    
                        var res = $.parseJSON(response);
                        if (res.status == 500) {
                            //alert('hellow');
                            //alert(res.message);
                            $('#errorToast').toast("show");
                            $('#errorMessage').html(res.message);
                        } else if(res.status == 200) {                                                         
                            $('#successToast').toast("show");
                            $('#successMessage').html(res.message);
                            $('#ticket_table').load(location.href + " #ticket_table", function() {
                                load_tickets();
                            });
                        }
                    }
                })
            }
            
        });

        $(document).on('click', '.deactivate', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to Disable this Ticket ?')) {

                var ticket_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: 'ajax/process_ticket.php',
                    data: {
                        'deactivate_ticket' : true,
                        'ticket_id' : ticket_id
                    },
                    success: function (response) {    
                        var res = $.parseJSON(response);
                        if (res.status == 500) {
                            //alert('hellow');
                            //alert(res.message);
                            $('#errorToast').toast("show");
                            $('#errorMessage').html(res.message);
                        } else if(res.status == 200) {                                                         
                            $('#successToast').toast("show");
                            $('#successMessage').html(res.message);
                            $('#ticket_table').load(location.href + " #ticket_table", function() {
                                load_tickets();
                            });
                        }
                    }
                })
            }
            
        });

        $(document).on('click', '.activate', function(e) {
            e.preventDefault();

            var ticket_id = $(this).val();

            $.ajax({
                type: 'post',
                url: 'ajax/process_ticket.php',
                data: {
                    'activate_ticket' : true,
                    'ticket_id' : ticket_id
                },
                success: function (response) {    
                    var res = $.parseJSON(response);
                    if (res.status == 500) {
                        //alert('hellow');
                        //alert(res.message);
                        $('#errorToast').toast("show");
                        $('#errorMessage').html(res.message);
                    } else if(res.status == 200) {                                                         
                        $('#successToast').toast("show");
                        $('#successMessage').html(res.message);
                        $('#ticket_table').load(location.href + " #ticket_table", function() {
                            load_tickets();
                        });
                    }
                }
            })
            
        });

        $(document).on('click', '.view', function(e) {
            alert ("Comming Soon !");
        });

        $('#sidebarToggleTop').on('click', function() {
            $('#sidebar').addClass('open');
            $('#overlay').toggle();
        });

        $('#closeBtn, #overlay').on('click', function() {
            $('#sidebar').removeClass('open');
            $('#overlay').hide();
        });

    })

</script>

</html>