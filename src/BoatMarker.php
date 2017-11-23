<?php
/**
 * @copyright Copyright (c) 2013-2015 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */

namespace squio\leaflet\plugins\boatmarker;

use dosamigos\leaflet\layers\LatLngTrait;
use dosamigos\leaflet\layers\PopupTrait;
use dosamigos\leaflet\layers\Layer;
use yii\base\InvalidConfigException;
use yii\web\JsExpression;
use yii\helpers\Json;

/**
 * BoatMarker allows to create map icons using BoatMarker
 *
 * @see https://github.com/thomasbrueggemann/leaflet.boatmarker
 * @author Thomas Brüggemann (boatmarker), Johannes la Poputré (yii plugin)
 * @link http://squio.nl/
 * @package squio\leaflet\plugins\boatmarker
 */
class BoatMarker extends  Layer
{
    use LatLngTrait;
    use PopupTrait;

    /**
     * @var string color of the boat, "#f1c40f"
     */
    public $color = "#f1c40f";

    /**
     * @var bool if set to true, the icon will draw a circle when
     * boatspeed == 0 and the ship-shape if speed > 0
     */
    public $idleCircle = false;


    /**
     * Initializes the marker.
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if (empty($this->latLng)) {
            throw new InvalidConfigException("'latLng' attribute cannot be empty.");
        }
    }

    /**
      * @return \yii\web\JsExpression the marker constructor string
      */
     public function encode()
     {
         $latLon = $this->getLatLng()->toArray(true);
         $options = $this->getOptions();
         $name = $this->name;
         $map = $this->map;
         $js = $this->bindPopupContent("L.boatMarker($latLon, $options)") . ($map !== null ? ".addTo($map)" : "");
         if (!empty($name)) {
             $js = "var $name = $js;";
         }
         $js .= $this->getEvents() . ($map !== null && empty($name)? ";" : "");
         return new JsExpression($js);
     }

    /**
     * Returns the plugin name
     * @return string
     */
    public function getPluginName()
    {
        return 'plugin:boatmarker';
    }

    /**
     * Registers plugin asset bundle
     *
     * @param \yii\web\View $view
     *
     * @return mixed
     * @codeCoverageIgnore
     */
    public function registerAssetBundle($view)
    {
        BoatMarkerAsset::register($view);
        return $this;
    }


}
