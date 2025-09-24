<?php  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <div>
    <form action="https://www.payfast.co.za/eng/process" method="post">
  <input type="hidden" name="merchant_id" value=" 27103171">
  <input type="hidden" name="merchant_key" value="mvfqwjpgncqnr">
  <input type="hidden" name="return_url" value="http://localhost:3000/pay_test/thank_u.php">
  <input type="hidden" name="cancel_url" value="http://localhost:3000/pay_test/cancel.php">
  <input type="hidden" name="notify_url" value="https://yourstore.com/payfast-itn">

  <input type="hidden" name="amount" value="100.00">
  <input type="hidden" name="item_name" value="Order #12345">
  
  <input type="submit" value="Pay with Payfast">
</form>


    </div>
    
</body>
</html>