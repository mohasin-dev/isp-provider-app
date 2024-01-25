<?php

function price_format($value) {
    return number_format($value, 2, '.', '');
}

// function price_format($value) {
//     return '$' . number_format($value, 2, '.', '');
//   }
