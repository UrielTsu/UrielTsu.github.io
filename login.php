<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hola Profe </title>
    <link rel="stylesheet" href="css/bootstrap.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(45deg, #0f172a, #1e293b);
            min-height: 100vh;
        }

        .animate-blob {
            animation: blob 7s infinite;
        }

        @keyframes blob {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -50px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        .custom-gradient {
            background: linear-gradient(135deg, #4f46e5, #6d28d9);
            transition: all 0.3s ease;
        }

        .custom-gradient:hover {
            background: linear-gradient(135deg, #6d28d9, #4f46e5);
            transform: translateY(-2px);
            box-shadow: 0 0 20px rgba(79, 70, 229, 0.4);
        }

        .form-control {
            background: rgba(0, 0, 0, 0.2) !important;
            border: 1px solid rgba(255, 255, 255, 0.1) !important;
            color: white !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background: rgba(0, 0, 0, 0.3) !important;
            border-color: #4f46e5 !important;
            box-shadow: 0 0 15px rgba(79, 70, 229, 0.3) !important;
        }

        .login-container {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            animation: containerGlow 3s infinite alternate;
        }

        @keyframes containerGlow {
            from {
                box-shadow: 0 0 30px rgba(0, 0, 0, 0.3);
            }
            to {
                box-shadow: 0 0 40px rgba(79, 70, 229, 0.2);
            }
        }

        .glow-effect {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            filter: blur(40px);
            opacity: 0.2;
            animation: glowMove 10s infinite alternate;
        }

        .glow-1 {
            background: #4f46e5;
            top: -50px;
            left: -50px;
        }

        .glow-2 {
            background: #6d28d9;
            bottom: -50px;
            right: -50px;
            animation-delay: 2s;
        }

        @keyframes glowMove {
            0% {
                transform: translate(0, 0) scale(1);
            }
            100% {
                transform: translate(20px, 20px) scale(1.2);
            }
        }

        .form-label {
            color: rgba(97, 93, 93, 0.8);
            font-weight: 500;
            letter-spacing: 0.5px;
        }

        h1 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, #4f46e5, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 1rem;
        }

        input[type="text"]::placeholder,
        input[type="password"]::placeholder {
            color: #6c757d; /* Placeholder gris */
        }

    </style>
</head>

<body class="d-flex align-items-center justify-content-center py-4">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
            <div class="login-container position-relative p-5 rounded-4">
                <div class="glow-effect glow-1"></div>
                <div class="glow-effect glow-2"></div>

                <main class="form-signin w-100">

                    <p class="text-center text-gray-300 mb-4">Hola mano, echa tus datos</p>

                    <form method="post" action="valida.php" class="mt-4">
                        <div class="mb-4">
                            <label for="nombre" class="form-label mb-2">Usuario</label>
                            <input type="text" id="nombre" name="nombre" class="form-control p-3 rounded-3" placeholder="Ingresa tu usuario" required autofocus>
                        </div>

                        <div class="mb-4">
                            <label for="pass" class="form-label mb-2">Contraseña</label>
                            <input type="password" id="pass" name="pass" class="form-control p-3 rounded-3" placeholder="Ingresa tu contraseña" required>
                        </div>


                        <button class="btn custom-gradient text-white w-100 p-3 rounded-3 fw-bold" type="submit">
                            Ingresar
                        </button>
                    </form>
                </main>
            </div>
        </div>
    </div>
</div>

<script src="js/jquery-3.7.1.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>