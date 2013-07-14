
CS 495 Introduction to Cryptography Group 2
G2GA1 Cipher

Group Members: Aaron Dutton, Chris Spillers, Cyndi Motley, Sudhir Regmi, Ka Fung
================================================================================

Notes:
1) Prevent Brute Force Attack
2) Stochastic Process

Requirements
Capabilities: The G2GA1 cipher will be able to encrypt and decrypt messages using
 stochastic algorithms.

Architecture/Design

Goals
- This cipher will use cryptography methods introduced prior to midterm.
- This cipher will defend against cryptanalysis methods introduced prior to 
   midterm.
- This cipher will encrypt and/or decrypt a message of no less than 1kB in less 
   than five minutes in real time.
- This cipher design will not include any binary operations
- This cipher design will not use any “known hard problems” from modern 
   cryptography.

Features
- This cipher will use a key derivation function is used to defend against 
   partial discovery keys.
- This cipher will latten letter frequency distribution to prevent plaintext 
   characterization leaking into the ciphertext.
- This cipher will use injective mapping between the message’s plaintext and 
   glyphs to force any autocorrelation to zero.
- This cipher will use a stochastic approach to ensure that brute force attacks
   will fail (the same message or keys will not produce the same ciphertext.


Key Derivation Function (KDF)
--------------------------------------------------------------------------------

- The KDF generates a matrix using the characters from the first key as entries
- The number of columns in this matrix is determined by the second key.
- The number of rows in this matrix is dependent upon the second key and the 
   length of the message.
- If the length of the message for the cipher is not divisible by the value of 
   the second key, the final row of the message will be padded by the required 
   amount of characters from the beginning of the key in order to make the 
   length of the message for the cipher divisible by the second key.
- During encryption of a message, the KDF will verify that the first key 
   contains at least one occurrence of each character in the alphabet in the 
   message so that the function mapping of characters to the first key is 
   surjective.


Encryption
--------------------------------------------------------------------------------

- All string data is processed in monocase English
- The message is a string containing the plaintext to encrypt
- k1 is the string containing the first key
- k2 is an integer containing the second key where 0 < k2 <= length of k1
- k3 is a string containing the passphrase used to encrypt the encoded

Round I: “Stochastic Plaintext Mapping”
- In round one, the encryption algorithm maps each character from the plaintext 
   message to an entry in the matrix generated from the KDF.
- Ordered Pair (Row, Column) from the n’th ocurrence 

Round II: “Coordinate Encoding”
- The ordered pairs string from Round 1 will be encoded where 0-9 is mapped to 
   A-J respectively.
- All commas will be mapped to a random character between K-Z by a random 
   number generator.

Round III: “Vigenere Cipher Encryption"
- Round III encrypts the string generated from the encRound2 function with k3 to
   produce the resulting output for the encryption algorithm.


Decryption
--------------------------------------------------------------------------------

Round I - “Vigenere Cipher Decryption” ; Function decRound1(cipher text, k3)
- Round I decrypts the ciphertext with the third key, k3 to produce ordered pair
   strings used in round 2.

Round II - “Coordinate Decoding” ; decRound2(encodedOrderedPairs)
- Characters “A-J” will be decoded to “0-9” respectively.
- Any character from K-Z will be decoded as a “,”.

Round III - “Plaintext LookUp” ; Function: decRound3(orderedpairs)
- Round 3 processes the strings of ordered pairs produced by round 2.
- Each ordered pair is processed to the corresponding plaintext character.
- The plaintext characters are appended to a string this becomes the output of
   the decryption algorithm.


G2GA1 Usage
--------------------------------------------------------------------------------

Usage: g2ga1 <message_file> <k1_file> <k2> <k3> <mode>

  <message_file>   The text file to be encrypted/decrypted.
  <k1_file>        The text file that contains the k1 key.
  <k2>             A numerical (base 16) value for the k2 key.
  <k3>             A string containing the letters for the k3 key.
  <mode>           Either 'E' for encryption, or 'D' for decryption.

Examples:
 To encrypt:
  ./g2ga1 /path/to/message /path/to/k1 C015 K3SECRET E

 To decrypt:
  ./g2ga1 /path/to/message /path/to/k1 C015 K3SECRET D
