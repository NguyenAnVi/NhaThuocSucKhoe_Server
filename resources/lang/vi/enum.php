<?php
return [
  'accesspermission' => [
    'customer' => '<span class="uk-text-bold">Truy cập với tư cách là Khách hàng</span><table><tr><td class="uk-align-top">✅</td><td>Thao tác trên tất cả các chức năng của trang khách hàng</td></tr><tr><td>❎</td><td>Không truy cập được trang quản lý</td></tr></table>',
    'admin' => '<span class="uk-text-bold">Truy cập với tư cách là Quản lý hệ thống</span><table><tr><td class="uk-align-top">✅</td><td>Thao tác trên hầu hết các chức năng của trang quản lý<table class="uk-width-1-1"><tr><td>✅</td><td>Sản phẩm</td></tr><tr><td>✅</td><td>Hóa đơn</td></tr></table></td></tr><tr><td>❎</td><td>Không thực hiện được một số chức năng của Khách hàng (Đặt đơn hàng)</td></tr></table>',
    'root' => '<span class="uk-text-bold">Truy cập với tư cách là Quản trị hệ thống</span><table><tr><td class="uk-align-top">✅</td><td>Thao tác trên tất cả các chức năng của trang quản lý</td></tr><tr><td class="uk-align-top">❎</td><td>Không thực hiện được một số chức năng của Khách hàng (Đặt đơn hàng)</td></tr></table>'
  ]
];