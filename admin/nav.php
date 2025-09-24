<?php  ?>

<div class="box navi" style="grid-area: box-1">

<div class="sys-name">
    Welcome to SimpCommerce &nbsp; <img src="../sys_img/simpcommerce logo.png" alt="system logo">
</div>

<ul>
    <a href="admin_dash.php" style="text-decoration: none; color: white;"><li onclick="border()">Dashboard</li></a>
    <a href="create_products.php" style="text-decoration: none; color: white;"><li onclick="border()">Create Products</li></a>
    <a href="category.php" style="text-decoration: none; color: white;"><li onclick="border()">Create Categories</li></a>
    <a href="create_admin.php" style="text-decoration: none; color: white;"><li onclick="border()">Create Admin</li></a>
    <a href="manage_admins.php" style="text-decoration: none; color: white;"><li onclick="border()">Manage Admins</li></a>
    <a href="manage_categories.php" style="text-decoration: none; color: white;"><li onclick="border()">Manage Categories</li></a>
    <li onclick="border()">View Products</li>
    <li onclick="border()">View Orders</li>
    <li onclick="border()">View User Details</li>
</ul>

<a href="p_logout.php" style="text-decoration: none;">
    <div class="sys-out">
        Logout &nbsp; <img src="../sys_img/logout.png" alt="logout icon">
    </div>
</a>

</div>

<script>
    //make the border of the ul li light

    function border() {
        let li = document.querySelectorAll('.navi ul li');
        li.forEach((item) => {
            item.style.border = '2px solid rgb(48, 48, 48)';
        });
        event.target.style.border = '2px solid  purple';
    }


</script>