<?php
include '../../config/config.php';
include 'get_next.php';

$response = array();

if(isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);

    $query = "SELECT * FROM student WHERE id='$student_id'";
    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Student Fetch Succesfully',
            'data' => $student
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Student Id Not Found !'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['save_student'])) {
    $sid = getNextStudentID($conn);
    $name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $address = mysqli_real_escape_string($conn, $_POST['student_address']);
    $contact = mysqli_real_escape_string($conn, $_POST['student_contact']);
    $parent = mysqli_real_escape_string($conn, $_POST['student_parent']);
    $dob = mysqli_real_escape_string($conn, $_POST['student_dob']);
    $sex = mysqli_real_escape_string($conn, $_POST['student_sex']);
    $card = mysqli_real_escape_string($conn, $_POST['student_card']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../../Upload/students/'.$image;
    $current_month_name = date('F');
    $current_year = date('Y');
    $current_date = date('Y-m-d');

    if($sid == NULL || $name == NULL || $address == NULL || $contact == NULL || $parent == NULL || $dob == NULL || $sex == NULL || $card == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    if ($image_size > 2000000) {
        $response['success'] = false;
        $response['message'] = 'Image size is too large!';
    } else {
        $insert = mysqli_query($conn, "INSERT INTO student (id, name, address, contact, parent, gender, dob, rfid, image, month, year, image_update_date, code, status) 
        VALUES ('$sid', '$name', '$address', '$contact', '$parent', '$sex', '$dob', '$card', '$image', '$current_month_name', '$current_year', '$current_date', 'student.kchord.me', 1)");

        if($insert) {
            move_uploaded_file($image_tmp_name, $image_folder);
            $res = [
                'status' => 200,
                'message' => 'Student Created Successfully'
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Student Not Created !'
            ];
            echo json_encode($res);
            return false;
        }
    }
}

if(isset($_POST['update_student'])) {
    $sid = mysqli_real_escape_string($conn, $_POST['student_id']);
    $name = mysqli_real_escape_string($conn, $_POST['student_name']);
    $address = mysqli_real_escape_string($conn, $_POST['student_address']);
    $contact = mysqli_real_escape_string($conn, $_POST['student_contact']);
    $parent = mysqli_real_escape_string($conn, $_POST['student_parent']);
    $dob = mysqli_real_escape_string($conn, $_POST['student_dob']);
    $sex = mysqli_real_escape_string($conn, $_POST['student_sex']);
    $card = mysqli_real_escape_string($conn, $_POST['student_card']);
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../../Upload/students/'.$image;

    if($sid == NULL || $name == NULL || $address == NULL || $contact == NULL || $parent == NULL || $dob == NULL || $sex == NULL || $card == NULL) {
        $res = [
            'status' => 422,
            'message' => 'All fields are required'
        ];
        echo json_encode($res);
        return false;
    }

    if ($image_size > 2000000) {
        $response['success'] = false;
        $response['message'] = 'Image size is too large!';
    } else {
        if ($image == NULL) {
            $insert = mysqli_query($conn, "UPDATE student SET name='$name', address='$address', contact='$contact', parent='$parent', gender='$sex', 
            dob='$dob', rfid='$card' WHERE id='$sid'");
        } else {
            $insert = mysqli_query($conn, "UPDATE student SET name='$name', address='$address', contact='$contact', parent='$parent', gender='$sex', 
            dob='$dob', rfid='$card', image='$image' WHERE id='$sid'");
        }

        if($insert) {
            if ($image !== NULL) {
                move_uploaded_file($image_tmp_name, $image_folder);
            }
            $res = [
                'status' => 200,
                'message' => 'Student Updated Successfully'
            ];
            echo json_encode($res);
            return false;
        } else {
            $res = [
                'status' => 500,
                'message' => 'Student Not Updated !'
            ];
            echo json_encode($res);
            return false;
        }
    }
}

if(isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    $insert = mysqli_query($conn, "UPDATE student SET status=0 WHERE id='$student_id'");

    if($insert) {
        $res = [
            'status' => 200,
            'message' => 'Student Removed Successfully'
        ];
        echo json_encode($res);
        return false;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Student Remove Failed !'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['load_students'])) {

    $search = mysqli_query($conn, "SELECT id, name,contact,image FROM student");
    $data = '';
    if($search) {
        while($row = mysqli_fetch_assoc($search)) {
            // Concatenate rows instead of overwriting the $data variable
            $data .= "<tr>
                        <td>".$row['id']."</td>
                        <td>".$row['name']."</td>
                        <td>".$row['contact']."</td>
                        <td><img src='../Upload/students/".$row['image']."' alt='Student Image' style='width: 30px; height: 30px;border-radius: 5px;'></td>
                        <td><button type='button' value='".$row['id']."' class='view'>View</button></td>
                        <td>
                            <button type='button' value='".$row['id']."' class='edit'>Edit</button>
                            <button type='button' value='".$row['id']."' class='remove'>Remove</button>
                        </td>
                    </tr>";
        }
        echo $data;
    } else {
        $res = [
            'status' => 422,
            'message' => 'Student Search Failed !'
        ];
        echo json_encode($res);
    }
    return false;
}

?>
