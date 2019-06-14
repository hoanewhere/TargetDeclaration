<?php
$title = 'パスワード変更';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>Change Pass</h1>
      <form action="#">
        <p>Old Password</p>
        <input type="password" name="user_name" placeholder="old" class="input-width-max">
        <p>New Password</p>
        <input type="password" name="password" placeholder="new" class="input-width-max">
        <p>Re: New Password</p>
        <input type="password" name="password" placeholder="re: new" class="input-width-max">
        <input type="submit" value="Change Pass" class="input-width-max">
      </form>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
