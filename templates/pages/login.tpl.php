<div class="container">
    <div class="login-form-container">
        <div class="login-form-top">
            <h2>Connectez vous a votre espace ADMIN MNS</h2>
        </div>
        <form method='post' action='index.php?page=login'>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="email" name="email" class="form-control" id="email_input" placeholder="name@example.com">
                <div class='check-form'>
                    <img src="images/check.svg" alt="icone de validation" class="icone-verif">
                    <span class="message-alerte">Rentrez un email valide.</span>
                </div>
            </div>
            <div class="form-group">
                <label for="password">Mot de passe</label>
                <input type="password"  name="password" class="form-control" id="password_input" placeholder="tappez votre mot de passe">
            </div>
                <?php if (!empty($_POST) && isset($user)):?>
                <div class="check-form">
                    <span class="message-alerte">Mot de passe ou email invalide</span>
                    <img src="images/check.svg" alt="icone de validation" class="icone-verif">
                </div>
                <?php endif ;?>
            <div class="container-btn">
                <input type="submit" class="btn btn-primary" value="Se connecter" name="submit" />
            </div>
            <div class="password_forgotten"><a href="">mot de passe oublié ?</a></div>
        </form>    
    </div>
</div>
</div>
<script src="scripts/login-check.js"></script>