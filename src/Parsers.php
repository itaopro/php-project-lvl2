<?php

namespace Src\Parsers;

use Exception;
use Symfony\Component\Yaml\Yaml;

/**
 * @param string $type
 * @param string $content
 * @return array<mixed>
 */

function parse(string $type, string $content): array
{
    switch ($type) {
        case 'yml':
        case 'yaml':
            return Yaml::parse($content);
        case 'json':
            return json_decode($content, true);
        default:
            throw new Exception('Use can only type: .json, .yaml .yml');
    }
}
