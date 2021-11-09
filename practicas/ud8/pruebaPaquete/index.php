<?php

/**
 * Genera un PDF
 *
 * @author    Mi pare <mipare@jiaro.org>
 * @copyright 2021 Mi pare
 * @license   GPL-3 https://www.gnu.org/licenses/gpl-3.0.en.html
 */

use Mpdf\Mpdf;

require 'vendor/autoload.php';

$mpdf = new Mpdf();

$html = <<<EOT
    <table border="1">
        <thead>
            <th>Cabesa</th>
        </thead>
        <tbody>
            <tr>
                <td>Pare k paza?</td>
            </tr>
        </tbody>
    </table>
EOT;

$mpdf->WriteHTML($html);
$mpdf->Output();
