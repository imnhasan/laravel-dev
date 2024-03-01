<?php

namespace App\ModelClass;

class Cart
{
    public $items = null;
    public $totalQyt = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        dump($oldCart);
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQyt = $oldCart->totalQyt;
            $this->totalPrice = $oldCart->totalPrice;
        }
        dump($this->items);
        dump($this->totalQyt);
        dump($this->totalPrice);
        dump('out from __construct');
    }

    public function add($item, $id)
    {
        $storedItem = ['qyt' => 0, 'price' => $item->price, 'item' => $item];
        dump($storedItem, $this->items);
        if($this->items) {
            dump('isset item', isset($this->items));
            if(array_key_exists($id, $this->items)) {
                dump('array key exists', $id, array_key_exists($id, $this->items));
                $storedItem = $this->items[$id];
                dump('after storeItem', $storedItem);
            }
        }

        $storedItem['qyt']++;
        $storedItem['price'] = $item->price * $storedItem['qyt'];

        dump('modify storeItem', $storedItem);

        $this->items[$id] = $storedItem;

        $this->totalQyt++;
        $this->totalPrice += $item->price;
        dump($this->items);
        dump($this->totalQyt);
        dump($this->totalPrice);
    }
}
