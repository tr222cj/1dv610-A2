<div class="container">

    <h2>Register new user</h2>

    <form action="?register" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>Register a new user - Write username and password</legend>
            <p id="<?= static::$registerMessage; ?>"><?= $this->message; ?></p>
            <label for="<?= static::$registerName; ?>">Username :</label>
            <input type="text" size="20" id="<?= static::$registerName; ?>" name="<?= static::$registerName; ?>"
                   value="<?= $this->username; ?>"/>
            <br/>
            <label for="<?= static::$registerPassword; ?>">Password :</label>
            <input type="password" size="20" id="<?= static::$registerPassword; ?>"
                   name="<?= static::$registerPassword; ?>" value=""/>
            <br/>
            <label for="<?= static::$registerPasswordRepeat; ?>">Repeat password :</label>
            <input type="password" size="20" id="<?= static::$registerPasswordRepeat; ?>"
                   name="<?= static::$registerPasswordRepeat; ?>" value=""/>
            <br/>
            <input id="submit" type="submit" name="<?= static::$registerDoRegister; ?>" value="Register"/>
            <br/>
        </fieldset>
    </form>

</div>
