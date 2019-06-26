<?php
include 'function.php';
?>

<?php
$title = 'マイページ';
include 'header.php';
include 'bodyHeader.php';
?>
  <main>
    <div class="mypage-container">
      <div class="my-side-container">
        <section class="side-bar">
          <h3>表示内容</h3>
          <form action="#">
            <p>開始日</p>
            <input type="date" name="start_day" class="input-width-max">
            <p>終了日</p>
            <input type="date" name="end_day" class="input-width-max">
            <p>表示単位</p>
            <select class="input-width-half" name="display_unit">
              <option value="year">YEAR</option>
              <option value="MONTH">MONTH</option>
              <option value="DAY">DAY</option>
            </select>
            <p>属性</p>
            <select class="input-width-half" name="attr_task">
              <option value="all">ALL</option>
              <option value="not_yet">NOT YET</option>
              <option value="complete">COMPLETE</option>
            </select>
            <input type="submit" name="" value="SHOW" class="input-width-max">
          </form>
          <button type="button" name="add-button">新規追加</button>
        </section>
      </div>
      <div class="my-main-container">
        <section class="main-bar">
          <h1>TARGET</h1>
          <article>
            <form class="" action="" method="">
              <div class="day-block">
                <h3 class="sentence-date">YYYY/MM/DD</h3>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
              </div>
              <div class="day-block">
                <h3 class="sentence-date">YYYY/MM/DD</h3>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
              </div>
              <div class="day-block">
                <h3 class="sentence-date">YYYY/MM/DD</h3>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
              </div>
              <div class="day-block">
                <h3 class="sentence-date">YYYY/MM/DD</h3>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
                  <div class="sententce">
                    <textarea name="target" rows="1">hogehoge</textarea>
                    <input type="date">
                    <input type="checkbox">
                  </div>
              </div>
            </form>
          </article>
        </section>
      </div>
    </div>
    <div class="add-form">
      <section>
        <form class="" action="" method="post">
          <div class="add-block">
            <h3 class="add-title">新規Target　追加</h3>
            <span class="cancel-add-form css-cancel"></span>
              <div class="sententce">
                <textarea name="target" rows="1">hogehoge</textarea>
                <input type="date">
                <input type="submit" name="" value="追加">
              </div>
          </div>
      </section>
    </div>
  </main>
<?php
include 'bodyFooter.php';
?>
