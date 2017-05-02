<?php

namespace Sheet03;

/**
 * Interface Encoder
 * @package Sheet04
 *
 * Transforms data between several file formats (e.g. CSV, XML) and arrays.
 */
interface Encoder
{
//    public function encode(array $data): string;

    /**
     * Transforms structured data into an array.
     *
     * @param string $data
     * @return array
     */
    public function decode(string $data): array;
}
