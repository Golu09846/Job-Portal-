<style>
    /* Global Reset */
    body {
        margin: 0;
        padding: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        overflow-x: hidden;
    }

    /* Background Image */
    .bg-overlay {
        position: fixed;
        top: 0;
        left: 0;
        height: 100vh;
        width: 100vw;
        background-image: url('https://www.bacancytechnology.com/main/img/job-recruitment-portal-development/form-bg.jpg?v-1');
        background-size: cover;
        background-position: center;
        filter: brightness(0.35) blur(2px);
        z-index: -1;
    }

    /* Navbar */
    .navbar {
        background: rgba(0, 0, 0, 0.85);
    }

    /* Container Position Fix */
    .container {
        position: relative;
        z-index: 2;
    }

    /* Overlay Box */
    .overlay {
        background-color: rgba(255, 255, 255, 0.95);
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 2;
    }

    /* Heading Style */
    h3.glow-text {
        font-weight: bold;
        color: #ffffff;
        text-align: center;
        margin-bottom: 50px;
        text-shadow: 0 0 10px #00e0ff, 0 0 20px #00e0ff, 0 0 30px #00e0ff;
    }

    /* Table */
    .table th,
    .table td {
        vertical-align: middle;
        text-align: center;
    }

    /* Card Base */
    .card {
        border-radius: 20px;
        border: none;
        padding: 50px 30px;
        min-height: 330px;
        transition: all 0.4s ease-in-out;
        color: #fff;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 12px 25px rgba(0, 0, 0, 0.5);
    }

    .card img {
        width: 80px;
        height: 80px;
        margin-bottom: 20px;
        filter: drop-shadow(0 3px 5px rgba(0, 0, 0, 0.4));
    }

    /* Buttons */
    .btn {
        border-radius: 25px;
        padding: 8px 20px;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.4);
    }

    .btn-warning {
        background: linear-gradient(to right, #f7971e, #ffd200);
        border: none;
        color: #000;
    }

    .btn-danger {
        background: linear-gradient(to right, #ff416c, #ff4b2b);
        border: none;
        color: white;
    }

    .btn-sm {
        padding: 6px 14px;
        font-size: 0.85rem;
    }

    /* Status Badges */
    .badge {
        padding: 5px 10px;
        font-size: 0.8rem;
        border-radius: 20px;
    }

    .badge.bg-success {
        background-color: #28a745 !important;
    }

    .badge.bg-danger {
        background-color: #dc3545 !important;
    }

    /* Themed Cards */
    .card-users {
        background: linear-gradient(135deg, #2980b9, #2c3e50);
    }

    .card-jobs {
        background: linear-gradient(135deg, #8e2de2, #4a00e0);
    }

    .card-applications {
        background: linear-gradient(135deg, #1f4037, #99f2c8);
        color: #fff;
    }

    /* Button Themes */
    .btn-users {
        background-color: rgba(255, 255, 255, 0.15);
        color: #e3f2fd;
    }

    .btn-jobs {
        background-color: rgba(255, 255, 255, 0.15);
        color: #f3e8fd;
    }

    .btn-applications {
        background-color: rgba(255, 255, 255, 0.15);
        color: #e0fff8;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .card {
            padding: 30px 20px;
            min-height: auto;
        }

        .card img {
            width: 60px;
            height: 60px;
        }

        .btn {
            padding: 6px 18px;
        }
    }

    /* 🔥 New Styles for settings.php enhancements 🔥 */

    .glass-card {
        background: rgba(255, 255, 255, 0.08);
        border-radius: 20px;
        backdrop-filter: blur(12px);
        box-shadow: 0 8px 32px rgba(31, 38, 135, 0.2);
        transition: all 0.3s ease-in-out;
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #fff;
    }

    .glass-card:hover {
        transform: scale(1.03);
        box-shadow: 0 12px 42px rgba(31, 38, 135, 0.3);
    }

    .btn-glow {
        background: linear-gradient(to right, #00c6ff, #0072ff);
        color: white;
        padding: 0.5rem 1.25rem;
        border: none;
        border-radius: 50px;
        font-weight: 500;
        transition: all 0.3s ease-in-out;
    }

    .btn-glow:hover {
        background: linear-gradient(to right, #ff6a00, #ee0979);
        color: white;
        transform: scale(1.05);
    }

    .icon-box {
        color: #00d4ff;
        margin-bottom: 12px;
    }
</style>
