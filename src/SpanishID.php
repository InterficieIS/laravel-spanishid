<?php

namespace Interficie\SpanishID;

class SpanishID
{
    public function isValidNif($documentId) : bool
    {
        return $this->isValidCif($documentId)
            || $this->isValidDni($documentId)
            || $this->isValidNie($documentId);
    }

    private function cifControlMatches($cif) : bool
    {
        $control = $cif[strlen($cif) - 1];
        $suma_A = 0;
        $suma_B = 0;

        for ($i = 1; $i < 8; $i++) {
            if ($i % 2 == 0) {
                $suma_A += intval($cif[$i]);
            } else {
                $t = (intval($cif[$i]) * 2);
                $p = 0;

                for ($j = 0; $j < strlen($t); $j++) {
                    $p += substr($t, $j, 1);
                }
                $suma_B += $p;
            }
        }

        $suma_C = (intval($suma_A + $suma_B))."";
        $suma_D = (10 - intval($suma_C[strlen($suma_C) - 1])) % 10;

        $letras = "JABCDEFGHI";

        if ($control >= "0" && $control <= "9") {
            return ($control == $suma_D);
        }

        return (strtoupper($control) == $letras[$suma_D]);
    }

    /**
     * Checks if the given string is a valid spanish company identification number.
     *
     * @param $cif
     * @return bool True if the given string is a valid company identification number
     *              or false otherwise.
     */
    public function isValidCif(string $cif) : bool
    {
        $regexes = [
            '/^[ABEH][0-9]{8}$/i',
            '/^[KPQS][0-9]{7}[A-J]$/i',
            '/^[CDFGJLMNRUVW][0-9]{7}[0-9A-J]$/i',
        ];

        foreach($regexes as $regex) {
            if (preg_match($regex, $cif)) {
                return $this->cifControlMatches($cif);
            }
        }

        return false;
    }

    /**
     * Checks if the given string is a valid spanish national identification number.
     *
     * @param $nif
     * @return bool True if the given string is a valid national identification number
     *              or false otherwise.
     */
    public function isValidDni(string $nif) : bool
    {
        $nifRegEx = '/^[0-9]{8}[A-Z]$/i';
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

        if (preg_match($nifRegEx, $nif)) {
            return $letras[(substr($nif, 0, 8) % 23)] === $nif[8];
        }

        return false;
    }

    /**
     * Checks if the given string is a valid spanish alien identification number.
     *
     * @param $nif
     * @return bool True if the given string is a valid alien identification number
     *              or false otherwise.
     */
    public function isValidNie(string $nif) : bool
    {
        $nieRegEx = '/^[KLMXYZ][0-9]{7}[A-Z]$/i';
        $letras = "TRWAGMYFPDXBNJZSQVHLCKE";

        if (preg_match($nieRegEx, $nif)) {

            $r = str_replace(['X', 'Y', 'Z'], [0, 1, 2], $nif);

            return ($letras[(substr($r, 0, 8) % 23)] == $nif[8]);
        }

        return false;

    }

    /**
     * Checks if the given string is a valid spanish Social Security Number
     *
     * @param $SSNumber
     * @return bool True if the given string is a valid social security number
     *              or false otherwise.
     */
    public function isValidNNSS(string $SSNumber) : bool
    {
        $SSNumberRegEx = '/^[0-9]{12}$/i';

        if (preg_match($SSNumberRegEx, $SSNumber)) {

            $na = substr($SSNumber, 0, 2);
            $nb = substr($SSNumber, 2, 8);
            $nc = substr($SSNumber, 10, 2);

            if($na && $nb && $nc) {

                if ($nb < 10000000){

                    $nd = $nb+$na*10000000;

                } else{

                    $nd = $na.$nb;

                }
                $validacion = $nd % 97;

                if ($validacion == $nc) {

                    return true;
                }
            }
        }

        return false;
    }
}