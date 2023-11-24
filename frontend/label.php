<?php

require __DIR__ . "/vendor/autoload.php";
use chillerlan\QRCode\{QRCode, QROptions};
use chillerlan\QRCode\Common\EccLevel;
use chillerlan\QRCode\Data\QRMatrix;
use chillerlan\QRCode\Output\{QRGdImagePNG, QRCodeOutputException};
include_once( 'lib/uuid.php' );
include_once( 'config.php' );

/*
 * Class definition
 */

class QRImageWithLogo extends QRGdImagePNG{

  /**
   * @param string|null $file
   * @param string|null $logo
   *
   * @return string
   * @throws \chillerlan\QRCode\Output\QRCodeOutputException
   */
  public function dump(string $file = null, string $logo = null):string{
    // set returnResource to true to skip further processing for now
    $this->options->returnResource = true;

    // of course, you could accept other formats too (such as resource or Imagick)
    // I'm not checking for the file type either for simplicity reasons (assuming PNG)
    if(!is_file($logo) || !is_readable($logo)){
      throw new QRCodeOutputException('invalid logo');
    }

    // there's no need to save the result of dump() into $this->image here
    parent::dump($file);

    $im = imagecreatefrompng($logo);

    // get logo image size
    $w = imagesx($im);
    $h = imagesy($im);

    // set new logo size, leave a border of 1 module (no proportional resize/centering)
    $lw = (($this->options->logoSpaceWidth - 2) * $this->options->scale);
    $lh = (($this->options->logoSpaceHeight - 2) * $this->options->scale);

    // get the qrcode size
    $ql = ($this->matrix->getSize() * $this->options->scale);

    // scale the logo and copy it over. done!
    imagecopyresampled($this->image, $im, (($ql - $lw) / 2), (($ql - $lh) / 2), 0, 0, $lw, $lh, $w, $h);

    $imageData = $this->dumpImage();

    $this->saveToFile($imageData, $file);

    if($this->options->outputBase64){
      $imageData = $this->toBase64DataURI($imageData);
    }

    return $imageData;
  }

}

# ============================================================
function make_label( $uuid = null ) {
# ============================================================
  global $config;
  if( is_null( $uuid )) {
    $uuid = MyshtUUID::new();
  }
  
  /*
   * Runtime
   */

  $options = new QROptions;

  $options->version             = 5;
  $options->outputBase64        = false;
  $options->scale               = 6;
  $options->imageTransparent    = false;
  $options->drawCircularModules = true;
  $options->circleRadius        = 0.45;
  $options->keepAsSquare        = [
    QRMatrix::M_FINDER,
    QRMatrix::M_FINDER_DOT,
  ];
  // ecc level H is required for logo space
  $options->eccLevel            = EccLevel::H;
  $options->addLogoSpace        = true;
  $options->logoSpaceWidth      = 13;
  $options->logoSpaceHeight     = 13;


  $qrcode = new QRCode( $options );
  $qrcode->addByteSegment( config_host( $config ) . "/view.php?uuid={$uuid}" );

  $qrOutputInterface = new QRImageWithLogo( $options, $qrcode->getQRMatrix());

  // dump the output, with an additional logo
  // the logo could also be supplied via the options, see the svgWithLogo example
  $out = $qrOutputInterface->dump( null, __DIR__.'/assets/images/favicon/favicon.png' );
  return $out;
}
?>
