<?php
namespace Concrete\Package\CommunityStoreWaTaxLookup;

defined('C5_EXECUTE') or die('Access Denied.');

use Package;
use Whoops\Exception\ErrorException;

class Controller extends Package
{
    protected $pkgHandle = 'community_store_wa_tax_lookup';
    protected $appVersionRequired = '5.7.5';
    protected $pkgVersion = '1.0';

    public function getPackageDescription(){
        return t('Adds Washington Sate Sales Tax Lookup classes');
    }

    public function getPackageName(){
        return t('Washington Sales Tax Lookup');
    }

    public function install(){
        $installed = Package::getInstalledHandles();
        if(!(is_array($installed) && in_array('community_store',$installed)) ) {
            throw new ErrorException(t('This package requires that Community Store be installed'));
        }
        else {
            $pkg = parent::install();
        }
    }

    public function on_start(){
        require  'vendor/autoload.php';
    }
}
