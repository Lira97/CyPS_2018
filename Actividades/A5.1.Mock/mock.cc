#include <iostream>
#include "gtest/gtest.h"
#include "gmock/gmock.h"

using namespace std;
using ::testing::AtLeast;
using ::testing::Return;
using ::testing::_;

class DataBaseConnect{
public:
  virtual bool login(string username,string password){return true;}
  virtual bool logout(string username){return true;}
  virtual int fetchRecord(){return -1 ;}
};

class MyDatabase{
  DataBaseConnect & dbConnect;
public:
  MyDatabase(DataBaseConnect & _dbC): dbConnect(_dbC){}
  int Init(string uname,string passwd)
  {
    if (dbConnect.login(uname,passwd) != true)
    {
      cout<<"Failed to connect >>>>>"<<endl;
      return -1;
    }else
    {
      cout<<"Successful Connection>>>>>>>"<< endl;

      return 1;
    }

  }

  int Init2(string uname)
  {
    if (dbConnect.logout(uname) != true)
    {
      cout<<"Failed to logout >>>>>"<<endl;
      return -1;
    }else
    {
      cout<<"Successful logout>>>>>>>"<< endl;

      return 1;
    }

  }
  int Init3()
  {
    if (dbConnect.fetchRecord() != 1)
    {
      cout<<"Failed fetch >>>>>"<<endl;
      return -1;
    }else
    {
      cout<<"Successful fetch >>>>>>>"<< endl;

      return 1;
    }

  }
};
class MockDB : public DataBaseConnect{
public:
  MOCK_METHOD0(fetchRecord,int());
  MOCK_METHOD1(logout,bool(string uname));
  MOCK_METHOD2(login,bool(string uname,string passwd));
};

TEST(MyDBTest,LoginTest)
{
  MockDB mdb;
  MyDatabase db(mdb);
  EXPECT_CALL(mdb,login("usuario","password"))
  .Times(AtLeast(1))
  .WillOnce(Return(true));

  int retValue = db.Init("usuario","password");
  EXPECT_EQ(1,retValue);
}
TEST(MyDBTest,LogoutTest)
{
  MockDB mdb;
  MyDatabase db(mdb);
  EXPECT_CALL(mdb,logout("usuario"))
  .Times(AtLeast(1))
  .WillOnce(Return(true));

  int retValue = db.Init2("usuario");
  EXPECT_EQ(1,retValue);
}
TEST(MyDBTest,FetchTest)
{
  MockDB mdb;
  MyDatabase db(mdb);
  EXPECT_CALL(mdb,fetchRecord())
  .Times(AtLeast(1))
  .WillOnce(Return(true));

  int retValue = db.Init3();
  EXPECT_EQ(1,retValue);
}
int main(int argc,char **argv)
{
  testing::InitGoogleTest(&argc,argv);
  return RUN_ALL_TESTS();
}
