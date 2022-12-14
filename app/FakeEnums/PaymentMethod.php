<?php 
namespace App\FakeEnums;

use App\FakeEnumS\FakeEnum;

class PaymentMethod extends FakeEnum
{
  const COD = 'Thanh toán khi nhận hàng';
  const CREDIT = 'Thanh toán bằng thẻ tín dụng';
}