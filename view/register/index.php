<div class="container">

    <h2>Register new user</h2>

    <form action='?register' method='post' enctype='multipart/form-data'>
        <fieldset>
            <legend>Register a new user - Write username and password</legend>
            <p id='RegisterView::Message'><?= $this->message; ?></p>
            <label for='RegisterView::UserName'>Username :</label>
            <input type='text' size='20' name='RegisterView::UserName' id='RegisterView::UserName' value='<?= $this->username; ?>'/>
            <br/>
            <label for='RegisterView::Password'>Password :</label>
            <input type='password' size='20' name='RegisterView::Password' id='RegisterView::Password' value=''/>
            <br/>
            <label for='RegisterView::PasswordRepeat'>Repeat password :</label>
            <input type='password' size='20' name='RegisterView::PasswordRepeat' id='RegisterView::PasswordRepeat' value=''/>
            <br/>
            <input id='submit' type='submit' name='RegisterView::Register' value='Register'/>
            <br/>
        </fieldset>
    </form>

</div>
