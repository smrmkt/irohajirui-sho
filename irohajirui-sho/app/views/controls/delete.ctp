<?php
if ($type !== null) {
	echo '<div class="span12">';
	echo "<br />";
	if ($type === "search") {
		if ($count == 0) {
			echo "<h4>検索キーワードに当てはまるデータはありませんでした</h4>";
		} else if ($count < 0) {
			echo "<h4>データベースに1件もデータがありません</h4>";
		} else {
			echo "<form name='deletes' action='./delete' method='post'>";
			echo "<input type='hidden' name='type' value='delete' />";
			echo "<input type='hidden' name='count' value='" . $count . "' />";
			echo "<h4>${count}件のデータがみつかりました</h4>";
			echo "<br /><br />";
			echo "<div id='delete'>";
			echo "<table class='delete'><tr>";
			echo "<th class='delete'></th>";
			foreach ($items as $eng => $jap) {
				echo "<th class='delete'>" . $jap . "</th>";
			}
			echo "</tr>";
			$cnt = 0;
			foreach ($results as $result) {
				echo "<tr>";
				echo "<td class='delete'>";
				echo "<input type='hidden' name='id[" . $cnt . "]' value='0'>";
				echo "<input type='checkbox' name='id[" . $cnt++ . "]' value='" . $result["iroha_datas"]["id"] . "'>";
				echo "</td>";
				foreach ($items as $eng => $jap) {
					echo "<td class='delete'>" . $result["iroha_datas"][$eng] . "</td>";				
				}
				echo "</tr>";
			}
			echo "</table>";
			echo "</div>";
			echo "<a href='javascript:void(0)' onclick='box_check(true);'>すべて選択</a>";
			echo "&nbsp;&nbsp;|&nbsp;&nbsp;";
			echo "<a href='javascript:void(0)' onclick='box_check(false);'>すべて未選択</a>";
			echo "<br />";
			echo '<br />';
			echo "<button class='btn btn-primary' type='submit'>削&nbsp;&nbsp;&nbsp;&nbsp;除</button>";
			echo "</form>";
			echo '<hr>';
			echo "<br />";
			echo '<br />';
	}
	} else if ($type === "delete") {
		if ($count < 0) {
			echo "<h4>データの削除に失敗しました</h4>";
		} else if ($count >= 0) {
			echo "<h4>${count}件のデータを削除しました</h4>";
		}
	}
	echo "</div>";
}
?>

<div class="span12">
	<br />
	<h4>削除するデータに含まれる値を入力してください</h4>
	<hr>
	<form class="form-horizontal" action="./delete" method="post">
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
