<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="./">色葉字類抄データベース</a>
			<div class="nav-collapse collapse">
				<ul class="nav pull-right">
					<li class="">
						<a href="./about">使いかた</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>

<form class="form-search" name="search" action="./search" method="post">
<div class="span12">
	<table>
		<thead>
			<tr>
				<th>
					<div style="padding-bottom:20px;">
						「見出し語」か「読み」を入力してください．
					</div>
				</th>
			</tr>
			<tr>
				<td>
					<div style="padding-left:20px;">
						<input type="text" class=".span3" name="query" value="<?php echo $query; ?>">
						<button type="submit" class="btn btn-primary">検 索</button>
					</div>
				</td>
			</tr>
		</thead>
	</table>
</div>
<div class="span12" style="padding-bottom:80px">
	<div style="padding:10px 0px 0px 20px;">
		<a href="#" data-toggle="collapse" data-target="#option">
			 条件で絞り込む
		</a>
		<div id="option" class="collapse in">
			<div style="padding:10px 0px 0px 20px;">
				<table>
						<thead>
							<tr>
								<td>所属篇</td>
								<td>
									<select class='span2' name='syozokuhen' onChange='document.search.submit()'>
										<option value=''>--　　　　　　</option>
										<?php
										foreach ($iroha_chars as $c) {
											echo "<option value='${c}'";
											if ($syozokuhen === $c) echo " selected";
											echo ">${c}</option>";
										}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td>所属部</td>
								<td>
									<select class='span2' name='syozokubu' onChange='document.search.submit()'>
										<option value=''>--　　　　　　</option>
									<?php
									foreach ($syozokubus as $s) {
										echo "<option value='${s}'";
										if ($syozokubu === $s) echo " selected";
										echo ">${s}</option>";
									}
									?>
									</select>
								</td>
							</tr>
							<tr>
								<td>漢字数</td>
								<td>
									<select class='span2' name='mojisuu' onChange='document.search.submit()'>
										<option value=''>--　　　　　　</option>
									<?php
									for ($i = 1; $i <= 6; $i++) {
										echo "<option value='${i}'";
										if (intval($mojisuu) === $i) echo " selected";
										echo ">${i}</option>";
									}
									?>
									</select>
								</td>
							</tr>
						</thead>
					</table>
				</div>
			</div>
	</div>
</div>
</form>

<!-- 
<ul class="nav nav-tabs" id="myTab">
	<li class="active"><a href="#search">検索</a></li>
	<li><a href="#option">オプション</a></li>
</ul>

<form class="form-search" action="./search" method="post">
	<div class="tab-content">
		<div class="tab-pane active" id="search" style="height:100px;">
			<div class="span8">
		    	<table class="table">
					<thead>
						<tr><th>「見出し語」か「読み」を入力してください．</th></tr>
						<tr>
							<td>
								<input type="text" class=".span3" name="query" value="<?php echo $query; ?>">
								<button type="submit" class="btn btn-primary">検 索</button>
							</td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
		<div class="tab-pane" id="option" style="height:100px;">
			<div class="span8">
		    	<table class="table">
					<thead>
						<tr>
							<th>所属篇</th>
							<th>所属部</th>
							<th>漢字数</th>
						</tr>
						<tr>
							<td>
								<select class='span2' name='syozokuhen'>
									<option value=''>--　　　　　　</option>
									<?php
									foreach ($iroha_chars as $c) {
										echo "<option value='${c}'";
										if ($syozokuhen === $c) echo " selected";
										echo ">${c}</option>";
									}
									?>
								</select>
							</td>
							<td>
								<select class='span2' name='syozokubu'>
									<option value=''>--　　　　　　</option>
									<?php
									foreach ($syozokubus as $s) {
										echo "<option value='${s}'";
										if ($syozokubu === $s) echo " selected";
										echo ">${s}</option>";
									}
									?>
								</select>
							</td>
							<td>
								<select class='span2' name='mojisuu'>
									<option value=''>--　　　　　　</option>
									<?php
									for ($i = 1; $i <= 6; $i++) {
										echo "<option value='${i}'";
										if (intval($mojisuu) === $i) echo " selected";
										echo ">${i}</option>";
									}
									?>
								</select>
							</td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</form>

<script>
	$('#myTab a').click(function (e) {
		e.preventDefault();
    	$(this).tab('show');
	})
</script>

-->
									
<?php // 検索結果の表示
// 検索結果のヘッダ
echo '<div style="padding-top:20px;"></div>';
if (($total =$ycount + $mcount) > 0) {
	echo "<h5>${total}件の検索結果</h5>";
	echo '<hr>';
	echo '<div style="padding-top:10px;"></div>';
} else {
	echo "<h4>${query}に一致する結果はみつかりませんでした．検索ワードを変えてもう一度試してください</h4>";
	echo '<div style="padding-top:60px;"></div>';
}

// 読みの結果出力
$cnt = 1;
if ($ycount > 0) {
	echo '<div class="row">';
	foreach ($yomis as $yomi) {
		$midashigo = $yomi["IrohaData"]["midashigo"];
		
		// 書き出し
		echo '<div class="span4">';
		echo '<span class="badge badge-important">' . $cnt++ . '</span>';
		echo '<div style="padding-bottom:10px;"></div>';
		echo '<div class="well">';
		echo "<h3>${midashigo}</h3>";
		echo '<table class="table">';
		foreach ($columns as $key => $value) {
			echo '<tr>';
			echo "<td style='min-width:80px;'>${value}</td>";
			if (($column = $yomi["IrohaData"][$key]) !== "") echo "<td>${column}</td>";
			else echo "<td>-</td>";
			echo '</td>';
		}
		for ($i = 1; $i <= 3; $i++) {
			list($key, $value) = $searchResult->getItaiji($yomi, $i);
			if ($key !== null) {
				echo '<tr><td>';
				echo $searchResult->getChar($i);
				echo '</td><td>';
				if ($key === 'img') echo $html->image($value, array('width' => 30, 'height' => 30));
				else echo $value;
				echo '</td></tr>';
			}
		}
		if (($column = $yomi["IrohaData"]["sakuseisya_chuu"]) !== "") {
			echo "<tr><td>作成者注</td><td>${column}</td></tr>";
		}
		echo '</table>';
		echo "</div>";
		echo "</div>";
		if ($cnt % 3 === 1) echo '<div class="span12"></div>';
	}
	echo '</div>';
}

// 見出し語の結果出力
$cnt = 1;
if ($mcount > 0) {
	echo '<div class="row">';
	foreach ($midashis as $midashi) {
		// データの取得
		$midashigo =  $midashi["IrohaData"]["midashigo"];
		
		// 書き出し
		echo '<div class="span4">';
		echo '<span class="badge badge-important">' . $cnt++ . '</span>';
		echo '<div style="padding-bottom:10px;"></div>';
		echo '<div class="well">';
		echo "<h3>${midashigo}</h3>";
		echo '<table class="table">';
		foreach ($columns as $key => $value) {
			echo '<tr>';
			echo "<td>${value}</td>";
			if (($column = $midashi["IrohaData"][$key]) !== "") echo "<td>${column}</td>";
			else echo "<td>-</td>";
			echo '</td>';
		}
		for ($i = 1; $i <= 3; $i++) {
			list($key, $value) = $searchResult->getItaiji($midashi, $i);
			if ($key !== null) {
				echo '<tr><td>';
				echo $searchResult->getChar($i);
				echo '</td><td>';
				if ($key === 'img') echo $html->image($value, array('width' => 18, 'height' => 18));
				else echo $value;
				echo '</td></tr>';
			}
		}
		if (array_key_exists("IrohaData", $midashis)) {
			if (($column = $midashi["IrohaData"]["sakuseisya_chuu"]) !== "") {
				echo "<tr><td>作成者注</td><td>${column}</td></tr>";
			}
		}
		echo '</table>';
		echo "</div>";
		echo "</div>";
	}
	echo '</div>';
}
?>
