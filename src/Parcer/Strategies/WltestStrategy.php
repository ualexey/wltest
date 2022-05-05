<?php

namespace App\Parcer\Strategies;

use PHPHtmlParser\Dom;

class WltestStrategy extends AbstractStrategy
{

    private $url = 'https://wltest.dns-systems.net';
    private $data = [];

    /**
     * @return string
     */

    public function getUrl(): string
    {
        return $this->url;
    }


    public function run(): array
    {
        $dom = new Dom;

        $dom->loadFromUrl($this->url);

        $sections = $dom->find('.package-features');

        foreach ($sections as $section) {

            $name = $section->find('.package-name');
            $description = $section->find('.package-description');
            $packagePrice = $section->find('.package-price');

            if ($packagePrice) {
                $price = $packagePrice->firstChild();
                $discount = $packagePrice->find('p', 0);
            }

            $this->data[] = [
                'name' => isset($name) ? $name->text : '',
                'description' => isset($description) ? $description->text : '',
                'price' => isset($price) ? $price->text : '',
                'discount' => isset($discount) ? $discount->text : ''
            ];
        }

        $this->sortResult();

        return $this->data;
    }

    private function sortResult()
    {

        $byPrice = [];
        foreach ($this->data as $key => $val) {
            $byPrice[$key] = substr($val['price'], 2);
        }
        array_multisort($byPrice, SORT_DESC, SORT_NUMERIC, $this->data);
    }

}
