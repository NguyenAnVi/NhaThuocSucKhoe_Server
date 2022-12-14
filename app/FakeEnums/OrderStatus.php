<?php 
namespace App\FakeEnums;

use App\FakeEnums\FakeEnum;

class OrderStatus extends FakeEnum
{
  const PENDING = 'Đang xác nhận';
  const PROCESSING = 'Chờ xử lý';
  const DELIVERING = 'Đang vận chuyển';
  const DELIVERED = 'Đã giao hàng';

  const CANCELLED_BY_SHOP = 'Đã hủy bởi cửa hàng';
  const CANCELLED_BY_USER = 'Đã hủy bởi khách hàng';

}