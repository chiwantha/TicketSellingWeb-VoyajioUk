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
    <meta name="mobile-web-app-capable" content="yes">
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
                    <span>Event Manage</span>
                </div>
            </div>
            <div class="user--info">
                <a href="index.php" class="brand-name" style="text-decoration: none;"><h1>K-CHORD</h1></a>
            </div>     
        </div>

        <!-----------------------------edit form content---------------------------->

        <div class="modal fade" id="eventeditmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">

                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Event</h1>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <form id="eventEditForm" class="row" method="post" role="form" enctype="multipart/form-data">

                            <div class="controls mt-2" id="eventEditFormBody">

                                <div class="separator">
                                    <span>Details</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <div class="form-group">
                                            <label for="name">event id *</label>
                                            <input type="text" name="id" id="id" class="form-control" placeholder="event id" readonly
                                            style="background: #F5F5F5;" maxlength="11">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="name">event name *</label>
                                            <input type="text" name="name" id="name" class="form-control" placeholder="event name" required="required"
                                            style="background: #F5F5F5;" maxlength="250">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 mb-3">
                                        <div class="form-group">
                                            <label for="date">event date *</label>
                                            <input type="date" name="date" id="date" placeholder="date" class="form-control" required="required"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <div class="form-group">
                                            <label for="start">start time *</label>
                                            <input  type="time" name="start" id="start" placeholder="start time" class="form-control" required="required"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 mb-3">
                                        <div class="form-group">
                                            <label for="end">end time *</label>
                                            <input type="time" name="end" id="end" placeholder="start time" class="form-control" required="required"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>
                                </div>

                                <div class="separator">
                                    <span>location</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4 mb-3">
                                        <div class="form-group">
                                            <label for="venue">venue *</label>
                                            <input type="text" id="venue" name="venue" class="form-control" placeholder="country club, london" required="required"
                                            style="background: #F5F5F5;" maxlength="250">
                                        </div>
                                    </div>
                                    <div class="col-sm-8 mb-3">
                                        <div class="form-group">
                                            <label for="map">Select Location *</label>
                                            <div class="">
                                                <input id="select-map-edit" type="text" class="form-control" placeholder="Choose location here" 
                                                style="background: #F5F5F5;">
                                            </div>
                                            <input type="text" name="lat" id="latedit" hidden>
                                            <input type="text" name="lon" id="lonedit" hidden>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="p-3">
                                        <!-- load map dinamicaly -->
                                        <div class="col-sm-12" style="border-radius: 10px;" id="mapedit"></div>
                                    </div>
                                    
                                </div>

                                <div class="separator">
                                    <span>Aditional Info</span>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12 mb-4">
                                        <div class="form-group">
                                            <label for="description">add description *</label>
                                            <textarea type="text" name="description" id="description" class="form-control" placeholder="this is a event of the year ! ..." required="required"
                                            style="background: #F5F5F5;" rows="5" maxlength="1000"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="file" class="form-control" name="image" id="imgInpedit" placeholder="Image"
                                            style="background: #F5F5F5;">
                                        </div>
                                    </div>  
                                    <div class="col-lg-2 mb-3">
                                        <img id="blahedit" src="../upload/event/default.png" alt="Event Image" 
                                        style="width: 100%; height: auto; border-radius: 10px;aspect-ratio: 16 / 9;">
                                    </div>                           
                                </div>

                            </div>

                            <div class="d-flex mb-3 d-none" style="justify-content: center;" id="Editprocessing">
                                <img src="../upload/assets/waiting.gif" alt="waiting.gif" class="loading_image mt-4">
                            </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" id="submit" name="submit" class="btn btn-success btn-send" value="Save">Update Event</button>
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

        <!-----------------------------------------------------------------------------------map -->

        <div class="modal fade" id="mapmodal" tabindex="-1" role="dialog" aria-labelledby="mapModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="map">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-----------------------------tab content---------------------------->

        <div class="table--wrapper">

            <ul class=" nav nav-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="simple-tab-0" data-bs-toggle="tab" href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0" aria-selected="true">Event List</a>
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
                        <input type="text" id="eventSearch" class="form-control" placeholder="search by name" style="background: #ebebeb;">
                    </div>

                    <div class="">
                        <div class="table--container">
                            <table id="event_table">
                                <thead>
                                    <tr>
                                        <!-- <th>ID</th> -->
                                        <th>Name</th>
                                        <th>Date</th>
                                        <th>Time</th>
                                        <th>Image</th>
                                        <th>State</th>
                                        <th>Options</th>
                                    </tr>                       
                                </thead>
                                <tbody id="event_table_body">
                                    
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

                    <form id="eventForm" class="m-1" method="post" role="form" enctype="multipart/form-data">

                        <div class="controls mt-2">

                            <div class="separator">
                                <span>Details</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="name">event name *</label>
                                        <input type="text" name="name" class="form-control" placeholder="event name" required="required"
                                        style="background: #F5F5F5;" maxlength="250">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="date">event date *</label>
                                        <input type="date" name="date" placeholder="date" class="form-control" required="required"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="start">start time *</label>
                                        <input  type="time" name="start" placeholder="start time" class="form-control" required="required"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="end">end time *</label>
                                        <input type="time" name="end" placeholder="start time" class="form-control" required="required"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>
                            </div>

                            <div class="separator">
                                <span>location</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-4 mb-3">
                                    <div class="form-group">
                                        <label for="venue">venue *</label>
                                        <input type="text" name="venue" class="form-control" placeholder="country club, london" required="required"
                                        style="background: #F5F5F5;" maxlength="250">
                                    </div>
                                </div>
                                <div class="col-sm-8 mb-3">
                                    <div class="form-group">
                                        <label for="map">Select Location *</label>
                                        <div class="d-flex gap-2">
                                            <input id="select-map" type="text" class="form-control" placeholder="Choose location here" 
                                            style="background: #F5F5F5;">
                                            <button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#mapmodal">Map</button>
                                        </div>
                                        <input type="text" name="lat" id="lat" hidden>
                                        <input type="text" name="lon" id="lon" hidden>
                                    </div>
                                </div>
                            </div>

                            <div class="separator">
                                <span>Aditional Info</span>
                            </div>

                            <div class="row">
                                <div class="col-sm-12 mb-4">
                                    <div class="form-group">
                                        <label for="description">add description *</label>
                                        <textarea type="text" name="description" class="form-control" placeholder="this is a event of the year ! ..." required="required"
                                        style="background: #F5F5F5;" rows="5" maxlength="1000"></textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <input type="file" class="form-control" name="image" id="imgInp" placeholder="Image"
                                        style="background: #F5F5F5;">
                                    </div>
                                </div>  
                                <div class="col-lg-2 mb-3">
                                    <img id="blah" src="../upload/event/default.png" alt="Student Image" style="width: 100%; height: auto; border-radius: 10px;aspect-ratio: 16 / 9;">
                                </div>                           
                            </div>

                        </div>

                        <div>
                            <button type="reset" class="reset-form btn btn-danger mt-1" value="Save">Reset</button>
                            <button type="submit" id="submit" name="submit" class="btn btn-success mt-1" value="Save">Light It Up</button>
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
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDjF1Mh7E9deDsS5-OjTJWM5c3xYw4KvPs&libraries=places&callback=initMapEdit" defer></script>

<?php
    include_once '../config/links.php';
?>

<!-- normal finctions -->

<script>

    //---------------------------------------------------------------------------------Page Load

    function load_events() {
        
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
            url: 'ajax/process_event.php',
            data: {
                'load_events' : true,
                'datetime' : formattedDateTime
            },
            success: function (response) {                                        
                $('#event_table_body').html(response);
                paginateTable('event_table', 10);
                $('#loadprocessing').addClass('d-none');
            }
        })
    }

    $(document).ready(function(){

        load_events();

        //---------------------------------------------------------------------------------Search-Intergration

        setup_Table_Search('eventSearch', 'event_table');

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

        $(document).on('submit', '#eventForm', function(e) {
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
            $('#eventForm').addClass('d-none');
            $('#processing').removeClass('d-none');

            formData.append("save_event", true);
            $.ajax({
                type: 'post',
                url: 'ajax/process_event.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = $.parseJSON(response);
                    if (res.status == 422) {
                        $('#eventForm').removeClass('d-none');
                        $('#processing').addClass('d-none');
                        $('#errorToast').toast("show");
                        $('#errorMessage').html(res.message);
                    } else if (res.status == 200) {
                        $('#eventForm').removeClass('d-none');
                        $('#processing').addClass('d-none');

                        $('#successToast').toast("show");
                        $('#successMessage').html(res.message);

                        $('#eventForm')[0].reset();
                        $('#blah').attr('src', '../upload/event/default.png');
                        
                        load_events();
                    }
                }
            });
        }

        //---------------------------------------------------------------------------------update-update

        $(document).on('submit', '#eventEditForm', function(e) {
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
            $('#eventEditFormBody').addClass('d-none');
            $('#Editprocessing').removeClass('d-none');
            var modal_id = '#eventeditmodal';

            formData.append("update_event", true)
            $.ajax({
                type:'post',
                url:'ajax/process_event.php',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    var res = $.parseJSON(response);
                    if (res.status == 422) {
                        $('#eventEditFormBody').removeClass('d-none');
                        $('#Editprocessing').addClass('d-none');

                        $('#errorToast').toast("show");
                        $('#errorMessage').html(res.message);
                    } else if(res.status == 200) {
                        $('#eventEditFormBody').removeClass('d-none');
                        $('#Editprocessing').addClass('d-none');

                        $('#successToast').toast("show");
                        $('#successMessage').html(res.message);

                        $('#eventEditForm')[0].reset();
                        load_events();
                        $(modal_id).modal('hide');   
                    }
                }
            });
        }

        //---------------------------------------------------------------------------------Page Buttons

        $(document).on('click', '.reset-form', function(e) {
            document.getElementById('studentForm').reset();
            $('#blah').attr('src', '../upload/event/default.png');
        });

        $(document).on('click', '.edit', function(e) {
            var modal_id = '#eventeditmodal';
            
            var event_id = $(this).val();
            $.ajax({
                type: 'GET',
                url: 'ajax/process_event.php?event_id=' + event_id, // Added '=' after 'event_id'
                success: function(response) {
                    var res = jQuery.parseJSON(response);
                    if (res.status == 422) {
                        alert(res.message);
                    } else if(res.status == 200) {
                        //alert(res.data.name);

                        $('#id').val(res.data.id);
                        $('#name').val(res.data.name);
                        $('#date').val(res.data.date);
                        $('#start').val(res.data.start_time);
                        $('#end').val(res.data.end_time);
                        $('#venue').val(res.data.venue);
                        $('#latedit').val(res.data.lat);
                        $('#lonedit').val(res.data.lon);
                        setLocation(res.data.lat, res.data.lon);
                        $('#description').val(res.data.description);
                        $('#blahedit').attr('src', '../upload/event/' + res.data.image);

                        $(modal_id).modal('show');         
                    }
                }
            });
        });

        $(document).on('click', '.remove', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to delete this Event ?')) {

                var event_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: 'ajax/process_event.php',
                    data: {
                        'remove_event' : true,
                        'event_id' : event_id
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
                            $('#event_table').load(location.href + " #event_table", function() {
                                load_events();
                            });
                        }
                    }
                })
            }
            
        });

        $(document).on('click', '.deactivate', function(e) {
            e.preventDefault();

            if (confirm('Are you sure you want to Deavtivate this Event ?')) {

                var event_id = $(this).val();
                $.ajax({
                    type: 'post',
                    url: 'ajax/process_event.php',
                    data: {
                        'deactivate_event' : true,
                        'event_id' : event_id
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
                            $('#event_table').load(location.href + " #event_table", function() {
                                load_events();
                            });
                        }
                    }
                })
            }
            
        });

        $(document).on('click', '.activate', function(e) {
            e.preventDefault();

            var event_id = $(this).val();

            $.ajax({
                type: 'post',
                url: 'ajax/process_event.php',
                data: {
                    'activate_event' : true,
                    'event_id' : event_id
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
                        $('#event_table').load(location.href + " #event_table", function() {
                            load_events();
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

        //---------------------------------------------------------------------------------map genarator

    });

</script>

<!-- mother fucking map functions  -->

<script>

    let map;
    let marker;
    let autocomplete;

    function initMap() {
        // Initialize the map without an initial location
        map = new google.maps.Map(document.getElementById("map"), {
            zoom: 8,
            center: { lat: 0, lng: 0 }, // Centering the map at (0,0)
        });

        // Initialize a draggable marker
        marker = new google.maps.Marker({
            map: map,
            draggable: true,
        });

        // Update hidden inputs and search bar when marker position changes
        google.maps.event.addListener(marker, 'position_changed', function() {
            const position = marker.getPosition();
            document.getElementById('lat').value = position.lat();
            document.getElementById('lon').value = position.lng();
            document.getElementById('select-map').value = `Lat: ${position.lat().toFixed(5)}, Lng: ${position.lng().toFixed(5)}`;
            //showAlert();
        });

        // Initialize Places Autocomplete
        const input = document.getElementById('select-map');
        autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.addListener('place_changed', function() {
            const place = autocomplete.getPlace();
            if (place.geometry) {
                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);
                document.getElementById('lat').value = place.geometry.location.lat();
                document.getElementById('lon').value = place.geometry.location.lng();
                document.getElementById('select-map').value = place.formatted_address;
            }
            //showAlert();
        });

        // Add a click listener to the map to set the marker position
        map.addListener('click', function(event) {
            const location = event.latLng;
            marker.setPosition(location);
            map.setCenter(location);

            // Update the inputs and search bar
            document.getElementById('lat').value = location.lat();
            document.getElementById('lon').value = location.lng();

            // Optionally, get an address from the selected location
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: location }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    document.getElementById('select-map').value = results[0].formatted_address;
                } else {
                    document.getElementById('select-map').value = 'Location selected';
                }
            });
            //showAlert();
        });
    }

    let mapedit;
    let markeredit;
    let autocompleteedit;

    function initMapEdit() {
        // Initialize the map and marker
        mapedit = new google.maps.Map(document.getElementById("mapedit"), {
            zoom: 8,
            center: { lat: 0, lng: 0 }, // Default center
        });

        markeredit = new google.maps.Marker({
            map: mapedit,
            draggable: true,
        });

        // Update hidden inputs and search bar when marker position changes
        google.maps.event.addListener(markeredit, 'position_changed', function() {
            const position = markeredit.getPosition();
            document.getElementById('latedit').value = position.lat();
            document.getElementById('lonedit').value = position.lng();
            document.getElementById('select-map-edit').value = `Lat: ${position.lat().toFixed(5)}, Lng: ${position.lng().toFixed(5)}`;
        });

        // Initialize Places Autocomplete for the new search bar
        const input = document.getElementById('select-map-edit');
        autocompleteedit = new google.maps.places.Autocomplete(input);

        autocompleteedit.addListener('place_changed', function() {
            const place = autocompleteedit.getPlace();
            if (place.geometry) {
                mapedit.setCenter(place.geometry.location);
                markeredit.setPosition(place.geometry.location);
                document.getElementById('latedit').value = place.geometry.location.lat();
                document.getElementById('lonedit').value = place.geometry.location.lng();
                document.getElementById('select-map-edit').value = place.formatted_address;
            }
        });

        // Add a click listener to the map to set the marker position
        mapedit.addListener('click', function(event) {
            const location = event.latLng;
            markeredit.setPosition(location);
            mapedit.setCenter(location);

            // Update the inputs and search bar
            document.getElementById('latedit').value = location.lat();
            document.getElementById('lonedit').value = location.lng();

            // Optionally, get an address from the selected location
            const geocoder = new google.maps.Geocoder();
            geocoder.geocode({ location: location }, function(results, status) {
                if (status === 'OK' && results[0]) {
                    document.getElementById('select-map-edit').value = results[0].formatted_address;
                } else {
                    document.getElementById('select-map-edit').value = 'Location selected';
                }
            });
        });
    }

    function setLocation(lat, lng) {
        if (!mapedit || !markeredit) {
            console.error("Map or marker not initialized.");
            return;
        }

        // Create a new LatLng object with the provided latitude and longitude
        const location = new google.maps.LatLng(lat, lng);

        // Update the marker position and center the map on the provided location
        markeredit.setPosition(location);
        mapedit.setCenter(location);

        // Update the hidden inputs
        document.getElementById('latedit').value = lat;
        document.getElementById('lonedit').value = lng;

        // Use the Geocoder to get the location name and set it in the search bar
        const geocoder = new google.maps.Geocoder();
        geocoder.geocode({ location: location }, function(results, status) {
            if (status === 'OK' && results[0]) {
                document.getElementById('select-map-edit').value = results[0].formatted_address;
            } else {
                document.getElementById('select-map-edit').value = 'Location selected';
            }
        });
    }

    window.onload = initMapEdit;

</script>

</html>