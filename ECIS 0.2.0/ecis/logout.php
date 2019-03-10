<?php
    setcookie("user", "testuser", time()-3600);
    setcookie("activity", "testaction", time()-3600);
    echo "Sign Out success";
    echo '<a href="login.php">3s后将转到登陆页面</a>';
    echo
    "<script>
        setTimeout(function(){window.location.href='/ecis/login.php';},3);
    </script>";
?>
