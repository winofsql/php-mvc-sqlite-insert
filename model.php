<?php
$tab_title = "登録";
$title = "<a href='control.php'>登録</a>";

// ***********************************
// 入力チェック
// ***********************************
function check_data() {

    global $err_message;
    $result = true;

    $err_message = "";

    // 未入力チェック
    $val = $_POST["name"];
    $val = preg_replace("/^[ 　]+/u", "", $val);
    $val = preg_replace("/[ 　]+$/u", "", $val);

    $_POST["name"] = $val;
    if ( $_POST["name"] == "" ) {
        $err_message .= "名前が入力されていません<br>";
        $result = false;
    }
    // 文字数チェック
    $len = mb_strlen( $_POST["name"] );
    if ( $len > 32 ) {
        $err_message .= "名前が長すぎます。32文字以内にしてください<br>";
        $result = false;
    }

    // 未入力チェック
    if ( $_POST["level"] == "" ) {
        $err_message .= "レベルが入力されていません<br>";
        $result = false;
    }
    // 文字数チェック
    $len = mb_strlen( $_POST["level"] );
    if ( $len > 3 ) {
        $err_message .= "レベルは３桁以内で指定してください<br>";
        $result = false;
    }
    // 文字種チェック( 数字のみ )
    $bool = ctype_digit( $_POST["level"] );
    if ( $bool == false ) {
        $err_message .= "0～999 の数字を入力してください<br>";
        $result = false;
    }


    return $result;
}

// ***********************************
// 画面用テーブル要素文字列作成
// ***********************************
function insert_data() {

    global $pdo;

    // ***********************************
    // SQL 文字列
    //
    // CREATE TABLE players (
    // id integer PRIMARY KEY AUTOINCREMENT,
    // name varchar(32),
    // level integer
    // )
    // ***********************************
    $sql = <<<INSERT
    insert into players
        (name,level)
        values(:name, :level)
INSERT;

    // ***********************************
    // 準備
    // ***********************************
    $statement = $pdo->prepare($sql);

    // ***********************************
    // バインド
    // ***********************************
    $statement->bindValue(':name', $_POST["name"], PDO::PARAM_STR);
    $statement->bindValue(':level', $_POST["level"], PDO::PARAM_INT);

    // ***********************************
    // 実行
    // ***********************************
    try {
        $statement->execute();
    }
    catch (PDOException $e) {
        print "エラー : {$e->getMessage()}";
        return;
    }

}

?>