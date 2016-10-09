<div class="container">

    <form method="post">
        <p id="<?= static::$loginMessage; ?>"><?= $this->message; ?></p>
        <input type="submit" name="<?= static::$loginDoLogout; ?>" value="logout"/>
    </form>

</div>