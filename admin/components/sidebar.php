<div class="overlay" id="overlay"></div>
<div class="sidebar" id="sidebar">

    <div class="sidebar_profile_wrapper">
        <div class="profile_image">
            <img id="profile_image" src="../upload/assets/profile.gif" alt="profile_image">
        </div>
        <div class="prile_details">
            <h4 id="profile_title" class="profile_title">Kausn Chiwantha</h4>
            <h6 id="profile_subtitle" class="profile_subtitle">Developer</h6>
        </div>
        <hr>
        <div class="brand-logo">
            <h1 class="brand-name">K-Chord</h1>
        </div>
    </div>

    <hr>

    <div class="menu">

        <div class="item">
            <a href="index.php" class="sub-btn"><i class="fa-solid fa-book-open-reader"></i><span>Dasboard<i class="dropdown"></i></span></a>
        </div>

        <div class="item">
            <a class="sub-btn"><i class="fa-solid fa-folder-plus"></i><span>Master<i class="dropdown"></i></span></a>
            <div class="sub-menu">
                <a href="event.php" class="sub-item"><i class="fa-solid fa-champagne-glasses"></i><span>Event</span></a>
                <a href="ticket.php" class="sub-item"><i class="fa-solid fa-ticket"></i><span>Ticket</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-mug-hot"></i><span>Holidays</span></a>
            </div>
        </div>

        <div class="item">
            <a class="sub-btn"><i class="fa-solid fa-money-bill-transfer"></i><span>Transactions<i class="dropdown"></i></span></a>
            <div class="sub-menu">
                <a href="#" class="sub-item"><i class="fa-solid fa-file-invoice-dollar"></i><span>Orders</span></a>
                <a href="#" class="sub-item"><i class="fa-regular fa-hourglass-half"></i><span>Pending</span></a>
            </div>
        </div>

        <div class="item">
            <a class="sub-btn"><i class="fa-solid fa-check"></i><span>Manage<i class="dropdown"></i></span></a>
            <div class="sub-menu">
                <a href="#" class="sub-item"><i class="fa-solid fa-graduation-cap"></i><span>Study</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-table"></i><span>TimeTable</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-comment-sms"></i><span>SmS</span></a>
            </div>
        </div>

        <div class="item">
            <a class="sub-btn"><i class="fa-solid fa-file-pdf"></i><span>Report<i class="dropdown"></i></span></a>
            <div class="sub-menu">
                <a href="#" class="sub-item"><i class="fa-solid fa-file-pdf"></i><span>Orders</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-file-pdf"></i><span>Payments</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-file-pdf"></i><span>Events</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-file-pdf"></i><span>Calendar</span></a>
            </div>
        </div>

        <div class="item">
            <a class="sub-btn"><i class="fa-solid fa-gear"></i><span>System<i class="dropdown"></i></span></a>
            <div class="sub-menu">
                <a href="#" class="sub-item"><i class="fa-solid fa-server"></i><span>Users</span></a>
                <a href="#" class="sub-item"><i class="fa-solid fa-satellite-dish"></i><span>Devices</span></a>
                <a href="#" class="sub-item"><i class="fas fa-table"></i><span>Settings</span></a>
            </div>
        </div>

        <div class="item">
            <a href="#"><i class="fa-solid fa-info-circle"></i><span>FAQ</span></a>
        </div>
        
    </div>

</div>

<?php
    include_once '../config/links.php';
?>

<script type="text/javascript">

    $(document).ready(function() {
        $('.sub-btn').click(function() {
            // Hide any open sub-menu
            $('.sub-menu').not($(this).next('.sub-menu')).slideUp();
            // Toggle the clicked sub-menu
            $(this).next('.sub-menu').slideToggle();
            // Rotate the dropdown icon
        });
    });
    
</script>