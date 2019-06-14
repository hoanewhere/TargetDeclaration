<?php
$title = 'ログイン';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>Login</h1>
      <form action="#">
        <input type="text" name="user_name" placeholder="UserName" class="input-width-max">
        <input type="password" name="password" placeholder="Password" class="input-width-max">
        <input type="submit" value="Enter" class="input-width-max">
      </form>
      <p class="new-acount-tab"><a href="addUser.php">→ New Acount</a></p>
      <p class="new-acount-tab"><a href="remindPass.php">→ Remaind Pass</a></p>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
