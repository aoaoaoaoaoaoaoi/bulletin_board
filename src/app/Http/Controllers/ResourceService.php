<?php

namespace App\Http\Controllers;

class ResourceService
{
    final protected function __construct() {}

    final public static function getInstance()
    {
        static $instance;
        if (!$instance) {
            $instance = new static;
        }
        return $instance;
    }

    public function saveIconResouce($uniq_file_name, string $name, string $uploadFolder)
    {       
        // 仮にファイルがアップロードされている場所のパスを取得
        $tmp_path = $_FILES[$name]['tmp_name'];
        
        // 保存先のパスを設定
        $upload_path = './'.$uploadFolder.'/';
        
        if (is_uploaded_file($tmp_path)) {
        // 仮のアップロード場所から保存先にファイルを移動
            if (move_uploaded_file($tmp_path, $upload_path.$uniq_file_name)) {
                // ファイルが読出可能になるようにアクセス権限を変更
                chmod($upload_path . $uniq_file_name, 0644);
            }
        }
    }
}