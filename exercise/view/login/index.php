<div class="container">

    <form method="post">
        <fieldset>
            <legend>Login - enter Username and password</legend>
            <p id="<?= static::$loginMessage; ?>"><?= $this->message; ?></p>

            <label for="<?= static::$loginName; ?>">Username :</label>
            <input type="text" id="<?= static::$loginName; ?>" name="<?= static::$loginName; ?>"
                   value="<?= $this->username ?>"/>

            <label for="<?= static::$loginPassword; ?>">Password :</label>
            <input type="password" id="<?= static::$loginPassword; ?>" name="<?= static::$loginPassword; ?>"/>

            <label for="<?= static::$loginKeep; ?>">Keep me logged in :</label>
            <input type="checkbox" id="<?= static::$loginKeep; ?>" name="<?= static::$loginKeep; ?>"/>

            <input type="submit" name="<?= static::$loginDoLogin; ?>" value="login"/>
        </fieldset>
    </form>

</div>