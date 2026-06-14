<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Flood Monitor</title>
    <style>
        * { box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { margin: 0; padding: 0; background-color: #f0f4f8; color: #333; }
        
        .navbar { 
            background-color: #00ff15; color: white; padding: 15px 30px; 
            display: flex; justify-content: space-between; align-items: center; 
            box-shadow: 0 2px 4px rgba(0,0,0,0.1); 
        }
        .navbar .brand { font-size: 1.2rem; font-weight: bold; letter-spacing: 1px; color: #ff0000; }
        .navbar .nav-links a { 
            color: #e2e8f0; text-decoration: none; margin-left: 20px; 
            font-weight: 500; transition: color 0.3s; 
        }
        .navbar .nav-links a:hover { color: #38bdf8; }
        .btn-logout { background-color: #ef4444; padding: 6px 12px; border-radius: 4px; color: white !important; }
        .btn-logout:hover { background-color: #dc2626; }

        .main-container { max-width: 1000px; margin: 40px auto; padding: 0 20px; }
        
        h2 { 
            color: #0f172a; margin-top: 0; margin-bottom: 20px; 
            border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; 
        }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: 600; color: #475569; font-size: 0.9rem; }
        input[type="text"], input[type="password"], input[type="number"], input[type="file"] { 
            width: 100%; padding: 10px 12px; border: 1px solid #cbd5e1; 
            border-radius: 6px; outline: none; font-size: 1rem; transition: border-color 0.2s; 
            background-color: #fff;
        }
        input:focus { border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1); }
        small { color: #64748b; font-size: 0.8rem; margin-top: 6px; display: block; }

        .btn, button[type="submit"] { 
            display: inline-block; padding: 10px 15px; border-radius: 6px; 
            text-decoration: none; border: none; cursor: pointer; font-size: 14px; 
            font-weight: 600; text-align: center; transition: 0.2s; 
        }
        button[type="submit"] { width: 100%; background-color: #3b82f6; color: white; margin-top: 10px;}
        button[type="submit"]:hover { background-color: #2563eb; }
        
        .btn { background-color: #e2e8f0; color: #334155; }
        .btn:hover { background-color: #cbd5e1; }
        .btn-success { background-color: #10b981; color: white; margin-bottom: 15px;}
        .btn-success:hover { background-color: #059669; }
        .btn-danger { background-color: #ef4444; color: white; }
        .btn-danger:hover { background-color: #dc2626; }

        table { 
            width: 100%; border-collapse: collapse; background: white; 
            border-radius: 8px; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,0.1); 
            margin-top: 15px;
        }
        thead, th { background-color: #f8fafc; border-bottom: 2px solid #e2e8f0; text-align: left; }
        th { padding: 15px; font-weight: 600; color: #475569; font-size: 0.9rem; text-transform: uppercase; }
        td { padding: 15px; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; }
        tr:hover { background-color: #f8fafc; }

        .badge { padding: 5px 12px; border-radius: 20px; font-size: 0.75rem; font-weight: bold; text-transform: uppercase; letter-spacing: 0.5px; }
        .bg-aman { background-color: #dcfce7; color: #166534; border: 1px solid #bbf7d0; }
        .bg-siaga { background-color: #fef3c7; color: #92400e; border: 1px solid #fde68a; }
        .bg-bahaya { background-color: #fee2e2; color: #991b1b; border: 1px solid #fecaca; }

        p[style*="color: red"], p[style*="color: green"], div[style*="background:#d4edda"] {
            padding: 15px; border-radius: 6px; font-weight: 500; font-size: 0.9rem; margin-bottom: 20px;
        }
        p[style*="color: red"] { background-color: #fee2e2; color: #991b1b !important; border: 1px solid #fecaca; }
        p[style*="color: green"], div[style*="background:#d4edda"] { background-color: #dcfce7 !important; color: #166534 !important; border: 1px solid #bbf7d0; }

        .footer { text-align: center; padding: 20px; color: #94a3b8; font-size: 0.85rem; margin-top: 40px; }
    </style>
</head>
<body>

<?php 
if(isset($_SESSION['user_id'])): 
?>
    <nav class="navbar">
        <div class="brand">🌊 SmartFlood App</div>
        <div class="nav-links">
            <span>Halo, <strong><?= htmlspecialchars($_SESSION['username']) ?></strong></span>
            <a href="index.php?page=sensor&action=index">Dashboard Sensor</a>
            <a href="index.php?page=auth&action=logout" class="btn-logout" onclick="return confirm('Anda yakin ingin keluar?');">Logout</a>
        </div>
    </nav>
<?php endif; ?>

<div class="main-container">