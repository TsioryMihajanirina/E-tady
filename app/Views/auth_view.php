<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-tady zavatra</title>
    <link rel="stylesheet" href="<?= base_url('./css/bootstrap.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('./fontawesome/css/all.min.css') ?>">
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

    <h2 class="text-center">Connectez-vous</h2>

    <?php if(isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="/auth/login" method="POST">
        <div class="form-group">
            <label for="username">Nom</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Votre nom d'utilisateur" required>
        </div>
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Votre mot de passe" required>
                <div class="input-group-append">
                    <span class="input_group-text" id="togglePassword" style="cursor: pointer;">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </span>
                </div>
            </div>
        </div>

        <br>

        <button type="submit" class="btn btn-primary btn-block">E-connect</button>
    </form>

    <hr>
    <p>Vous n'avez pas encore de compte ? <a href="<?= base_url('inscription') ?>">Inscrivez-vous ici</a></p>
    
    
</div>

<script src="<?= base_url('./js/bootstrap.bundle.min.js') ?>"></script>
<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.querySelector('i').classList.toggle('fa-eye');
        this.querySelector('i').classList.toggle('fa-eye-slash');
    });
</script>
</body>
</html>
