<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyMate AI</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #6f42c1);
            color: white;
            display: flex;
            align-items: center;
        }

        .feature-card {
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .2);
        }

        .section {
            padding: 90px 0;
        }

        footer {
            background: #212529;
            color: white;
            padding: 30px;
        }

        .hero h1 {
            font-size: 60px;
            font-weight: bold;
        }

        .hero p {
            font-size: 20px;
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top">

        <div class="container">

            <a class="navbar-brand fw-bold" href="#home">

                🎓 StudyMate AI

            </a>

            <button class="navbar-toggler"
                data-bs-toggle="collapse"
                data-bs-target="#menu">

                <span class="navbar-toggler-icon"></span>

            </button>

            <div class="collapse navbar-collapse"
                id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">

                        <a class="nav-link" href="#home">

                            Home

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#features">

                            Features

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#about">

                            About

                        </a>

                    </li>

                    <li class="nav-item">

                        <a class="nav-link" href="#contact">

                            Contact

                        </a>

                    </li>

                    <li>

                        <a href="/Admin/login"
                            class="btn btn-warning ms-3">

                            Admin Login

                        </a>

                    </li>

                </ul>

            </div>

        </div>

    </nav>

    <!-- HERO -->

    <section id="home" class="hero">

        <div class="container">

            <div class="row align-items-center">

                <div class="col-lg-6">

                    <h1>

                        StudyMate AI

                    </h1>

                    <p class="mt-4">

                        AI Powered Learning Assistant using Laravel, Gemini AI and RAG.

                        Upload your study materials, chat with AI and learn smarter.

                    </p>

                    <a href="/Admin/login"
                        class="btn btn-warning btn-lg mt-3">

                        Get Started

                    </a>

                </div>

                <div class="col-lg-6 text-center">

    <img src="{{ asset('images/dashboard.png') }}"
         class="img-fluid rounded shadow-lg"
         style="max-height:550px; border-radius:20px;">

</div>

            </div>

        </div>

    </section>

    <!-- FEATURES -->

    <section id="features" class="section">

        <div class="container">

            <h2 class="text-center mb-5">

                Our Features

            </h2>

            <div class="row">

                <div class="col-md-4 mb-4">

                    <div class="card feature-card shadow h-100">

                        <div class="card-body text-center">

                            <i class="bi bi-file-earmark-pdf fs-1 text-primary"></i>

                            <h4 class="mt-3">

                                Documents

                            </h4>

                            <p>

                                Upload PDF, DOCX and TXT files.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-4">

                    <div class="card feature-card shadow h-100">

                        <div class="card-body text-center">

                            <i class="bi bi-journal-bookmark fs-1 text-success"></i>

                            <h4 class="mt-3">

                                Study Notes

                            </h4>

                            <p>

                                Manage all study notes digitally.

                            </p>

                        </div>

                    </div>

                </div>

                <div class="col-md-4 mb-4">

                    <div class="card feature-card shadow h-100">

                        <div class="card-body text-center">

                            <i class="bi bi-chat-dots fs-1 text-danger"></i>

                            <h4 class="mt-3">

                                Smart Chat

                            </h4>

                            <p>

                                Ask AI questions from uploaded study material.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <!-- ABOUT -->

    <section id="about" class="section bg-light">

        <div class="container text-center">

            <h2>

                About StudyMate AI

            </h2>

            <p class="mt-4">

                StudyMate AI is an AI-powered learning assistant developed using Laravel, Bootstrap, MySQL and Google Gemini AI. It allows students to upload documents, manage study notes and receive AI-powered answers based on uploaded study materials.

            </p>

        </div>

    </section>

    <!-- CONTACT -->

    <section id="contact" class="section">

        <div class="container text-center">

            <h2>

                Contact

            </h2>

            <p>

                Department of Information Technology

            </p>

            <p>

                University College of Engineering, Nagercoil

            </p>

            <p>

                Final Year B.Tech Project

            </p>

        </div>

    </section>

    <!-- FOOTER -->

    <footer>

        <div class="container text-center">

            <h5>

                StudyMate AI

            </h5>

            <p>

                AI Powered Learning Assistant

            </p>

            <p>

                © 2026 All Rights Reserved

            </p>

        </div>

    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>