<?php

use PHPUnit\Framework\TestCase;
require_once dirname(__DIR__) . '/InvoiceCalculator.php';
class InvoiceCalculatorTest extends TestCase {

    private $invoiceCalculator;

    protected function setUp(): void {
        $this->invoiceCalculator = new InvoiceCalculator();
    }

    // 正常なアイテムの追加と合計値のテスト
    public function testCalculateTotal() {
        //　商品を追加
        $this->invoiceCalculator->addItem('Apple', 100);
        $this->invoiceCalculator->addItem('Banana', 200);

        //　追加した商品の合計値
        $total = $this->invoiceCalculator->calculateTotal();
        $this->assertEquals(300, $total);
    }


    // 有効な割引コードを適応し、割引が正しいかのテスト
    public function testApplyDiscount() {
         
        $this->invoiceCalculator->addItem('melon', 2000);

        //　10％割引コードを適応
        $discountedTotal = $this->invoiceCalculator->applyDiscount('DISCOUNT10');
        $this->assertEquals(1800, $discountedTotal);

        //　20％割引コードを適応
        $discountedTotal = $this->invoiceCalculator->applyDiscount('DISCOUNT20');
        $this->assertEquals(1600, $discountedTotal);
    }

    // 無効な割引コードを使用した場合
    public function testApplyInvalidDiscount() {
        $this->invoiceCalculator->addItem('A', 100);
        $this->expectException(\Exception::class);
        $this->invoiceCalculator->applyDiscount('INVALID');
    }
}
?>