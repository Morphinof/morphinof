<?php

namespace CoreBundle\Twig;

use Doctrine\ORM\EntityManager;

/**
 * A TWIG Extension providing various tools
 */
class ToolsExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    private $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function getFilters()
    {
        return array
        (
            new \Twig_SimpleFilter('age', array($this, 'age')),
            new \Twig_SimpleFilter('amount', array($this, 'amountFormat')),
            new \Twig_SimpleFilter('amount_short', array($this, 'amountShortFormat')),
            new \Twig_SimpleFilter('phone', array($this, 'phoneFormat')),
            new \Twig_SimpleFilter('siret', array($this, 'siretFormat')),
            new \Twig_SimpleFilter('iban', array($this, 'ibanFormat')),
            new \Twig_SimpleFilter('b64_encode', array($this, 'b64Encode')),
            new \Twig_SimpleFilter('b64_decode', array($this, 'b64Decode')),
        );
    }

    public function getFunctions()
    {
        return array
        (
            new \Twig_SimpleFunction('is_instance_of', array($this, 'isInstanceOf')),
            new \Twig_SimpleFunction('number_format', array($this, 'numberFormat')),
        );
    }

    /**
     * Php instance of
     *
     * @param $object
     * @param $instance
     * @return bool
     */
    public function isInstanceof($object, $instance)
    {
        return ($object instanceof $instance);
    }

    /**
     * number_format
     *
     * @param $number
     * @param int $precision
     * @param string $decSeparator
     * @param string $thousandSeparator
     * @return string
     */
    public function numberFormat($number, $precision = 0, $decSeparator = ',', $thousandSeparator = ' ')
    {
        if (is_null($number)) return null;

        return number_format($number, $precision, $decSeparator, $thousandSeparator);
    }

    /**
     * Calculate age
     *
     * @param \DateTime $birthDate
     * @return int
     */
    public function age(\DateTime $birthDate)
    {
        return $birthDate->diff(new \DateTime('now'))->y;
    }

    /**
     * Format number to an amount
     *
     * @param $number
     * @param int $precision
     * @param null $currency
     * @param string $decSeparator
     * @param string $thousandSeparator
     * @return null|string
     */
    public function amountFormat($number, $precision = 2, $currency = null, $decSeparator = ',', $thousandSeparator = ' ')
    {
        if (is_null($number)) return null;

        return number_format($number, $precision, $decSeparator, $thousandSeparator).(!is_null($currency) ? ' '.$currency : '');
    }

    /**
     * Short version of format amount
     *
     * @param $number
     * @param null $currency
     * @return string
     */
    public function amountShortFormat($number, $currency = null)
    {
        if (is_null($number)) return null;

        return number_format($number, 0, ',', ' ').(!is_null($currency) ? ' '.$currency : '');
    }

    /**
     * Format a string to a phone format
     *
     * @param $string
     * @return string
     */
    public function phoneFormat($string)
    {
        if (is_null($string)) return null;

        return chunk_split($string, 2, ' ');
    }

    /**
     * Format a string to a siret format
     *
     * @param $string
     * @return string
     */
    public function siretFormat($string)
    {
        if (is_null($string)) return null;

        return chunk_split($string, 3, ' ');
    }

    /**
     * Format a string to an iban format
     *
     * @param $string
     * @return string
     */
    public function ibanFormat($string)
    {
        if (is_null($string)) return null;

        return substr($string, 0, 2).' '.chunk_split(substr($string, 3, strlen($string)), 4, ' ');
    }

    /**
     * Returns the string b64 encoded
     *
     * @param $string
     * @return string
     */
    public function b64Encode($string)
    {
        if (is_null($string)) return null;

        return base64_encode($string);
    }

    /**
     * Returns the string b64 decoded
     *
     * @param $string
     * @return string
     */
    public function b64Decode($string)
    {
        if (is_null($string)) return null;

        return base64_decode($string);
    }

    public function getName()
    {
        return 'core_bundle_tools_extension';
    }
}