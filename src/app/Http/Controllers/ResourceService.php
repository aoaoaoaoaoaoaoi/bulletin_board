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

    /*
    if (isset($_FILES['upfile']['error']) && is_array($_FILES['upfile']['error'])) {

        // 各ファイルをチェック
        foreach ($_FILES['upfile']['error'] as $k => $error) {
    
            try {
    
                // 更に配列がネストしていれば不正とする
                if (!is_int($error)) {
                    throw new RuntimeException("[{$k}] パラメータが不正です");
                }
    
                // $_FILES['upfile']['error'][$k] の値を確認
                switch ($error) {
                    case UPLOAD_ERR_OK: // OK
                        break;
                    case UPLOAD_ERR_NO_FILE:   // ファイル未選択
                        continue 2;
                    case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                    case UPLOAD_ERR_FORM_SIZE: // フォーム定義の最大サイズ超過
                        throw new RuntimeException("[{$k}] ファイルサイズが大きすぎます");
                    default:
                        throw new RuntimeException("[{$k}] その他のエラーが発生しました");
                }
    
                // $_FILES['upfile']['mime']の値はブラウザ側で偽装可能なので
                // MIMEタイプを自前でチェックする
                if (!$info = @getimagesize($_FILES['upfile']['tmp_name'][$k])) {
                    throw new RuntimeException("[{$k}] 有効な画像ファイルを指定してください");
                }
                if (!in_array($info[2], [IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG], true)) {
                    throw new RuntimeException("[{$k}] 未対応の画像形式です");
                }
    
                // 画像処理に使う関数名を決定する
                $create = str_replace('/', 'createfrom', $info['mime']);
                $output = str_replace('/', '', $info['mime']);
    
                // 縦横比を維持したまま 120 * 120 以下に収まるサイズを求める
                if ($info[0] >= $info[1]) {
                    $dst_w = 120;
                    $dst_h = ceil(120 * $info[1] / max($info[0], 1));
                } else {
                    $dst_w = ceil(120 * $info[0] / max($info[1], 1));
                    $dst_h = 120;
                }
    
                // 元画像リソースを生成する
                if (!$src = @$create($_FILES['upfile']['tmp_name'][$k])) {
                    throw new RuntimeException("[{$k}] 画像リソースの生成に失敗しました");
                }
    
                // リサンプリング先画像リソースを生成する
                $dst = imagecreatetruecolor($dst_w, $dst_h);
    
                // getimagesize関数で得られた情報も利用してリサンプリングを行う
                imagecopyresampled($dst, $src, 0, 0, 0, 0, $dst_w, $dst_h, $info[0], $info[1]);
    
                // ファイルデータからSHA-1ハッシュを取ってファイル名を決定し、保存する
                if (!$output(
                    $dst,
                    sprintf('./resized/%s%s',
                        sha1_file($_FILES['upfile']['tmp_name'][$k]),
                        image_type_to_extension($info[2])
                    )
                )) {
                    throw new RuntimeException("[{$k}] ファイル保存時にエラーが発生しました");
                }
    
                $msgs[] = ['green', "[{$k}] リサイズして保存しました"];
    
            } catch (RuntimeException $e) {
    
                $msgs[] = ['red', $e->getMessage()];
    
            }
    
            // リソースを解放
            if (isset($msg) && is_resource($img)) {
                imagedestroy($img);
            }
            if (isset($dst) && is_resource($dst)) {
                imagedestroy($dst);
            }
    
        }
    
    }*/
}