<?php
class InvoiceCalculator {
    private $items = [];

    public function addItem($item, $price) {
        $this->items[$item] = $price;
    }

    public function calculateTotal() {
        return array_sum($this->items);
    }

    public function applyDiscount($discountCode) {
        if($discountCode == 'DISCOUNT10') {
            $total = $this->calculateTotal();
            return $total * 0.9;
        } elseif ($discountCode == 'DISCOUNT20') {
            $total = $this->calculateTotal();
            return $total * 0.8;
        }
        throw new Exception("Invalid discount code");
    }
}