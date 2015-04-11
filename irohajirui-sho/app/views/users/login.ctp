<?php if ($session->check("Message.auth")) $session->flash("auth"); ?>
<?php echo $form->create("User", array("action" => "login")); ?>
<div class="span12">
	<div class="span8">
		<table class="table">
			<thead>
				<tr>
					<th colspan="2">ユーザ名とパスワードを入力してください</th>
				</tr>
				<tr>
					<td style="padding-top: 12px;">ユーザ名</td>
					<td><input class="query" name="data[User][username]" type="text" maxlength="50" id="UserUsername" /></td>
				</tr>
				<tr>
					<td style="padding-top: 12px;">パスワード</td>
					<td><input class="query" type="password" name="data[User][password]" id="UserPassword" /></td>
				</tr>
				<tr>
					<td colspan="2"></td>
				</tr>
			</thead>
		</table>
		<button class="btn btn-primary" type="submit">ログイン</button>
	</div>
</div>
<spa>　</span>