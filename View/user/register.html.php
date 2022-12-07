<form action="/?c=user&a=register" method="post">
    <h1>Inscription</h1>
    <div>
        <label for="email">Mail: </label>
        <input type="email" name="email" id="email" minlength="6" maxlength="150" required>
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password" minlength="8" maxlength="40" required>
    </div>

    <div>
        <label for='password_repeat'>Répétez mot de passe</label>
        <input type="password" name="password_repeat" id="password_repeat" minlength="8" maxlength="40" required>
    </div>

    <input type="submit" name="submit">
</form>