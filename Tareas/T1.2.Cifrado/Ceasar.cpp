#include "gtest/gtest.h"
#include <iostream>
#include <stdio.h>
#include <string>
#include <fstream>

using namespace std;

class Ceasar{
public:
  string msn;
  int key;
  string encrypt(string msn, int key);
  string decrypt(string msn, int key);
  string readFile(string file);
  string readConsole();
  void printResult(string msg, string ecr, string dec);
  string getMsn(){return msn;}
  int getKey(){return key;}
};

class myFixture : public ::testing::Test{
public:
  static void SetUpTestCase(){c = new Ceasar;}
  static void TearDownTestCase(){delete c;}
  virtual void SetUp() {cout << "SetUp"<<endl;}
  virtual void TearDown() {cout << "TearDown"<<endl;}
protected:
  static Ceasar* c;
};

Ceasar* myFixture::c = 0;


class myEnvironment : public ::testing::Environment{
public:
  void SetUp(){cout << "EnvSetUp"<<endl; ce = new Ceasar;}
  void TearDown(){cout << "EnvTearD"<<endl; delete ce;}
  static Ceasar* ce;
};

testing::Environment* const foo_en = testing::AddGlobalTestEnvironment(new myEnvironment);

Ceasar* myEnvironment::ce = 0;

class Values : public  ::testing::TestWithParam<int>{

};

TEST_F(myFixture, ecrypt_decrypt){
  string dcr, ecr;
  c->msn = c->readFile("diccionario.txt");
  c->key = 15;
  ecr = c->encrypt(c->getMsn(), 15);
  dcr = c->decrypt(ecr, 15);
  c->printResult(c->msn, ecr, dcr);
  ASSERT_STREQ(dcr.c_str(), c->getMsn().c_str());
}

TEST_F(myFixture, keyTest){
  ASSERT_EQ(c->getKey(), 15);
}

TEST_P(Values, multiplekey){
  int value = GetParam();
  ASSERT_EQ(value, 15);
}


INSTANTIATE_TEST_CASE_P(enteros, Values, ::testing::Values(5,10,15,20,25));

string Ceasar::readFile(string file){
  string msg;
  ifstream infile(file);
  string line;
  while (std::getline(infile, line)){
    msg += line;
  }
  return msg;
}


string Ceasar::readConsole(){
  string msg;
  int key;
  cout << "Write a message to encrypt: ";
  getline(cin, msg);
  return msg;
}

string Ceasar::encrypt(string msn, int key){
  unsigned char c;
  for(int i = 0; i < msn.size(); i++){
    if(msn[i] >= 'a' && msn[i] <= 'z'){
      c = msn[i] + key;
      if( c > 'z')
        c =   c - 'z' + 'a' - 1;
      msn[i] = c;
    }
    else if(msn[i] >= 'A' && msn[i] <= 'Z'){
      c = msn[i] + key;
      if(c > 'Z')
        c = c - 'Z' + 'A' - 1;
      msn[i] = c;
    }
  }
  return msn;
}

string Ceasar::decrypt(string msn, int key){
  unsigned char c;
  for(int i = 0; i < msn.size(); i++){
    if(msn[i] >= 'a' && msn[i] <= 'z'){
      c = msn[i] - key;
      if( c < 'a')
        c  =   c  + 'z' - 'a' + 1;
      msn[i] = c;
    }
    else if(msn[i] >= 'A' && msn[i] <= 'Z'){
      c = msn[i] - key;
      if(c < 'A')
        c = c + 'Z' - 'A' + 1;
      msn[i] = c;
    }
  }
  return msn;
}

void Ceasar::printResult(string msg, string ecr, string dec){
  cout << "Original message: " << msg << endl;
  cout << "Encrypted message: " << ecr << endl;
  cout << "Decrypted message: " << dec << endl;
}
