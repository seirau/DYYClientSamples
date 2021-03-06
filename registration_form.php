<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link href="form_style.css" rel="stylesheet">
	<title>手垢登録用紙</title>
</head>
<body>
<?php
$book_id = $_GET["book_id"];

if (!is_null($book_id))
{
	$res = json_decode(file_get_contents("http://49.212.141.66/DYY/list.php?book_id=${book_id}"), true);
	$data = $res[0];
}
?>
	<article>
		<section class="print_page">
			<div id="header">
				<div id="form_title_area">手垢登録用紙</div>
				<div id="nickname_area">
					<div class="head">
						登録者<br>ニックネーム可
					</div>
					<div class="name">
						<?php echo $data["nickname"] ?>
					</div>
					<div class="clear"></div>
				</div><!-- nickname_area -->
				<div id="date_area">
					<?php echo date("発見日　Y年m月d日", strtotime($data["timestamp"])); ?>
				</div>
				<div class="clear"></div>
			</div><!-- header -->
			<hr />

			<div id="wrap">
				<div id="book_info_area">
					<table id="mark">
						<tr>
							<td class="head">名称</td>
							<td class="value"><?php echo $data["title"]; ?></td>
							<td class="head">分類</td>
							<td class="value"><?php echo implode(", ", $data["categories"]); ?></td>
						</tr>
						<tr>
							<td class="head">場所</td>
							<td class="value"><?php echo implode(", ", $data["mark_positions"]); ?></td>
							<td class="head">特徴</td>
							<td class="value"><?php echo implode(", ", $data["characteristics"]); ?></td>
						</tr>
						<tr>
							<td class="head">種類</td>
							<td class="value"><?php echo implode(", ", $data["types"]); ?></td>
							<td class="head">パターン</td>
							<td class="value"><?php echo implode(", ", $data["patterns"]); ?></td>
						</tr>
						<tr>
							<td class="head">色</td>
							<td class="value"><?php echo implode(", ", $data["colors"]); ?></td>
							<td class="head">形<br><span>吹き出し・点線など詳細を記入</span></td>
							<td class="value"><?php echo implode(", ", $data["shapes"]); ?></td>
						</tr>
						<tr>
							<td class="head">その他<br>特記事項<br><span>手垢のつき方など特徴的な部分を記入</span></td>
							<td colspan="3" class="other_column"><?php echo $data["note"]; ?></td>
						</tr>
					</table>
					<div align="center">本の情報</div>
					<table id="information">
						<tr>
							<td class="head">書名</td>
							<td class="value"><?php echo $data["book_title"]; ?></td>
							<td class="head">作者</td>
							<td class="value"><?php echo $data["author"]; ?></td>
						</tr>
						<tr>
							<td class="head">出版社</td>
							<td class="value"><?php echo $data["publisher"]; ?></td>
							<td class="head">印刷年</td>
							<td class="value"><?php echo $data["year"]; ?></td>
						</tr>
						<tr>
							<td class="head">形態</td>
							<td class="value"><?php echo $data["form"]; ?></td>
							<td class="head">素材</td>
							<td class="value"><?php echo $data["subject"]; ?></td>
						</tr>
						<tr>
							<td class="head">発見場所</td>
							<td colspan="3" class="value"><?php echo $data["discovered_place"]; ?></td>
						</tr>
					</table>

					<table id="note">
						<tr>
							<td class="head">所感<br><span>感想などを自由に記入</span></td>
							<td class="other_column"><?php echo $data["comment"]; ?></td>
						</tr>
					</table>
				</div><!-- book_info_area -->
				<div id="book_picture_area">
					<?php
						$urls = explode(",", $data["url"]);
						$i = 0;
						foreach ($urls as $url)
						{
							if ($i < 2)
							{
								$url = trim($url);
								$contents = htmlspecialchars(file_get_contents($url));
								preg_match('/https:\/\/farm.\.staticflickr\.com\/.*_z\.jpg/', $contents, $matches, PREG_OFFSET_CAPTURE);

								echo '<img src="'.$matches[0][0].'" width="390px">';
							}
							$i++;
						}
					?>
				</div>
				<div class="clear"></div>
			</div>
		</section>
	</article>
</body>
</html>