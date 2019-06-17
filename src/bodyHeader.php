<body>
<div class="main-content">
  <header>
    <div class="header-logo">
      <a href="index.php"><img src="../img/logo.png"></a>
    </div>
    <nav>
      <ul>
        <li><a href="index.php">TOP</a></li>
        <?php if (!isset($_SESSION['login_id'])): ?>
          <li><a href="login.php">ログイン</a></li>
        <?php else: ?>
          <li><a href="myPage.php">マイページ</a></li>
          <li><a href="#">ログアウト</a></li>
          <li><a href="withdrow.php">退会</a></li>
        <?php endif; ?>

      </ul>
    </nav>
  </header>
