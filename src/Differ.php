<?php

namespace Src\genDiff;


function сompare ($json1, $json2)
{
    $json1 = json_decode(file_get_contents('file1.json'), true);
    $json2 = json_decode(file_get_contents('file2.json'), true);
    $result = [];
    $result2 = [];
    foreach ($json1 as $key => $value) {
    
      if (array_key_exists($key, $json2) && $value === $json2[$key]) {
        $result[$key ] = $value;
      } if (array_key_exists($key, $json2) && $value !== $json2[$key]) {
        $result['- ' . $key ] = $value;
        
      } if (!array_key_exists($key, $json2)) {
        $result['- ' . $key ] = $value;
        
      }
    }
    foreach ($json2 as $key => $value) {
      if (array_key_exists($key, $json1) && $value === $json1[$key]) {
        $result2[$key ] = $value;
      } if (array_key_exists($key, $json1) && $value !== $json1[$key]) {
        $result2['+ ' . $key ] = $value;
      } if (!array_key_exists($key, $json1)) {
        $result2['+ ' . $key ] = $value;
      } 
    } 
    $merge = (array_merge($result, $result2));
    return ($merge);
}
