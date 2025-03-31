<!DOCTYPE html>
<html lang="en">
    <?php
    include('conn.php');
    include('clogin.php');

    // เพิ่มโค้ดสำหรับการลบข้อมูล
    if(isset($_GET['action_even']) && $_GET['action_even'] == 'del' && isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // คำสั่ง SQL สำหรับลบข้อมูล
        $delete_sql = "DELETE FROM graphics_cards WHERE id = '$id'";
        
        if ($conn->query($delete_sql) === TRUE) {
            // หากลบสำเร็จ ให้ redirect กลับมาที่หน้าเดิม
            echo "<script>
                    alert('ลบข้อมูลสำเร็จ');
                    window.location.href = 'show.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('เกิดข้อผิดพลาดในการลบข้อมูล: " . $conn->error . "');
                    window.location.href = 'show.php';
                  </script>";
            exit();
        }
    }
    ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ข้อมูลการ์ดจอ</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Kanit', sans-serif;
            background-color: #F5F5DC; /* Cream background */
            padding: 20px;
        }
        .container-custom {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .page-header {
            margin-bottom: 30px;
            border-bottom: 2px solid #dc3545;
            padding-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .table-responsive {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container-custom">
        <div class="page-header">
            <div>
                <h1 class="text-danger">
                    <i class="fas fa-users me-3"></i>ข้อมูลการ์ดจอ
                </h1>
                <h2 class="text-muted fs-5">
                    <i class="fas fa-user-check me-2"></i>
                    ผู้เข้าสู่ระบบ: <?php echo $_SESSION["u_name"]; ?> 
                    ตำแหน่ง: <?php echo $_SESSION["u_position"]; ?>
                </h2>
            </div>
            <div>
                <a href="add.php" class="btn btn-success">
                    <i class="fas fa-plus me-2"></i>เพิ่มข้อมูล
                </a>
            </div>
        </div>

        <div class="table-responsive">
            <table id="example" class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>รหัส</th>
                        <th>แบรน</th>
                        <th>โมเดล</th>
                        <th>ขนาดของหน่วยความจำ</th>
                        <th>ชนิดของหน่วยความจำ</th>
                        <th>อัตรานาฬิกา</th>
                        <th>ราคา</th>
                        <th>ปีที่วางจำหน่าย</th>
                        <th>จัดการข้อมูล</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // ดึงข้อมูลพนักงาน
                    $sql = "SELECT * FROM graphics_cards";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["id"] . " </td>";
                            echo "<td>" . $row["brand"] . " </td>";
                            echo "<td>" . $row["model"] . " </td>";
                            echo "<td>" . $row["memory_size"] . " </td>";
                            echo "<td>" . $row["memory_type"] . " </td>";
                            echo "<td>" . $row["clock_speed"] . " </td>";
                            echo "<td>" . number_format($row["price"]) . " </td>";
                            echo "<td>" . $row["release_year"] . " </td>";
                            echo '<td>
                                <div class="btn-group" role="group">
                                    <a href="show.php?action_even=del&id=' . $row['id'] . '" 
                                       class="btn btn-danger btn-sm" 
                                       title="ลบข้อมูล" 
                                       onclick="return confirm(\'ต้องการลบข้อมูลพนักงาน ' . $row['brand'] . ' ' . $row['model'] . '?\')"
                                    >
                                        <i class="fas fa-trash me-1"></i>ลบข้อมูล
                                    </a>
                                    <a href="edit.php?action_even=edit&id=' . $row['id'] . '" 
                                       class="btn btn-primary btn-sm" 
                                       title="แก้ไขข้อมูล"
                                    >
                                        <i class="fas fa-edit me-1"></i>แก้ไขข้อมูล
                                    </a>
                                </div>
                            </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='8' class='text-center'>ไม่พบข้อมูล</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4 text-muted">
            <i class="fas fa-code me-2"></i>
            พัฒนาโดย 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        new DataTable('#example', {
            language: {
                lengthMenu: 'แสดง _MENU_ รายการ',
                search: 'ค้นหา:',
                info: 'หน้า _PAGE_ จาก _PAGES_',
                infoEmpty: 'ไม่มีข้อมูล',
                zeroRecords: 'ไม่พบข้อมูล',
                paginate: {
                    first: 'หน้าแรก',
                    last: 'หน้าสุดท้าย',
                    next: 'ถัดไป',
                    previous: 'ก่อนหน้า'
                }
            }
        });
    </script>
</body>
</html>