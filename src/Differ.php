<?php

namespace Differ\Differ;

use Exception;

use function Src\Parsers\parse;
use function Src\Formatters\format;
use function Src\Ast\buildAst;

/**
 * @param string $firstPath
 * @param string $secondPath
 * @param string $format
 * @return string
 */

function genDiff(string $firstPath, string $secondPath, string $format = 'stylish'): string
{
    $firstContent = getContent($firstPath);
    $secondContent = getContent($secondPath);
    $ast = buildAst($firstContent, $secondContent);
    return format($ast, $format);
}

 /**
  * @param string $path
  * @return array
  */

function getContent(string $content): array
{
    $path = getPath($content);
    $contents = file_get_contents($path);
    $type = pathinfo($path, PATHINFO_EXTENSION);
    if ($contents === false) {
        throw new Exception("Can't read file");
    }
    return parse($type, $contents);
}

/**
 * @param string $path
 * @return string
 */

function getPath(string $path): string
{
    if (strpos($path, '/') === 0) {
        return $path;
    }
    return __DIR__ . '/../' . $path;
}
