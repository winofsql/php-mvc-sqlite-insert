<?php
require_once( "setting.php" );
require_once( "connect.php" );

require_once("model.php");

// ***********************************
// グローバル変数( 重要 )
// ***********************************
$pdo = null;
$err_message = "";

// ***************************
// 接続
// ***************************
try {
    $pdo = new PDO( "sqlite:../{$dbname}" );
}
catch ( PDOException $e ) {
    $error["db"] .= $dbname;
    $error["db"] .= " " . $e->getMessage();
}
// 接続以降で try ～ catch を有効にする設定
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
    // ***********************************
    // 更新
    // ***********************************
    $result = check_data();
    $result = true;
    if ( $result == true ) {
        insert_data();
        $_POST["name"] = "";
        $_POST["level"] = "";
    }
    else {
    }
}

// ***********************************
// 終了処理
// ***********************************
$pdo = null;

// ***********************************
// 画面
// ***********************************
require_once("view.php");
?>
