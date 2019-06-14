<?php
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="main-form">
      <h1>User Info</h1>
      <form action="#">
        <p>User Name</p>
        <input type="text" name="user_name" placeholder="UserName" class="input-width-max">
        <p>Email</p>
        <input type="text" name="user_name" placeholder="Email" class="input-width-max">
        <p>Password</p>
        <input type="password" name="password" placeholder="Password" class="input-width-max">
        <p>Re: Password</p>
        <input type="password" name="password" placeholder="Password" class="input-width-max">
        <input type="submit" value="Add User" class="input-width-max">
      </form>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
