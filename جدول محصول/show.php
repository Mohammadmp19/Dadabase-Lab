<html lang="fa" dir="rtl">
    <head>
     <!--   <?php include('head.php');?>
       <title><?php title("نمایش") ?></title>
     </head>
    <body>
     <?php

            include_once("server.php");

            $con = connect();

            
    if ($_SERVER['REQUEST_METHOD']='GET') {
        $id = $_GET['id'];
        $sql = "UPDATE room SET status='dactive' WHERE id='$id'";
        $result = mysqli_query($con,$sql);
        if ($result) {
            header("Location: show.php");
        }
        else
        {
            die("softdelete has failed");
        }
    }

            $sql = "SELECT id,price,number,area,floor FROM room WHERE status='active'";

            $result = mysqli_query($con,$sql);

            echo "<table class='table table-bordered table-striped'>";
            echo "<thead class='table-primary'>";
                echo"<th>price</th>";
                echo"<th>number</th>";
                echo"<th>area</th>";
                echo"<th>floor</th>";
                echo"<th>action</th>";
            echo "</thead>";

            if (mysqli_num_rows($result) > 0) {

                
                echo "<tbody>";
                while($row = mysqli_fetch_assoc($result))
                {
                    $id = $row['id'];

                    echo "<tr>";

                    echo"<td>".$row['price']."</td>";
                    echo"<td>".$row['number']."</td>";
                    echo"<td>".$row['area']."</td>";
                    echo"<td>".$row['floor']."</td>";
                    
                    echo"<td>"."<a href='show.php?id=$id'>DEL</a>"."</td>";

                    echo "</tr>";
                }
                echo "</tbody>";
                
            }
            echo "</table>";
        ?>
    </body>
</html>