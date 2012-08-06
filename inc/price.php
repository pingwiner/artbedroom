<?php

function getUserPrice($product) {
  $result = $product['price'] * 1.2;
  $result = ceil($result);
  return intval($result);
}