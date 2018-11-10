#include "gtest/gtest.h"
#include <iostream>
#include <stdio.h>
#include <string>
#include <fstream>

using namespace std;

class Vigenere{
public:
  string msn, key, newKey, ecr, dcr;
  void generateKey();
  void encrypt();
  void decrypt();
  void readFile(string file);
  void readConsole();
  void printResult();
  string getMsn(){return msn;}
  string getKey(){return key;}
  string getNewKey(){return newKey;}
  string getEcr(){return ecr;}
  string getDcr(){return dcr;}
};

class myFixture : public ::testing::Test{
public:
  static void SetUpTestCase(){v = new Vigenere;}
  static void TearDownTestCase(){delete v;}
  virtual void SetUp() {cout << "SetUp"<<endl;}
  virtual void TearDown() {cout << "TearDown"<<endl;}
protected:
  static Vigenere* v;
};

Vigenere* myFixture::v = 0;


class myEnvironment : public ::testing::Environment{
public:
  void SetUp(){cout << "EnvSetUp"<<endl; ce = new Vigenere;}
  void TearDown(){cout << "EnvTearD"<<endl; delete ce;}
  static Vigenere* ce;
};

testing::Environment* const foo_en = testing::AddGlobalTestEnvironment(new myEnvironment);

Vigenere* myEnvironment::ce = 0;

class Values : public  ::testing::TestWithParam<string>{

};

TEST_F(myFixture, ecrypt_decrypt){
  string dcr, ecr;
  v->readFile("vin.txt");
  v->key = "key";
  v->generateKey();
  v->encrypt();
  v->decrypt();
  v->printResult();
  ASSERT_STREQ(v->getDcr().c_str(), v->getMsn().c_str());
}

TEST_F(myFixture, keyTest){
  ASSERT_STREQ(v->getKey().c_str(), "key");
}

TEST_P(Values, multiplekey){
  string value = GetParam();
  ASSERT_STREQ(value.c_str(), "key");
}


INSTANTIATE_TEST_CASE_P(enteros, Values, ::testing::Values("this","is","the","key","right?"));

void Vigenere::readFile(string file){
  ifstream infile(file);
  string line;
  while (std::getline(infile, line)){
    msn += line;
  }
}


void Vigenere::readConsole(){
  string msg;
  int key;
  cout << "Write a message to encrypt: ";
  getline(cin, msn);
}


void Vigenere::generateKey(){
  for(int i = 0, j = 0; i < msn.length(); ++i, ++j){
        if(j == key.length())
            j = 0;
        newKey += key[j];
    }
}

void Vigenere::encrypt(){
  for(int i = 0; i < msn.length(); ++i)
      ecr += ((msn[i] + newKey[i]) % 26) + 'A';
}

void Vigenere::decrypt(){
  for(int i = 0; i <  msn.length(); ++i)
    dcr += (((ecr[i] - newKey[i]) + 26) % 26) + 'A';
}

void Vigenere::printResult(){
  cout << "Original message: " << msn << endl;
  cout << "Encrypted message: " << ecr << endl;
  cout << "Decrypted message: " << dcr << endl;
}

