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


<form class="form-search" action="./search" method="post">
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
						<input type="text" class=".span3" name="query">
						<button type="submit" class="btn btn-primary">検 索</button>
					</div>
				</td>
			</tr>
		</thead>
	</table>
</div>
<div class="span12">
	<div style="padding:10px 0px 0px 20px;">
		<a href="#" data-toggle="collapse" data-target="#option">
			 条件で絞り込む
		</a>
		<div id="option" class="collapse out">
			<div style="padding:10px 0px 0px 20px;">
				<table>
						<thead>
							<tr>
								<td>所属篇</td>
								<td>
									<select class='span2' name='syozokuhen'>
										<option value=''>--　　　　　　</option>
										<?php foreach ($iroha_chars as $c) echo "<option value='${c}'>${c}</option>" ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>所属部</td>
								<td>
									<select class='span2' name='syozokubu'>
										<option value=''>--　　　　　　</option>
										<?php foreach ($syozokubus as $s) echo "<option value='${s}'>${s}</option>" ?>
									</select>
								</td>
							</tr>
							<tr>
								<td>漢字数</td>
								<td>
									<select class='span2' name='mojisuu'>
										<option value=''>--　　　　　　</option>
										<?php for ($i = 1; $i <= 6; $i++) echo "<option value='${i}'>${i}</option>" ?>
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
<div style="height:120px;"></div>
  

<!-- 
<form class="form-search" action="./search" method="post">
	<div class="tab-content">
		<div class="tab-pane active" id="search" style="height:100px;">
			<div class="span8">
		    	<table class="table">
					<thead>
						<tr>
							<th>
								「見出し語」か「読み」を入力してください．
							</tr>
						<tr>
							<td>
								<input type="text" class=".span3" name="query">
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
									<?php foreach ($iroha_chars as $c) echo "<option value='${c}'>${c}</option>" ?>
								</select>
							</td>
							<td>
								<select class='span2' name='syozokubu'>
									<option value=''>--　　　　　　</option>
									<?php foreach ($syozokubus as $s) echo "<option value='${s}'>${s}</option>" ?>
								</select>
							</td>
							<td>
								<select class='span2' name='mojisuu'>
									<option value=''>--　　　　　　</option>
									<?php for ($i = 1; $i <= 6; $i++) echo "<option value='${i}'>${i}</option>" ?>
								</select>
							</td>
						</tr>
					</thead>
				</table>
			</div>
		</div>
	</div>
</form>
 -->
 
<script>
	$('#myTab a').click(function (e) {
		e.preventDefault();
    	$(this).tab('show');
	})
</script>

<div class="" style="height:120px;"></div>
<div class="row">
	<div class="span6">
		<h3>このサイトについて</h3>
		<p>本サイトは，三巻本「色葉字類抄」収録語彙検索システムを公開する目的で，特別研究員奨励費（日本学術振興会PD・藤本灯 / 東京大学）の助成を受けて作成されました．システム構築及びデータベース運用に際しては，志村誠氏・津村昌祐氏の支援・技術提供を受けました．</p>
	</div>
	<div class="span6">
		<h3>更新履歴</h3>
		<?php
		foreach($change_logs as $change_log) {
			$change_log = split(",", $change_log);
			if (count($change_log) === 2) {
				echo "<h4>${change_log[0]}</h4>";
				echo $change_log[1];
				echo '<div style="padding-bottom:8px;"></div>';
		}
		}
		?>
	</div>
</div>
