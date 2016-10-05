<div class="span12">
	<div class="span8">
	<?php if ($comment !== null) echo "<br /><h4>${comment}</h4><br /><br />"; ?>
	<br />
		<h4>データベースに追加するデータを選択してください</h4>
		<hr>
		<br />
		<form class="form-vertical" action="./insert" enctype="multipart/form-data" method="post" accept-charset="">
			<input type="file" name="data[Control][file_name]" />
			<br /><br />
			<button class="btn btn-primary" type="submit">データ追加</button>
		</form>
	</div>
</div>
<span>　</span>