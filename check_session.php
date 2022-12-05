<?php
session_start();
if(!isset($_SESSION["user_data"]))
{
    ?>
        <script>
            window.location.href = "index.php";
        </script>
    <?php
}
?>