<?php
requirePHPLib('uploaded-file');

$domain = $_GET['username'];

$config = array();

$dir = (new UploadedFile($domain))->filePath();

$files = array_values(array_filter(
	scandir($dir),
	function ($x) use ($dir) {
		return !strStartWith($x, '.') && is_file($dir . $x);
	}
));

$config['data'] = array();
foreach ($files as $name) {
	$file = new UploadedFile($domain, $name);
	if ($file->hasReadPermission()) $config['data'][] = $file;
}
usort($config['data'], function (UploadedFile $x, UploadedFile $y) {
	return filemtime($y->filePath()) - filemtime($x->filePath());
});

function printRow(UploadedFile $file)
{
	echo '<tr>';
	echo '<td>' . $file->mtime() . '</td>';
	echo '<td><a href="' . $file->url() . '">' . $file->name . '</a></td>';
	echo '<td data-sort="' . filesize($file->filePath()) . '">' . $file->size() . '</td>';
	echo '<td>' . $file->deleteButton() . '</td>';
	echo '</tr>';
}

$header = <<<EOD
    <tr>
		<th>修改时间</th>
		<th>文件名</th>
		<th>大小</th>
		<th>操作</th>
    </tr>
EOD;

$config['table_classes'] = array('table', 'table-hover');

?>

<?php echoUOJPageHeader($domain . " - 已上传文件列表"); ?>

<div class="float-right">
	<a href="<?= HTML::url('/upload-file?' . 'domain=' . $domain) ?>" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-upload"></span> 上传新文件</a>
</div>

<h2><?= $domain ?> 的文件列表</h2>

<?php echoLongTableData($header, 'printRow', $config); ?>

<?php echoUOJPageFooter(); ?>
