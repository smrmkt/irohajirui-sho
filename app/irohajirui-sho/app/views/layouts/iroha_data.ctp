<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja"> 
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
		<meta http-equiv="Content-Style-Type" content="text/css" /> 
		<title><?php echo PAGE_TITLE; ?></title>
		<?php echo $html->css("bootstrap/bootstrap"); ?>
		<?php echo $html->css("bootstrap/bootstrap-responsive"); ?>
		<?php echo $javascript->link("folding"); ?>
		<?php echo $javascript->link("bootstrap/jquery.min.1.7.1"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap.min"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap-tab"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap-popover"); ?>
		<?php echo $javascript->link("bootstrap/bootstrap-collapse"); ?>
		<script>
		$(function(){
			$('a[rel=tooltip]').tooltip();
			$('a[rel=popover]').popover();
		});
		</script>
		<style> body { padding-top: 60px; } </style>
	</head>
	<body>
		<div class="container">
			<?php echo $content_for_layout; ?>
			<hr>
			<footer>
				<p class="pull-right"><?php echo PAGE_FOOTER; ?></p>
			</footer>
		</div>
	</body>
</html>
