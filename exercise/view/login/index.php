<div class="container">

    <form method="post">
        <fieldset>
            <legend>Login - enter Username and password</legend>
            <p id="<?= self::$loginMessage; ?>"><?= $this->message; ?></p>

            <label for="<?= self::$loginName; ?>">Username :</label>
            <input type="text" id="<?= self::$loginName; ?>" name="<?= self::$loginName; ?>" value="<?= $this->username ?>"/>

            <label for="<?= self::$loginPassword; ?>">Password :</label>
            <input type="password" id="<?= self::$loginPassword; ?>" name="<?= self::$loginPassword; ?>"/>

            <label for="<?= self::$loginKeep; ?>">Keep me logged in :</label>
            <input type="checkbox" id="<?= self::$loginKeep; ?>" name="<?= self::$loginKeep; ?>"/>

            <input type="submit" name="<?= self::$loginDoLogin; ?>" value="login"/>
        </fieldset>
    </form>

</div>