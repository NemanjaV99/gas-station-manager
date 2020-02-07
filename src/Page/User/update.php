<div class="form-container">
    <h2 class='header'>Update Email:</h2>
    <form action="#" method="POST" class="form">
        <label for="input-email">Email:</label>
        <input type="text" name="email" class="form__input" id="input-email" value="<?php echo $user["EMAIL"]; ?>">
        <label for="input-old-password">Current Password:</label>
        <input type="password" name="old-password" class="form__input" id="input-old-password" placeholder="Enter your password">
        <input type="submit" name="submit-update-email" value="Update">
    </form>
    <h2 class='header'>Update Password:</h2>
    <form action="#" method="POST" class="form">
        <label for="input-new-password">New Password:</label>
        <input type="password" name="new-password" class="form__input" id="input-new-password">
        <label for="input-old-password">Current Password:</label>
        <input type="password" name="old-password" class="form__input" id="input-old-password" placeholder="Enter your password">
        <input type="submit" name="submit-update-pass" value="Update">
    </form>
</div>