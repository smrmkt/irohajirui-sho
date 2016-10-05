<div class="span12">
	<div class="span8">
		<table  class="table">
			<thead>
				<tr>
					<th colspan="2" class="user">削除するユーザを選んでください</th>
				</tr>
				<?php
				foreach ($users as $user) {
					echo "<tr>";
					echo '<td style="padding-top: 12px;">';
					echo $user["users"]["username"];
					echo '</td>';
					echo '<td style="padding-top: 12px;">';
					if ($user["users"]["authority"] === "user") { 
						echo "<form action='./remove' method='post'>";
						echo "<input type='hidden' name='id' value='{$user["users"]["id"]}'>";
						echo "<button class='btn btn-primary' type='submit'>削除</button>";
						echo "</form>";
					} else {
						echo "管理者";
					}
					echo "</td>";
					echo "</tr>";
				}
				?>
				<tr><td colspan="2"></td></tr>
			</thead>
		</table>
	</div>
</div>
<spa>　</span>