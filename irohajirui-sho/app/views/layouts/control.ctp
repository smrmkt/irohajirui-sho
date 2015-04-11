<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<meta http-equiv="Content-Style-Type" content="text/css" /> 
		<title><?php echo $header; ?> 管理画面</title>
		<?php echo $html->css("control"); ?>
		<?php echo $html->css("bootstrap/bootstrap"); ?>
		<?php echo $javascript->link("folding"); ?>
		<?php echo $javascript->link("box_check"); ?>
		<?php echo $javascript->link("bootstrap/jquery.min.1.7.1"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap.min"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap-tab"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap-popover"); ?>
		<script>
		$(function(){
			$('a[rel=tooltip]').tooltip();
			$('a[rel=popover]').popover();
		});
		</script>
		<style> body { padding-top: 60px; } </style>
	</head>
	<body>
		<div class="navbar navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="./../">色葉字類抄データベース</a>
					<ul class="nav pull-right">
							<?php 
							// データ管理
							echo '<li class="dropdown">';
							echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
							echo 'データ<span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu">';
							echo '<li class="">';
							echo $html->link("現在のデータを確認", "../controls/index");
							echo '</li>';
							echo '<li class="">';
							echo $html->link("データの追加", "../controls/insert");
							echo '</li>';
							echo '<li class="">';
							echo $html->link("データの更新", "../controls/update");
							echo '</li>';
							echo '<li class="">';
							echo $html->link("不要データの削除", "../controls/delete");
							echo '</li>';
							echo '</ul>';
							echo '</li>';
							// アカウント管理
							echo '<li class="dropdown">';
							echo '<a href="#" class="dropdown-toggle" data-toggle="dropdown">';
							echo 'アカウント<span class="caret"></span>';
							echo '</a>';
							echo '<ul class="dropdown-menu">';
							if ($is_admin) {
								echo '<li class="">';
								echo $html->link("ユーザの追加", "../users/add");
								echo '</li>';
								echo '<li class="">';
								echo $html->link("ユーザの削除", "../users/remove");
								echo '</li>';
							}
							echo '<li class="">';
							echo $html->link("パスワードの変更", "../users/change");
							echo '</li>';
							echo '</ul>';
							echo '</li>';
							echo '<li class="">';
							echo $html->link("更新履歴編集", "../controls/changelog");
							echo '</li>';
							echo '<li class="">';
							echo $html->link("ログアウト", "/users/logout");
							echo '</li>';
							?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="container">
			<?php echo $content_for_layout; ?>
			<hr>
			<footer>
				<p class="pull-left"><?php echo $html->link("　", "/controls/index"); ?></p>
				<p class="pull-right"><?php echo $footer; ?></p>
			</footer>
		</div>
	</body>
</html>