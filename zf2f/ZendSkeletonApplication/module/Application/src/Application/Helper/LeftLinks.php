<?php
/**
 * The Market LeftLinks Helper Class
 *
 * Filename: LeftLinks.php
 * Created for: zf2fmyexamples.
 * Engineer: Daryl Wood <daryl@datashuttle.net>
 */

namespace Application\Helper;

use Zend\View\Helper\AbstractHelper;

class LeftLinks extends AbstractHelper
{
    public function __invoke(array $categories, $urlPrefix)
    {
        $output = '<ul>';
        foreach ($categories as $item) {
            $output .= "<li><a href=\"{$urlPrefix}/{$item}\">$item</a></li>";
        }
        $output .= '</ul>';
        return $output;
    }
}