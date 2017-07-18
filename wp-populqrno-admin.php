<div class="wrap">
	<?php    echo "<h2>" . __( 'WP-Populqrno', 'oscimp_trdom' ) . "</h2>"; ?><br />
	<?php 
	if($_POST['ats_hidden'] == 'Y') {  
		$dbpwd = $_POST['ats_shorturl'];  
		update_option('ats-shorturl', $dbpwd); 
		
		$dbpwd = $_POST['ats_mode'];  
		update_option('ats-mode', $dbpwd);
		
		$dbpwd = $_POST['ats_size'];  
		update_option('ats-size', $dbpwd);
		
		$dbpwd = $_POST['ats_align'];  
		update_option('ats-align', $dbpwd);
				
		print "<div class=\"updated\"><p><strong>Промените бяха запазени</strong></p></div>";
	}

	if($_POST['ats_restore'] == 'Y') {  
		update_option('ats-shorturl', '1'); 
		update_option('ats-mode', 'automatic');
		update_option('ats-size', 'small');
		update_option('ats-align', 'justify');
				
		print "<div class=\"updated\"><p><strong>Промените бяха запазени</strong></p></div>";
	}
	?>
	<form name="ats_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="ats_hidden" value="Y">
		<p>
			<b><a href="#mode">Начин на показване</a></b><br />
			<input type="radio" name="ats_mode" checked="checked" value="automatic" <? if (get_option('ats-mode') == "automatic") { echo 'checked="yes"'; } ?> /> Автоматичен<br />
			<input type="radio" name="ats_mode" value="manual" <? if (get_option('ats-mode') == "manual") { echo 'checked="yes"'; } ?> /> Ръчен<br />
			<input type="radio" name="ats_mode" value="shortcode" <? if (get_option('ats-mode') == "shortcode") { echo 'checked="yes"'; } ?> /> Къс код<br /><br />
			<em>Дали да се добавят автоматично бутоните или не.</em>
		</p>
		<hr />
		<p>
			<b><a href="#shorturl">Смаляване на URL адресите ?</a></b><br />
			<input type="radio" name="ats_shorturl" value="0" <? if (get_option('ats-shorturl') == 0) { echo 'checked="yes"'; } ?> /> Не<br />
			<input type="radio" name="ats_shorturl" checked="checked" value="1" <? if (get_option('ats-shorturl') == 1) { echo 'checked="yes"'; } ?> /> Да<br /><br />
			<em>Удобно при споделяне в социални мрежи с ограничен брой символи. Пример Twitter - 140 символа.</em>
		</p>	
		<p>
			<b>Изглед на иконките</b><br />
			<input type="radio" name="ats_size" checked="checked" value="small" <? if (get_option('ats-size') == "small") { echo 'checked="yes"'; } ?> /> Малки <i>(16x16)</i><br /><br />
			<img src="http://plugins.svn.wordpress.org/wp-populqrno/tags/buttonssmall.png" alt="small" title="Преглед на малките бутони" /><br /><br />
			<input type="radio" name="ats_size" value="large" <? if (get_option('ats-size') == "large") { echo 'checked="yes"'; } ?> /> Големи <i>(32x32)</i><br /><br />
			<img src="http://plugins.svn.wordpress.org/wp-populqrno/tags/buttonssmall.png" alt="large" title="Преглед на големите бутони" /><br /><br />
		</p>
		<p>
			<b>Подравняване на иконките</b><br />
			<input type="radio" name="ats_align" value="justify" <? if (get_option('ats-align') == "justify") { echo 'checked="yes"'; } ?> /> Двустранно подравнени <i>(justify)</i><br />
			<input type="radio" name="ats_align" value="left" <? if (get_option('ats-align') == "left") { echo 'checked="yes"'; } ?> /> Ляво<br />
			<input type="radio" name="ats_align" value="center" <? if (get_option('ats-align') == "center") { echo 'checked="yes"'; } ?> /> Центрирани<br />
			<input type="radio" name="ats_align" checked="checked" value="right" <? if (get_option('ats-align') == "right") { echo 'checked="yes"'; } ?> /> Дясно<br />
		</p>
		<hr />		
		<p class="submit">
			<input type="submit" name="Submit" value="<?php _e('Запазване', 'oscimp_trdom' ) ?>" />
		</p>
	</form>
	<h2>Информация</h2><br />
	<div id="mode">
	<b>Начин на показване:</b><br /><br />

	- При <u>автоматичния режим</u>, бутоните се добавят автоматично към всики материали от блога ви. Забележете, че те се добавят чак при отпечатването, и по никакъв начин не променят съдържанието на материалите.<br />
	<br />
	- При <u>ръчен режим</u> можете да поставите бутоните, където си пожелаете в темплейта, чрез поставянето на следния код: "<b>&lt;?php echo ats_buttons(); ?&gt;</b>"<br />
	<br />
	<em>Пример за използване на shortcode</em>
	<blockquote>
		<pre style="background:#BFDFFF; padding: 1em; ">	
&lt;div class=&quot;entry&quot;&gt;
	&lt;?php the_content(''); ?&gt;
	&lt;?php the_tags( '&lt;p&gt;Tags: ', ', ', '&lt;/p&gt;'); ?&gt;
	&lt;p class="postmetadata"&gt;

		<b>&lt;?php echo ats_buttons(); ?&gt;</b>
		
	&lt;/p&gt;
&lt;/div&gt;
</pre>
	</blockquote>	
	- При <u>къс код</u> <em>(shortcode)</em>, Вие сами контролирате на кои страници да се показват бутоните, като поставите следният код "<b>[wp-populqrno]</b>"<br /><br />
	<em>Пример за използване на shortcode</em>
	<blockquote>
	<pre style="background:#BFDFFF; padding: 1em; ">Заглавие....,
Това е примерен текст...

<b>[wp-populqrno]</b></pre>
	</blockquote>
	</div>
	<div id="shorturl">
	<b>Смаляване на URL адреса</b><br /><br />
	Чрез тази опция можете да смалите дългите URL адресите. За целта се използва API-то на <a href="http://bit.ly/" target="_blank">bit.ly</a>. Тази опция е полезна при споделяне на дадена публикация в Twitter, където има ограничение от 140 символа.<br /><br />
	<em>Пример за смаляване на URL</em>
	<blockquote>
		<pre style="background:#BFDFFF; padding: 1em; ">http://tursia.info/faq/
</pre>
	</blockquote>
		<blockquote>
		<pre style="background:#BFDFFF; padding: 1em; ">http://bit.ly/jpicWX
</pre>
	</blockquote>
	</div>
	<h2>Възстановяване на настройки</h2><br />
	Ако натиснете бутона "Възстановяване", всички настройки ще бъдат по подразбиране, а вашите промени ще бъдат премахнати.<br />
	<form name="ats_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="ats_restore" value="Y">
		<p class="submit">
			<input class="button-primary" type="submit" value="Възстановяване" />
		</p>
	</form>
</div>