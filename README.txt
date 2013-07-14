
CS 495 Introduction to Cryptography Group 2
Group Assignment 1: G2GA1 Cipher

Group Members: Aaron Dutton, Chris Spillers, Cyndi Motley, Sudhir Regmi, Ka Fung
================================================================================

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
  ./g2ga1 /path/to/message /path/to/k1 C015 K3SECRET E > /path/to/encMessage

 To decrypt:
  ./g2ga1 /path/to/encMessage /path/to/k1 C015 K3SECRET D
