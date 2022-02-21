
<?php

  $dsn = 'mysql:dbname=test;host=localhost';
  $user = 'root';
  $password = '';

  // データベースへ接続
  try{
      $dbh = new PDO($dsn, $user, $password);
  }catch (PDOException $e){
      // エラー時の処理
      exit('データベース接続エラーです');
  }

  // 打刻されたら、このifの中の処理を行う
  if ($_POST) {
    // データベースに登録する
    // 登録日付は今日の日付(PHPで設定する)[2022/02/20 09:51:00]
    $kintaiDate = date('Y/m/d') . ' '
      . $_POST['time_1'] . $_POST['time_2'] . ':' 
      . $_POST['time_3'] . $_POST['time_4'] . ':00';

    try {
      $dbh->query("insert into kintai(kintai_date) values('" . $kintaiDate . "');");
    }
    catch (PDOException $e) {
      echo '打刻エラーです';
    }
    
  }

?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  
  <form action="" method="post">
    <select name="time_1">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
    </select>
    <select name="time_2">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
    </select>
    ：
    <select name="time_3">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
    </select>
    <select name="time_4">
      <option value="0">0</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
    </select>

    <!-- 打刻を押すことで、データベースへ勤怠記録がされる -->
    <button type="submit">打刻</button>
  </form>
  
  <table border="1">
<?php
  // データベースから勤怠の記録を取ってきて、一覧へ表示する
  foreach ($dbh->query('select kintai_date from kintai;') as $row) {
?>
    <tr><td><?php echo $row['kintai_date']; ?></td></tr>
<?php
  }
?>
  </table>

</body>
</html>