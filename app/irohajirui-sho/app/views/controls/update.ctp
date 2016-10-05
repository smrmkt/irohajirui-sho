<?php
if ($count !== null) {
	echo '<div class="span12">';
	if ($count == 0) {
		echo "<h4>検索キーワードに当てはまるデータはありませんでした</h4>";
	} else if ($count == -1) {
		echo "<h4>データを正常に更新しました</h4>";
	} else if ($count == -2) {
		echo "<h4>データが正しく更新できませんでした</h4>";
	} else {
		echo "<h4>${count}件のデータがみつかりました</h4>";
		echo "<br /><br />";
		foreach ($results as $result) {
			echo "<form class='form-horizontal' action='./update' method='post'>";
			echo '<fieldset>';
			echo "<input type='hidden' name='type' value='update' />";
			echo "<input type='hidden' name='id' value='" . $result["iroha_datas"]["id"] ."' />";
			foreach ($items as $eng => $jap) {
				echo '<div class="span4">';
				echo '<div class="control-group">';
				echo "<label class=\"control-label\">${jap}</label>";
				echo '<div class="controls">';
				echo "<input class='list' type='text' name='${eng}' value='{$result["iroha_datas"][$eng]}'>";
				echo "</div>";
				echo "</div>";
				echo "</div>";
				echo '<div class="span1">　</div>';
			}
			echo '<br />';
			echo '<div class="span10 offset1">';
			echo '<br />';
			echo '<button class="btn btn-primary" type="submit">更&nbsp;&nbsp;&nbsp;&nbsp;新</button>';
			echo '</div>';
			echo '</fieldset>';
			echo "</form>";
			if (--$count > 0) echo "<hr>";
		}
		if ($count > 0) echo "検索結果が多すぎるため，残り${count}件のデータは省略されました";
	}
	echo "</div>";
}
?>
<div class="span12">
	<br />
	<h4>更新するデータに含まれる値を入力してください</h4>
	<hr>
	<form class="form-horizontal" action="./update" method="post">
		<input type="hidden" name="type" value="search" />
		<input type="hidden" name="id" value="0" />
		<fieldset>
			<?php
				foreach ($items as $eng => $jap) {
					echo '<div class="span4">';
					echo '<div class="control-group">';
					echo "<label class=\"control-label\">${jap}</label>";
					echo '<div class="controls">';
					echo "<input class='list' type='text' name='${eng}' value=''>";
					echo "</div>";
					echo "</div>";
					echo "</div>";
					echo '<div class="span1">　</div>';
				}
				?>
			<br />
			<div class="span10 offset1">
				<br />
				<button class='btn btn-primary' type='submit'>検&nbsp;&nbsp;&nbsp;&nbsp;索</button>
			</div>
		</fieldset>
	</form>
</div>
<span>　</span>