<?php

namespace App\Utilities;

use Illuminate\Filesystem\Filesystem;

class DirectoryManipulator
{
  protected $files;
  public function __construct(Filesystem $files)
  {
    $this->files = $files;
  }

  /**
   * @param  string  $path
   * @return bool すでに存在するor不適切な$pathの場合にfalse, ディレクトリ作成に成功した場合はtrue
   */
  public function makeDirectory(string $path): bool
  {
    if ($this->isExist($path)) return false;

    $this->files->makeDirectory($path, 0755, true);
    return true;
  }

  public function makeFile(string $path): bool
  {
    if ($this->isExist($path)) return false;

    $this->files->put($path, '');
    return true;
  }

  public function putContentToFile(string $path, string $content): bool
  {
    if (!$this->isExist($path)) return false;
    $this->files->put($path, $content);
    return true;
  }

  public function getFileContent(string $path): string|null
  {
    if (!$this->isExist($path)) return null;
    return file_get_contents($path);
  }

  /**
   * @param  string  $path
   * @return bool $pathがすでに存在するかどうか
   */
  private function isExist(string $path): bool
  {
    return $this->files->exists($path);
  }
}
