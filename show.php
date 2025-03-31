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
    <title>ฐานข้อมูลการ์ดจอ</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9000ff;
            --neon-green: #00ff8c;
            --neon-orange: #ff7b00;
            --dark-space: #0a0a20;
            --cyber-black: #111122;
            --grid-color: rgba(0, 243, 255, 0.1);
        }
        
        body {
            font-family: 'Kanit', sans-serif;
            background-color: var(--dark-space);
            color: #fff;
            background-image: 
                radial-gradient(circle at 50% 50%, rgba(25, 25, 112, 0.3), transparent 80%),
                linear-gradient(to right, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.1)),
                repeating-linear-gradient(to right, var(--grid-color) 0, var(--grid-color) 1px, transparent 1px, transparent 30px),
                repeating-linear-gradient(to bottom, var(--grid-color) 0, var(--grid-color) 1px, transparent 1px, transparent 30px);
            background-attachment: fixed;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple), var(--neon-blue));
            z-index: 1000;
            box-shadow: 0 0 20px var(--neon-blue);
        }
        
        .container-custom {
            background-color: rgba(10, 14, 40, 0.85);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.2), 
                        inset 0 0 10px rgba(0, 243, 255, 0.1);
            border: 1px solid rgba(0, 243, 255, 0.3);
            backdrop-filter: blur(5px);
        }
        
        .page-header {
            margin-bottom: 30px;
            border-bottom: 2px solid var(--neon-blue);
            padding-bottom: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.7);
            letter-spacing: 2px;
            font-weight: bold;
        }
        
        /* ปรับแต่งส่วนแสดงผู้เข้าสู่ระบบ */
        .user-info-panel {
            background: linear-gradient(to right, rgba(0, 30, 60, 0.7), rgba(0, 60, 120, 0.4));
            padding: 10px 15px;
            border-radius: 10px;
            margin-top: 10px;
            border-left: 4px solid var(--neon-green);
            box-shadow: 0 0 15px rgba(0, 255, 140, 0.3);
            animation: glow 3s infinite alternate;
            display: inline-block;
        }
        
        @keyframes glow {
            from { box-shadow: 0 0 10px rgba(0, 255, 140, 0.3); }
            to { box-shadow: 0 0 20px rgba(0, 255, 140, 0.6); }
        }
        
        .user-label {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.85rem;
            color: #aaa;
            text-transform: uppercase;
            letter-spacing: 1px;
            display: inline-block;
            margin-right: 5px;
        }
        
        .user-name {
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 0 0 10px rgba(0, 255, 140, 0.7);
            background: linear-gradient(to right, #fff, var(--neon-green));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding: 0 5px;
        }
        
        .position-name {
            color: #fff;
            font-weight: 600;
            font-size: 1.1rem;
            text-shadow: 0 0 10px rgba(255, 123, 0, 0.7);
            background: linear-gradient(to right, #fff, var(--neon-orange));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            padding: 0 5px;
        }
        
        .login-info-divider {
            margin: 0 10px;
            color: rgba(255, 255, 255, 0.5);
        }
        
        /* Table styling */
        .table {
            border-collapse: separate;
            border-spacing: 0;
            color: #fff;
            background: transparent;
        }
        
        .table-dark {
            background: linear-gradient(to right, #000040, #000830);
        }
        
        .table thead th {
            border-bottom: none;
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            letter-spacing: 1px;
            text-transform: uppercase;
            font-size: 0.9rem;
        }
        
        .table tbody tr {
            background-color: rgba(20, 30, 70, 0.4);
            transition: all 0.3s ease;
        }
        
        .table tbody tr:hover {
            background-color: rgba(20, 30, 90, 0.7);
            transform: scale(1.01);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.3);
        }
        
        /* Buttons */
        .btn {
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            padding: 8px 20px;
        }
        
        .btn::after {
            content: "";
            position: absolute;
            top: -50%;
            left: -60%;
            width: 200%;
            height: 200%;
            background: linear-gradient(rgba(255, 255, 255, 0.2), transparent);
            transform: rotate(30deg);
            transition: all 0.5s ease;
            opacity: 0;
        }
        
        .btn:hover::after {
            opacity: 1;
            left: 0;
        }
        
        .btn-success {
            background: linear-gradient(135deg, #00aa6c, #00cc8e);
            border: none;
            box-shadow: 0 0 10px rgba(0, 170, 108, 0.5);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #cf0030, #ff3366);
            border: none;
            box-shadow: 0 0 10px rgba(207, 0, 48, 0.5);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0059cf, #3399ff);
            border: none;
            box-shadow: 0 0 10px rgba(0, 89, 207, 0.5);
        }
        
        /* DataTables custom styling */
        .dataTables_wrapper .dataTables_filter input {
            background-color: rgba(0, 0, 60, 0.7);
            color: white;
            border: 1px solid var(--neon-blue);
            border-radius: 8px;
            padding: 5px 10px;
        }
        
        .dataTables_wrapper .dataTables_length select {
            background-color: rgba(0, 0, 60, 0.7);
            color: white;
            border: 1px solid var(--neon-blue);
            border-radius: 8px;
            padding: 5px 10px;
        }
        
        .dataTables_info, .dataTables_paginate {
            color: rgba(255, 255, 255, 0.7) !important;
            margin-top: 15px;
        }
        
        .page-link {
            background-color: rgba(0, 0, 60, 0.7);
            color: var(--neon-blue);
            border-color: var(--neon-blue);
        }
        
        .page-link:hover {
            background-color: rgba(0, 243, 255, 0.2);
            color: white;
        }
        
        /* Footer */
        .footer-credit {
            font-size: 0.9rem;
            padding: 15px;
            border-top: 1px solid rgba(0, 243, 255, 0.3);
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.6);
            background: linear-gradient(to right, rgba(10, 14, 40, 0.9), rgba(20, 24, 70, 0.6));
            border-radius: 10px;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.2);
        }
        
        /* Animated elements */
        @keyframes pulse {
            0% { opacity: 0.7; }
            50% { opacity: 1; }
            100% { opacity: 0.7; }
        }
        
        .tech-icon {
            animation: pulse 3s infinite ease-in-out;
            margin-right: 10px;
        }
        
        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 10px;
            height: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--cyber-black);
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--neon-blue), var(--neon-purple));
            border-radius: 5px;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-header div:last-child {
                margin-top: 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Decorative elements -->
    <div class="container-custom">
        <div class="page-header">
            <div>
                <h1>
                    <i class="fas fa-microchip tech-icon"></i>GPU Database
                </h1>
                <div class="user-info-panel">
                    <i class="fas fa-user-shield me-2"></i>
                    <span class="user-label">USER:</span>
                    <span class="user-name"><?php echo $_SESSION["u_name"]; ?></span>
                    <span class="login-info-divider">|</span>
                    <span class="user-label">POSITION:</span>
                    <span class="position-name"><?php echo $_SESSION["u_position"]; ?></span>
                </div>
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
                        <th>แบรนด์</th>
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
                            echo "<td><span class='badge bg-dark'>" . $row["id"] . "</span></td>";
                            echo "<td>" . $row["brand"] . " </td>";
                            echo "<td><strong class='text-info'>" . $row["model"] . "</strong></td>";
                            echo "<td>" . $row["memory_size"] . " </td>";
                            echo "<td>" . $row["memory_type"] . " </td>";
                            echo "<td>" . $row["clock_speed"] . " </td>";
                            echo "<td class='text-warning'>" . number_format($row["price"]) . " บาท</td>";
                            echo "<td>" . $row["release_year"] . " </td>";
                            echo '<td>
                                <div class="btn-group" role="group">
                                    <a href="show.php?action_even=del&id=' . $row['id'] . '" 
                                       class="btn btn-danger btn-sm" 
                                       title="ลบข้อมูล" 
                                       onclick="return confirm(\'ต้องการลบข้อมูลการ์ดจอ ' . $row['brand'] . ' ' . $row['model'] . '?\')"
                                    >
                                        <i class="fas fa-trash me-1"></i>ลบ
                                    </a>
                                    <a href="edit.php?action_even=edit&id=' . $row['id'] . '" 
                                       class="btn btn-primary btn-sm" 
                                       title="แก้ไขข้อมูล"
                                    >
                                        <i class="fas fa-edit me-1"></i>แก้ไข
                                    </a>
                                </div>
                            </td>';
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9' class='text-center'>ไม่พบข้อมูลการ์ดจอในระบบ</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4 footer-credit">
            <i class="fas fa-code tech-icon"></i>
            พัฒนาโดย: 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
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
            },
            // Sci-fi themed initializing message
            language: {
                processing: "<div class='spinner-border text-info' role='status'><span class='visually-hidden'>กำลังประมวลผล...</span></div>"
            }
        });
        
        // Add futuristic hover effect to table rows
        document.addEventListener('DOMContentLoaded', function() {
            const tableRows = document.querySelectorAll('tbody tr');
            tableRows.forEach(row => {
                row.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                    this.style.transition = 'all 0.3s ease';
                });
                row.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
</body>
</html>