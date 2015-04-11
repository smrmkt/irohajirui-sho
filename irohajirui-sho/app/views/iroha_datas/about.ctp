<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<button type="button"class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="brand" href="./">色葉字類抄データベース </a>
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

<div id="result">
	<div class="" style="height:20px;"></div>
	<h3>検索のしかた</h3>
	<div class="" style="height:10px;"></div>
	<div class="row">
		<div class="span3">
			<p>検索ボックスに，見出し語の「漢字」または「読み」のいずれかを入力して検索してください．検索する際には，現行字体の漢字や現代仮名遣いでも検索できます．</p>
			<p>また検索ボックス下部の「オプション」リンクをクリックすることで，検索時のオプションが表示されます．</p>
			<p>オプションとして利用可能なのは，「所属篇」「所属部」「見出し語の漢字数」の3つです．これらのオプションを設定して検索を行うことで，検索結果を絞り込むことができます．</p>
			<p>検索結果表示画面では，このオプションが最初から開いた状態になっており，オプションを指定することで，検索結果の絞り込みを行うことが可能です．</p>
		</div>
		<div class="span9">
			<?php
			echo $html->image(
					'help/search_word.png',
					array('style' => 'border: 1px #999999 solid;')
			);
			?>
			<div class="" style="height:20px;"></div>
			<?php
			echo $html->image(
					'help/search_option.png',
					array('style' => 'border: 1px #999999 solid;')
			);
			?>
		</div>
	</div>
	
	<div class="" style="height:40px;"></div>
	<h3>検索結果について</h3>
	<div class="" style="height:10px;"></div>
	<div class="row">
		<div class="span3">
			<p>検索結果として，右に示した「漢字表記」「音読み」「訓読み」「注文」「声点」「所属篇」「所属部」「前田本所在」「黒川本所在」の8項目が表示されます．</p>
			<p>結果が存在しない，もしくは該当しない項目については，「-」で表示されます．■は「くの字点」を表します．（　）内の情報は，すべて作成者による注です．Chrome等のブラウザにおいて，一部の文字が正常に表示されない場合がありますのでご注意ください．そのような場合には，別のブラウザをご利用ください．</p>
			<p>原本中の異体字については，「A」「B」のようにアルファベットで表示される場合があります．その場合は検索結果下部の字体説明欄に，近似字体の偏旁等の構成や，画像を表示しています．</p>
			<p>なお，異体字の画像については「<a href="http://www.mojikyo.gr.jp/">今昔文字鏡</a>」により配布されている画像データを使用しています．</p>
			<p>	<?php echo $html->link($html->image('mojikyo_banner.gif', array('width' => '120')), 'http://www.mojikyo.org/', array('escape' => false), false, true); ?></p>
		</div>
		<div class="span9">
		<?php
		echo $html->image(
				'help/search_result.png',
				array('style' => 'border: 1px #999999 solid;')
		);
		?>
		</div>
	</div>
	
	<div class="" style="height:40px;"></div>
	<h3>底本について</h3>
	<div class="" style="height:10px;"></div>
	<div class="row">
		<div class="span8">
			<p>三巻本「色葉字類抄」の主底本は前田本としましたが，前田本の逸する部分は黒川本を用いました．検索結果に表示される「前田本所在」の項目が「-」である場合は，黒川本を用いたことを示しています．原則として前田本と黒川本との異同は示さず，両本共に存する語については前田本の情報を記しました．</p>
			<p>正確な字体，声点の位置等については原本をご覧ください．</p>
		</div>
		<div class="span4"></div>
	</div>
</div>
