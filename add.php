<!DOCTYPE html>
<html lang="en">
<?php
include("conn.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการ์ดจอ</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            background-color: #F5F5DC;
            /* Cream background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
            margin-left: 25%;
        }

        .form-container {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 600px;
            width: 100%;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-custom {
            font-weight: 600;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1 class="text-center mb-4">
                <i class="fas fa-user-plus me-2"></i>โปรแกรมเพิ่มข้อมูลการ์ดจอ
            </h1>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="mb-3 row">
                    <label for="model" class="col-sm-3 col-form-label">
                        <i class="fas fa-user me-2"></i>แบรน
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="brand" name="brand" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="model" class="col-sm-3 col-form-label">
                        <i class="fas fa-user me-2"></i>โมเดล
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="model" name="model" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="memory_size" class="col-sm-3 col-form-label">
                        <i class="fas fa-building me-2"></i>ขนาดของหน่วยความจำ
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="memory_size" name="memory_size" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="memory_type" class="col-sm-3 col-form-label">
                        <i class="fas fa-venus-mars me-2"></i>ชนิดของหน่วยความจำ
                    </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="memory_type" name="memory_type" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="clock_speed" class="col-sm-3 col-form-label">
                        <i class="fas fa-birthday-cake me-2"></i>อัตรานาฬิกา
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="clock_speed" name="clock_speed" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="price" class="col-sm-3 col-form-label">
                        <i class="fas fa-money-bill-wave me-2"></i>ราคา
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="price" name="price" min="0" required>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="release_year" class="col-sm-3 col-form-label">
                        <i class="fas fa-money-bill-wave me-2"></i>ปีวางจำหน่าย
                    </label>
                    <div class="col-sm-9">
                        <input type="number" class="form-control" id="release_year" name="release_year" required>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-custom me-2">
                        <i class="fas fa-save me-2"></i>บันทึก
                    </button>
                    <a href="show.php" class="btn btn-danger btn-custom">
                        <i class="fas fa-times me-2"></i>ย้อนกลับ
                    </a>
                </div>
            </form>

            <!-- PHP -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $brand = $_POST["brand"];
                $model = $_POST["model"];
                $memory_size = $_POST["memory_size"];
                $memory_type = $_POST["memory_type"];
                $clock_speed = $_POST["clock_speed"];
                $price = $_POST["price"];
                $release_year = $_POST["release_year"];

                // เพิ่มข้อมูล
                $sql = "INSERT INTO employees (brand, model, memory_size, memory_type, clock_speed, price, release_year)
                        VALUES ('$brand', '$model', '$memory_size','$memory_type','$clock_speed','$price','$release_year')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success text-center mt-3'>
                            <strong>บันทึกเสร็จแล้ว!</strong> คุณได้บันทึกข้อมูล 1 รายการแล้ว
                          </div>";
                } else {
                    echo "<div class='alert alert-danger text-center mt-3'>
                            <strong>เกิดข้อผิดพลาด: </strong>" . $conn->error . "
                          </div>";
                }

                $conn->close();
            }
            ?>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>