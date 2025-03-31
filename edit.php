<!DOCTYPE html>
<html lang="en">
<?php
//เชื่อมต่อฐานข้อมูล
include("conn.php");
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- เพิ่ม ส่วน Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- เพิ่มฟอนต์ -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: "Kanit", sans-serif;
            margin-left: 100px;
            margin-top: 50px;
        }

        h1 {
            /* อันนี้กำหนดส่วนย่อหน้าด้านซ้าย */

            /* อันนี้กำหนดส่วนย่อหน้าด้านบน */
            margin-top: 50px;
        }
    </style>


    <title>เเก้ไขข้อมูลการ์ดจอ</title>
</head>

<?php
if (isset($_GET['action_even']) == 'edit') {
    $id = $_GET['id'];
    $sql = "SELECT * FROM graphics_cards WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "ไม่พบข้อมูลที่ต้องการแก้ไข กรุณาตรวจสอบ";
    }
    //$conn->close();
}
?>

<h1>แก้ไขข้อมูลการ์ดจอ</h1>


<form action="edit_1.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> รหัส </label>
        <div class="col-sm-2">
            <label class="col-sm-1 col-form-label"> <?php echo $row['id']; ?> </label>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> แบรน </label>
        <div class="col-sm-2">
            <select class="form-select" name="brand" aria-label="Default select example">
                <option>กรุณาระบุแบรน</option>
                <option value="AMD" <?php if ($row['brand'] == 'AMD') {
                                        echo "selected";
                                    } ?>>AMD</option>
                <option value="NVIDIA" <?php if ($row['brand'] == 'NVIDIA') {
                                            echo "selected";
                                        } ?>>NVIDIA</option>
            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> โมเดล </label>
        <div class="col-sm-2">
            <input type="text" name="model" class="form-control" maxlength="50" value="<?php echo $row['model']; ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> ขนาดของหน่วยความจำ </label>
        <div class="col-sm-2">
            <input type="text" name="memory_size" class="form-control" maxlength="50" value="<?php echo $row['memory_size']; ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> ชนิดของหน่วยความจำ </label>
        <div class="col-sm-2">
            <select class="form-select" name="memory_type" aria-label="Default select example">
                <option>กรุณาระบุชนิดของหน่วยความจำ</option>
                <option value="GDDR5" <?php if ($row['memory_type'] == 'GDDR5') {
                                            echo "selected";
                                        } ?>>GDDR5</option>
                <option value="GDDR6" <?php if ($row['memory_type'] == 'GDDR6') {
                                            echo "selected";
                                        } ?>>GDDR6</option>
                <option value="GDDR6X" <?php if ($row['memory_type'] == 'GDDR6X') {
                                            echo "selected";
                                        } ?>>GDDR6X</option>
                <option value="GDDR5X" <?php if ($row['memory_type'] == 'GDDR5X') {
                                            echo "selected";
                                        } ?>>GDDR5X</option>
                <option value="HBM2" <?php if ($row['memory_type'] == 'HBM2') {
                                            echo "selected";
                                        } ?>>HBM2</option>

            </select>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> อัตรานาฬิกา </label>
        <div class="col-sm-2">
            <input type="text" name="clock_speed" class="form-control" maxlength="50" value="<?php echo $row['clock_speed']; ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> ราคา </label>
        <div class="col-sm-2">
            <input type="text" name="price" class="form-control" maxlength="50" value="<?php echo $row['price']; ?>" required>
        </div>
    </div>

    <div class="row mb-3">
        <label class="col-sm-1 col-form-label"> ปีวางจำหน่าย </label>
        <div class="col-sm-2">
            <input type="text" name="release_year" class="form-control" maxlength="50" value="<?php echo $row['release_year']; ?>" required>
        </div>
    </div>


    <button type="submit" class="btn btn-primary"> บันทึกข้อมูล</button>
    <a href="show.php" class="btn btn-danger btn-custom">
        <i class="fas fa-times me-2"></i>ย้อนกลับ
    </a>

</form>
<br>
พัฒนาโดย 664485021 นายปัญญาวัฒน์ ภุมมะดิลก <br>
</head>

</html>