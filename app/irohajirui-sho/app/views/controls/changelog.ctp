<div class="span12">
	<div class="span10">
		<br />
		<h4>更新履歴の編集</h4>
		<hr>
		<br />
		<h5>記法</h5>
		<ul>
			<li>記入形式は，「日付,更新内容」です．日付と更新内容の間は半角カンマで区切ってください</li>
			<li>1つの「日付,更新内容」ごとに改行してください</li>
			<li>1つの「更新内容」の中で改行したい場合には，改行を入れたいところに「&lt;br&gt;」を記入してください</li>
		</ul>
		<br />
		<form action='./changelog' method='post'>
			<textarea name="update_log" style="resize: none; width: 95%; height: 200px;"><?php echo $changelog; ?></textarea>
			<br/>
			<button class='btn btn-primary' type='submit'>更&nbsp;&nbsp;&nbsp;&nbsp;新</button>
		</form>
	</div>
</div>
<span>　</span>