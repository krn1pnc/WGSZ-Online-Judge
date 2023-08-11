<?php

class UploadedFile
{
	public $domain;
	public $name;

	public function __construct($domain, $name = '')
	{
		$this->domain = $domain;
		$this->name = $name;
	}

	private function relPath()
	{
		return '/upload/' . $this->domain . '/' . $this->name;
	}

	public function filePath()
	{
		return UOJContext::storagePath() . $this->relPath();
	}

	public function url()
	{
		return HTML::url($this->relPath());
	}

	public function hasWritePermission()
	{
		if (isSuperUser(Auth::user())) return true;
		return Auth::id() === $this->domain;
	}

	public function hasReadPermission()
	{
		return true;
	}

	public function delete()
	{
		if ($this->hasWritePermission())
			return unlink($this->filePath());
		return false;
	}

	public function size()
	{
		return humanFilesize(filesize($this->filePath()));
	}

	public function mtime()
	{
		return date("Y-m-d H:i:s", filemtime($this->filePath()));
	}

	public function deleteButton()
	{
		return <<<EOD
<button class="btn btn-danger delete-uploaded-file-btn" data-domain="{$this->domain}" data-name="{$this->name}">
	删除
</button>
EOD;
	}

	public function exists()
	{
		return file_exists($this->filePath());
	}
};
