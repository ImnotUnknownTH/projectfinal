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
            margin: 0 auto;
            max-width: 1200px;
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
        
        /* Custom Form Styling */
        .form-control, .form-select {
            background-color: rgba(20, 30, 60, 0.6);
            border: 1px solid var(--neon-blue);
            color: #fff;
            border-radius: 8px;
            padding: 10px 15px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus, .form-select:focus {
            background-color: rgba(30, 40, 80, 0.7);
            border-color: var(--neon-green);
            box-shadow: 0 0 15px rgba(0, 255, 140, 0.4);
            color: #fff;
        }
        
        .form-label {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            color: var(--neon-blue);
            letter-spacing: 1px;
            text-transform: uppercase;
            margin-bottom: 8px;
            display: block;
        }
        
        .col-form-label {
            font-family: 'Orbitron', sans-serif;
            font-size: 0.9rem;
            color: var(--neon-blue);
            letter-spacing: 1px;
            text-transform: uppercase;
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
        
        .btn-primary {
            background: linear-gradient(135deg, #0059cf, #3399ff);
            border: none;
            box-shadow: 0 0 10px rgba(0, 89, 207, 0.5);
        }
        
        .btn-danger {
            background: linear-gradient(135deg, #cf0030, #ff3366);
            border: none;
            box-shadow: 0 0 10px rgba(207, 0, 48, 0.5);
        }
        
        /* Form Group Styling */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-group::after {
            content: "";
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 1px;
            background: linear-gradient(to right, transparent, rgba(0, 243, 255, 0.3), transparent);
        }
        
        /* ID Display */
        .id-display {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.2rem;
            color: var(--neon-green);
            text-shadow: 0 0 10px rgba(0, 255, 140, 0.5);
            background: rgba(0, 40, 80, 0.4);
            padding: 5px 15px;
            border-radius: 8px;
            border-left: 3px solid var(--neon-green);
            display: inline-block;
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
            
            .form-row {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
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
}
?>

<div class="container-custom">
    <div class="page-header">
        <div>
            <h1>
                <i class="fas fa-edit tech-icon"></i>แก้ไขข้อมูลการ์ดจอ
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

    <form action="edit_1.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        
        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">รหัสการ์ดจอ</label>
            <div class="col-sm-4">
                <div class="id-display"><?php echo $row['id']; ?></div>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">แบรนด์</label>
            <div class="col-sm-4">
                <select class="form-select" name="brand" aria-label="Default select example" required>
                    <option value="">กรุณาระบุแบรนด์</option>
                    <option value="AMD" <?php if ($row['brand'] == 'AMD') echo "selected"; ?>>AMD</option>
                    <option value="NVIDIA" <?php if ($row['brand'] == 'NVIDIA') echo "selected"; ?>>NVIDIA</option>
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">โมเดล</label>
            <div class="col-sm-4">
                <input type="text" name="model" class="form-control" maxlength="50" value="<?php echo $row['model']; ?>" required>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">ขนาดของหน่วยความจำ</label>
            <div class="col-sm-4">
                <input type="text" name="memory_size" class="form-control" maxlength="50" value="<?php echo $row['memory_size']; ?>" required>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">ชนิดของหน่วยความจำ</label>
            <div class="col-sm-4">
                <select class="form-select" name="memory_type" aria-label="Default select example" required>
                    <option value="">กรุณาระบุชนิดของหน่วยความจำ</option>
                    <option value="GDDR5" <?php if ($row['memory_type'] == 'GDDR5') echo "selected"; ?>>GDDR5</option>
                    <option value="GDDR6" <?php if ($row['memory_type'] == 'GDDR6') echo "selected"; ?>>GDDR6</option>
                    <option value="GDDR6X" <?php if ($row['memory_type'] == 'GDDR6X') echo "selected"; ?>>GDDR6X</option>
                    <option value="GDDR5X" <?php if ($row['memory_type'] == 'GDDR5X') echo "selected"; ?>>GDDR5X</option>
                    <option value="HBM2" <?php if ($row['memory_type'] == 'HBM2') echo "selected"; ?>>HBM2</option>
                </select>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">อัตรานาฬิกา</label>
            <div class="col-sm-4">
                <input type="text" name="clock_speed" class="form-control" maxlength="50" value="<?php echo $row['clock_speed']; ?>" required>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">ราคา</label>
            <div class="col-sm-4">
                <input type="text" name="price" class="form-control" maxlength="50" value="<?php echo $row['price']; ?>" required>
                <small class="text-info">* กรอกเฉพาะตัวเลข ไม่ต้องใส่เครื่องหมายคั่นพัน</small>
            </div>
        </div>

        <div class="row mb-4">
            <label class="col-sm-2 col-form-label">ปีที่วางจำหน่าย</label>
            <div class="col-sm-4">
                <input type="text" name="release_year" class="form-control" maxlength="50" value="<?php echo $row['release_year']; ?>" required>
            </div>
        </div>

        <div class="mt-4 mb-5">
            <button type="submit" class="btn btn-primary me-2">
                <i class="fas fa-save me-2"></i>บันทึกข้อมูล
            </button>
            <a href="show.php" class="btn btn-danger">
                <i class="fas fa-times me-2"></i>ย้อนกลับ
            </a>
        </div>
    </form>

    <div class="text-center mt-4 footer-credit">
        <i class="fas fa-code tech-icon"></i>
        พัฒนาโดย: 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

<script>
    // Add futuristic animation effects
    document.addEventListener('DOMContentLoaded', function() {
        // Add glow effect to input fields on focus
        const formElements = document.querySelectorAll('.form-control, .form-select');
        formElements.forEach(element => {
            element.addEventListener('focus', function() {
                this.style.boxShadow = '0 0 20px rgba(0, 255, 140, 0.5)';
            });
            element.addEventListener('blur', function() {
                this.style.boxShadow = '';
            });
        });
        
        // Add button hover effect
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
            });
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    });
</script>
</body>
</html>