<?php
namespace Concrete\Package\CommunityStoreWaTaxLookup\Src;

use \SalesTaxWa\SalesTax;
use \Concrete\Package\CommunityStore\Src\CommunityStore\Tax\TaxRate;
use Concrete\Package\CommunityStore\Src\CommunityStore\Customer\Customer as StoreCustomer;

class TaxLookup{

    private $customer;

    public function getTax(){
        $this->customer = new StoreCustomer();
        return $this->buildTaxRate();
    }

    private function buildTaxRate(){
        $taxRate = new TaxRate();
        $taxRate->setEnabled(ture);
        $taxRate->setTaxLabel('Sales Tax');
        $taxRate->setTaxRate($this->lookupTax() * 100);
        $taxRate->setTaxAddress('shipping');
        $taxRate->setTaxBasedOn('grandtotal');
        $taxRate->setTaxCountry('US');
        $taxRate->setTaxState('WA');

        return $taxRate;
    }

    private function lookupTax(){
        $taxLookup = new SalesTax();
        return $taxLookup->getTax($this->getAddress(),$this->getCity(),$this->getZip());
    }

    private function getAddress(){
        return strtolower(trim($this->customer->getValue("shipping_address")->address1));
    }

    private function getCity(){
        return strtolower(trim($this->customer->getValue("shipping_address")->city));
    }

    private function getZip(){
        return strtolower(trim($this->customer->getValue("shipping_address")->postal_code));
    }
}
