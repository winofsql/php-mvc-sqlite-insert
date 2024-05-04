<!DOCTYPE html>
<html>

<head>
<meta content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" name="viewport">
<meta charset="UTF-8">
<title><?= $tab_title ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">

<style>
    #content {
        background-color: #dddddd;
    }

    .left {
        width: 100px;
    }

    .right {
        width: 300px;
    }

    .entry {
        display: inline-block;
        margin-bottom: 20px;
    }

    h3 a {
        text-decoration: none;
    }
</style>

<script>
$(function(){

    $("#frm").on( "submit", function(event){

        $("#message").text("");

        // 【名前】 未入力チェック
        var name = $("#name").val();
        name = name.replace(/^[\s]+/, "");
        name = name.replace(/[\s]+$/, "");
        if ( name == "" ) {
            $("#message").text("名前が入力されていません");
            $("#name").val( "" );
            $("#name").focus();
            $("#name").select();

            event.preventDefault();
            return;
        }

        // 【レベル】 文字数チェック
        var level = $("#level").val();
        if( level.length > 3 ) {
            $("#message").text("レベルは３桁以内で指定してください");
            $("#level").focus();
            $("#level").select();

            event.preventDefault();
            return;
        }

        // 文字種チェック( 数字のみ )
        var result = level.match(/^[0-9]+$/);
        if (result ==null ){
            $("#message").text("0～999 の数字を入力してください");
            $("#level").focus();
            $("#level").select();

            event.preventDefault();
            return;
        }

        if ( !confirm("更新してもよろしいですか?") ) {
            event.preventDefault();
            return;
        }

    });

});
</script>
</head>

<body>
<h3 class="alert alert-primary"><?= $title ?></h3>
<div id="message" class="ms-3 mb-3"><?= $err_message ?></div>
<div id="content" class="p-4">

    <form id="frm" method="post">

        <section class="body">
            <span class="entry left">名前</span>

            <span class="entry right">
                <input size="50" type="text" name="name" id="name" value="<?= $_POST["name"] ?>">
            </span>
        </section>

        <section class="body">
            <span class="entry left">レベル</span>

            <span class="entry right">
                <input size="5" type="text" name="level" id="level" value="<?= $_POST["level"] ?>">
            </span>
        </section>

        <section class="mt-2">
            <input type="submit" name="btn" id="btn" value="更新" class="btn btn-primary">
        </section>

    </form>

</div>

<div class="m-4">
<pre>
CREATE TABLE players (
  id integer PRIMARY KEY AUTOINCREMENT,
  name varchar(32),
  level integer
)
</div>
</pre>

</body>

</html>