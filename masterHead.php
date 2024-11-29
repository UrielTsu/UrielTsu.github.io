<?php
include "seguridad.php";
?>

<!doctype html>
<html lang="en" data-bs-theme="dark">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Masterhead</title>

  <link rel="stylesheet" href="css/bootstrap.css">

    <style>
        body {
            background-color: #4F46E519; /* Fondo del cuerpo */
            font-family: 'Arial', sans-serif;
        }

        .sidebar {
            display: flex;
            flex-direction: column;
            height: 100vh; /* Altura completa de la ventana */
        }

        .sidebar .nav {
            flex-grow: 1; /* Ocupa el espacio disponible */
        }

        .sidebar .nav:last-child {
            margin-top: auto; /* Empuja el último elemento al fondo */
        }


        .sidebar .nav-link {
            display: block;
            color: #ffffff; /* Texto blanco */
            padding: 10px 15px;
            margin: 10px 0; /* Espaciado entre botones */
            border: 1px solid rgba(49, 27, 111, 0.45); /* Borde gris oscuro */
            border-radius: 5px; /* Bordes redondeados */
            text-decoration: none;
            background-color: #4f46e5;
            transition: all 0.3s ease;
        }


        h1 {
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #4f46e5, #6d28d9);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .sidebar hr {
            border-color: #ffffff; /* Separadores grises */

        }

        header.navbar {
            background-color: #1e293b; /* Fondo del encabezado oscuro */
        }


    </style>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
  <header class="navbar sticky-top bg-dark flex-md-nowrap p-0 shadow" data-bs-theme="dark">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3 fs-6 text-white" href="#">
        <h1> SUGH </h1>
    </a>

    <ul class="navbar-nav flex-row d-md-none">
      <li class="nav-item text-nowrap">
        <button class="nav-link px-3 text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch" aria-controls="navbarSearch" aria-expanded="false" aria-label="Toggle search">
          <svg class="bi">
            <use xlink:href="#search" />
          </svg>
        </button>
      </li>
      <li class="nav-item text-nowrap">
        <button class="nav-link px-3 text-white" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
          <svg class="bi">
            <use xlink:href="#list" />
          </svg>
        </button>
      </li>
    </ul>

    <div id="navbarSearch" class="navbar-search w-100 collapse">
      <input class="form-control w-100 rounded-0 border-0" type="text" placeholder="Search" aria-label="Search">
    </div>
  </header>

  <div class="container-fluid">
    <div class="row">
      <div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
        <div class="offcanvas-md offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarMenuLabel">Company name</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
          </div>
            <div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto sidebar">
                <ul class="nav flex-column mb-auto">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="crear.php">
                            <svg class="bi">
                                <use xlink:href="#file-earmark-text" />
                            </svg>
                            Crear Producto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="modificar.php">
                            <svg class="bi">
                                <use xlink:href="#file-earmark-text" />
                            </svg>
                            Modificar Producto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="eliminar.php">
                            <svg class="bi">
                                <use xlink:href="#file-earmark-text" />
                            </svg>
                            Eliminar Producto
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="buscar.php">
                            <svg class="bi">
                                <use xlink:href="#file-earmark-text" />
                            </svg>
                            Buscar
                        </a>
                    </li>
                </ul>

                <hr class="my-3">

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link d-flex align-items-center gap-2" href="login.php">
                            <svg class="bi">
                                <use xlink:href="#door-closed" />
                            </svg>
                            Salir
                        </a>
                    </li>
                </ul>
            </div>

        </div>
      </div>
      <script src="js/jquery-3.7.1.js"></script>
      <script src="js/bootstrap.js"></script>

