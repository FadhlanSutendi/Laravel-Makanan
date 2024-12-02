@extends('layouts.app')

@section('content-dinamis')
    <!-- Hero Section -->
    <header class="bg-primary text-white text-center d-flex align-items-center justify-content-center position-relative" style="height: 100vh; overflow: hidden;">
        <!-- Background Overlay -->
        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0, 0, 0, 0.5); z-index: 1;"></div>
        
        <!-- Hero Content -->
        <div class="container position-relative z-2 text-white">
            <h1 class="display-4 fw-bold text-uppercase" style="text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.8);">
                Juara Baru Kuliner Online
            </h1>
            <p class="lead fs-5 mb-4" style="text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.8);">----- WELCOME -----</p>
            
           
        </div>

        <!-- Floating Decorative Elements -->
        <div class="position-absolute bottom-0 start-50 translate-middle-x mb-5">
            <img src="images/logo.png" class="img-fluid rounded-circle shadow-lg" alt="Decorative Element" style="animation: float 3s ease-in-out infinite;">
        </div>
    </header>

    <!-- Keyframes for Floating Animation -->
    <style>
        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
    </style>
@endsection
