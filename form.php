<?php
include "database.php";

if(count($_POST)){
    $url = $_POST['url'];
    $code = $_POST['code'];

    if(addUrl($url, $code, $conn)){
        $data = ['code' => $code, 'url' => $url];
    }else {
        $data = ['error' => 1];
    }

    echo json_encode($data);exit;

}

if(isset($_GET['report'])){
	$code = $_GET['code'];
	$data = getreport($code, $conn);
	
	echo json_encode(['data' => $data]);exit;
}


if(count($_GET)){
    $code = $_GET['code'];

    $url = getUrl($code, $conn);
	
    echo json_encode(['url' => $url]);exit;
}


function addUrl($url, $code, $conn){
    $addsql = "INSERT INTO tableone (url, code, date) VALUES('$url','$code', now());";
    return mysqli_query($conn, $addsql);
}

function getUrl($code, $conn){
    $urls = mysqli_query($conn, "SELECT URL FROM tableone WHERE code = trim('$code');");
    if (mysqli_num_rows($urls) > 0) {
        return mysqli_fetch_array($urls)[0];
    }

    return null;

}

function getreport($code, $conn){
    $urls = mysqli_query($conn, "SELECT date,counter FROM tableone WHERE code = trim('$code');");
    if (mysqli_num_rows($urls) > 0) {
        return mysqli_fetch_array($urls);
    }

    return null;

}

function deleteUrl($code, $conn){
    return mysqli_query($conn, "DELETE FROM `tableone` WHERE URL = '$code';");
}




?>