<?php

include '../../config/config.php';

// load

if(isset($_POST['load_tickets'])) {

    $now = mysqli_real_escape_string($conn, $_POST['datetime']);

    $search = mysqli_query($conn, "SELECT ticket_id, ticket_name, ticket_type, event_name, ticket_price, ticket_stock, ticket_image, ticket_state, 
    event_date, event_start_time, event_end_time, event_state FROM Vw_event_ticket
    WHERE event_state = 1 AND ticket_state = 1 or ticket_state = 0 ORDER BY ticket_state DESC, ticket_open DESC");
    $data = '';
    if($search) {
        while($row = mysqli_fetch_assoc($search)) {

            $eventDateTimeStart =$row['event_date'] . ' ' . $row['event_start_time'];
            $eventDateTimeEnd = $row['event_date'] . ' ' . $row['event_end_time'];

            if ($now > $eventDateTimeEnd) {
                $event_roll = "<div class='badge_container'><span class='badge text-bg-danger'><i class='fa-solid fa-calendar-xmark'></i></span></div>";
            } elseif ($now >= $eventDateTimeStart && $now <= $eventDateTimeEnd) {
                $event_roll = "<div class='badge_container'><span class='badge text-bg-primary'><i class='fa-solid fa-champagne-glasses fa-beat-fade'></i></span></div>";
            } else {
                $event_roll = "<div class='badge_container'><span class='badge text-bg-warning'><i class='fa-solid fa-calendar-days'></i></span></div>";
            }

            $ticket_type = $row['ticket_type'];

            if ($ticket_type == "0") {
                $ticket_type_batch = "<div class='badge_container'><span class='badge text-bg-secondary'>ECO</span></div>";
            } elseif ($ticket_type == "1") {
                $ticket_type_batch = "<div class='badge_container'><span class='badge text-bg-info'>REG</span></div>";
            } elseif ($ticket_type == "2") {
                $ticket_type_batch = "<div class='badge_container'><span class='badge text-bg-warning'>VIP <i class='fa-solid fa-crown fa-bounce'></i></span></div>";
            }

            $data .= "<tr>   
                        <td>".$row['ticket_name']."</td>
                        <td>".$ticket_type_batch."</td>
                        <td>".$row['event_name']."</td>
                        <td>".$row['ticket_price']."</td>
                        <td>".$row['ticket_stock']."</td>
                        <td><img src='../upload/ticket/".$row['ticket_image']."' alt='Ticket Banner' style='width: 54px; height: 30px;border-radius: 5px;'></td>
                        <td class='gap-2 d-flex'>".($row['ticket_state'] == '1' 
                            ? "<div class='badge_container'><span class='badge text-bg-success'>Active</span></div>"
                            : "<div class='badge_container'><span class='badge text-bg-danger'>inActive</span></div>")."
                        </td>
                        <td>".$event_roll."</td>
                        <td>
                            ".($row['ticket_state'] == '1' 
                            ? "<button type='button' value='".$row['ticket_id']."' class='view'><i class='fa-solid fa-eye'></i></button>
                               <button type='button' value='".$row['ticket_id']."' class='edit'><i class='fa-solid fa-pen-to-square'></i></button>
                               <button type='button' value='".$row['ticket_id']."' class='deactivate'><i class='fa-solid fa-bolt'></i></button>" 
                            : "<button type='button' value='".$row['ticket_id']."' class='activate'><i class='fa-solid fa-bolt'></i></button>
                               <button type='button' value='".$row['ticket_id']."' class='remove'><i class='fa-solid fa-trash'></i></button>")."
                        </td>
                    </tr>";
        }
        echo $data;
    } else {
        $res = [
            'status' => 422,
            'message' => 'Ticket Load Failed !'
        ];
        echo json_encode($res);
    }
    return false;
}

if(isset($_GET['ticket_id'])) {
    $ticket_id = mysqli_real_escape_string($conn, $_GET['ticket_id']);

    $query = "SELECT * FROM ticket WHERE id='$ticket_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $ticket = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Ticket Fetch Succesfully',
            'data' => $ticket
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 422,
            'message' => 'Ticket Id Not Found !'
        ];
        echo json_encode($res);
        return false;
    }
}

// update & insert

if(isset($_POST['save_ticket'])) {

    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $event_id = mysqli_real_escape_string($conn, $_POST['event']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    if ($type == "" || empty($name) || empty($event_id) || empty($price) || empty($stock)) {
        $res = [
            'status' => 422,
            'message' => 'Some fields are missing !'
        ];
        echo json_encode($res);
        return;
    }

    // Check if a ticket with the same type and event already exists
    // $check_query = mysqli_query($conn, "SELECT * FROM ticket WHERE type='$type' AND event_id='$event_id'");
    // if (mysqli_num_rows($check_query) > 0) {
    //     $res = [
    //         'status' => 409, // Conflict status
    //         'message' => 'Ticket type already exists for this event. Do you want to create another one?'
    //     ];
    //     echo json_encode($res);
    //     return;
    // }

    // Image fields handle
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = bin2hex(random_bytes(10)) . '.' . $image_ext;
        $image_folder = '../../upload/event/' . $unique_image_name;
    } else {
        $unique_image_name = 'default.png'; // Default image
    }

    // Insert into the database
    $insert = mysqli_query($conn, "INSERT INTO ticket (name, event_id, type, price, stock, image, state) 
    VALUES ('$name', '$event_id', '$type', '$price', '$stock', '$unique_image_name', 1)");

    if ($insert) {
        // Move the uploaded image to the designated folder if it exists
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            move_uploaded_file($image_tmp_name, $image_folder);
        }

        $res = [
            'status' => 200,
            'message' => 'Ticket Created Successfully'
        ];
    } else {
        $res = [
            'status' => 422,
            'message' => 'Ticket Not Created!'
        ];
    }

    echo json_encode($res);
    return;
}

if(isset($_POST['update_ticket'])) {
    
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $type = mysqli_real_escape_string($conn, $_POST['type']);
    $event_id = mysqli_real_escape_string($conn, $_POST['event']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = mysqli_real_escape_string($conn, $_POST['stock']);

    if (empty($id) || $type == "" || empty($name) || empty($event_id) || empty($price) || empty($stock)) {
        $res = [
            'status' => 422,
            'message' => 'Some fields are missing !'
        ];
        echo json_encode($res);
        return;
    }

    // Initialize the SQL query
    $sql = "UPDATE ticket SET name='$name', type='$type', event_id='$event_id', price='$price', stock='$stock'";

    // Image fields handle
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = bin2hex(random_bytes(10)) . '.' . $image_ext;
        $image_folder = '../../upload/ticket/' . $unique_image_name;

        // Append the image update to the SQL query
        $sql .= ", image='$unique_image_name'";
    }

    // Complete the SQL query
    $sql .= " WHERE id = '$id'";

    // Insert into the database
    $insert = mysqli_query($conn, $sql);

    if ($insert) {
        // Move the uploaded image to the designated folder if it exists
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            move_uploaded_file($image_tmp_name, $image_folder);
        }

        $res = [
            'status' => 200,
            'message' => 'Ticket Updated Successfully'
        ];
    } else {
        $res = [
            'status' => 422,
            'message' => 'Ticket Not Updated!'
        ];
    }

    echo json_encode($res);
    return;
}

// state update

if(isset($_POST['remove_ticket'])) {
    $ticket_id = mysqli_real_escape_string($conn, $_POST['ticket_id']);

    $insert = mysqli_query($conn, "UPDATE ticket SET state=2 WHERE id='$ticket_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Ticket Removed Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Ticket Removed Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['deactivate_ticket'])) {
    $ticket_id = mysqli_real_escape_string($conn, $_POST['ticket_id']);

    $insert = mysqli_query($conn, "UPDATE ticket SET state=0 WHERE id='$ticket_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Ticket Deavtivated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Ticket Deavtivated Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['activate_ticket'])) {
    $ticket_id = mysqli_real_escape_string($conn, $_POST['ticket_id']);

    $insert = mysqli_query($conn, "UPDATE ticket SET state=1 WHERE id='$ticket_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Ticket Avtivated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Ticket Avtivated Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}
?>