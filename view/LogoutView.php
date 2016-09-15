<div class="container">
    <form  method="post" >
        <p id="LoginView::Message"><?php echo Session::get('feedback'); ?></p>
        <input type='submit' name='LoginView::Logout' value='logout'/>
    </form>
</div>