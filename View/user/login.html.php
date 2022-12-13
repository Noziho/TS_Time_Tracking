<div class="container">
    <form class="form" action="/?c=user&a=login" method="post">
        <h1>Login</h1>
        <div>
            <label for="email">Mail: </label>
            <input type="email" name="email" id="email" minlength="6" maxlength="150" required>
        </div>

        <div>
            <label for="password">Mot de passe: </label>
            <input type="password" name="password" id="password" minlength="8" maxlength="40" required>
        </div>

        <input type="submit" name="submit">
    </form>
</div>

