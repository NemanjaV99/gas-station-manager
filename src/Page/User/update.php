<div class="form-container">
    <h2 class='header'>Update Profile</h2>
    <form action="#" method="POST" class="form">
        <label for="input-email">Email:</label>
        <input type="text" name="email" class="form__input" id="input-email" value="<?php echo $user["EMAIL"]; ?>">
        <label for="input-old-password">Password:</label>
        <input type="password" name="old-password" class="form__input" id="input-old-password" placeholder="Enter your password">
        <input type="submit" name="submit-update" value="Update">
    </form>
</div>