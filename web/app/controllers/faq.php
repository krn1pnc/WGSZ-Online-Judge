<?php
	requireLib('shjs');
	requireLib('mathjax');
	echoUOJPageHeader(UOJLocale::get('help'));
	$model = file_get_contents('/sys/devices/virtual/dmi/id/product_name') . file_get_contents('/sys/devices/virtual/dmi/id/product_version');
	$meminfo_file = file_get_contents('/proc/meminfo');
	preg_match_all('/(\w+):\s+(\d+)\s/', $meminfo_file, $matches);
	$meminfo_array = array_combine($matches[1], $matches[2]);
	$cpuinfo_file = file_get_contents('/proc/cpuinfo');
	preg_match_all('/(\S+(?: \S+)*)\s*:\s*(\S+(?: \S+)*)\s/', $cpuinfo_file, $matches);
	$cpuinfo_array = array_combine($matches[1], $matches[2]);
?>
<article>
	<header>
		<h2 class="page-header">常见问题及其解答(FAQ)</h2>
	</header>
	<section>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerTwo" data-toggle="collapse" data-target="#collapseTwo" style="cursor:pointer;">
				<h5 class="mb-0">注册后怎么上传头像？</h5>
			</div>
			<div id="collapseTwo" class="collapse">
				<div class="card-body">
					<p><?= UOJConfig::$data['profile']['oj-name-short'] ?> 提供头像存储服务！在文件上传中上传名为 <code>avatar.png</code> 的图片即可。</p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerThree" data-toggle="collapse" data-target="#collapseThree" style="cursor:pointer;">
				<h5 class="mb-0"><?= UOJConfig::$data['profile']['oj-name-short'] ?> 的测评环境？</h5>
			</div>
			<div id="collapseThree" class="collapse">
				<div class="card-body">
					<p>操作系统是 Ubuntu Linux 20.04 LTS x64，运行在 <?= $model ?> 上。</p>
					<p>CPU 型号是 <?= $cpuinfo_array['model name'] ?>，有 <?= $cpuinfo_array['cpu cores'] ?> 核 <?= $cpuinfo_array['siblings'] ?> 线程。</p>
					<p>内存大小为 <?= humanFilesize($meminfo_array['MemTotal'] * 1024) ?>。</p>
					<p>C++ 编译器是 g++ 9.4.0。编译命令：<code>g++ code.cpp -o code -lm -O2 -DONLINE_JUDGE</code>。选择对应的语言版本会附加 <code>-std=<语言版本></code> 开关。</p>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerFour" data-toggle="collapse" data-target="#collapseFour" style="cursor:pointer;">
				<h5 class="mb-0">各种评测状态的鸟语是什么意思？</h5>
			</div>
			<div id="collapseFour" class="collapse">
				<div class="card-body">
					<ul>
						<li>Accepted: 答案正确。恭喜大佬，您通过了这道题。</li>
						<li>Wrong Answer: 答案错误。仅仅通过样例数据的测试并不一定是正确答案，一定还有你没想到的地方。</li>
						<li>Runtime Error: 运行时错误。像非法的内存访问，数组越界，指针漂移，调用禁用的系统函数都可能出现这类问题，请点击评测详情获得输出。</li>
						<li>Time Limit Exceeded: 时间超限。请检查程序是否有死循环，或者应该有更快的计算方法。</li>
						<li>Memory Limit Exceeded: 内存超限。数据可能需要压缩，或者您数组开太大了，请检查是否有内存泄露。</li>
						<li>Output Limit Exceeded: 输出超限。你的输出居然比正确答案长了两倍！</li>
						<li>Dangerous Syscalls: 危险系统调用，你是不是带了文件，或者使用了某些有意思的 system 函数？</li>
						<li>Judgement Failed: 评测失败。可能是评测机抽风了，也可能是服务器正在睡觉；反正不一定是你的锅啦！</li>
						<li>No Comment: 没有详情。评测机对您的程序无话可说，那么我们也不知道到底发生了什么...</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="card my-1">
			<div class="card-header collapsed" id="headerNine" data-toggle="collapse" data-target="#collapseNine" style="cursor:pointer;">
				<h5 class="mb-0">联系方式</h5>
			</div>
			<div id="collapseNine" class="collapse">
				<div class="card-body">
					<p>由于是校内 OJ，直接在机房找管理员就好了。</p>
				</div>
			</div>
		</div>
	</section>
</article>

<?php echoUOJPageFooter() ?>
