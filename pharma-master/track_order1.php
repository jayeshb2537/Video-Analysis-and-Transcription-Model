<?php
session_start();
include "config/db_connect.php";

if (!isset($_GET['order_id'])) {
    echo "Invalid request. Order ID is missing.";
    exit;
}

$order_id = $_GET['order_id'];

// Fetch order details from database
$sql = "SELECT * FROM orders WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $order_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "Order not found.";
    exit;
}

$order = $result->fetch_assoc();

$status = strtolower($order['status']);
$steps = ["processed", "shipped", "enroute", "arrived"];

// Cancelled logic
if ($status === 'cancelled') {
    $isCancelled = true;
    $activeIndex = -1;
} else {
    $isCancelled = false;
    switch ($status) {
        case 'processed': $activeIndex = 0; break;
        case 'shipped':   $activeIndex = 1; break;
        case 'enroute':   $activeIndex = 2; break;
        case 'arrived':   $activeIndex = 3; break;
        default:          $activeIndex = 0; break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Track Order - Medicare</title>
    <style>
        :root {
            --body: #8c9eff;
            --cont: #eceff1;
            --line: #651fff;
            --txt: #007bfd;
            --light: #c5cae9;
        }

        body {
            width: 100%;
            min-height: 100vh;
            background: var(--body);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            width: 1100px;
            max-width: 100%;
            padding: 40px;
            margin: 0 30px;
            background: var(--cont);
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .details {
            display: flex;
            gap: 1em;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .order h1 {
            text-transform: uppercase;
        }

        .order span {
            color: var(--txt);
        }

        .date p {
            font-size: 1.1rem;
        }

        .track {
            margin: 4em 0;
        }

        #progress {
            list-style: none;
            display: flex;
            justify-content: space-between;
            position: relative;
            text-align: center;
        }

        #progress li {
            width: 20%;
            position: relative;
        }

        #progress li::before {
            content: '\2713';
            position: absolute;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 50px;
            height: 50px;
            font-size: 2rem;
            background: var(--light);
            color: #fff;
            border-radius: 50%;
            z-index: 11;
        }

        #progress li.active::before {
            background: var(--line);
        }

        #progress::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 35px;
            width: calc(100% - 70px);
            height: 10px;
            background: var(--light);
            z-index: 1;
        }

        #progress::after {
            content: '';
            position: absolute;
            top: 20px;
            left: 35px;
            height: 10px;
            background: var(--line);
            z-index: 2;
            width: <?php echo $isCancelled ? '0%' : (($activeIndex / (count($steps) - 1)) * 100) . '%'; ?>;
        }

        .lists {
            display: flex;
            gap: 2em;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .list {
            display: flex;
            gap: 1em;
            flex: 1 1 200px;
            align-items: center;
        }

        .list p {
            font-size: 1.1rem;
        }

        .list img {
            width: 50px;
        }

        .cancelled-status {
            margin-top: 30px;
            padding: 15px;
            border: 2px solid red;
            background-color: #ffe6e6;
            color: red;
            font-weight: bold;
            text-align: center;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="details">
        <div class="order">
            <h1>Order <span><?php echo htmlspecialchars($order['id']); ?></span></h1>
        </div>
        <div class="date">
            <p>Expected Arrival: <?php echo date("d/m/Y", strtotime($order['created_at'] . ' +5 days')); ?></p>
            <p><?php echo strtoupper($order['payment_mode']); ?> <b><?php echo htmlspecialchars($order['email']); ?></b></p>
        </div>
    </div>

    <div class="track">
        <?php if ($isCancelled): ?>
            <div class="cancelled-status">This order has been cancelled.</div>
        <?php else: ?>
            <ul id="progress">
                <?php for ($i = 0; $i < count($steps); $i++): ?>
                    <li class="<?php echo ($i <= $activeIndex) ? 'active' : ''; ?>"></li>
                <?php endfor; ?>
            </ul>
        <?php endif; ?>
    </div>

    <div class="lists">
        <div class="list">
            <img src="uploads/inventory-management.png" alt="Order Processed">
            <p>Order<br>Processed</p>
        </div>
        <div class="list">
            <img src="uploads/shipping-cost.png" alt="Order Shipped">
            <p>Order<br>Shipped</p>
        </div>
        <div class="list">
            <img src="uploads/tracking.png" alt="Order Enroute">
            <p>Order<br>Enroute</p>
        </div>
        <div class="list">
            <img src="uploads/check.png" alt="Order Arrived">
            <p>Order<br>Arrived</p>
        </div>
    </div>
</div>
</body>
</html>
