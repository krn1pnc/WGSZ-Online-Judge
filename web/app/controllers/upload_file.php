<?php
requirePHPLib('form');
requirePHPLib('uploaded-file');

$upload_form = new UOJForm('upload');

$upload_form->is_big = true;
$upload_form->has_file = true;

$upload_form->addInput("file", "file", "选择文件", null, null, null, true);

$upload_form->addInput("domain", "text", "域", $_GET['domain'] ?? Auth::id(), function ($domain) {
	$file = new UploadedFile($domain, $_POST['name']);
	if ($file->hasWritePermission()) return '';
	return '非管理员只能在自己的用户名内上传文件';
}, null);

$upload_form->addInput("name", "text", "文件名", "", function ($name) {
	if (strStartWith($name, '.')) return '文件名不能以 "." 开头';
	if (!preg_match('/^[a-zA-Z0-9_\-\.\x{4e00}-\x{9fa5}]+$/u', $name)) return '文件名不合法';
	if (strlen($name) > 200) return '文件名实在是太长了..';
	return '';
}, null);

$upload_form->handle = function () {
	$file = new UploadedFile($_POST['domain'], $_POST['name']);
	if (!$file->hasWritePermission()) {
		becomeMsgPage("你没有创建这个文件的权限", "上传失败");
	}
	if ($file->exists()) {
		becomeMsgPage("该文件已存在，请换一个名字或者删除已存在的文件: " . $file->deleteButton());
	}
	if (!is_uploaded_file($_FILES['file']['tmp_name'])) {
		becomeMsgPage('上传出错，你真的选择了要上传的文件吗？', "上传失败");
	}
	$path = $file->filePath();
	mkdir(dirname($path), 0777, true);
	if (move_uploaded_file($_FILES['file']['tmp_name'], $path)) {
		redirectTo('/upload-list' . '/' . $file->domain);
	} else {
		becomeMsgPage("上传成功，但由于未知原因保存失败，这很可能是一个 bug", "上传失败");
	}
};

$upload_form->submit_button_config['align'] = 'left';
$upload_form->submit_button_config['text'] = '上传';
$upload_form->submit_button_config['class_str'] = 'btn btn-primary';

$upload_form->runAtServer();

$username = Auth::id();

echoUOJPageHeader("文件上传");

$upload_form->printHTML(); ?>

<script>
	$('#input-file').change(function() {
		$('#input-name').val($(this).val().split('\\').pop());
	});
	$('#button-view-list').click(function() {
		const domain = $('#input-domain').val();
		window.location.href = `/upload-list/${domain}`;
	});
</script>

<?php echoUOJPageFooter(); ?>
