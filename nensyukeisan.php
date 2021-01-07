<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>その年収だとどんな生活？理想の生活には年収がいくら必要か計算してみよう！</title>
</head>
<body>
<?php 
	// DB接続設定
$dsn = 'mysql:dbname=tb221060db;host=localhost';
$user = 'tb-221060';
$password = 'kwsWVbySb8';
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
    
    $tyokin=$tedori-$sekatsuhi;
if(isset($_POST["submit"])){  
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
    <div style="text-alingn:center">
<p style="width:70%; margin-left:auto;margin-right:auto;text-align:left;">

    ＊年収と生活費を入力するだけで、ひと月あたりの生活費と手取り給料の差額を計算し、いくら貯金できるか分かります。<br>
    ＊年収から医療保険・年金・所得税などが差し引かれた、実際に自分の手元に入る給料のことを手取り給料と言います。<br>
    </p>
    </div>
    <div style="text-align: center">
    

    <form action="" method="post">
        *単位：万円<br>
        <table border="1" align="center">
    <tr>
      <th>年収</th>
      <th><input type="float" name="nensyu" value="<?php echo$nensyu; ?>">万円</th>
    </tr>
    </table>
    *単位：円<br>
    <table border="1" align="center">
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
        <th>その他経費</th>
        <th><input type="float" name="sonota" value="<?php echo$sonota; ?>">円</th>
    </tr>
    </table>
        <input type="submit" name="submit" value="結果をチェック"><br>
    <div style="text-alingn:center">
    <p style="width:70%; margin-left:auto;margin-right:auto;text-align:left;">

    ＊年収はボーナスを含めた額を入力してください。「会社名　年収」で検索すると出てきます。<br>
    ＊都内の会社に通勤する人の家賃は6~10万円が一般的です。<br>
    ＊都内の会社に通勤する人の水道光熱費は平均9000円です。<br>
    ＊通信費は大手キャリアスマホの場合平均7000~10000円です。<br>
    ＊その他経費には交通費や教養・教育費などが入ります。<br>
    ＊手取り給料は、配偶者・子供がいない場合を想定して計算しています。<br>
    ＊手取り年収はあくまで推定値です。同じ年収でも会社や地域などによって、手取り年収には若干の誤差が生じます。<br><br>

    あなたのひと月あたりの<br>
    ①手取りは<input type="float" name="nensyu1" value="<?php
    echo number_format($tedori, 1);
    ?>">万円です。<br>
    ②生活費は<input type="float" name="tedori1" value="<?php
    echo number_format($sekatsuhi, 1);
    ?>">万円です。<br>
    貯金額（①-②）は
    <input type="float" name="tedori" value="<?php
    echo number_format($tyokin, 1);
    ?>">万円です。<br>
    </p>
    <div>


 
    
    
    
        〜他の人はこんな結果になりました〜<br><br>
        </div>
    </form>
<?php
             $nensyu0=0;
		     $nensyu200=0;
		     $nensyu400=0;
		     $nensyu600=0;
		     $nensyu800=0;
		     $nensyu1000=0;
		     
		     $sekatsuhi0=0;
		     $sekatsuhi14=0;
		     $sekatsuhi17=0;
		     $sekatsuhi20=0;
		     $sekatsuhi23=0;
		     $sekatsuhi26=0;
		     
		     $tyokin0=0;
		     $tyokin2=0;
		     $tyokin4=0;
		     $tyokin6=0;
		     $tyokin8=0;
		     
		     $yachin0=0;
		     $yachin4=0;
		     $yachin6=0;
		     $yachin8=0;
		     $yachin10=0;
		     
		     $konetsuhi0=0;
		     $konetsuhi5=0;
		     $konetsuhi10=0;
		     
		     $syokuhi0=0;
		     $syokuhi3=0;
		     $syokuhi4=0;
		     $syokuhi5=0;
		     $syokuhi6=0;
		     $syokuhi7=0;
		     
		     $tsushinhi0=0;
		     $tsushinhi5=0;
		     $tsushinhi10=0;
		     
		     $zakkadai0=0;
		     $zakkadai5=0;
		     $zakkadai10=0;
		     $zakkadai20=0;
		     
		     $kosaihi0=0;
		     $kosaihi1=0;
		     $kosaihi2=0;
		     $kosaihi3=0;
		     $kosaihi4=0;
		     $kosaihi5=0;
		     
		     $yohukudai0=0;
		     $yohukudai1=0;
		     $yohukudai2=0;
		     $yohukudai3=0;
		     
		     $shiokuri0=0;
		     $shiokuri1=0;
		     $shiokuri2=0;
		     $shiokuri3=0;
		     
$sql = 'SELECT * FROM nensyu';
	$stmt = $pdo->query($sql);
	$results = $stmt->fetchAll();
	foreach ($results as $row){
		//$rowの中にはテーブルのカラム名が入る
		     
		     
		     if($row['nensyu']<200){
		         $nensyu0+=1;
		     }elseif($row['nensyu']<400){
		         $nensyu200+=1;
		     }elseif($row['nensyu']<600){
		         $nensyu400+=1;
		     }elseif($row['nensyu']<800){
		         $nensyu600+=1;
		     }elseif($row['nensyu']<1000){
		         $nensyu800+=1;
		     }else{
		         $nensyu1000+=1;
		     }
		     
		     if($row['sekatsuhi']<14){
		         $sekatsuhi0+=1;
		     }elseif($row['sekatsuhi']<17){
		         $sekatsuhi14+=1;
		     }elseif($row['sekatsuhi']<20){
		         $nensyu17+=1;
		     }elseif($row['sekatsuhi']<23){
		         $sekatsuhi20+=1;
		     }elseif($row['sekatsuhi']<26){
		         $sekatsuhi23+=1;
		     }else{
		         $sekatsuhi26+=1;
		     }
		     
		     if($row['tyokin']<0){
		         $tyokin0+=1;
		     }elseif($row['tyokin']<2){
		         $tyokin2+=1;
		     }elseif($row['tyokin']<4){
		         $tyokin4+=1;
		     }elseif($row['tyokin']<6){
		         $tyokin6+=1;
		     }else{
		         $tyokin8+=1;
		     }
		     
		     if($row['yachin']<40000){
		         $yachin0+=1;
		     }elseif($row['yachin']<60000){
		         $yachin4+=1;
		     }elseif($row['yachin']<80000){
		         $yachin6+=1;
		     }elseif($row['yachin']<10000){
		         $yachin8+=1;
		     }else{
		         $yachin10+=1;
		     }
		     
		     if($row['konetsuhi']<5000){
		         $konetsuhi0+=1;
		     }elseif($row['konetsuhi']<10000){
		         $konetsuhi5+=1;
		     }else{
		         $konetsuhi10+=1;
		     }
		     
		     if($row['syokuhi']<30000){
		         $syokuhi0+=1;
		     }elseif($row['syokuhi']<40000){
		         $syokuhi3+=1;
		     }elseif($row['syokuhi']<50000){
		         $syokuhi4+=1;
		     }elseif($row['syokuhi']<60000){
		         $syokuhi5+=1;
		     }elseif($row['syokuhi']<70000){
		         $syokuhi6+=1;
		     }else{
		         $syokuhi7+=1;
		     }
		     
		     if($row['tsushinhi']<5000){
		         $tsushinhi0+=1;
		     }elseif($row['tsushinhi']<10000){
		         $tsushinhi5+=1;
		     }else{
		         $tsushinhi10+=1;
		     }
		     
		     if($row['zakkadai']<5000){
		         $zakkadai0+=1;
		     }elseif($row['zakkadai']<10000){
		         $zakkadai5+=1;
		     }elseif($row['zakkadai']<20000){
		         $zakkadai10+=1;
		     }else{
		         $zakkadai20+=1;
		     }
		     
		     if($row['kosaihi']<10000){
		         $kosaihi0+=1;
		     }elseif($row['kosaihi']<20000){
		         $kosaihi1+=1;
		     }elseif($row['kosaihi']<30000){
		         $kosaihi2+=1;
		     }elseif($row['kosaihi']<40000){
		         $kosaihi3+=1;
		     }elseif($row['kosaihi']<50000){
		         $kosaihi4+=1;
		     }else{
		         $kosaihi5+=1;
		     }
		     
		     if($row['yohukudai']<10000){
		         $yohukudai0+=1;
		     }elseif($row['yohukudai']<20000){
		         $yohukudai1+=1;
		     }elseif($row['yohukudai']<30000){
		         $yohukudai2+=1;
		     }else{
		         $yohukudai3+=1;
		     }
		     
	     	if($row['shiokuri']<10000){
		         $shiokuri0+=1;
		     }elseif($row['shiokuri']<20000){
		         $shiokuri1+=1;
		     }elseif($row['shiokuri']<30000){
		         $shiokuri2+=1;
		     }else{
		         $shiokuri3+=1;
		     }
		
	
	}
	$nensyuSum=$nensyu0+$nensyu200+$nensyu400+$nensyu600+$nensyu800+$nensyu1000;
    $sekatsuhiSum=$sekatsuhi0+$sekatsuhi14+$sekatsuhi17+$sekatsuhi20+$sekatsuhi23+$sekatsuhi26;
    $tyokinSum=$tyokin0+$tyokin2+$tyokin4+$tyokin6+$tyokin8;
    $yachinSum=$yachin0+$yachin4+$yachin6+$yachin8+$yachin10;
    $konetsuhiSum=$konetsuhi0+$konetsuhi5+$konetsuhi10;
    $syokuhiSum=$syokuhi0+$syokuhi3+$syokuhi4+$syokuhi5+$syokuhi6+$syokuhi7;
    $tsushinhiSum=$tsushinhi0+$tsushinhi5+$tsushinhi10;
    $zakkadaiSum=$zakkadai0+$zakkadai5+$zakkadai10+$zakkadai20;
    $kosaihiSum=$kosaihi0+$kosaihi1+$kosaihi2+$kosaihi3+$kosaihi4+$kosaihi5;
    $yohukudaiSum=$yohukudai0+$yohukudai1+$yohukudai2+$yohukudai3;
    $shiokuriSum=$shiokuri0+$shiokuri1+$shiokuri2+$shiokuri3;
    
?>
    </style>
    
    <table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>年収分布(%)</caption>

<?php
//参考https://webings.net/php/graph/
    
    $data = array(                        //　グラフ作成用データ
            array("~200万円", "$nensyu0"/"$nensyuSum"*"100"),
            array("200万円~400万円","$nensyu200"/"$nensyuSum"*"100"),
            array("400万円~600万円", "$nensyu400"/"$nensyuSum"*"100"),
            array("600万円~800万円", "$nensyu600"/"$nensyuSum"*"100"),
            array("800万円~1000万円", "$nensyu800"/"$nensyuSum"*"100"),
            array("1000万円~", "$nensyu1000"/"$nensyuSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>", 30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>生活費分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~14万円", "$sekatsuhi0"/"$sekatsuhiSum"*"100"),
            array("14万円~17万円", "$sekatsuhi14"/"$sekatsuhiSum"*"100"),
            array("17万円~20万円","$sekatsuhi17"/"$sekatsuhiSum"*"100"),
            array("20万円~23万円", "$sekatsuhi20"/"$sekatsuhiSum"*"100"),
            array("23万円~26万円", "$sekatsuhi23"/"$sekatsuhiSum"*"100"),
            array("26万円~", "$sekatsuhi26"/"$sekatsuhiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>", 30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>

</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>貯金額分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~0万円", "$tyokin0"/"$tyokinSum"*"100"),
            array("0万円~2万円", "$tyokin2"/"$tyokinSum"*"100"),
            array("2万円~4万円","$tyokin4"/"$tyokinSum"*"100"),
            array("4万円~6万円", "$tyokin6"/"$tyokinSum"*"100"),
            array("6万円~", "$tyokin8"/"$tyokinSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>", 30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>

</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>家賃分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~4万円", "$yachin0"/"$yachinSum"*"100"),
            array("4万円~6万円","$yachin4"/"$yachinSum"*"100"),
            array("6万円~8万円", "$yachin6"/"$yachinSum"*"100"),
            array("8万円~10万円", "$yachin8"/"$yachinSum"*"100"),
            array("10万円~", "$yachin10"/"$yachinSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>", 30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>

</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>水道光熱費分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~5000円", "$konetsuhi0"/"$konetsuhiSum"*"100"),
            array("5000円~1万円", "$konetsuhi5"/"$konetsuhiSum"*"100"),
            array("1万円~","$konetsuhi10"/"$konetsuhiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>",30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>

</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>食費分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~3万円", "$syokuhi0"/"$syokuhiSum"*"100"),
            array("3万円~4万円", "$syokuhi3"/"$syokuhiSum"*"100"),
            array("4万円~5万円","$syokuhi4"/"$syokuhiSum"*"100"),
            array("5万円~6万円", "$syokuhi5"/"$syokuhiSum"*"100"),
            array("6万円~7万円", "$syokuhi6"/"$syokuhiSum"*"100"),
            array("7万円~", "$syokuhi7"/"$syokuhiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>",30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>通信費分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~5000円", "$tsushinhi0"/"$tsushinhiSum"*"100"),
            array("5000円~1万円", "$tsushinhi5"/"$tsushinhiSum"*"100"),
            array("1万円~","$tsushinhi10"/"$tsushinhiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>", 30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>雑貨代分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~5000円", "$zakkadai0"/"$zakkadaiSum"*"100"),
            array("5000円~1万円", "$zakkadai5"/"$zakkadaiSum"*"100"),
            array("1万円~2万円", "$zakkadai10"/"$zakkadaiSum"*"100"),
            array("2万円~","$zakkadai20"/"$zakkadaiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>",30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>交際/娯楽費分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~1万円", "$kosaihi0"/"$kosaihiSum"*"100"),
            array("1万円~2万円", "$kosaihi1"/"$kosaihiSum"*"100"),
            array("2万円~3万円", "$kosaihi2"/"$kosaihiSum"*"100"),
            array("3万円~4万円", "$kosaihi3"/"$kosaihiSum"*"100"),
            array("4万円~5万円", "$kosaihi4"/"$kosaihiSum"*"100"),
            array("5万円~","$kosaihi5"/"$kosaihiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>",30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>洋服代分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~1万円", "$yohukudai0"/"$yohukudaiSum"*"100"),
            array("1万円~2万円", "$yohukudai1"/"$yohukudaiSum"*"100"),
            array("2万円~3万円", "$yohukudai2"/"$yohukudaiSum"*"100"),
            array("3万円~","$yohukudai3"/"$yohukudaiSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen *8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>",30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
<br>
<table width="70%" align="center" border="1" rules="none" bordercolor="#000099" cellspacing="0">
<caption>仕送り額分布(%)</caption>

<?php
    $data = array(                        //　グラフ作成用データ
            array("~1万円", "$shiokuri0"/"$shiokuriSum"*"100"),
            array("1万円~2万円", "$shiokuri1"/"$shiokuriSum"*"100"),
            array("2万円~3万円", "$shiokuri2"/"$shiokuriSum"*"100"),
            array("3万円~","$shiokuri3"/"$shiokuriSum"*"100"));
    for($i = 0 ; $i < count($data) ; $i++) {
        if(strlen($data[$i][0]) > $maxlen) {        //　文字数最大
            $maxlen = strlen($data[$i][0]);
        }
        if($data[$i][1] > $max) {            //　データ最大
            $max = $data[$i][1];
        }
    }
    for($i = 0 ; $i < count($data) ; $i++) {        //　グラフ作成
        print("<tr>");
        printf("<td width=\"%d\" align=\"right\">%s</td>", $maxlen * 8, $data[$i][0]);
        printf("<td><hr size=\"10\" color=\"#cc6633\" align=\"left\" width=\"%d%%\"></td>", $data[$i][1] / $max * 100);
        printf("<td width=\"%d\">%d</td>",30, $data[$i][1]."%");
        print("</tr>\n");
    }
?>
</table>
</body>
</html>