<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TOPページ</title>
  <link rel="stylesheet" href="./css/reset.css">
  <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<div class="main-content">
  <header>
    <div class="header-logo">
      <img src="../img/logo.png">
    </div>
    <nav>
      <ul>
        <li><a href="#">TOP</a></li>
        <li><a href="#">マイページ</a></li>
        <li><a href="#">ログイン</a></li>
      </ul>
    </nav>
  </header>
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
</div>
<footer>
  <p>© Copyright 2019 Target Declaration All rights reserved.</p>
</footer>
</body>
</html>
