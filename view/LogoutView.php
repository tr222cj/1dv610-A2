<div class="container">
    <form method="post">
        <p id="LoginView::Message"><?php echo $this->message; ?></p>
        <input type="hidden" name="LoginView::CsrfToken" value="<?php echo $this->csrfToken; ?>"/>
        <input type='submit' name='LoginView::Logout' value='logout'/>
    </form>
</div>