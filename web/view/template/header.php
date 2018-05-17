<div style="display:inline-block;">
    <button onclick="toggleMenu()">Toggle</button>
</div>
<!-- Information sur l'utilisateur si connecté, sinon bouton de login -->
<div style="display:inline-block;">
    <?php if (!$user) { ?>
        <a href="/web/auth/login"><button>Login</button></a><br/>
    <?php } else { ?>
        <p><?= $user['name']?></p>
        <p><?= $user['email']?></p>
        <form action="/web/auth/logout" method="post">
        <input type="submit" value="Logout">
        </form>
    <?php } ?>
</div>
