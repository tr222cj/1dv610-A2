<div class="container">

    <form method="post">
        <p id="<?= self::$loginMessage; ?>"><?= $this->message; ?></p>
        <input type="submit" name="<?= self::$loginDoLogout; ?>" value="logout"/>
    </form>

</div>