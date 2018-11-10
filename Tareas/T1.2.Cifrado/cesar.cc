#include "gtest/gtest.h"
#include "cesar.h"

string text = "ABCDEFGHIJKLMNOPQRSTUVWXYZ", otra = "THISISCOMPLICATED", otra2 = "THISISEASY";

namespace {

  TEST(CesarTest, DiferentShifts) {
    EXPECT_EQ("DEFGHIJKLMNOPQRSTUVWXYZABC", encrypt(text, 3));
    EXPECT_EQ("IJKLMNOPQRSTUVWXYZABCDEFGH", encrypt(text, 8));
  }

  TEST(CesarTest, DiferentStrings) {
    EXPECT_EQ("WKLVLVFRPSOLFDWHG", encrypt(otra, 3));
    EXPECT_EQ("WKLVLVHDVB", encrypt(otra2, 3));
  }

}
