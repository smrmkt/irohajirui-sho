<?php echo $error_msg; ?>
<?php if ($session->check("Message.auth")) $session->flash("auth"); ?>
<div class="span12">
	<div class="span8">
		<form action='./change' method='post'>
			<table class="table">
				<thead>
					<tr>
						<th colspan="2">新しいパスワードを入力してください</th>
					</tr>
					<tr>
						<td style="padding-top: 12px;">新しいパスワード</td>
						<td><input class="query" type="password" name="password" /></td>
					</tr>
					<tr>
						<td style="padding-top: 12px;">新しいパスワード（確認用）</td>
						<td><input class="query" type="password" name="password_cfr" /></td>
					</tr>
					<tr>
						<td colspan="2"></td>
					</tr>
				</thead>
			</table>
			<button class="btn btn-primary" type="submit">変更</button>
		</form>
	</div>
</div>
<spa>　</span>
