<?php
	if (!isset($ShowPageFooter)) {
		$ShowPageFooter = true;
	}
?>
			</div>
			<?php if ($ShowPageFooter): ?>
			<div class="uoj-footer">				
				<ul class="list-inline"><li class="list-inline-item"><?= UOJConfig::$data['profile']['oj-name'] ?></li></ul>
				<?php if (UOJConfig::$data['profile']['ICP-license'] != '' && preg_match_all('/(\d+\.?\d+)/', UOJConfig::$data['profile']['ICP-license'], $ICP_number)): ?>
				<p><a target="_blank" href="http://www.beian.gov.cn/portal/registerSystemInfo?recordcode=<?= $ICP_number[0][0] ?>" style="text-decoration:none;"><img src="http://uoj.ac/pictures/beian.png" /> <?= UOJConfig::$data['profile']['ICP-license'] ?></a></p>
				<?php endif ?>
				<p><?= UOJLocale::get('server time') ?>: <?= UOJTime::$time_now_str ?> | <a href="https://github.com/UniversalOJ/UOJ-System" target="_blank"><?= UOJLocale::get('opensource project') ?></a></p>
			</div>
			<?php endif ?>
		</div>
		<!-- /container -->
	</body>
</html>
