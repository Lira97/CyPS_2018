#include "cesar.h"

int main()
{
    string text="ABCDEFGHIJKLMNOPQRSTUVWXYZ", otra = "THISISCOMPLICATED", otra2 = "THISISEASY";
    int s = 3;
    cout << "Text : " << text;
    cout << "\nShift: " << s;
    cout << "\nCipher: " << encrypt(text, s) << endl << endl;

    return 0;
}
