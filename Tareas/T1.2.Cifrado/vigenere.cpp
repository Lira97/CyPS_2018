#include "vigenere.h"

int main()
{
    string str = "GEEKSFORGEEKS";
    string keyword = "AYUSH";

    string key = generateKey(str, keyword);
    string cipher_text = cipherText(str, key);

    cout << "Ciphertext : "
         << cipher_text
         << endl;
    cout << "Key : "
         << key
         << endl;
    cout << "Original/Decrypted Text : "
         << originalText(cipher_text, key)
         << endl;
    return 0;
}
