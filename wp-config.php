<?php
define( 'WP_CACHE', true );
if(isset($_SERVER['HTTP_SSL']))
 
{
 
$_SERVER['SERVER_PORT']=443;
 
$_SERVER['HTTPS']='on';
 
}

define('WP_ALLOW_REPAIR', true);

//Begin Really Simple SSL session cookie settings
@ini_set('session.cookie_httponly', true);
@ini_set('session.cookie_secure', true);
@ini_set('session.use_only_cookies', true);
//END Really Simple SSL

/**
 * WordPress için taban ayar dosyasý.
 *
 * Bu dosya þu ayarlarý içerir: MySQL ayarlarý, tablo öneki,
 * gizli anahtaralr ve ABSPATH. Daha fazla bilgi için 
 * {@link http://codex.wordpress.org/Editing_wp-config.php wp-config.php düzenleme}
 * yardým sayfasýna göz atabilirsiniz. MySQL ayarlarýnýzý servis saðlayýcýnýzdan edinebilirsiniz.
 *
 * Bu dosya kurulum sýrasýnda wp-config.php dosyasýnýn oluþturulabilmesi için
 * kullanýlýr. Ýsterseniz bu dosyayý kopyalayýp, ismini "wp-config.php" olarak deðiþtirip,
 * deðerleri girerek de kullanabilirsiniz.
 *
 * @package WordPress
 */
// ** MySQL ayarlarý - Bu bilgileri sunucunuzdan alabilirsiniz ** //
/** WordPress için kullanýlacak veritabanýnýn adý */
define('DB_NAME', 'oftidear_idearc');
/** MySQL veritabaný kullanýcýsý */
define('DB_USER', 'oftidear_idearc');
/** MySQL veritabaný parolasý */
define('DB_PASSWORD', '8113278IDEArc');
/** MySQL sunucusu */
define('DB_HOST', 'localhost');
/** Yaratýlacak tablolar için veritabaný karakter seti. */
define('DB_CHARSET', 'utf8');
/** Veritabaný karþýlaþtýrma tipi. Herhangi bir þüpheniz varsa bu deðeri deðiþtirmeyin. */
define('DB_COLLATE', '');
/**#@+
 * Eþsiz doðrulama anahtarlarý.
 *
 * Her anahtar farklý bir karakter kümesi olmalý!
 * {@link http://api.wordpress.org/secret-key/1.1/salt WordPress.org secret-key service} servisini kullanarak yaratabilirsiniz.
 * Çerezleri geçersiz kýlmak için istediðiniz zaman bu deðerleri deðiþtirebilirsiniz. Bu tüm kullanýcýlarýn tekrar giriþ yapmasýný gerektirecektir.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'isJEvt#Z/_$)RiMpVf|^Een)F.2)y=~ MP}f&B%kA<`y(:86-Kdw9/|dS,dy_-8*');
define('SECURE_AUTH_KEY',  '`Cs3z:=wM;j|*$xBE2ai-+wD{>Wd:-*/+ljm*9Z^A)5UtA<?8]]Bx E?W-S<ZmNo');
define('LOGGED_IN_KEY',    'nxeDx FT{>7MGm*H{Wo&}jq>hkB,-j??(G>+TN&,`]x-%E T<>N`yU^-=OL6,^vl');
define('NONCE_KEY',        '(PhsGcgfdVyh&PPM-,FuW;zV$kT.;Lp{x+q+7?G3/R<s[#r^m6*-&[H$==_ohFfR');
define('AUTH_SALT',        ':|w&o|!`lh!|,H:zv-On#1@M!O=-|(*6-VF&gry:j jNusC7Q,U%X}lP1$Mg?Q>1');
define('SECURE_AUTH_SALT', '%_P9~ gp2L&^ctyqad/AYj<yDMH1@xA:cPuDU{#KV<H_gS*TevU[3X7I-0J+ e-Q');
define('LOGGED_IN_SALT',   'IhI[n,((#>+tP]dJ9W?99^YM8-ImG,Fz|U9/(-r@N13(4n^0+;i%?:XeD -d*%|&');
define('NONCE_SALT',       '|#p[PoMI51$1iDS!7bUaW)S&K|g>/Ep9p2ru)b5oJ&_?PZqsUZJp W2A|YRu2N&&');
/**#@-*/
/**
 * WordPress veritabaný tablo ön eki.
 *
 * Tüm kurulumlara ayrý bir önek vererek bir veritabanýna birden fazla kurulum yapabilirsiniz.
 * Sadece rakamlar, harfler ve alt çizgi lütfen.
 */
$table_prefix  = 'wp_';
/**
 * Geliþtiriciler için: WordPress hata ayýklama modu.
 *
 * Bu deðeri "true" yaparak geliþtirme sýrasýnda hatalarýn ekrana basýlmasýný saðlayabilirsiniz.
 * Tema ve eklenti geliþtiricilerinin geliþtirme aþamasýnda WP_DEBUG
 * kullanmalarýný önemle tavsiye ederiz.
 */
define('WP_DEBUG', false);
/* Hepsi bu kadar. Mutlu bloglamalar! */
/** WordPress dizini için mutlak yol. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** WordPress deðiþkenlerini ve yollarýný kurar. */
require_once(ABSPATH . 'wp-settings.php');
