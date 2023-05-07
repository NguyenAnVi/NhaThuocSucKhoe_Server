<?php
return [
  'accesspermission' => [
    'customer' => '<span class="uk-text-bold">CUSTOMER</span><table><tr><td class="uk-align-top">✅</td><td></td></tr><tr><td>❎</td><td>Non-Administrator</td></tr></table>',
    'admin' => '<span class="uk-text-bold">AMDIN SYSTEM</span><table><tr><td class="uk-align-top">✅</td><td>Almost access<table class="uk-width-1-1"><tr><td>✅</td><td>Products Manager</td></tr><tr><td>✅</td><td>Orders Manager</td></tr></table></td></tr><tr><td>❎</td><td>Cannot access Customer\'s pages</td></tr></table>',
    'root' => '<span class="uk-text-bold">ROOT</span><table><tr><td class="uk-align-top">✅</td><td>All access</td></tr><tr><td class="uk-align-top">❎</td><td>Cannot access Customer\'s pages</td></tr></table>'
  ]
];