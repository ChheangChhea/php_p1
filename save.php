<?php
date_default_timezone_set("Asia/Phnom_Penh");
$cn = new mysqli("localhost", "root", "", "php25");
$cn->set_charset("utf8");
$editId = $_POST['txt-edit-id'];
$name = trim($_POST['txt-name']);
$name = $cn->real_escape_string($name);
$price = $_POST['txt-price'];
$date = date("Y-m-d h:i:s A");
$img = $_POST['txt-img'];
//ckeck daulicat name
$sql = "SELECT name FROM tbl_test WHERE name='$name'";
$rs = $cn->query($sql);
if ($rs->num_rows > 0) {
    $msg['dpl'] = true;
} else {
    if ($editId == 0) {
        $sql = "INSERT INTO tbl_test
                values(null,'$name',$price,'$date','$img')";
        $cn->query($sql);
        $msg['id'] = $cn->insert_id;
        $msg['edit'] = false;
    } else {
        $sql = "UPDATE tbl_test SET name='$name',price='$price',img ='$img' WHERE id= $editId";
        $cn->query($sql);
        $msg['edit'] = true;
    }

    $msg['dpl'] = false;
}
echo json_encode($msg);
