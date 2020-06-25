<?php include_once "function.php"; ?>
<html>
    <head>
        <title>
            MENU UTAMA
        </title>
    </head>
    <body>
        <h1>Menu utama</h1>
        <h3><a href="index.php?page=<?php echo encrypt("page1"); ?>">Page 1</a></h3>
        <h3><a href="index.php?page=<?php echo encrypt("page2"); ?>">Page 2</a></h3>
    </body>
    <?php
        if(isset($_GET['page'])){
            $page = decrypt($_GET['page']);

            switch($page){
                case 'page1' :
                    include "halaman/p1.php";
                break;
                case 'page2' :
                    include "halaman/p2.php";
                break;
                default:
                    echo "<center><h2>Halaman Tidak Ditemukan</h2><center>";
                break;
            }
        }else{
            include_once "index.php";
        }
    ?>
</html>