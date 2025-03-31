<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;700&family=Kanit:wght@300;400;600&display=swap" rel="stylesheet">

    <title>ตรวจสอบ Login</title>
    
    <style>
        :root {
            --neon-blue: #00f3ff;
            --neon-purple: #9000ff;
            --neon-green: #00ff8c;
            --neon-orange: #ff7b00;
            --neon-red: #ff3366;
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
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin-left: 32%;
            position: relative;
            overflow: hidden;
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
        
        .error-container {
            background-color: rgba(10, 14, 40, 0.85);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 25px rgba(255, 51, 102, 0.3), 
                        inset 0 0 10px rgba(255, 51, 102, 0.2);
            border: 1px solid rgba(255, 51, 102, 0.3);
            backdrop-filter: blur(5px);
            max-width: 500px;
            width: 100%;
            text-align: center;
            animation: appear 0.5s ease-out;
            position: relative;
        }
        
        @keyframes appear {
            from { 
                opacity: 0;
                transform: scale(0.9);
            }
            to { 
                opacity: 1;
                transform: scale(1);
            }
        }
        
        .error-icon {
            color: var(--neon-red);
            font-size: 5rem;
            margin-bottom: 20px;
            text-shadow: 0 0 15px var(--neon-red);
            animation: pulse 2s infinite ease-in-out;
        }
        
        @keyframes pulse {
            0% { opacity: 0.7; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.05); }
            100% { opacity: 0.7; transform: scale(1); }
        }
        
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-red);
            text-shadow: 0 0 10px rgba(255, 51, 102, 0.7);
            letter-spacing: 2px;
            font-weight: bold;
            position: relative;
        }
        
        h2 {
            font-family: 'Kanit', sans-serif;
            color: #fff;
            text-shadow: 0 0 5px rgba(255, 255, 255, 0.5);
            margin-bottom: 30px;
        }
        
        .btn {
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            font-family: 'Orbitron', sans-serif;
            padding: 10px 24px;
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
        
        .btn-danger {
            background: linear-gradient(135deg, #cf0030, #ff3366);
            border: none;
            box-shadow: 0 0 15px rgba(207, 0, 48, 0.5);
        }
        
        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 0 20px rgba(207, 0, 48, 0.7);
        }
        
        .footer-credit {
            font-size: 0.9rem;
            padding: 10px;
            margin-top: 20px;
            color: rgba(255, 255, 255, 0.6);
            border-top: 1px solid rgba(0, 243, 255, 0.3);
            display: inline-block;
        }
        
        /* Animated glitch effect */
        .glitch-container {
            position: absolute;
            top: -10px; /* Adjusted to position above h1 */
            left: 0;
            right: 0;
            text-align: center;
            z-index: 1;
        }
        
        .glitch-text {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.5rem; /* Slightly smaller size */
            font-weight: bold;
            color: var(--neon-blue);
            text-shadow: 0 0 10px var(--neon-blue);
            position: relative;
            animation: glitch 3s infinite;
        }
        
        @keyframes glitch {
            0% { transform: translate(0); }
            20% { transform: translate(-2px, 2px); }
            40% { transform: translate(-2px, -2px); }
            60% { transform: translate(2px, 2px); }
            80% { transform: translate(2px, -2px); }
            100% { transform: translate(0); }
        }
        
        .glitch-text::before,
        .glitch-text::after {
            content: "ACCESS DENIED";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        
        .glitch-text::before {
            color: var(--neon-red);
            z-index: -1;
            animation: glitch-effect 3s infinite;
        }
        
        .glitch-text::after {
            color: var(--neon-green);
            z-index: -2;
            animation: glitch-effect 2s infinite reverse;
        }
        
        @keyframes glitch-effect {
            0% { transform: translate(0); }
            20% { transform: translate(-3px); }
            40% { transform: translate(3px); }
            60% { transform: translate(-3px); }
            80% { transform: translate(3px); }
            100% { transform: translate(0); }
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
            background: linear-gradient(var(--neon-blue), var(--neon-red));
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-container">
            <div class="error-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <div class="glitch-container">
                <div class="glitch-text">ACCESS DENIED</div>
            </div>
            <h1 class="mb-3">Login ผิดพลาด</h1>
            <h2 class="mb-4">กรุณาตรวจสอบ ชื่อผู้ใช้และรหัสผ่าน</h2>
            <a href="login.php" class="btn btn-danger mb-3">
                <i class="fas fa-arrow-left me-2"></i>กลับสู่หน้าจอ Login
            </a>
            <div class="footer-credit">
                <i class="fas fa-code me-2"></i>
                พัฒนาโดย 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>