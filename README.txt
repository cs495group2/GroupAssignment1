
CS 495 Introduction to Cryptography Group 2
Group Assignment 1: G2GA1 Cipher

Group Members: Aaron Dutton, Chris Spillers, Cyndi Motley, Sudhir Regmi, Ka Fung
================================================================================

Group2's cipher design for Group Assignment 1 is called the G2GA1 Cipher.

The G2GA1 Cipher is a polygraphic substitution cipher that uses three rounds, 
 three keys, a key derivation function, and a stochastic algorithm to 
 encrypt/decrypt messages.


Design
--------------------------------------------------------------------------------

The documentation/description of the G2GA1 Cipher is located in Design.txt


Implementation
--------------------------------------------------------------------------------

The G2GA1 Cipher is implemented in the general-purpose programming language PHP.

The PHP script is designed to run with any installation of PHP that includes the
 CLI SAPI of version >= 5.3.x.

The script file for the G2GA1 Cipher is located in src/g2ga1.


Security
--------------------------------------------------------------------------------

If the version of the PHP running g2ga1 is >= 5.5.x, then the script
 will automatically reset it's title to conceal command line arguments from 
 users that can view the process status (thus listing k1, k2, and k3.)

For users running g2ga1 with older versions of PHP it is recommended to run the
 script with the -H or --hide-args flag.


Performance
--------------------------------------------------------------------------------

Empirical performance data gathered from running g2ga1, with the PHP CLI SAPI 
 5.3.x, on the ODU CS Department's Soalris infrastructure.

Testing arguments:

message file:	src/message_test.txt (3.9K)
k1 file:		src/k1_test.txt (581K)
k2 value:		C01F
k3 string:		K3SECRET

Encryption command:

> ./g2ga1 ./message_test.txt ./k1_test.txt C01F K3SECRET E > ./encMessage.txt

KDF duration:				0.291 (s)
Round1 duration:			1.724 (s)
Round2 duration:			0.142 (s)
Round3 duration:			0.152 (s)
Total encryption duration:	2.309 (s)
Peak memory used:			94234512 (bytes)

Decryption command:

> ./g2ga1 ./encMessage.txt ./k1_test.txt C01F K3SECRET D

KDF duration:				0.293 (s)
Round1 duration:			0.157 (s)
Round2 duration:			0.091 (s)
Round3 duration:			1.246 (s)
Total decryption duration:	1.788 (s)
Peak memory used:			75884136 (bytes)


Running
--------------------------------------------------------------------------------

On Unix and GNU/Linux based systems:

 > ./g2ga1 [args...]
OR
 > php g2ga1 [args...]
 > php -H -f g2ga1 -- [args...]

Microsoft based systems:

 x:\path\to\php.exe g2ga1 [args...]
OR
 x:\path\to\php.exe -H -f g2ga1 -- [args...]


Usage
--------------------------------------------------------------------------------

Usage: g2ga1 <message_file> <k1_file> <k2> <k3> <mode>

  <message_file>   The text file to be encrypted/decrypted.
  <k1_file>        The text file that contains the k1 key.
  <k2>             A numerical (base 16) value for the k2 key.
  <k3>             A string containing the letters for the k3 key.
  <mode>           Either 'E' for encryption, or 'D' for decryption.

Examples:
 To encrypt:
  ./g2ga1 /path/to/message /path/to/k1 C015 K3SECRET E > /path/to/encMessage

 To decrypt:
  ./g2ga1 /path/to/encMessage /path/to/k1 C015 K3SECRET D
