<?php
namespace  CS495Group2\G2GA1;

class G2GA1Cipher
{
    // Monocase English alpahbet lenght
    const MODULUS = 26;
    // Holds matrix generated by KDF
    private $matrix;


/* G2GA1 Cryptographic Primitives
============================================================================= */

    // G2GA1 encryption
    public function encrypt($plainText, $k1, $k2, $k3)
    {
        // Run KDF function using k1 and k2
        $this->kdf($k1, $k2);

        // Generate ordered pairs string
        $orderedPairs = $this->encRound1($plainText);

        // Encode ordered pairs string
        $orderedPairsEncoded = $this->encRound2($orderedPairs);

        // Encrypt the encoded ordered pairs string with Vigenere Cipher
        $cipherText = $this->encRound3($orderedPairsEncoded, $k3);

        return $cipherText;
    }

    // G2GA1 decryption
    public function decrypt($cipherText, $k1, $k2, $k3)
    {
        // Run KDF function using k1 and k2
        $this->kdf($k1, $k2);

        // Decrypt the encoded ordered pairs string with Vigenere Cipher
        $orderedPairsEncoded = $this->decRound1($cipherText, $k3);

        // Decode the ordered pairs string
        $orderedPairs = $this->decRound2($orderedPairsEncoded);

        // Lookup the origional plaintext from the ordered pairs string
        $plainText = $this->decRound3($orderedPairs);

        return $plainText;
    }

    // G2GA1 key derivation function
    private function kdf($k1, $k2)
    {
        // Store modified k1 key in $this->matrix

        // TODO: Code me!
    }


/* Encryption Rounds
============================================================================= */

    // Encryption Round 1 - Stochastic plaintext mapping
    private function encRound1($plainText)
    {
        $orderedPairs = '';

        // TODO: Code me!

        return $orderedPairs;
    }

    // Encryption Round 2 - Coordinate encoding
    private function encRound2($orderedPairs)
    {
        $orderedPairsEncoded = '';

        $len = strlen($orderedPairs);
         for($i=0; $i<=$len; $i++){
             // Evaluate each character in the string of ordered pairs
             switch ($orderedPairs[$i]){
                // Convert 0-9 to letters A-J
                case "0":
                    $orderedPairsEncoded = $orderedPairsEncoded."A";
                    break;
                case "1":
                    $orderedPairsEncoded = $orderedPairsEncoded."B";
                    break;
                case "2":
                    $orderedPairsEncoded = $orderedPairsEncoded."C";
                    break;
                case "3":
                    $orderedPairsEncoded = $orderedPairsEncoded."D";
                    break;
                case "4":
                    $orderedPairsEncoded = $orderedPairsEncoded."E";
                    break;
                case "5":
                    $orderedPairsEncoded = $orderedPairsEncoded."F";
                    break;
                case "6":
                    $orderedPairsEncoded = $orderedPairsEncoded."G";
                    break;
                case "7":
                    $orderedPairsEncoded = $orderedPairsEncoded."H";
                    break;
                case "8":
                    $orderedPairsEncoded = $orderedPairsEncoded."I";
                    break;
                case "9":
                    $orderedPairsEncoded = $orderedPairsEncoded."J";
                    break;
                case ",":
                    // Convert commas to random letters K-Z
                    switch (rand(10, 25)){
                        case "10":
                            $orderedPairsEncoded = $orderedPairsEncoded."K";
                            break;
                        case "11":
                            $orderedPairsEncoded = $orderedPairsEncoded."L";
                            break;
                        case "12":
                            $orderedPairsEncoded = $orderedPairsEncoded."M";
                            break;
                        case "13":
                            $orderedPairsEncoded = $orderedPairsEncoded."N";
                            break;
                        case "14":
                            $orderedPairsEncoded = $orderedPairsEncoded."O";
                            break;
                        case "15":
                            $orderedPairsEncoded = $orderedPairsEncoded."P";
                            break;
                        case "16":
                            $orderedPairsEncoded = $orderedPairsEncoded."Q";
                            break;
                        case "17":
                            $orderedPairsEncoded = $orderedPairsEncoded."R";
                            break;
                        case "18":
                            $orderedPairsEncoded = $orderedPairsEncoded."S";
                            break;
                        case "19":
                            $orderedPairsEncoded = $orderedPairsEncoded."T";
                            break;
                        case "20":
                            $orderedPairsEncoded = $orderedPairsEncoded."U";
                            break;
                        case "21":
                            $orderedPairsEncoded = $orderedPairsEncoded."V";
                            break;
                        case "22":
                            $orderedPairsEncoded = $orderedPairsEncoded."W";
                            break;
                        case "23":
                            $orderedPairsEncoded = $orderedPairsEncoded."X";
                            break;
                        case "24":
                            $orderedPairsEncoded = $orderedPairsEncoded."Y";
                            break;
                        case "25":
                            $orderedPairsEncoded = $orderedPairsEncoded."Z";
                            break;
                        }
                }
            }

        return $orderedPairsEncoded;
    }

    // Encryption Round 3 - Vigenère Cipher encryption
    private function encRound3($orderedPairsEncoded, $k3)
    {
        // Process key
        for ($i = 0; $i < strlen($k3); $i++) {
            $key[$i] = ord(strtoupper(substr($k3, $i, 1))) - 65;
        }

        // Process encoded ordered pairs string
        $row = 0;
        for ($i = 0; $i < strlen($orderedPairsEncoded); $i++) {
            // Move to the next row when index is a multiple of the key
            if ($i > 0 && $i % count($key) == 0) {
                ++$row;
            }
            // Store each plaintext character in matrix entry in decimal format
            $plainTextMatrix[$row][] = ord(
                strtoupper(substr($orderedPairsEncoded, $i, 1))
            )-65;
        }

        // Encrypt plaintext
        foreach ($plainTextMatrix as $column) {
            for ($i = 0; $i < count($column); $i++) {
                $cipherCharDec = ($column[$i] + $key[$i]) % self::MODULUS;
                // No negative cipher characters in decimal format
                while ($cipherCharDec < 0) {
                    $cipherCharDec += self::MODULUS;
                }
                $cipherText .= chr($cipherCharDec + 65);
            }
        }

        return $cipherText;
    }


/* Decryption Rounds
============================================================================= */

    // Decryption Round 1 - Vigenère Cipher decryption
    private function decRound1($cipherText, $k3)
    {
        // Process key
        for ($i = 0; $i < strlen($k3); $i++) {
            $key[$i] = ord(strtoupper(substr($k3, $i, 1))) - 65;
        }

        // Process ciphertext
        $row = 0;
        for ($i = 0; $i < strlen($cipherText); $i++)
        {
            if ($i > 0 && $i % count($key) == 0)
            {
                ++$row;
            }
            $cipherTextMatrix[$row][] = ord(
                strtoupper(substr($cipherText, $i, 1))
            )-65;
        }

        // Decrypt ciphertext
        foreach ($cipherTextMatrix as $column) {
            for ($i = 0; $i < count($column); $i++) {
                $plainCharDec = ($column[$i] - $key[$i]) % self::MODULUS;
                while ($plainCharDec < 0) {
                    $plainCharDec += self::MODULUS;
                }
                $orderedPairsEncoded .= chr($plainCharDec + 65);
            }
        }

        return $orderedPairsEncoded;
    }

    // Decryption Round 2 - Coordinate decoding
    private function decRound2($orderedPairsEncoded)
    {
        $orderedPairs = '';

        $len = strlen($orderedPairsEncoded);
        for($i=0; $i<=$len; $i++){
            // Evaluate each lettter in the encoded string
            switch ($orderedPairsEncoded[$i]){
                // Convert letters A-J to numerals 0-9
                case "A":
                    $orderedPairs = $orderedPairs."0";
                    break;
                case "B":
                    $orderedPairs = $orderedPairs."1";
                    break;
                case "C":
                    $orderedPairs = $orderedPairs."2";
                    break;
                case "D":
                    $orderedPairs = $orderedPairs."3";
                    break;
                case "E":
                    $orderedPairs = $orderedPairs."4";
                    break;
                case "F":
                    $orderedPairs = $orderedPairs."5";
                    break;
                case "G":
                    $orderedPairs = $orderedPairs."6";
                    break;
                case "H":
                    $orderedPairs = $orderedPairs."7";
                    break;
                case "I":
                    $orderedPairs = $orderedPairs."8";
                    break;
                case "J":
                    $orderedPairs = $orderedPairs."9";
                    break;
                // Convert any other letter to a comma
                default:
                    $orderedPairs = $orderedPairs.",";
                    break;
            }
          }

        return $orderedPairs;
    }

    // Decryption Round 3 - Plaintext lookup
    private function decRound3($orderedPairs)
    {
        $plainText = '';

        // TODO: Code me!

        return $plainText;
    }
}