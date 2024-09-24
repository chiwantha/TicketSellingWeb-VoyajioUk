<?php

include '../../config/config.php';

// update & insert

if(isset($_POST['save_event'])) {

    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $start = substr(mysqli_real_escape_string($conn, $_POST['start']), 0, 5);
    $end = substr(mysqli_real_escape_string($conn, $_POST['end']), 0, 5);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);

    if (empty($name) || empty($date) || empty($start) || empty($end) || empty($venue)) {
        $res = [
            'status' => 422,
            'message' => 'Some fields are missing'
        ];
        echo json_encode($res);
        return;
    }

    $lat = !empty($_POST['lat']) ? mysqli_real_escape_string($conn, $_POST['lat']) : "0.0";
    $lon = !empty($_POST['lon']) ? mysqli_real_escape_string($conn, $_POST['lon']) : "0.0";
    $description = !empty($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : "Not Updated Yet !";

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
    $insert = mysqli_query($conn, "INSERT INTO event (name, date, start_time, end_time, venue, lat, lon, description, image, state) 
    VALUES ('$name', '$date', '$start', '$end', '$venue', '$lat', '$lon', '$description', '$unique_image_name', 1)");

    if ($insert) {
        // Move the uploaded image to the designated folder if it exists
        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            move_uploaded_file($image_tmp_name, $image_folder);
        }

        $res = [
            'status' => 200,
            'message' => 'Event Created Successfully'
        ];
    } else {
        $res = [
            'status' => 422,
            'message' => 'Event Not Created!'
        ];
    }

    echo json_encode($res);
    return;
}

if(isset($_POST['update_event'])) {
    
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $start = substr(mysqli_real_escape_string($conn, $_POST['start']), 0, 5);
    $end = substr(mysqli_real_escape_string($conn, $_POST['end']), 0, 5);
    $venue = mysqli_real_escape_string($conn, $_POST['venue']);

    if (empty($name) || empty($date) || empty($start) || empty($end) || empty($venue)) {
        $res = [
            'status' => 422,
            'message' => 'Some fields are missing'
        ];
        echo json_encode($res);
        return;
    }

    $lat = !empty($_POST['lat']) ? mysqli_real_escape_string($conn, $_POST['lat']) : "0.0";
    $lon = !empty($_POST['lon']) ? mysqli_real_escape_string($conn, $_POST['lon']) : "0.0";
    $description = !empty($_POST['description']) ? mysqli_real_escape_string($conn, $_POST['description']) : "Not Updated Yet !";

    // Initialize the SQL query
    $sql = "UPDATE event SET name='$name', date='$date', start_time='$start', end_time='$end', venue='$venue', lat='$lat', lon='$lon', description='$description'";

    // Image fields handle
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_ext = pathinfo($image, PATHINFO_EXTENSION);
        $unique_image_name = bin2hex(random_bytes(10)) . '.' . $image_ext;
        $image_folder = '../../upload/event/' . $unique_image_name;

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
            'message' => 'Event Updated Successfully'
        ];
    } else {
        $res = [
            'status' => 422,
            'message' => 'Event Not Updated!'
        ];
    }

    echo json_encode($res);
    return;
}

// load

if(isset($_POST['load_events'])) {

    $now = mysqli_real_escape_string($conn, $_POST['datetime']);


    $search = mysqli_query($conn, "SELECT id, name, date, start_time, end_time, image, state FROM event WHERE state = 1 OR state = 0 ORDER BY state DESC, open DESC");
    $data = '';
    if($search) {
        while($row = mysqli_fetch_assoc($search)) {

            $eventDateTimeStart =$row['date'] . ' ' . $row['start_time'];
            $eventDateTimeEnd = $row['date'] . ' ' . $row['end_time'];

            if ($now > $eventDateTimeEnd) {
                $badge = "<div class='badge_container'><span class='badge text-bg-danger'><i class='fa-solid fa-calendar-xmark'></i></span></div>";
            } elseif ($now >= $eventDateTimeStart && $now <= $eventDateTimeEnd) {
                $badge = "<div class='badge_container'><span class='badge text-bg-primary'><i class='fa-solid fa-champagne-glasses fa-beat-fade'></i></span></div>";
            } else {
                $badge = "<div class='badge_container'><span class='badge text-bg-warning'><i class='fa-solid fa-calendar-days'></i></span></div>";
            }

            $data .= "<tr>
                        
                        <td>".$row['name']."</td>
                        <td>".$row['date']."</td>
                        <td>".$row['start_time']." - ".$row['end_time']."</td>
                        <td><img src='../upload/event/".$row['image']."' alt='Event Banner' style='width: 54px; height: 30px;border-radius: 5px;'></td>
                        <td class='gap-2 d-flex'>".($row['state'] == '1' 
                            ? "<div class='badge_container'><span class='badge text-bg-success'>Active</span></div>" 
                            : "<div class='badge_container'><span class='badge text-bg-danger'>inActive</span></div>")."".$badge."
                        </td>
                        
                        <td>
                            ".($row['state'] == '1' 
                            ? "<button type='button' value='".$row['id']."' class='view'><i class='fa-solid fa-eye'></i></button>
                               <button type='button' value='".$row['id']."' class='edit'><i class='fa-solid fa-pen-to-square'></i></button>
                               <button type='button' value='".$row['id']."' class='deactivate'><i class='fa-solid fa-bolt'></i></button>" 
                            : "<button type='button' value='".$row['id']."' class='activate'><i class='fa-solid fa-bolt'></i></button>
                               <button type='button' value='".$row['id']."' class='remove'><i class='fa-solid fa-trash'></i></button>")."
                        </td>
                    </tr>";
        }
        echo $data;
    } else {
        $res = [
            'status' => 422,
            'message' => 'Event Load Failed !'
        ];
        echo json_encode($res);
    }
    return false;
}

if(isset($_GET['event_id'])) {
    $event_id = mysqli_real_escape_string($conn, $_GET['event_id']);

    $query = "SELECT * FROM event WHERE id='$event_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $event = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Event Fetch Succesfully',
            'data' => $event
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 422,
            'message' => 'Event Id Not Found !'
        ];
        echo json_encode($res);
        return false;
    }
}

// state update

if(isset($_POST['remove_event'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    $insert = mysqli_query($conn, "UPDATE event SET state=2 WHERE id='$event_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Event Removed Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Event Removed Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['deactivate_event'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    $insert = mysqli_query($conn, "UPDATE event SET state=0 WHERE id='$event_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Event Deavtivated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Event Deavtivated Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['activate_event'])) {
    $event_id = mysqli_real_escape_string($conn, $_POST['event_id']);

    $insert = mysqli_query($conn, "UPDATE event SET state=1 WHERE id='$event_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Event Avtivated Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Event Avtivated Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}

?>
