#include "gtest/gtest.h"
#include "vigenere.h"

string str = "GEEKSFORGEEKS", keyword = "AYUSH", key = "AYUSHAYUSHAYU", cipher_text = "GCYCZFMLYLEIM";

namespace {
  TEST(VigenereTest, FullEncription) {
    EXPECT_EQ(key, generateKey(str, keyword));
    cout << "It generate the correct key\n..." << endl;

    EXPECT_EQ(cipher_text, cipherText(str, key));
    cout << "It make the correct cipher\n..." << endl;

    EXPECT_EQ(str, originalText(cipher_text, key));
    cout << "It returns to the real text\n..." << endl;
  }
}
