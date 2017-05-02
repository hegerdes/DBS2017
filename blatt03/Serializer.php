<?php

namespace Sheet03;

include_once("Encoder.php");
include_once("Normalizer.php");

/**
 * Class Serializer
 * @package Sheet04
 *
 * Transforms data between several file formats (e.g. CSV, XML) and their corresponding objects.
 */
abstract class Serializer
{
    /**
     * Transforms a datum into a corresponding object.
     *
     * @param string $data
     * @return mixed
     */
    public function deserialize(string $data)
    {
        $encoder = $this->getEncoder();
        $normalizer = $this->getNormalizer();

        $array = $encoder->decode($data);
        $object = $normalizer->denormalize($array);

        return $object;
    }

    /**
     * @return Normalizer
     */
    abstract protected function getNormalizer(): Normalizer;

    /**
     * @return Encoder
     */
    abstract protected function getEncoder(): Encoder;
}
