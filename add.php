<!DOCTYPE html>
<html lang="en">
<?php
include("conn.php");
include('clogin.php'); // Added login check
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มข้อมูลการ์ดจอ</title>
    
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
            max-width: 800px;
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
        }
        
        /* User info panel */
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
            color: var(--neon-blue);
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 0.5rem;
        }
        
        .form-control {
            background-color: rgba(0, 10, 30, 0.6);
            border: 1px solid rgba(0, 243, 255, 0.3);
            color: #fff;
            border-radius: 8px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: rgba(0, 20, 40, 0.8);
            border-color: var(--neon-blue);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.5);
            color: #fff;
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.4);
        }
        
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }
        
        .form-group:before {
            content: "";
            position: absolute;
            left: 0;
            bottom: -2px;
            width: 0;
            height: 2px;
            background: linear-gradient(to right, var(--neon-blue), var(--neon-purple));
            transition: width 0.3s ease;
        }
        
        .form-group:hover:before {
            width: 100%;
        }
        
        /* Form icon styling */
        .form-icon {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 15px;
            color: var(--neon-blue);
            font-size: 1.2rem;
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
            padding: 12px 25px;
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
        
        .btn-primary {
            background: linear-gradient(135deg, #0059cf, #3399ff);
            border: none;
            box-shadow: 0 0 15px rgba(0, 89, 207, 0.5);
            margin-right: 10px;
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #cf0030, #ff3366);
            border: none;
            box-shadow: 0 0 15px rgba(207, 0, 48, 0.5);
        }
        
        /* Alert styling */
        .alert {
            background: rgba(0, 20, 40, 0.7);
            border-left: 4px solid;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
            animation: fadeIn 0.5s ease;
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .alert-success {
            border-color: var(--neon-green);
            color: var(--neon-green);
        }
        
        .alert-danger {
            border-color: #ff3366;
            color: #ff3366;
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
        
        /* Input group icons */
        .input-group-text {
            background-color: rgba(0, 20, 50, 0.8);
            border: 1px solid rgba(0, 243, 255, 0.3);
            color: var(--neon-blue);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .page-header div:last-child {
                margin-top: 15px;
                width: 100%;
                display: flex;
                justify-content: space-between;
            }
            
            .container-custom {
                padding: 20px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="container-custom">
            <div class="page-header">
                <div>
                    <h1>
                        <i class="fas fa-microchip tech-icon"></i>เพิ่มข้อมูลการ์ดจอ
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

            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="brand" class="form-label">
                                <i class="fas fa-building me-2"></i>แบรนด์
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-tag"></i></span>
                                <input type="text" class="form-control" id="brand" name="brand" placeholder="เช่น NVIDIA, AMD" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="model" class="form-label">
                                <i class="fas fa-microchip me-2"></i>โมเดล
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-code-branch"></i></span>
                                <input type="text" class="form-control" id="model" name="model" placeholder="เช่น RTX 3080, Radeon RX 6800" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="memory_size" class="form-label">
                                <i class="fas fa-memory me-2"></i>ขนาดของหน่วยความจำ
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-hdd"></i></span>
                                <input type="text" class="form-control" id="memory_size" name="memory_size" placeholder="เช่น 8GB, 12GB" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="memory_type" class="form-label">
                                <i class="fas fa-memory me-2"></i>ชนิดของหน่วยความจำ
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-memory"></i></span>
                                <input type="text" class="form-control" id="memory_type" name="memory_type" placeholder="เช่น GDDR6, GDDR6X" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="clock_speed" class="form-label">
                                <i class="fas fa-tachometer-alt me-2"></i>อัตรานาฬิกา
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                <input type="number" class="form-control" id="clock_speed" name="clock_speed" placeholder="เช่น 1815" required>
                                <span class="input-group-text">MHz</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="price" class="form-label">
                                <i class="fas fa-money-bill-wave me-2"></i>ราคา
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-coins"></i></span>
                                <input type="number" class="form-control" id="price" name="price" min="0" placeholder="เช่น 25000" required>
                                <span class="input-group-text">บาท</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label for="release_year" class="form-label">
                                <i class="fas fa-calendar me-2"></i>ปีวางจำหน่าย
                            </label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-calendar-alt"></i></span>
                                <input type="number" class="form-control" id="release_year" name="release_year" placeholder="เช่น 2020" required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>บันทึกข้อมูล
                    </button>
                    <a href="show.php" class="btn btn-danger">
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

                // แก้ไขชื่อตาราง - เปลี่ยนจาก employees เป็น graphics_cards
                $sql = "INSERT INTO graphics_cards (brand, model, memory_size, memory_type, clock_speed, price, release_year)
                        VALUES ('$brand', '$model', '$memory_size','$memory_type','$clock_speed','$price','$release_year')";

                if ($conn->query($sql) === TRUE) {
                    echo "<div class='alert alert-success text-center'>
                            <i class='fas fa-check-circle me-2'></i><strong>บันทึกเสร็จแล้ว!</strong> คุณได้บันทึกข้อมูลการ์ดจอ $brand $model เรียบร้อยแล้ว
                          </div>";
                    echo "<script>
                            setTimeout(function() {
                                window.location.href = 'show.php';
                            }, 2000);
                          </script>";
                } else {
                    echo "<div class='alert alert-danger text-center'>
                            <i class='fas fa-exclamation-triangle me-2'></i><strong>เกิดข้อผิดพลาด: </strong>" . $conn->error . "
                          </div>";
                }

                $conn->close();
            }
            ?>

            <div class="text-center mt-4 footer-credit">
                <i class="fas fa-code tech-icon"></i>
                พัฒนาโดย: 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <script>
        // Add futuristic hover effect to form elements
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'translateX(5px)';
                    this.parentElement.style.transition = 'all 0.3s ease';
                });
                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'translateX(0)';
                });
            });
            
            // Glowing effect on form submit
            const form = document.querySelector('form');
            form.addEventListener('submit', function() {
                this.classList.add('submitting');
                document.body.style.animation = 'pulse 0.5s';
            });
        });
    </script>
</body>
</html>