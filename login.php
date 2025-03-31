<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เข้าสู่ระบบ - GPU Database</title>
    
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
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow-x: hidden;
            margin-left: 10%;
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
        
        .login-container {
            background-color: rgba(10, 14, 40, 0.85);
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 0 25px rgba(0, 243, 255, 0.2), 
                        inset 0 0 10px rgba(0, 243, 255, 0.1);
            border: 1px solid rgba(0, 243, 255, 0.3);
            backdrop-filter: blur(5px);
            max-width: 450px;
            width: 100%;
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--neon-blue), var(--neon-purple));
            box-shadow: 0 0 15px var(--neon-blue);
        }
        
        h1 {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-blue);
            text-shadow: 0 0 10px rgba(0, 243, 255, 0.7);
            letter-spacing: 2px;
            font-weight: bold;
            margin-bottom: 30px;
        }
        
        .form-label {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-green);
            letter-spacing: 1px;
            font-size: 0.9rem;
            text-transform: uppercase;
        }
        
        .form-control {
            background-color: rgba(0, 0, 60, 0.7);
            border: 1px solid var(--neon-blue);
            color: white;
            font-family: 'Kanit', sans-serif;
            padding: 12px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            background-color: rgba(0, 0, 80, 0.8);
            box-shadow: 0 0 15px rgba(0, 243, 255, 0.4);
            border-color: var(--neon-purple);
            color: white;
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
            padding: 12px 20px;
            margin-top: 10px;
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
        
        .btn-secondary {
            background: linear-gradient(135deg, #444, #666);
            border: none;
            box-shadow: 0 0 10px rgba(80, 80, 80, 0.5);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 243, 255, 0.4);
        }
        
        .icon-large {
            font-size: 5rem;
            margin-bottom: 20px;
            color: var(--neon-blue);
            text-shadow: 0 0 15px rgba(0, 243, 255, 0.7);
            animation: pulse 3s infinite ease-in-out;
        }
        
        @keyframes pulse {
            0% { opacity: 0.7; text-shadow: 0 0 10px rgba(0, 243, 255, 0.5); }
            50% { opacity: 1; text-shadow: 0 0 20px rgba(0, 243, 255, 0.8); }
            100% { opacity: 0.7; text-shadow: 0 0 10px rgba(0, 243, 255, 0.5); }
        }
        
        .footer-credit {
            font-size: 0.9rem;
            padding: 15px;
            border-top: 1px solid rgba(0, 243, 255, 0.3);
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
        }
        
        /* Floating particles effect */
        .particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: -1;
        }
        
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background-color: var(--neon-blue);
            border-radius: 50%;
            box-shadow: 0 0 10px var(--neon-blue);
            animation: float 15s infinite linear;
        }
        
        @keyframes float {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(-100vh) translateX(100px); opacity: 0; }
        }
    </style>
</head>
<body>
    <!-- Particles background -->
    <div class="particles">
        <div class="particle" style="left: 10%; animation-duration: 20s; animation-delay: 0s;"></div>
        <div class="particle" style="left: 20%; animation-duration: 18s; animation-delay: 1s;"></div>
        <div class="particle" style="left: 30%; animation-duration: 15s; animation-delay: 2s;"></div>
        <div class="particle" style="left: 40%; animation-duration: 22s; animation-delay: 0.5s;"></div>
        <div class="particle" style="left: 50%; animation-duration: 17s; animation-delay: 1.5s;"></div>
        <div class="particle" style="left: 60%; animation-duration: 19s; animation-delay: 3s;"></div>
        <div class="particle" style="left: 70%; animation-duration: 16s; animation-delay: 2.5s;"></div>
        <div class="particle" style="left: 80%; animation-duration: 23s; animation-delay: 1s;"></div>
        <div class="particle" style="left: 90%; animation-duration: 21s; animation-delay: 0s;"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="login-container">
                    <!-- Icon -->
                    <div class="text-center">
                        <i class="fas fa-microchip icon-large"></i>
                    </div>

                    <h1 class="text-center">GPU DATABASE</h1>
                    <form action="chklogin.php" method="POST">
                        <div class="mb-4">
                            <label for="u_id" class="form-label">
                                <i class="fas fa-user me-2"></i>ชื่อผู้ใช้
                            </label>
                            <input type="text" class="form-control text-center" id="u_id" name="u_id" maxlength="30" required placeholder="กรอกชื่อผู้ใช้">
                        </div>
                        <div class="mb-4">
                            <label for="u_passwd" class="form-label">
                                <i class="fas fa-lock me-2"></i>รหัสผ่าน
                            </label>
                            <input type="password" class="form-control text-center" id="u_passwd" name="u_passwd" maxlength="30" required placeholder="กรอกรหัสผ่าน">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-sign-in-alt me-2"></i>เข้าสู่ระบบ
                            </button>
                            <button type="reset" class="btn btn-secondary">
                                <i class="fas fa-times-circle me-2"></i>ยกเลิก
                            </button>
                        </div>
                    </form>
                    <div class="footer-credit">
                        <i class="fas fa-code me-2"></i>
                        พัฒนาโดย: 664485021 นายปัญญาวัฒน์ ภุมมะดิลก
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Add more dynamic particles
        document.addEventListener('DOMContentLoaded', function() {
            const particles = document.querySelector('.particles');
            for (let i = 0; i < 15; i++) {
                const particle = document.createElement('div');
                particle.classList.add('particle');
                const left = Math.random() * 100;
                const duration = 15 + Math.random() * 15;
                const delay = Math.random() * 5;
                const size = 1 + Math.random() * 3;
                
                particle.style.left = `${left}%`;
                particle.style.animationDuration = `${duration}s`;
                particle.style.animationDelay = `${delay}s`;
                particle.style.width = `${size}px`;
                particle.style.height = `${size}px`;
                
                // Random color between blue and purple
                const hue = 180 + Math.random() * 60; // blue to purple
                particle.style.backgroundColor = `hsl(${hue}, 100%, 70%)`;
                particle.style.boxShadow = `0 0 ${size * 3}px hsl(${hue}, 100%, 70%)`;
                
                particles.appendChild(particle);
            }
        });
    </script>
</body>
</html>