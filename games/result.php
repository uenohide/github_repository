<?php
CONST STORE_FILE_PATH = './ranking.json';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    exit('不正なアクセスです');
}

if (!isset($_POST['result']) || !is_numeric($_POST['result'])) {
    exit('不正なパラメータです');
}
    $result = $_POST['result'];

    // 現在のランキングを取得する
    $ranking = json_decode(file_get_contents(STORE_FILE_PATH), true);

    // 現在のランクに今回の結果を追加
    $ranking[] = $result;

    // ランキングを再ソート
    sort($ranking);

    // 新しいランキングの最下位を削除
    array_pop($ranking);

    // 新しいランキングを保存
    file_put_contents(STORE_FILE_PATH, json_encode($ranking));
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>時限爆弾</title>
        <link rel="stylesheet" href="./css/style.css">
      </head>
    <body>
        <div class="container">
        <h1>時限爆弾: ランキング</h1>
        <?php $flg = false;?>
        <?php foreach ($ranking as $rank => $time) :?>
            <?php if ($time === $result && !$flg) :?>
                <p><?php echo ($rank + 1) ?>位: <?php echo number_format($time, 3, '.', ','); $flg = true;?> 秒 ランクイン！</p>
            <?php else:?>
                <p><?php echo ($rank + 1) ?>位: <?php echo number_format($time, 3, '.', ',');?> 秒</p>
            <?php endif ?>
        <?php endforeach;?>
        <?php if (!$flg) { echo '<p>あなたの誤差: ' . number_format($result, 3, '.', ',') . ' 秒 (ランキング圏外)</p>'; }?>
        <p><a href="index.html">戻る</a></p>
        </div>
    </body>
</html>
