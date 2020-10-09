<?php

namespace app\components;

use League\Glide\Server;
use Yii;

/**
 * @author Alexander Kononenko <contact@hauntd.me>
 * @package app\components
 */
class GlideServer extends Server
{
    /**
     * Generate and output image.
     * @param string $path
     * @param array $params
     * @return bool|string|void
     * @throws \League\Flysystem\FileNotFoundException
     * @throws \League\Glide\Filesystem\FileNotFoundException
     * @throws \League\Glide\Filesystem\FilesystemException
     */
    public function outputImage($path, array $params)
    {
        $disableFunctions = explode(',', ini_get('disable_functions'));

        $path = $this->makeImage($path, $params);

        header('Content-Type:'.$this->cache->getMimetype($path));
        header('Content-Length:'.$this->cache->getSize($path));
        header('Cache-Control:'.'max-age=31536000, public');
        header('Expires:'.date_create('+1 years')->format('D, d M Y H:i:s').' GMT');

        $stream = $this->cache->readStream($path);

        if (ftell($stream) !== 0) {
            rewind($stream);
        }

        if (!in_array('fpassthru', $disableFunctions)) {
            fpassthru($stream);
        } elseif (!in_array('stream_get_contents', $disableFunctions)) {
            echo stream_get_contents($stream);
        } else {
            Yii::error('Could not output image because of PHP configuration, see php.ini "disable_functions"');
        }

        fclose($stream);
    }
}
