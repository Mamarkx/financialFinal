<?php

$host = 'localhost:3307';
$db = 'fin_disbursement';
$user = 'root'; 
$pass = ''; 


$conn = new mysqli($host, $user, $pass, $db);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$employeeId = $_POST['employeeId'];
$budgetId = $_POST['budgetId'];
$amount = $_POST['amount'];


$stmt = $conn->prepare("INSERT INTO disbursementrequests (EmployeeID, AllocationID, Amount, Status, DateOfRequest) VALUES (?, ?, ?, 'Pending', NOW())");
$stmt->bind_param("iid", $employeeId, $budgetId, $amount);
$stmt->execute();
$requestId = $stmt->insert_id;


$stmt = $conn->prepare("INSERT INTO approvals (AllocationID, RequestID, Amount, Status) VALUES (?, ?, ?, 'Pending')");
$stmt->bind_param("iid", $budgetId, $requestId, $amount);
$stmt->execute();


  
header("Location: ../Disbursement_Request.php");
exit();

$stmt->close();
$conn->close();
?>