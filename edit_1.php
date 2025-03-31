<!DOCTYPE html>
<html lang="en">
<?php
//เชื่อมต่อฐานข้อมูล
include("conn.php");
include('clogin.php');
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลการ์ดจอ</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">

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
            max-width: 900px;
            margin: 40px auto;
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
            text-align: center;
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
        
        /* Form styling */
        .form-label {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-green);
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 5px;
        }
        
        .form-control {
            background-color: rgba(0, 30, 60, 0.5);
            border: 1px solid rgba(0, 243, 255, 0.3);
            color: white;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: rgba(0, 30, 60, 0.7);
            border-color: var(--neon-blue);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.4);
            color: white;
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
        
        .btn-info {
            background: linear-gradient(135deg, #0088aa, #00ccdd);
            border: none;
            box-shadow: 0 0 10px rgba(0, 136, 170, 0.5);
            color: white;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #0059cf, #3399ff);
            border: none;
            box-shadow: 0 0 10px rgba(0, 89, 207, 0.5);
        }
        
        /* Alert */
        .alert-success {
            background: linear-gradient(to right, rgba(0, 100, 50, 0.8), rgba(0, 170, 108, 0.5));
            border-left: 4px solid var(--neon-green);
            color: white;
            box-shadow: 0 0 15px rgba(0, 255, 140, 0.3);
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
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
            text-align: center;
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
    <div class="container-custom">
        <div class="page-header">
            <div>
                <h1>
                    <i class="fas fa-microchip tech-icon"></i>แก้ไขข้อมูลการ์ดจอ
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
        </div>

        <?php
        //เริ่มเก็บข้อมูล
        $id = $_POST['id'];
        $brand = $_POST['brand'];
        $model = $_POST['model'];
        $memory_size = $_POST['memory_size'];
        $memory_type = $_POST['memory_type'];
        $clock_speed = $_POST['clock_speed'];
        $price = $_POST['price'];
        $release_year = $_POST['release_year'];

        //เขียนคำสั่ง SQL
        $sql = "UPDATE graphics_cards SET brand='$brand',model='$model',memory_size='$memory_size',memory_type='$memory_type',clock_speed='$clock_speed',price='$price',release_year='$release_year' WHERE id=$id ";

        // รับคำสั่ง sql
        if ($conn->query($sql) === TRUE) {
            echo '<div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>ยินดีด้วยครับ! คุณได้ทำการแก้ไขข้อมูลเรียบร้อยแล้ว
                  </div>';
        } else {
            echo '<div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>เกิดข้อผิดพลาดในการแก้ไขข้อมูล: ' . $conn->error . '
                  </div>';
        }
        // ปิดการเชื่อมต่อ
        $conn->close();
        ?>

        <div class="text-center mt-4">
            <a href="show.php" class="btn btn-primary">
                <i class="fas fa-database me-2"></i>กลับหน้าแสดงข้อมูล
            </a>
        </div>

        <div class="text-center mt-4 footer-credit">
            <i class="fas fa-code tech-icon"></i>
            พัฒนาโดย: 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add futuristic hover effect to buttons
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.btn');
            buttons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px)';
                    this.style.boxShadow = '0 10px 20px rgba(0, 243, 255, 0.4)';
                });
                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '';
                });
            });
        });
    </script>
</body>
</html>