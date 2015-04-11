<div class="span12">
	<div class="span8">
		<form action='./add' method='post'>
			<input type="hidden" name="data[User][authority]" id="UserAuthority" value="user" />	
			<table class="table">
				<thead>
					<tr>
						<th colspan="2">作成するユーザの名前とパスワードを入力してください</th>
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
			<button class="btn btn-primary" type="submit">登録</button>
		</form>
	</div>
</div>
<spa>　</span>