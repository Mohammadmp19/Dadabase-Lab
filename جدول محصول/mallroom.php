<!doctype html>
<html lang="en">
  <head>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <title>sabt otag</title>
  </head>
  <body>

  <div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>mallroom Add
                        <a href="index.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="row">

                 <div class="mb-3">
                 <label>price</label>
                  <input type="number" class="form-control" name="price">
                 </div>
                 <div class="mb-3">
                 <label>number </label>
                  <input type="text" class="form-control" name="number">
                 </div>
                 <div class="mb-3">
                 <label>area</label>
                  <input type="number" class="form-control"name="area">
                 </div>
                 <div class="mb-3">
                 <label>floor</label>
                  <input type="number" class="form-control" name="floor">
                 </div>

                 <div class="mb-3">
                    <button type="submit" name="save_room" class="btn btn-primary">save room</button>
                 </div>
                 <div class="mb-4">

                 <?php
                 if ($_SERVER['REQUEST_METHOD'] == "POST") {
                  include_once("server.php");
                  $con = connect();
                  $price=$_POST['price'];
                  $number=$_POST['number'];
                  $area=$_POST['area'];
                  $floor=$_POST['floor'];
                  $sql = "INSERT INTO room (price,number,area,floor)
                  VALUES ($price,'$number',$area,$floor)";

                  $result = mysqli_query($con,$sql);
                  if($result){
                    echo "<p class='alert alert-success alert-dismissible fade show'><strong>پیام سیستم</strong> اطلاعات اتاق با موفقیت ثبت شد <button type='button' class='close' data-dismiss='alert'>&times;</button></p>";
                  }
                else
                {
                    echo "<p class='alert alert-danger alert-dismissible fade show'><strong>اخطار</strong> ثبت اطلاعات اتاق به مشکل برخورد <button type='button' class='close' data-dismiss='alert'>&times;</button></p>";
                }
                 }
                 ?>
                 </div>
                </form>
                </div>
            </div>
        </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  
  </body>
</html>