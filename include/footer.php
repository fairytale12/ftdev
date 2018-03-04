<?
$year = 2013;
$nowYear = date('Y');
if($nowYear > $year ) {
	$year = $year . ' &ndash; ' . $nowYear;
}

?>
<div class="footer">
	<p>Copyright © <?=$year?>. Все права защищены. <br>Перепост материалов сайта возможен только с <br>письменного разрешения Администратора. </p>
	<p id="back-top" style="display: none;">
		<a href="#top"><i class="icon-angle-up"></i></a>
	</p>
</div>