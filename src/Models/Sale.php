<?php
namespace App\Models;

class Sale {
    public $id;
    public $client;
    public $product;
    public $quantity;
    public $unit_price;
    public $date;

    public function __construct($id, $client, $product, $quantity, $unit_price, $date){
        $this->id = $id;
        $this->client = $client;
        $this->product = $product;
        $this->quantity = (int)$quantity;
        $this->unit_price = (float)$unit_price;
        $this->date = $date;
    }

    public function total() {
        return $this->quantity * $this->unit_price;
    }

    public static function loadAll() {
        $file = __DIR__ . '/../../storage/sales.json';
        if (!file_exists($file)) return [];
        $data = json_decode(file_get_contents($file), true);
        $list = [];
        foreach ($data as $item) {
            $list[] = new Sale($item['id'], $item['client'], $item['product'], $item['quantity'], $item['unit_price'], $item['date']);
        }
        return $list;
    }

    public static function saveAll(array $sales) {
        $file = __DIR__ . '/../../storage/sales.json';
        $arr = array_map(function($s){ return [
            'id'=>$s->id,'client'=>$s->client,'product'=>$s->product,'quantity'=>$s->quantity,'unit_price'=>$s->unit_price,'date'=>$s->date
        ]; }, $sales);
        file_put_contents($file, json_encode($arr, JSON_PRETTY_PRINT));
    }
}