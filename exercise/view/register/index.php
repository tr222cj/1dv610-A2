<div class="container">

    <h2>Register new user</h2>

    <form action="?register" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Register a new user - Write username and password</legend>
            <p id="<?= self::$registerMessage; ?>"><?= $this->message; ?></p>
            <label for="<?= self::$registerName; ?>">Username :</label>
            <input type="text" size="20" id="<?= self::$registerName; ?>" name="<?= self::$registerName; ?>" value="<?= $this->username; ?>"/>
            <br/>
            <label for="<?= self::$registerPassword; ?>">Password :</label>
            <input type="password" size="20" id="<?= self::$registerPassword; ?>" name="<?= self::$registerPassword; ?>" value=""/>
            <br/>
            <label for="<?= self::$registerPasswordRepeat; ?>">Repeat password :</label>
            <input type="password" size="20" id="<?= self::$registerPasswordRepeat; ?>" name="<?= self::$registerPasswordRepeat; ?>" value=""/>
            <br/>
            <input id="submit" type="submit" name="<?= self::$registerDoRegister; ?>" value="Register"/>
            <br/>
        </fieldset>
    </form>

</div>
