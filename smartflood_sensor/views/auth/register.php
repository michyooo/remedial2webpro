<style>
body{
    background: linear-gradient(135deg, #4facfe, #00f2fe);
    font-family: Arial, sans-serif;
}
</style>
<div style="
    max-width: 400px;
    margin: 50px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
">

    <h2 style="
        text-align:center;
        color:#007bff;
        margin-bottom:20px;
    ">
        Registrasi Akun
    </h2>

    <?php if(isset($error)): ?>
        <div style="
            background:#f8d7da;
            color:#721c24;
            padding:10px;
            border-radius:8px;
            margin-bottom:15px;
        ">
            <?= $error ?>
        </div>
    <?php endif; ?>

    <form action="index.php?page=auth&action=register" method="POST">

        <div style="
            background:#f8f9fa;
            padding:15px;
            border-radius:10px;
            margin-bottom:15px;
        ">
            <label><strong>Username Baru</strong></label>
            <input type="text" name="username" required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:8px;
                    border:1px solid #ccc;
                    border-radius:8px;
                ">
        </div>

        <div style="
            background:#f8f9fa;
            padding:15px;
            border-radius:10px;
            margin-bottom:20px;
        ">
            <label><strong>Password Baru</strong></label>
            <input type="password" name="password" required
                style="
                    width:100%;
                    padding:10px;
                    margin-top:8px;
                    border:1px solid #ccc;
                    border-radius:8px;
                ">
        </div>

        <button type="submit"
            style="
                width:100%;
                background:#28a745;
                color:white;
                border:none;
                padding:12px;
                border-radius:10px;
                font-size:16px;
                cursor:pointer;
            ">
            Daftar
        </button>
    </form>

    <p style="
        text-align:center;
        margin-top:20px;
    ">
        Sudah punya akun?
        <a href="index.php?page=auth&action=login"
           style="color:#007bff; text-decoration:none;">
            Login di sini
        </a>
    </p>
</div>