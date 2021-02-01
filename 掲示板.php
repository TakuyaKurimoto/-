<!DOCTYPE html>

<!--練習-->


<?php 
	// DB接続設定
$dsn = 'データベース名';
$user = 'ユーザー名';
$password = 'パスワード';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "CREATE TABLE IF NOT EXISTS mission5"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
	. "name char(32),"
	. "time char(32),"
	. "comment TEXT,"
	."password char(32)"
	.");";
	$stmt = $pdo->query($sql);
	
	$name= ($_POST["namae"]);
    $comment = ($_POST["comment"]);
//日付データを取得
    $postedAt = date("Y年m月d日 H:i:s");
    $password1=($_POST["password1"]);
    
//通常入力
//もしフォームが空じゃなかったら書き込みをする
if (empty($name)==false&&empty($comment)==false&&empty($password1)==false &&empty($_POST["hidden"])==true){
 
$sql = $pdo -> prepare("INSERT INTO mission5 (id, name, time, comment, password) VALUES (:id, :name, :time, :comment, :password)");
	$sql -> bindParam(':id', $did, PDO::PARAM_STR);//strで文字列だと指定
	$sql -> bindParam(':name', $dname, PDO::PARAM_STR);
	$sql -> bindParam(':time', $dtime, PDO::PARAM_STR);
	$sql -> bindParam(':comment', $dcomment, PDO::PARAM_STR);
	$sql -> bindParam(':password', $dpassword, PDO::PARAM_STR);
	$dname = $name;
	$dtime = $postedAt;
	$dcomment = $comment; 
	$dpassword = $password1; //好きな名前、好きな言葉は自分で決めること
	$sql -> execute();
}	
	
//削除機能

    $delete=$_POST["delete"];
    $password2=$_POST["password2"];
if (empty($delete)==false) {
    $id = $delete;
    //$idの値を抽出する
    $sql = 'SELECT * FROM mission5 WHERE id=:id ';
    $stmt = $pdo->prepare($sql);                  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute();                            
    $results = $stmt->fetchAll(); 
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		 if($row['password']==$password2){//パスワードが一致したら
		     $sql = 'delete from mission5 where id=:id';
	         $stmt = $pdo->prepare($sql);
	         $stmt->bindParam(':id', $id, PDO::PARAM_INT);
	         $stmt->execute();
		 }
		 else{
		     echo "パスワードが違います";
		 }
	}
}
//削除機能終わり

//編集機能始まり
  $edit=$_POST["edit"];
  $password3=$_POST["password3"];
if(empty($edit)==false){
    $id = $edit;
    //$idの値を抽出する
    $sql = 'SELECT * FROM mission5 WHERE id=:id ';
    $stmt = $pdo->prepare($sql);                  
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute();                            
    $results = $stmt->fetchAll(); 
	foreach ($results as $row){//idが一致するテーブルから値を取り出す
		//$rowの中にはテーブルのカラム名が入る
		 if($row['password']==$password3){
		     $editname=$row['name'];
             $editcomment=$row['comment'];
             $editid=$row['id'];
             $editpassword=$row['password'];
		 }
		 else{
		     echo "パスワードが違います";
		 }
	}
}
  if(empty($_POST["hidden"])==false){//hiddenが空っぽじゃなかったら
  //上書き書き込み
    $id = $_POST["hidden"]; //変更する投稿番号
	 //変更したい名前、変更したいコメントは自分で決めること
	$sql = 'UPDATE mission5 SET name=:name,comment=:comment,password=:password,time=:time WHERE id=:id';
	$stmt = $pdo->prepare($sql);
	$stmt->bindParam(':name', $name, PDO::PARAM_STR);
	$stmt->bindParam(':comment', $comment, PDO::PARAM_STR);
	$stmt->bindParam(':time', $postedAt, PDO::PARAM_STR);
	$stmt->bindParam(':password', $password1, PDO::PARAM_STR);
	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	$stmt->execute();
}
 //編集機能終わり
?>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>mission_3</title>
</head>
<body>
    <form action="" method="post">
        <投稿フォーム><br>名前<br><input type="text" name="namae" value="<?php 
        
  if(empty($edit)==false&&$row['password']==$password3){//編集番号とパスワードが一致したら
  
     echo $editname; 
  } ?>"><br>


      
        コメント<br><input type="text" name="comment" value="<?php 
        
  if(empty($edit)==false&&$row['password']==$password3){//編集番号とパスワードが一致したら
  
     echo $editcomment; 
  } ?>">
        <input type="hidden" name="hidden" value="<?php 
        
  if(empty($edit)==false&&$row['password']==$password3){//編集番号とパスワードが一致したら
  
     echo $editid; 
  } ?>"><br>
        パスワード<br><input type="text" name="password1" value="<?php 
        
  if(empty($edit)==false&&$row['password']==$password3){//編集番号とパスワードが一致したら
  
     echo $editpassword; 
  } ?>">
        <input type="submit" name="submit"><br>
    </form>
    <form action="" method="post">    
<br><削除フォーム><br>削除番号<br><input type="text" name="delete" ><br>
パスワード<br><input type="text" name="password2" >
    <input type="submit" value="削除"><br>
    </form>
    <form action="" method="post">
    <br><編集フォーム><br>編集番号<br><input type="text" name="edit" ><br>
    パスワード<br><input type="text" name="password3">
      <input type="submit" value="編集"><br>
      
      </form>
</body>
</html>



<?php
$sql = 'SELECT * FROM mission5';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		echo $row['id'].',';
		echo $row['name'].',';
		echo $row['time'].',';
		echo $row['comment'];
	echo "<hr>";
	}	

    
?>
