<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\CreatedUpdated;
use App\Traits\WhereLike;
use Illuminate\Database\Eloquent\Model;
use Altek\Accountant\Contracts\Recordable;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

/**
 * Model base que implementa comportamentos comuns aos demais.
 */

class BaseModel extends Model implements Recordable
{
    use HasFactory, CreatedUpdated, WhereLike;
    use \Altek\Accountant\Recordable;
    use \Altek\Eventually\Eventually;

    /**
     * Método para converter uma imagem em Base 64 para arquivo e salvar em um diretório
     *
     * @return string
     */
    public function imageDecoder($base64) {
        $today = Carbon::today()->format('d-m-Y');

        if (!file_exists(public_path('/uploads/' . $today))) {
            mkdir(public_path('/uploads/' . $today), 0777, true);
        }

        // $file = Str::random(40) .  '.jpg';
        $file = Str::random(40).hash('sha3-512', strval($base64)).  '.jpg';
        $image = Image::make(base64_decode($base64))->save(public_path('/uploads/' . $today . '/' . $file));
        $image->resize(600, null, function($constraint) {
            $constraint->aspectRatio();
        })->save(public_path('/uploads/' . $today . '/thumb-' . $file), 80);
        return '/uploads/' . $today . '/thumb-' . $file;
    }

    public function ImageSave($file,$hash_veficacao) {
        $today = Carbon::today()->format('d-m-Y');
        if (!file_exists(public_path('/uploads/' . $today))) {
            mkdir(public_path('/uploads/' . $today), 0777, true);
        }
        if (!$file->isValid() ) throw new \Exception('Erro no upload da image');
        if (hash_file('md5', $file->path()) != $hash_veficacao) throw new \Exception('Frost Aparentemente Corrompida');
        $file_name = Str::random(128).$hash_veficacao.'.jpg';
        // $file = hash('sha512', strval($file)).'.jpg';
        $path = public_path('/uploads/' . $today);   
        // echo $path.$file_name;
        move_uploaded_file($file->path(), $path.'/'.$file_name);     
        return str_replace('/web/geoposteindra/aplicacao/public','',$path).'/thumb-'.$file_name;
        // if (!file_exists(public_path('/uploads/' . $today))) {
        //     mkdir(public_path('/uploads/' . $today), 0777, true);
        // }

        // // $file = Str::random(40) .  '.jpg';
        // 
        // $image = Image::make(base64_decode($base64))->save(public_path('/uploads/' . $today . '/' . $file));
        // $image->resize(600, null, function($constraint) {
        //     $constraint->aspectRatio();
        // })->save(public_path('/uploads/' . $today . '/thumb-' . $file), 80);
        // return '/uploads/' . $today . '/thumb-' . $file;
    }
}
