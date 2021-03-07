<?php

namespace App\Invoices;

use LaravelDaily\Invoices\Invoice;
use Illuminate\Support\Facades\App;
use Symfony\Polyfill\Intl\Icu\NumberFormatter;
use LaravelDaily\Invoices\Traits\CurrencyFormatter;

/**
 * Class Invoices
 * @package LaravelDaily\Invoices
 */
class Bill extends Invoice
{
    use CurrencyFormatter;
    /**
     * @param float $amount
     * @param string|null $locale
     * @return string
     */
    public function getAmountInWords(float $amount, ?string $locale = null)
    {
        $amount = number_format($amount, $this->currency_decimals, '.', '');
        $formatter = new NumberFormatter($locale ?? App::getLocale(), NumberFormatter::SPELLOUT);

        $value = explode('.', $amount);

        $integer_value = (int) $value[0] !== 0 ? $formatter->format($value[0]) : 0;
        $fraction_value = isset($value[1]) ? $formatter->format($value[1]) : 0;

        if ($this->currency_decimals <= 0) {
            return sprintf('%s %s', ucfirst($integer_value), strtoupper($this->currency_code));
        }

        return sprintf(
            '%s %s et %s %s',
            ucfirst($integer_value),
            $this->currency_code,
            $fraction_value,
            $this->currency_fraction
        );
    }
    /**
     * @param null
     * @return string
     */
    public function getAmounttc()
    {
        $amount = number_format($amount, $this->currency_decimals, '.', '');
        $formatter = new NumberFormatter($locale ?? App::getLocale(), NumberFormatter::SPELLOUT);

        $value = explode('.', $amount);

        $integer_value = (int) $value[0] !== 0 ? $formatter->format($value[0]) : 0;
        $fraction_value = isset($value[1]) ? $formatter->format($value[1]) : 0;

        if ($this->currency_decimals <= 0) {
            return sprintf('%s %s', ucfirst($integer_value), strtoupper($this->currency_code));
        }

        return sprintf(
            '%s %s et %s %s',
            ucfirst($integer_value),
            $this->currency_code,
            $fraction_value,
            $this->currency_fraction
        );
    }
}
