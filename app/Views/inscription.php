<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-tady zavatra</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/all.min.css">

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: auto;
            background-color: #f8f9fa;
            position: relative;
            margin: 0;
            padding: 0;
        }
        
        .auth-container {
            width: auto;
            max-width: 800px;
            padding: 2rem;
            background-color: bisque;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .titre {
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            position: relative;
            text-transform: capitalize;
        }

    </style>

</head>
<body>
<div class="auth-container">

    <div class="titre">
        <h1>E-tady zavatra</h1>
    </div>

    <h2 class="text-center">Inscrivez-vous</h2>

    <?php if(session()->has('error')): ?>
        <div class="alert alert-danger" role="alert"><?= session()->get('error') ?></div>
    <?php endif; ?>

    <form action="<?= base_url('auth/register') ?>" method="POST">
        <div class="form-group">
            <label for="reg_username">Username</label>
            <input type="text" class="form-control" id="reg_username" name="reg_username" placeholder="votre nom d'utilisateur" required>
        </div>
        <div class="form-group">
            <label for="reg_password">Mot de passe</label>
            <div class="input-group">
                <input type="password" class="form-control" id="reg_password" name="reg_password" placeholder="votre mot de passe" required>
                <div class="input-group-append">
                    <span class="input_group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="reg_email">Email</label>
            <input type="email" class="form-control" id="reg_email" name="reg_email" placeholder="votre email@gmail.com" required>
        </div>
        <div class="form-group">
            <label for="reg_telephone">Numéro télephone</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                </div>
            <input type="number" class="form-control" id="reg_telephone" name="reg_telephone" data-inputmask='"mask": "(999) 999-9999"' data-mask required>
            </div>
        </div>

        <br>

        <button type="submit" class="btn btn-success btn-block">E-s'inscrire</button>
    </form>

</div>

<script src="./js/bootstrap.bundle.min.js"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').clssList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>

</body>
</html>