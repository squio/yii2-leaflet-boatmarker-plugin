<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace squio\leaflet\plugins\boatmarker;


use yii\web\AssetBundle;

/**
 * MakiMarkerAsset
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\leaflet\plugins\markercluster
 */
class BoatMarkerAsset extends AssetBundle
{

    public $sourcePath = '@vendor/squio/yii2-leaflet-boatmarker-plugin/src/assets';

    public $js = ['js/leaflet.boatmarker.js'];

    public $depends = [
        'dosamigos\leaflet\LeafLetAsset',
    ];
}
