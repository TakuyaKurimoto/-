<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>その年収だとどんな生活？理想の生活には年収がいくら必要か計算してみよう！</title>
</head>
<body>
<?php 
	// DB接続設定
$dsn = '';
$user = '';
$password = '';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));
$sql = "CREATE TABLE IF NOT EXISTS nensyu"
	." ("
	. "name char(32),"
	. "yachin char(32),"
	. "konetsuhi char(32),"
	. "syokuhi char(32),"
	. "tsushinhi char(32),"
	. "zakkadai char(32),"
	. "kosaihi char(32),"
	. "yohukudai char(32),"
	. "shiokuri char(32),"
	. "tyokin char(32),"
	. "sonota char(32),"
	. "sekatsuhi char(32),"
	. "nensyu char(32),"
	. "tedori char(32),"
	. "sagaku char(32)"
	.");";
	$stmt = $pdo->query($sql);
	
	$name= ($_POST["name"]);
	$nensyu= ($_POST["nensyu"]);
	$yachin= ($_POST["yachin"]);
    $konetsuhi = ($_POST["konetsuhi"]);
    $syokuhi= ($_POST["syokuhi"]);
    $tsushinhi = ($_POST["tsushinhi"]);
    $zakkadai= ($_POST["zakkadai"]);
    $kosaihi= ($_POST["kosaihi"]);
    $yohukudai= ($_POST["yohukudai"]);
    $shiokuri= ($_POST["shiokuri"]);
    $tyokin= ($_POST["tyokin"]);
    $sonota= ($_POST["sonota"]);
    $sekatsuhi=($yachin+$konetsuhi+$syokuhi+$tsushinhi+$zakkadai+$kosaihi+$yohukudai+$shiokuri+$tyokin+$sonota)/10000;
    
    if ($nensyu<=330){
        $tedori=$nensyu/12*0.8;
    }
    elseif($nensyu<=695){
        $tedori=$nensyu/12*0.775;
    }
    elseif($nensyu<=1000){
        $tedori=$nensyu/12*0.745;
    }
    elseif($nensyu<=3000){
        $tedori=$nensyu/12*0.6;
    }
    else{
        $tedori=$nensyu/12*0.5;
    }
if(isset($_POST["share"])){  
$sql = $pdo -> prepare("INSERT INTO nensyu (name, yachin, konetsuhi, syokuhi,tsushinhi, zakkadai,kosaihi,yohukudai,shiokuri,tyokin,sonota,sekatsuhi,nensyu,tedori,sagaku) VALUES (:name, :yachin, :konetsuhi, :syokuhi, :tsushinhi,:zakkadai,:kosaihi,:yohukudai,:shiokuri,:tyokin,:sonota,:sekatsuhi,:nensyu,:tedori,:sagaku)");
	$sql -> bindParam(':name', $name, PDO::PARAM_STR);//strで文字列だと指定
	$sql -> bindParam(':yachin', $yachin, PDO::PARAM_STR);
	$sql -> bindParam(':konetsuhi', $konetsuhi, PDO::PARAM_STR);
	$sql -> bindParam(':syokuhi', $syokuhi, PDO::PARAM_STR);
	$sql -> bindParam(':tsushinhi', $tsushinhi, PDO::PARAM_STR);
	$sql -> bindParam(':zakkadai', $zakkadai, PDO::PARAM_STR);
	$sql -> bindParam(':kosaihi', $kosaihi, PDO::PARAM_STR);
	$sql -> bindParam(':yohukudai', $yohukudai, PDO::PARAM_STR);
	$sql -> bindParam(':shiokuri', $shiokuri, PDO::PARAM_STR);
	$sql -> bindParam(':tyokin', $tyokin, PDO::PARAM_STR);
	$sql -> bindParam(':sonota', $sonota, PDO::PARAM_STR);
	$sql -> bindParam(':sekatsuhi', $sekatsuhi, PDO::PARAM_STR);
	$sql -> bindParam(':nensyu', $nensyu, PDO::PARAM_STR);
	$sql -> bindParam(':tedori', $tedori, PDO::PARAM_STR);
	$sql -> bindParam(':sagaku', $sagaku, PDO::PARAM_STR);
	$sql -> execute(); 
}   


?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>その年収だとどんな生活？理想の生活には年収がいくら必要か計算してみよう！</title>
</head>
<body>
    年収と生活費を入力するだけで、ひと月あたりの生活費と手取り給料の差額を計算することができます！(手取り給料とは、年収から税金などを引いた実際に貰える額のこと)<br>
    
    <form action="" method="post">
        *単位：万円<br>
        <table border="1">
    <tr>
      <th>年収</th>
      <th><input type="float" name="nensyu" value="<?php echo$nensyu; ?>">万円</th>
    </tr>
    </table>
    *単位：円<br>
    <table border="1">
    <tr>
        <th>家賃</th>
        <th><input type="float" name="yachin" value="<?php echo$yachin; ?>">円</th>
    </tr>
    <tr>
        <th>水道光熱費</th>
        <th><input type="float" name="konetsuhi" value="<?php echo$konetsuhi; ?>">円</th>
    </tr>
    <tr>
        <th>食費</th>
        <th><input type="float" name="syokuhi" value="<?php echo$syokuhi; ?>">円</th>
    </tr>
    <tr>
        <th>通信費</th>
        <th><input type="float" name="tsushinhi"value="<?php echo$tsushinhi; ?>">円</th>
    </tr>
    <tr>
        <th>雑貨代</th>
        <th><input type="float" name="zakkadai" value="<?php echo$zakkadai; ?>">円</th>
    </tr>
    <tr>
        <th>交際/娯楽費</th>
        <th><input type="float" name="kosaihi" value="<?php echo$kosaihi; ?>">円</th>
    </tr>
    <tr>
        <th>洋服代</th>
        <th><input type="float" name="yohukudai" value="<?php echo$yohukudai; ?>">円</th>
    </tr>
    <tr>
        <th>仕送り</th>
        <th><input type="float" name="shiokuri" value="<?php echo$shiokuri; ?>">円</th>
    </tr>
    <tr>
        <th>貯金</th>
        <th><input type="float" name="tyokin" value="<?php echo$tyokin; ?>">円</th>
    </tr>
    <tr>
        <th>その他経費</th>
        <th><input type="float" name="sonota" value="<?php echo$sonota; ?>">円</th>
    </tr>
    </table>
        <input type="submit" name="submit" value="結果をチェック"><br>
    ＊年収はボーナスを含めた額を入力してください。「会社名　年収」で検索すると出てきます。<br>
    ＊都内の会社に通勤する人の家賃は6~10万円が一般的<br>
    ＊都内の会社に通勤する人の水道光熱費は平均9000円<br>
    ＊通信費は大手キャリアスマホの場合平均7000~10000円<br>
    ＊その他経費には交通費や教養・教育費などが入ります<br>
    ＊手取り金額は会社や地域によって若干の誤差があります<br><br>

    あなたのひと月あたりの①手取りは<input type="float" name="nensyu1" value="<?php
    echo $tedori;
    ?>">万円,
    ②生活費は<input type="float" name="tedori1" value="<?php
    echo $sekatsuhi;
    ?>">万円,
    ①-②は
    <input type="float" name="tedori" value="<?php
    echo $tedori-$sekatsuhi;
    ?>">万円です<br>
    


 
    
    
    
        <input type="submit" name="share" value="結果をシェアする">
        <input type="text" name="name" placeholder="ニックネームを入力"><br><br>
        〜他の人はこんな結果になりました〜
    </form>
<?php
$sql = 'SELECT * FROM nensyu';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		
        echo $row['name']."さんの結果(年収:".$row['nensyu'].'万円,'.
		     "手取り:".$row['tedori'].'万円,'.
		     "生活費:".$row['sekatsuhi'].'万円'."<br>".
		     "(内訳:家賃:".$row['yachin'].'円,'.
		     "水道光熱費:".$row['konetsuhi'].'円,'.
		     "食費:".$row['syokuhi'].'円,'.
		     "通信費:".$row['tsushinhi'].'円,'.
		     "雑貨代:".$row['zakkadai'].'円,'.
		     "交際/娯楽費:".$row['kosaihi'].'円,'.
		     "洋服代:".$row['yohukudai'].'円,'.
		     "仕送り:".$row['shiokuri'].'円,'.
		     "貯金:".$row['tyokin'].'円）'.
	     	"<br>"."<br>";
		
	
	}
?>
    </style>
</body>
</html>
