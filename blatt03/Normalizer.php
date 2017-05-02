<?php

namespace Sheet03;

/**
 * Interface Normalizer
 * @package Sheet04
 *
 * Transforms data between array representation and object representation.
 */
interface Normalizer
{
//    public function normalize($serializable): array;

    /**
     * Transforms a given array into a corresponding object.
     *
     * @param array $data
     * @return mixed
     */
    public function denormalize(array $data);
}
