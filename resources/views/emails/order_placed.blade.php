<!DOCTYPE html>
<html>
<head>
    <title>New Order Placed</title>
</head>
<body>
    <h1>New Order Placed</h1>
    <p>Hello Admin,</p>
    <p>A new order has been placed. Details are as follows:</p>

    <ul>
        <li>Email: {{ $mainOrder->email }}</li>
        <li>Telephone: {{ $mainOrder->telephone }}</li>
    </ul>

    <p>Thank you for your attention.</p>
</body>
</html>
